<?php

namespace App\Http\Controllers;

use App\Library\GetResponse;
use App\Library\NganLuong;
use App\Library\VNPay;
use App\Library\AlePayPayment;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Library\AlePay\Utils\AlepayUtils;
use App\Library\AlePay\Alepay;
class IndexController extends Controller {
	private $paymentService;
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct(VNPay $paymentService) {
		$this->paymentService = $paymentService;
	}

	public function index(Request $request) {
		$data = [
			'course' => $request->khoahoc,
			'sheet_id' => !empty($request->ggs) ? $request->ggs : '',
			'campaign' => $request->campaign,
			'amount' => $request->gia,
			'content' => $request->nd,
			'name' => $request->ten,
			'phone' => $request->dt,
			'email' => $request->email,
			'is_installment' => !empty($request->is_installment) ? $request->is_installment : '',
			'coupon' => !empty($request->coupon) ? $request->coupon : '',
		];
		if ($request->direct == 1) {
			return redirect(route('register', $data));
		}
		return view('index', $data);
	}

	public function register(Request $request) {
		$this->validate($request, [
			'amount' => 'required',
			'phone' => 'required',
			'email' => 'required|email',
		]);
		if ($this->inBlockedData(['name' => $request->name, 'email' => $request->email])) {
			return redirect('/');
		}
		$data = $request->only(['name', 'email', 'phone', 'content', 'amount', 'course', 'campaign', 'coupon', 'sheet_id']);
		$data['amount'] = str_replace(".", "", $data['amount']);
		$data['status'] = 0;
		$data['payment_complete_email_sent'] = 0;

		$data['transaction_code'] = time() . rand(10, 99);
		$transaction = \App\Transaction::create($data);
		if (!empty($data['sheet_id'])) {
			$this->insertRegisteredSheet($transaction);
		}
		if(!empty($request->installment)){
			return (new AlePayPayment())->handlePayment($data);
		}
		return redirect($this->paymentService->buildUrlCheckout($data));
	}

	/**
	 * [nganluongCallback description]
	 * @author thanhnm
	 * @param  Request $request
	 * @return [type]
	 */
	public function nganluongCallback(Request $request) {
		$returned_data = $request->only(['transaction_info', 'order_code', 'price', 'payment_id', 'payment_type', 'error_text', 'secure_code', 'payment_method']);

		$returned_data['transaction_info'] = !empty($returned_data['transaction_info']) ? $returned_data['transaction_info'] : '';
		if(empty($request->payment_method)){
			$is_verified_url = $this->paymentService->verifyPaymentUrl($returned_data);
			if (!$is_verified_url) {
				return false;
			}
		}
		else{
			$returned_data['order_code'] = !empty($request->order_code) ? $request->order_code : '';
			if(empty($request->payment_method)){
				$env          = env('APP_ENV');
				$config       = collect(config('payment.alepay.'.$env));
				$encryptKey = $config['encryptKey'];
				$alepay = new Alepay($config);
				$utils = new AlepayUtils();
				$result = $utils->decryptCallbackData($request->data, $encryptKey);
				$obj_data = json_decode($result, true);
				if(!empty($obj_data['errorCode'])){
					$returned_data['error_text'] = '';
					$returned_data['order_code_alepay'] = $obj_data['data'];
				}
				else{
					$returned_data['error_text'] = '-1';
				}
			}
			else{
				$returned_data['error_text'] = '-1';
			}
		}
		$data_to_update = [
			'status' => 1,
			'paid_date' => date('Y-m-d H:i:s'),
			'paid_via' => !empty($returned_data['payment_method']) ? 'Trả góp' : 'Ngan Luong',
			'note' => json_encode($returned_data),
		];

		if ($returned_data['error_text'] != '') {
			$data_to_update['status'] = -1;
		}
		$data_to_update['payment_complete_email_sent'] = 1;
		$transaction = \App\Transaction::updateOrCreate(['transaction_code' => $returned_data['order_code']], $data_to_update);
		
		//insert get response
		if ($transaction->campaign == 'khoi_nghiep_online_2018') {
			$this->insertGetResponse('regis_payment', $transaction->name, $transaction->email, 'IMG-' . $transaction->id, $transaction->phone, $transaction->amount);
			//sms free ticket
			$this->sms('payment', $transaction->phone);
		}

		//send mail admin
		$this->sendMailComplete($transaction, $returned_data['error_text']);
		if (!empty($transaction->sheet_id)) {
			$this->insertPaymentSheet($transaction);
		}

		if ($request->redirect) {
			return redirect($request->redirect);
		}
		if($data_to_update['status'] == -1){
			return redirect(route('payment.cancel'));
		}
		return redirect(route('payment.success'));
	}
	
