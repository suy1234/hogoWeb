<?php

namespace App\Library\AlePay;

use App\Library\AlePay\Utils\AlepayUtils;

define('DS', str_replace('\\', '/', DIRECTORY_SEPARATOR));
define('ROOT_PATH', dirname(__FILE__));

/*
 * Alepay class
 * Implement with Alepay service
 */

class Alepay
{
    protected $alepayUtils;
    protected $publicKey = "";
    protected $checksumKey = "";
    protected $apiKey = "";
    protected $callbackUrl = "";
    protected $cancelUrl = "";
    protected $env = "live";
    protected $baseURL = array(
        'dev' => 'localhost:8080',
        'test' => 'https://alepay-sandbox.nganluong.vn',
        'live' => 'https://alepay.vn'
    );
    protected $URI = array(
        'requestPayment' => '/checkout/v1/request-order',
        'calculateFee' => '/checkout/v1/calculate-fee',
        'getTransactionInfo' => '/checkout/v1/get-transaction-info',
        'requestCardLink' => '/checkout/v1/request-profile',
        'tokenizationPayment' => '/checkout/v1/request-tokenization-payment',
        'tokenizationPaymentDomestic' => '/checkout/v1/request-tokenization-payment-domestic',
        'cancelCardLink' => '/checkout/v1/cancel-profile',
        'requestCardLinkDomestic' => '/alepay-card-domestic/request-profile',
    );

    public function __construct($opts)
    {
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Credentials: true");
        header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
        header('Access-Control-Max-Age: 1000');
        header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');

        /*
         * Require curl and json extension
         */
        if (!function_exists('curl_init')) {
            throw new \Exception('Alepay needs the CURL PHP extension.');
        }
        if (!function_exists('json_decode')) {
            throw new \Exception('Alepay needs the JSON PHP extension.');
        }

        // set KEY
        if (isset($opts) && !empty($opts["apiKey"])) {
            $this->apiKey = $opts["apiKey"];
        } else {
            throw new \Exception("API key is required !");
        }
        if (isset($opts) && !empty($opts["encryptKey"])) {
            $this->publicKey = $opts["encryptKey"];
        } else {
            throw new \Exception("Encrypt key is required !");
        }
        if (isset($opts) && !empty($opts["checksumKey"])) {
            $this->checksumKey = $opts["checksumKey"];
        } else {
            throw new \Exception("Checksum key is required !");
        }
        if (isset($opts) && !empty($opts["callbackUrl"])) {
            $this->callbackUrl = $opts["callbackUrl"];
        }

        if (isset($opts) && !empty($opts["cancelUrl"])) {
            $this->cancelUrl = $opts["cancelUrl"];
        }
        if (isset($opts) && !empty($opts["env"])) {
            $this->env = $opts["env"];
        }
        $this->alepayUtils = new AlepayUtils();
    }

    /*
     * sendOrder - Send order information to Alepay service
     * @param array|null $data
     */

    public function sendOrderToAlepay($data)
    {
        // get demo data
        // $data = $this->createCheckoutData();
        // $data['returnUrl'] = $this->callbackUrl;
        $data['cancelUrl'] = $this->cancelUrl;
        $url = $this->baseURL[$this->env] . $this->URI['requestPayment'];
        $result = $this->sendRequestToAlepay($data, $url);
        if (isset($result) && $result->errorCode == '000') {
            $dataDecrypted = $this->alepayUtils->decryptData($result->data, $this->publicKey);
            return json_decode($dataDecrypted);
        } else {
            return (array)$result;
        }
    }

    public function sendOrderToAlepayDomestic($data)
    {
        // get demo data
        $data = $this->createCheckoutDomesticData();
        $data['returnUrl'] = $this->callbackUrl;
        $url = $this->baseURL[$this->env] . $this->URI['requestPayment'];
        $result = $this->sendRequestToAlepay($data, $url);
        if ($result->errorCode == '000') {
            $dataDecrypted = $this->alepayUtils->decryptData($result->data, $this->publicKey);
            return json_decode($dataDecrypted);
        } else {
            echo json_encode($result);
        }
    }

    /*
     * get transaction info from Alepay
     * @param array|null $data
     */

    public function getTransactionInfo($transactionCode)
    {

        // demo data
        $data = array('transactionCode' => $transactionCode);
        $url = $this->baseURL[$this->env] . $this->URI['getTransactionInfo'];
        $result = $this->sendRequestToAlepay($data, $url);
        if ($result->errorCode == '000') {
            $dataDecrypted = $this->alepayUtils->decryptData($result->data, $this->publicKey);
            return $dataDecrypted;
        } else {
            return json_encode($result);
        }
    }

