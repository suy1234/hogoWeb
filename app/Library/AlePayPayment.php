<?php

namespace App\Library;
use App\Library\AlePay\Alepay;
class AlePayPayment
{
    function handlePayment($data) {
        $env          = env('APP_ENV');
        // $config       = collect(config('payment.alepay.dev'));
        $config       = collect(config('payment.alepay.' . $env));
        $url = $config['check_order_url'];
        $data['payment_thankyou_url'] = !empty($data['payment_thankyou_url']) ? $data['payment_thankyou_url'] : 'https://imgroup.vn/tangso101-thanh-toan-thanh-cong.html';
        $data = [
            'orderCode'         => $data['transaction_code'],
            'amount'            => $data['amount'],
            'currency'          => 'VND',
            'orderDescription'  => $data['content'],
            'totalItem'         => 1,
            'checkoutType'      => 0,
            'returnUrl'         => $config['return_url'].'&order_code='.$data['transaction_code'],
            'cancelUrl'         => $data['payment_thankyou_url'],
            'buyerName'         => $data['name'],
            'buyerEmail'        => $data['email'],
            'buyerPhone'        => $data['phone'],
            'buyerAddress'      => '18 Trần Thiện Chánh, Phường 12, Quận 10, Thành Phố Hồ Chí Minh',
            'buyerCity'         => 'Thành Phố Hồ Chí Minh',
            'buyerCountry'      => 'Việt Nam',
        ];
        $config = $config->toArray();
        $config['return_url'] = $config['return_url'].'&order_code='.$data['orderCode'];
        $config['cancelUrl'] = $config['cancelUrl'].'&order_code='.$data['orderCode'];
        $config['callbackUrl'] = $config['callbackUrl'].'&order_code='.$data['orderCode'];
        $alepay = new Alepay($config);
        $result = $alepay->sendOrderToAlepay($data); // Khởi tạo
        if(!empty($result->checkoutUrl)){
            return redirect()->to($result->checkoutUrl);
        }
        return '';
    }

    function cancelPayment($option){
        return [
            'order_id' => (int) $option['order_id'],
            'payment_status' => false,
        ];
    }

    function successPayment($option){
        return [
            'order_id' => (int) $option['order_id'],
            'payment_status' => true,
        ];
    }
}
