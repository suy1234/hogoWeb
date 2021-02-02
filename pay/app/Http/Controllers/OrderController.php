<?php

namespace App\Http\Controllers;

use App\Library\AlePay\Alepay;
use App\Library\AlePay\Utils\AlepayUtils;
use App\Library\NganLuong;
use Illuminate\Http\Request;
use GuzzleHttp\Client;


class OrderController extends Controller {
	private $paymentService;
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct(NganLuong $paymentService) {
		$this->paymentService = $paymentService;
	}

	public function payment(Request $request) {
		$data = json_decode(base64_decode($request->signed), true);
		$request->merge($data);
		$this->validate($request, [
			'order_id' => 'required',
			'fullname' => 'required',
			'phone' => 'required',
			'email' => 'required|email',
			'price' => 'required',
			'content' => 'required',
			'web_hook' => 'required',
		]);
		$data['name'] = $data['fullname'];
		$data['amount'] = $data['price'];
		$data['status'] = 0;
		$data['payment_complete_email_sent'] = 0;
		$data['transaction_code'] = time() . rand(10, 99);
		$transaction = \App\Transaction::create($data);

		$data['payment_thankyou_url'] = route('order_payment.callback',['transaction_code'=>$data['transaction_code'],'order_id'=>$data['order_id'],'money'=>$data['price'],'web_hook'=>$data['web_hook']]);

		return redirect($this->paymentService->buildUrlCheckout($data));
	}

	/**
	 * [nganluongCallback description]	
	 * @author thanhnm lcfirst(str)
	 * @param  Request $request
	 * @return [type]
	 */
	public function paymentCallback(Request $request) {
		$this->validate($request, [
			'transaction_code' => 'required',
			'web_hook' => 'required',
			'money' => 'required',
			'order_id' => 'required'
		]);

		$transaction = \App\Transaction::where('transaction_code',$request->transaction_code)->first();
		if($transaction){
			$client = new Client();
			$res = $client->request('POST', $request->web_hook, [
				'headers'        => ['Authorization' => 'img YdCUzRGEQFxIudJfHSjLdNeHrgQqrO7rnsPIxSx0'],
				'form_params' => [
					'money' => $request->money,
					'order_id' => $request->order_id,
				],
			]);
			return view('success');
		}

		return 'Forbiden';
	}

}