    /*
     * sendCardLinkRequest - Send user's profile info to Alepay service
     * return: cardlink url
     * @param array|null $data
     */

    public function sendCardLinkRequest($data)
    {
        // get demo data
        $data = $this->createRequestCardLinkData();
        $url = $this->baseURL[$this->env] . $this->URI['requestCardLink'];
        $result = $this->sendRequestToAlepay($data, $url);
        if ($result->errorCode == '000') {
            $dataDecrypted = $this->alepayUtils->decryptData($result->data, $this->publicKey);
            return json_decode($dataDecrypted);
        } else {
            return $result;
        }
    }

    public function sendCardLinkDomesticRequest()
    {
        // get demo data
        $data = $this->createRequestCardLinkDataDomestic();
        $url = $this->baseURL[$this->env] . $this->URI['requestCardLinkDomestic'];
        $result = $this->sendRequestToAlepay($data, $url);
        if ($result->errorCode == '000') {
            $dataDecrypted = $this->alepayUtils->decryptData($result->data, $this->publicKey);
            return json_decode($dataDecrypted);
        } else {
            return $result;
        }
    }

    public function sendTokenizationPayment($tokenization)
    {

        $data = $this->createTokenizationPaymentData($tokenization);
        $url = $this->baseURL[$this->env] . $this->URI['tokenizationPayment'];
        $result = $this->sendRequestToAlepay($data, $url);
        if ($result->errorCode == '000') {
            $dataDecrypted = $this->alepayUtils->decryptData($result->data, $this->publicKey);
            return json_decode($dataDecrypted);
        } else {
            return $result;
        }
    }

    public function sendTokenizationPaymentDomestic($tokenization)
    {
        $data = $this->createTokenizationPaymentDomesticData($tokenization);
        $url = $this->baseURL[$this->env] . $this->URI['tokenizationPaymentDomestic'];
        $result = $this->sendRequestToAlepay($data, $url);
        if ($result->errorCode == '000') {
            $dataDecrypted = $this->alepayUtils->decryptData($result->data, $this->publicKey);
            return json_decode($dataDecrypted);
        } else {
            return $result;
        }
    }

    public function cancelCardLink($alepayToken)
    {
        $params = array('alepayToken' => $alepayToken);
        $url = $this->baseURL[$this->env] . $this->URI['cancelCardLink'];
        $result = $this->sendRequestToAlepay($params, $url);
        echo json_encode($result);
        if ($result->errorCode == '000') {
            $dataDecrypted = $this->alepayUtils->decryptData($result->data, $this->publicKey);
            echo $dataDecrypted;
        }
    }