	public function cancel() {
		return view('cancel');
	}

	public function success() {
		return view('success');
	}

	public function sendMailComplete($row, $error_text) {
		$body = [
			'Họ tên: ' . $row->name . '<br/>',
			'Email: ' . $row->email . '<br/>',
			'SDT: ' . $row->phone . '<br/>',
			'Số tiền: ' . number_format($row->amount) . ' đ<br/>',
			'Nội dung thanh toán: ' . $row->content . '<br/>',
			'Trạng thái: ' . (($row->status == 1) ? 'Thành công' : $error_text),
		];
		return $this->sendMailByMailgun(env('RECEIVE_EMAIL'), 'Support IMG', 'IMG-Thông báo thanh toán online pay.imgroup.vn - ' . $row->phone, implode('', $body));
	}

	public function buyTicket(Request $request) {
		if ($this->inBlockedData(['name' => $request->fullname, 'email' => $request->email])) {
			return redirect('/');
		}
		$data = $request->only([
			'fullname',
			'email',
			'phone',
			'coupon',
			'campaign',
			'content',
			'course',
			'quantity',
			'sheet_id',
			'checkout',
			'register_thankyou_url',
			'payment_thankyou_url',
			'ignoredatabase',
			'transaction_code',
			'amount',
			'order_id',
		]);
		$data['utm_source'] = !empty($request->utm_source) ? $request->utm_source : '';
		$data['client_ip'] = !empty($request->client_ip) ? $request->client_ip : '';
		$data['full_url'] = !empty($request->full_url) ? $request->full_url : '';

		$data['ignore_pay'] = false;
		$data['name'] = $data['fullname'];
		$data['status'] = 0;
		$data['payment_complete_email_sent'] = 0;
		if (empty($data['content'])) {
			$data['content'] = $data['quantity'] . ' x ' . $data['course'];
		}

		if ($data['course'] == 'zalo') {
			$data['amount'] = 1270000;
			$data['sheet_id'] = '1Yi_SpCjBEVppTRkOu2e9Hoda9rqWQyEqZKsqeGKtld8';
		}
		if ($data['course'] == 'google') {
			$data['amount'] = 1270000;
			$data['sheet_id'] = '1N0anXt6pUA4PUI_dQgIB4shb__vCYKphS4EwH9ZPhxA';
		}
		if ($data['campaign'] == 'khoi_nghiep_online_2018') {
			$coupon = false;
			//check combo
			if (strpos($data['course'], 'Combo 3') !== false) {
				$data['amount'] = 308000 * $data['quantity'];
			} else if (strpos($data['course'], 'Combo 5') !== false) {
				$data['amount'] = 478000 * $data['quantity'];
			} else {
				$data['amount'] = intval(preg_replace('/[^0-9]/', '', $data['course'])) * $data['quantity'];
				if ($data['coupon'] != 'none') {
					$data['coupon'] = strtolower($data['coupon']);

					if ((strpos(strtolower($data['coupon']), 'img_') !== false) && strpos($data['course'], 'Vé General') !== false) {
						$data['amount'] = 103000;
						$coupon = true;
					} elseif ((strpos(strtolower($data['coupon']), 'img_') !== false) && strpos($data['course'], 'Vé VIP') !== false) {
						$data['amount'] = 513000;
						$coupon = true;
					} elseif ((in_array(strtolower($data['coupon']), ['sinhvien', 'google', 'digital40', 'digital4.0', 'nhataitro', 'topdev'])) && strpos($data['course'], 'Vé General') !== false) {
						$data['amount'] = 0;
						$coupon = true;
					}
				}

				if ($coupon) {
					$data['amount'] = intval($data['amount']) * intval($data['quantity']);
				}
			}
		}
		if ($data['campaign'] == 'dien-dan-thuong-mai-dien-tu-VN-2019') {
			$url = $_SERVER["HTTP_REFERER"];
			$query_str = parse_url($url, PHP_URL_QUERY);
			parse_str($query_str, $query_params);
			$data['referal'] = !empty($query_params['ref']) ? $query_params['ref'] : '';

			$coupon = false;
			//check combo
			if (strpos($data['course'], 'Combo 3') !== false) {
				$data['amount'] = 308000 * $data['quantity'];
			} else if (strpos($data['course'], 'Combo 5') !== false) {
				$data['amount'] = 478000 * $data['quantity'];
			} else {
				$data['amount'] = intval(preg_replace('/[^0-9]/', '', $data['course'])) * $data['quantity'];
				if (isset($data['coupon']) && $data['coupon'] != 'none') {
					$data['coupon'] = strtolower($data['coupon']);

					$vecom_free_list = ['dungvecom01vip', 'dungvecom02vip', 'dungvecom03vip', 'dungvecom04vip', 'dungvecom05vip', 'dungvecom06vip', 'dungvecom07vip', 'dungvecom08vip', 'dungvecom09vip', 'dungvecom10vip', 'dungvecom01guess', 'dungvecom02guess', 'dungvecom03guess', 'dungvecom04guess', 'dungvecom05guess', 'dungvecom06guess', 'dungvecom07guess', 'dungvecom08guess', 'dungvecom09guess', 'dungvecom10guess', 'dungvecom01gen', 'dungvecom02gen', 'dungvecom03gen', 'dungvecom04gen', 'dungvecom05gen', 'dungvecom06gen', 'dungvecom07gen', 'dungvecom08gen', 'dungvecom09gen', 'dungvecom10gen'];
					$other_coupon = ['lethithuytrang', 'nguyentienhuy', 'tranquyhien', 'dohuuhung', 'nguyenthitramy', 'laituancuong', 'truonglyhoangphi', 'phandung', 'huynhlamho', 'hocvienimgroup', 'giadinhimgroup', 'nielsen'];
					if (in_array(strtolower($data['coupon']), $vecom_free_list)) {
						$data['amount'] = 0;
						$coupon = true;
						$data['quantity'] = 1;
					} elseif (in_array(strtolower($data['coupon']), ['giadinhimgroup']) && strpos($data['course'], 'Vé General') !== false) {
						$data['amount'] = 0;
						$coupon = true;
					} elseif (in_array(strtolower($data['coupon']), $other_coupon) && strpos($data['course'], 'Vé General') !== false) {
						$data['amount'] = 99000;
						$coupon = true;
					} elseif (in_array(strtolower($data['coupon']), $other_coupon) && strpos($data['course'], 'Vé VIP') !== false) {
						$data['amount'] = 558000;
						$coupon = true;
					}
					//                elseif ((strpos(strtolower($data['coupon']), 'img_') !== false) && strpos($data['course'], 'Vé VIP') !== false) {
					// 	$data['amount'] = 513000;
					// 	$coupon = true;
					// }

					// elseif ((in_array(strtolower($data['coupon']), ['sinhvien', 'google', 'digital40', 'digital4.0', 'nhataitro','topdev'])) && strpos($data['course'], 'Vé General') !== false) {
					//     $data['amount'] = 0;
					//     $coupon         = true;
					// }
				}

				if ($coupon) {
					$data['amount'] = intval($data['amount']) * intval($data['quantity']);
				}
			}
		}

		if ($data['campaign'] == 'VOMF-2019') {
			$url = '';
			if(!empty(@$_SERVER["HTTP_REFERER"])) {
				$url = $_SERVER["HTTP_REFERER"];	
			}
			if(!empty(@$_SERVER["HTTPS_REFERER"])) {
				$url = $_SERVER["HTTPS_REFERER"];	
			}
			$data['referal'] = '';
			if(!empty($url)) {
				$query_str = parse_url($url, PHP_URL_QUERY);
				parse_str($query_str, $query_params);
				$data['referal'] = !empty($query_params['ref']) ? $query_params['ref'] : '';
			}
			$price = intval(preg_replace('/[^0-9]/', '', $data['course']));
			$data['quantity'] = intval($data['quantity']);
			if(!empty($data['coupon'])) {
				$data['coupon'] = trim(strtolower($data['coupon']));
				if( $data['coupon'] == '#haravan' || 
					$data['coupon'] == 'haravan' || 
					$data['coupon'] == '#imgroup' || 
					$data['coupon'] == 'imgroup' || 
					(strpos($data['coupon'], '_vomf2019') !== false )) 
				{
					if(strpos($data['course'], 'General') !== false) {
						if($data['quantity'] < 3) { // < 3 ve
							$price = 199200;
						}
					}

					if(strpos($data['course'], 'VIP') !== false) {
						if($data['quantity'] < 3) { // < 3 ve
							$price = 557600;
						}
					}
				}elseif( $data['coupon'] == 'nguyenngocdung') {
					if(strpos($data['course'], 'General') !== false) {
						$price = 186750;
					}

					if(strpos($data['course'], 'VIP') !== false) {
						$price = 522750;
					}
				}elseif(strpos($data['coupon'], '_imgroup') !== false) {
					if(strpos($data['course'], 'General') !== false) {
						$price = 0;
					}

					if(strpos($data['course'], 'VIP') !== false) {
						$price = 558000;
					}
				}
			}

			$price = $this->discountGroup($data, $price);

			$data['amount'] = $price * $data['quantity'];
		}

		if ($data['campaign'] == 'TANGSO1012019') {
			$url = '';
			if(!empty(@$_SERVER["HTTP_REFERER"])) {
				$url = $_SERVER["HTTP_REFERER"];	
			}
			if(!empty(@$_SERVER["HTTPS_REFERER"])) {
				$url = $_SERVER["HTTPS_REFERER"];	
			}
			$data['referal'] = '';
			if(!empty($url)) {
				$query_str = parse_url($url, PHP_URL_QUERY);
				parse_str($query_str, $query_params);
				$data['referal'] = !empty($query_params['ref']) ? $query_params['ref'] : '';
			}
			$price = intval(preg_replace('/[^0-9]/', '', $data['course']));
			$data['quantity'] = intval($data['quantity']);
			if(!empty($data['coupon'])) {
				$data['coupon'] = trim(strtolower($data['coupon']));
				if( $data['coupon'] == 'vipimgroup') 
				{
					$price = 100000;
				}else if( $data['coupon'] == 'imgroup50') {
					$price = 150000;
				}else if( $data['coupon'] == 'imgroup50k') {
					$price = 250000;
				}
			}

			$data['amount'] = $price * $data['quantity'];
			/*$data['ignore_pay'] = true;
			if(!empty(@$_GET['debug'])) {
				$data['ignore_pay'] = false;
			}*/
		}

		//store transaction
		$data['transaction_code'] = time() . rand(10, 99);
		$transaction = \App\Transaction::create($data);

		if (!empty($data['sheet_id'])) {
			$this->insertRegisteredSheet($transaction);
		}

		if ($data['campaign'] == 'khoi_nghiep_online_2018') {
			$this->insertGetResponse(($data['amount'] == 0) ? 'regis_free' : 'regis', $data['fullname'], $data['email'], 'IMG-' . $transaction->id, $data['phone'], $data['amount']);
		}
		// if ($data['campaign'] == 'dien-dan-thuong-mai-dien-tu-VN-2019') {
		//      $this->insertGetResponse(($data['amount'] == 0)?'regis_free':'regis',$data['fullname'],$data['email'],'IMG-'.$transaction->id,$data['phone'],$data['amount']);
		// }

		/*if ($data['amount'] == 0) {
			//sms free ticket
			// $this->sms('free',$data['phone']);
			$transaction->status = 1;
			$transaction->save();
			$this->insertPaymentSheet($transaction);
			return redirect($data['payment_thankyou_url']);
		}*/

		// if (!empty($data['register_thankyou_url'])) {
		//     return redirect($data['register_thankyou_url'].'?signed='.$this->encode_arr($data));
		// }

		if ($data['amount'] == 0) {
			$data['ignore_pay'] = true;
		}

		if($data['ignore_pay'] == true) {
			return redirect($data['register_thankyou_url']);
		}

		return redirect($this->paymentService->buildUrlCheckout($data));
	}

