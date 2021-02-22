<?php

namespace App\Library;

class NganLuong
{

    public function buildUrlCheckout($data)
    {

        $env          = env('APP_ENV');
        $config       = collect(config('payment.nganluong.' . $env));
        $redirect_url = $config['destination_url'];

        $arr_param = array(
            'merchant_site_code' => strval($config['website_id']),
            'return_url'         => strval(strtolower($config['return_url'])),
            'receiver'           => strval($config['receiver_email']),
            'transaction_info'   => 'Thanh toan giao dich pay.imgroup.vn',
            'order_code'          => strval($data['transaction_code']),
            'price'              => strval($data['amount']),
            'currency'           => strval($config['currency']),
            'quantity'           => strval(1),
            'tax'                => strval(0),
            'discount'           => strval(0),
            'fee_cal'            => strval(0),
            'fee_shipping'       => strval(0),
            'order_description'   => strval($data['content']),
            'buyer_info'         => strval($data['name'] . "*|*" . $data['email'] . "*|*" . $data['phone'] . "*|*IMGroup - 18 Trần Thiện Chánh, Phường 12, Quận 10, Thành Phố Hồ Chí Minh"),
            'affiliate_code'     => strval(''),
        );
        
         if(!empty($data['payment_thankyou_url'])){
            $arr_param['return_url'].='?redirect='.strval(strtolower($data['payment_thankyou_url']));
        }


        $arr_param['secure_code'] = md5(implode(' ', $arr_param) . ' ' . $config['secrect']);
        if (strpos($redirect_url, '?') === false) {
            $redirect_url .= '?';
        } elseif (substr($redirect_url, strlen($redirect_url) - 1, 1) != '?' && strpos($redirect_url, '&') === false) {
            $redirect_url .= '&';
        }

        /* */
        $url = '';
        foreach ($arr_param as $key => $value) {
            $value = urlencode($value);
            if ($url == '') {
                $url .= $key . '=' . $value;
            } else {
                $url .= '&' . $key . '=' . $value;
            }
        }

        if(!empty($data['register_thankyou_url'])){
            $url.='&cancel_url='.strval(strtolower($data['register_thankyou_url']));
        }

        return $redirect_url . $url;
    }

    public function verifyPaymentUrl($data){
        $env          = env('APP_ENV');
        $config       = collect(config('payment.nganluong.' . $env));
        // Tạo mã xác thực từ chủ web
        $str = '';
        $str .= ' ' . strval($data['transaction_info']);
        $str .= ' ' . strval($data['order_code']);
        $str .= ' ' . strval($data['price']);
        $str .= ' ' . strval($data['payment_id']);
        $str .= ' ' . strval($data['payment_type']);
        $str .= ' ' . strval($data['error_text']);
        $str .= ' ' . strval($config['website_id']);
        $str .= ' ' . strval($config['secrect']);

        // Mã hóa các tham số
        $verify_secure_code = md5($str);

        // Xác thực mã của chủ web với mã trả về từ nganluong.vn
        if($verify_secure_code === $data['secure_code']) return true;
        else return false;
    }
}