    private function sendRequestToAlepay($data, $url)
    {
        $dataEncrypt = $this->alepayUtils->encryptData(json_encode($data), $this->publicKey);
        $checksum = md5($dataEncrypt . $this->checksumKey);
        $items = array(
            'token' => $this->apiKey,
            'data' => $dataEncrypt,
            'checksum' => $checksum
        );
        $data_string = json_encode($items);
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data_string))
        );
        $result = curl_exec($ch);
        // echo $result;
        return json_decode($result);
    }

    public function return_json($error, $message = "", $data = array())
    {
        header('Content-Type: application/json');
        echo json_encode(array(
            "error" => $error,
            "message" => $message,
            "data" => $data
        ));
    }

    public function decryptCallbackData($data)
    {
        return $this->alepayUtils->decryptCallbackData($data, $this->publicKey);
    }

    public function getError($error_code)
    {
        $errors = [
            '000' => 'Thành công',
            '101' => 'Checksum không hợp lệ',
            '102' => 'Mã hóa không hợp lệ',
            '103' => 'IP không được phép truy cập',
            '104' => 'Dữ liệu không hợp lệ',
            '105' => 'Token key không hợp lệ',
            '106' => 'Token thanh toán Alepay không tồn tại hoặc đã bị hủy',
            '107' => 'Giao dịch đang được xử lý',
            '108' => 'Dữ liệu không tìm thấy',
            '109' => 'Mã đơn hàng không tìm thấy',
            '110' => 'Phải có email hoặc số điện thoại người mua',
            '111' => 'Giao dịch thất bại',
            '120' => 'Giá trị đơn hàng phải lớn hơn 0',
            '121' => 'Loại tiền tệ không hợp lệ',
            '122' => 'Mô tả đơn hàng không tìm thấy',
            '123' => 'Tổng số sản phẩm phải lớn hơn không',
            '124' => 'Định dạng URL không chính xác (http://, https://)',
            '125' => 'Tên người mua không đúng định dạng',
            '126' => 'Email người mua không đúng định dạng',
            '127' => 'SĐT người mua không đúng định dạng',
            '128' => 'Địa chỉ người mua không hợp lệ',
            '129' => 'City người mua không hợp lệ',
            '130' => 'Quốc gia người mua không hợp lệ',
            '131' => ' hạn thanh toán phải lớn hơn 0',
            '132' => 'Email không hợp lệ',
            '133' => 'Thông tin thẻ không hợp lệ',
            '134' => 'Thẻ hết hạn mức thanh toán',

            '157' => 'Email không khớp với profile đã tồn tại',
            '158' => 'Số điện thoại không khớp với profile đã tồn tại',
            '159' => 'Id không được để trống',
            '160' => 'First name không được để trống',
            '161' => 'Last name không được để trống',
            '162' => 'Email không được để trống',
            '163' => 'City không được để trống',
            '164' => 'Country không được để trống',
            '165' => 'SĐT Không được để trống',
            '166' => 'State không được để trống',
            '167' => 'Street không được để trống',
            '168' => 'Sostalcode không được để trống',
            '169' => 'Url callback không đươc để trống',
            '170' => 'OTP nhập sai quá 3 lần',
            '171' => 'Thẻ của khách hàng đã được liên kết trên Merchant',
            '172' => 'Thẻ tạm thời bị cấm liên kết do vượt quá số lần xác thực số tiền',
            '173' => 'Trạng thái liên kết thẻ không đúng',
            '174' => 'Không tìm thấy phiên liên kết thẻ',
            '175' => 'Số tiền thanh toán của thẻ 2D chưa xác thực vượt quá hạn mức',
            '176' => 'Thẻ 2D đang chờ xác thực',
            '177' => 'Khách hàng ấn nút hủy giao dịch',

            '178' => 'thanh toán subscription thành công',
            '179' => 'Thanh toán subscription thất bại',
            '180' => 'Đăng ký subscription thành công',
            '181' => 'Đăng ký subscription thất bại',
            '182' => 'Mã Alepay token không hợp lệ',
            '183' => 'Mã plan không được trống',
            '184' => 'URL callback không được trống',
            '185' => 'Subscription Plan không tồn tại',
            '186' => 'Subscription plan không kích hoạt',
            '187' => 'Subscription plan hết hạn',
            '188' => 'Subscription Record đã tồn tại',
            '189' => 'Subscription Record không tồn tại',
            '190' => 'Trạng thái Subscription Record không hợp lệ',
            '191' => 'Xác thực OTP quá số lần cho phép',
            '192' => 'Sai OTP xác thực',
            '193' => 'Đăng ký subscription cho khách hàng thành công',
            '194' => 'Khách hàng cần confirm subscription',
            '195' => 'Trạng thái Alepay token không hợp lệ',
            '196' => 'Gửi OTP không thành công',
            '197' => 'Ngày kết thúc hoặc số lần thanh toán tối đa không hợp lệ',
            '198' => 'Alepay token không được để trống',
            '199' => 'Alepay token chưa được active',
            '200' => 'Subscription Plan không hợp lệ',
            '201' => 'Thời gian bắt đầu không hợp lệ',
            '202' => 'IP request của merchant chưa được cấu hình hoặc không được cho phép',
            '203' => 'Không tìm thấy file subscription',
            '204' => 'Alepay token chưa được xác thực',
            '205' => 'Tên chủ thẻ không hợp lệ',
            '206' => 'Merchant không được phép sử dụng dịch vụ này',
            '207' => 'Ngân hàng nội địa không hợp lệ',
            '208' => 'Mã token xác thực không hợp lệ',
            '209' => 'Số tiền xác thực không hợp lệ',
            '210' => 'Quá số lần xác thực số tiền',
            '211' => 'Tên người mua phải bao gồm cả họ và tên',
            '212' => 'Merchant không được phép liên kết thẻ',
            '213' => 'Khách hàng không lựa chọn liên kết thẻ',
            '214' => 'Giao dịch chưa được thực hiện',
            '215' => 'Không duyệt thẻ bị review',
            '216' => 'Thẻ không được hỗ trợ thanh toán',
            '217' => 'Profile khách hàng không tồn tại trên hệ thống',
            '999' => 'Lỗi không xác định. Vui lòng liên hệ với Quản trị viên Alepay'

        ];
        return isset($errors[$error_code]) ? $errors[$error_code] : 'Lỗi chưa xác định!';
    }

}

?>