	private function discountGroup($data, $price) {
		if(strpos($data['course'], 'General') !== false) {
			if($data['quantity'] >= 3 && $data['quantity'] < 5) { // >= 3 ve
				$price = 186750;
			}elseif($data['quantity'] >= 5 && $data['quantity'] < 10) { // >= 5 ve
				$price = 174300;
			}elseif($data['quantity'] >= 10) { // >= 10 ve
				$price = 161850;
			}
		}

		if(strpos($data['course'], 'VIP') !== false) {
			if($data['quantity'] >= 3 && $data['quantity'] < 5) { // 3 ve
				$price = 522750;
			}elseif($data['quantity'] >= 5 && $data['quantity'] < 10) { // 5 ve
				$price = 487900;
			}elseif($data['quantity'] >= 10) { // >= 10 ve
				$price = 453050;
			}
		}

		return $price;
	}

	public function doopage(Request $request) {
		$data = $request->only([
			'content',
			'amount',
			'success_callback_url',
			'cancel_callback_url',
		]);
		if(!empty($request->fullname)) {
			$data['name'] = $request->fullname;
		}
		if(!empty($request->fullname)) {
			$data['email'] = $request->email;
		}
		if(!empty($request->fullname)) {
			$data['phone'] = $request->phone;
		}
		$data['quantity'] = 1;
		$data['status'] = 0;
		$data['payment_complete_email_sent'] = 0;
		$data['course'] = 'Doopage';
		$data['campaign'] = 'Doopage';
		$data['coupon'] = 'none';
		$data['sheet_id'] = '';
		$data['referal'] = '';

		$data['payment_thankyou_url'] = $data['success_callback_url'];
		$data['register_thankyou_url'] = $data['cancel_callback_url'];

		//store transaction
		$data['transaction_code'] = time() . rand(10, 99);
		$transaction = \App\Transaction::create($data);

		if (!empty($data['sheet_id'])) {
			$this->insertRegisteredSheet($transaction);
		}

		return redirect($this->paymentService->buildUrlCheckout($data));
	}

