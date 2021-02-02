<?php

namespace App\Library;
use App\Transaction;
class VNPay
{
    protected $config;
    public function __construct()
    {
        $env     = env('APP_ENV');
        $this->config  = collect(config('payment.vnpay.' . $env));
    }

    public function buildUrlCheckout($data)
    {
        
        $vnp_OrderType = isset($data['type']) ? $data['type'] : "topup";
        $vnp_BankCode = "";
        $url = '';
        if(!empty($data['back_url'])){
            $url = '';
        }
        $inputData = array(
            "vnp_Version" => "2.0.0",
            "vnp_TmnCode" => $this->config['code'],
            "vnp_Amount" => $data['amount'] * 100,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_ExpireDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $_SERVER['REMOTE_ADDR'],
            "vnp_Locale" => "vn",
            "vnp_OrderInfo" => 'Thanh toan giao dich pay.imgroup.vn',
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $this->config['return_url'].(!empty($data['payment_thankyou_url']) ? '?redirect='.$data['payment_thankyou_url'] : ''),
            "vnp_TxnRef" => $data['transaction_code'],
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . $key . "=" . $value;
            } else {
                $hashdata .= $key . "=" . $value;
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $this->config['check_order_url'] . "?" . $query;
        if (isset($this->config['hash_secret'])) {
            $vnpSecureHash = hash('sha256', $this->config['hash_secret'] . $hashdata);
            $vnp_Url .= 'vnp_SecureHashType=SHA256&vnp_SecureHash=' . $vnpSecureHash;
        }
        return $vnp_Url;
    }

    public function paymentIpn($data){
        $vnp_HashSecret = $this->config['hash_secret'];
        $inputData = array();
        $returnData = array();

        foreach ($data as $key => $value) {
            if (substr($key, 0, 4) == "vnp_") {
                $inputData[$key] = $value;
            }
        }
        if(!$data || !isset($inputData['vnp_SecureHash'])){
            $returnData['RspCode'] = '99';
            $returnData['Message'] = 'Unknow error';
            return json_encode($returnData);
        }
        $vnp_SecureHash = $inputData['vnp_SecureHash'];

        unset($inputData['vnp_SecureHashType']);
        unset($inputData['vnp_SecureHash']);

        ksort($inputData);
        $i = 0;
        $hashData = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData = $hashData . '&' . $key . "=" . $value;
            } else {
                $hashData = $hashData . $key . "=" . $value;
                $i = 1;
            }
        }
        $secureHash = hash('sha256',$vnp_HashSecret . $hashData);
        $code = $inputData['vnp_TxnRef'];

        try {
            if ($secureHash == $vnp_SecureHash) {
                $transaction = Transaction::where('transaction_code', $code)->first();
                if ($transaction) {
                    if ($transaction["status"] != 1) { // transaction status
                        if($transaction["amount"] == ($inputData['vnp_Amount']/100)){
                            if ($inputData['vnp_ResponseCode'] == '00') {
                                $transaction_status = 1;
                                $returnData['RspCode'] = '00';
                                $returnData['Message'] = 'Confirm Success';
                            } else if ($inputData['vnp_ResponseCode'] == '24'){
                                $transaction_status = -1;
                                $returnData['RspCode'] = '24';
                                $returnData['Message'] = 'Cancel';
                            }
                            $transaction->update(['status' => $transaction_status, 'note' => json_encode($data)]);
                        }else{
                            $returnData['RspCode'] = '04';
                            $returnData['Message'] = 'Invalid Amount';
                        }
                    } else {
                        $returnData['RspCode'] = '02';
                        $returnData['Message'] = 'Order already confirmed';
                    }
                    $returnData['transaction'] = $transaction;
                } else {
                    $returnData['RspCode'] = '01';
                    $returnData['Message'] = 'Order not found';
                }
            } else {
                $returnData['RspCode'] = '97';
                $returnData['Message'] = 'Chu ky khong hop le';
            }
        } catch (\Exception $e) {
            $returnData['RspCode'] = '99';
            $returnData['Message'] = 'Unknow error';
        }

        return $returnData;
    }

}