	public function buyTicketPayment(Request $request) {
		$data = $this->decode_arr($request->signed);
		return redirect($this->paymentService->buildUrlCheckout($data));
	}

	private function sendMailByMailgun($to, $toname, $subject, $content) {
		$array_data = array(
			'from' => 'IMGROUP.VN<support@imgroup.vn>',
			'to' => $toname . '<' . $to . '>',
			'subject' => $subject,
			'html' => $content,
			'text' => $content,
			'h:Reply-To' => 'no-reply@imgroup.vn',
		);
		$session = curl_init(env('MAILGUN_URL') . '/messages');
		curl_setopt($session, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
		curl_setopt($session, CURLOPT_USERPWD, 'api:' . env('MAILGUN_KEY'));
		curl_setopt($session, CURLOPT_POST, true);
		curl_setopt($session, CURLOPT_POSTFIELDS, $array_data);
		curl_setopt($session, CURLOPT_HEADER, false);
		curl_setopt($session, CURLOPT_ENCODING, 'UTF-8');
		curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($session, CURLOPT_SSL_VERIFYPEER, false);
		$response = curl_exec($session);
		curl_close($session);
		$results = json_decode($response, true);
		return $results;
	}

	private function inBlockedData($data = []) {
		$blocked_name = [
			'enetdomain',
			'netcentraldomain',
			'dpmainxweb',
			'webgodomain'];
			$blocked_email = [
				'noreply@enetdomain.com',
				'noreply@netcentraldomain.com',
				'noreply@dpmainxweb.com',
				'noreply@webgodomain.com',
			];
			if (in_array(strtolower($data['name']), $blocked_name)) {
				return true;
			}
			if (in_array(strtolower($data['email']), $blocked_email)) {
				return true;
			}
			return false;
		}

		private function insertRegisteredSheet($transaction_info) {
			if (empty($transaction_info) || empty($transaction_info->sheet_id)) {
				return false;
			}
			try {
				$client = new \Google_Client();
				$client->setScopes(implode(' ', [\Google_Service_Sheets::SPREADSHEETS]));
				$client->setAuthConfig(env('GOOGLE_CLIENT_SECRET_PATH'));
				$service = new \Google_Service_Sheets($client);
				$options = array('valueInputOption' => 'RAW');

				$values = [[
					(string) 'IMG-' . $transaction_info->id,
					(int) $transaction_info->transaction_code,
					(string) $transaction_info->name,
					(string) $transaction_info->phone,
					(string) $transaction_info->email,
					(string) $transaction_info->coupon,
					(int) $transaction_info->quantity,
					(int) $transaction_info->amount,
					(string) $transaction_info->content,
					(string) $transaction_info->course,
					(string) date('Y-m-d H:i:s'),
					(string) $transaction_info->utm_source,
					(string) $transaction_info->client_ip,
					(string) $transaction_info->full_url,
				]];

				$sheet_id = $transaction_info->sheet_id;
				$body = new \Google_Service_Sheets_ValueRange(['values' => $values]);
				$rows = $service->spreadsheets_values->get($sheet_id, 'Da_dang_ky!A2:A', ['majorDimension' => 'ROWS']);

				if (empty($rows['values']) || !in_array($transaction_info->id, array_flatten($rows['values']))) {
					$result = $service->spreadsheets_values->append($sheet_id, 'Da_dang_ky!A1:N1', $body, $options);
				}
				return true;
			} catch (\Exception $e) {
				echo $e->getMessage();
			}

		}

		private function insertPaymentSheet($transaction_info) {
			if (empty($transaction_info) || empty($transaction_info->sheet_id)) {
				return false;
			}
			$client = new \Google_Client();
			$client->setScopes(implode(' ', [\Google_Service_Sheets::SPREADSHEETS]));
			$client->setAuthConfig(env('GOOGLE_CLIENT_SECRET_PATH'));
			$service = new \Google_Service_Sheets($client);
			$options = array('valueInputOption' => 'RAW');

			$values = [[
				(string) 'IMG-' . $transaction_info->id,
				(int) $transaction_info->transaction_code,
				(string) $transaction_info->name,
				(string) $transaction_info->phone,
				(string) $transaction_info->email,
				(string) $transaction_info->coupon,
				(string) $transaction_info->content,
				(int) $transaction_info->quantity,
				(int) $transaction_info->amount,
				(string) $transaction_info->course,
				(string) $transaction_info->status,
				(string) $transaction_info->paid_via,
				(string) $transaction_info->paid_date,
				(string) $transaction_info->referal,
				(string) $transaction_info->utm_source,
				(string) $transaction_info->client_ip,
				(string) $transaction_info->full_url,
			]];

			$sheet_id = $transaction_info->sheet_id;
			$body = new \Google_Service_Sheets_ValueRange(['values' => $values]);

			$sheet_name = 'Chua_thanh_toan';
			if ($transaction_info->status == 1) {
				$sheet_name = 'Da_thanh_toan';
			}
			$rows = $service->spreadsheets_values->get($sheet_id, $sheet_name . '!A2:A', ['majorDimension' => 'ROWS']);
			if (empty($rows['values']) || !in_array($transaction_info->id, array_flatten($rows['values']))) {
				$result = $service->spreadsheets_values->append($sheet_id, $sheet_name . '!A2:Z2', $body, $options);
			}
		}

		private function encode_arr($data) {
			return base64_encode(serialize($data));
		}

		private function decode_arr($data) {
			return unserialize(base64_decode($data));
		}

		private function insertGetResponse($type, $name, $email, $order_id, $phone, $amount = 0) {
			$campaign_ids = ['regis' => 'ajl53', 'regis_free' => 'aFKox', 'regis_payment' => 'ajlZr'];
			$getresponse = new GetResponse('7a88d9eb4067e2ada20a5a9550d506e8');
			$getresponse->addContact(array(
				'name' => $name,
				'email' => $email,
				'campaign' => array('campaignId' => $campaign_ids[$type]),
				'customFieldValues' => array(
					array('customFieldId' => 'v3eio',
						'value' => [$order_id]),
					array('customFieldId' => 'NZEL3',
						'value' => [$phone]),
					array('customFieldId' => 'NZEiV',
						'value' => [$amount]),
				),
			));
		}
		private function sms($type, $phone) {
			$sms = 'IMGroup Thong bao: Chuc mung ban nhan duoc ve tang Dien Dan Khoi Nghiep Online 2018. Thoi gian: 8h, Ngay 21/11. Ma checkin la sdt cua ban. LH 0902940969.';
			if ($type == 'payment') {
				$sms = 'IMGroup Thong bao: Chuc mung ban thanh toan thanh cong ve Dien Dan Khoi Nghiep Online 2018. Thoi gian: 8h, Ngay 21/11. Ma checkin la sdt cua ban. LH 0902940969.';
			}
			$client = new Client();
			$res = $client->request('POST', 'http://support.imgroup.vn/knol_sms.php', [
				'form_params' => [
					'phone' => $phone,
					'sms' => $sms,
				],
			]);
		}

		public function vnpayInpn(Request $request)
		{
			return $this->paymentService->paymentIPN($request->all());
		}

		public function vnpayCallback(Request $request)
		{
			$data = $this->paymentService->paymentIPN($request->all());
			//insert get response
			if(!empty($data['transaction'])){
				$transaction = $data['transaction'];
				if ($transaction->campaign == 'khoi_nghiep_online_2018') {
					$this->insertGetResponse('regis_payment', $transaction->name, $transaction->email, 'IMG-' . $transaction->id, $transaction->phone, $transaction->amount);
					//sms free ticket
					$this->sms('payment', $transaction->phone);
				}
				if(!empty($transaction->order_id)){
					$this->confirmOrder($transaction->order_id, $transaction->amount);
				}
				//send mail admin
				$this->sendMailComplete($transaction, $transaction->status);
				if (!empty($transaction->sheet_id)) {
					$this->insertPaymentSheet($transaction);
				}
			}
			
			if ($request->redirect) {
				return redirect($request->redirect);
			}
			if($data['RspCode'] != '00'){
				return redirect(route('payment.cancel'));
			}
			return redirect(route('payment.success'));
		}

		public function confirmOrder($order_id, $amount)
		{
			$env     = env('APP_ENV');
			$config  = config('payment.vnpay.' . $env);
			
			$data_string = json_encode(['order_id' => $order_id, 'amount' => $amount]);
			$curl = curl_init($config['confirm_order_url']);
			curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl, CURLOPT_HTTPHEADER, [
				'Content-Type: application/json',
				'Content-Length: ' . strlen($data_string),
				'Authorization: img YdCUzRGEQFxIudJfHSjLdNeHrgQqrO7rnsPIxSx6',
			]);
			$result = curl_exec($curl);
			curl_close($curl);
		}
	}
