<?php

return [
    'nganluong'=>[
        'local'        => [
            'currency'        => "vnd",
            'lang'            => 'vi',
            'receiver_email'  => 'thanhnm.dev@gmail.com',
            'return_url'      => "http://pay.imgroup.loc/payment/nganluong/callback",
            'destination_url' => "https://sandbox.nganluong.vn:8088/nl30/checkout.php",
            'check_order_url' => 'https://sandbox.nganluong.vn:8088/nl30/public_api.php?wsdl',
            'website_id'      => "46889",
            'secrect'         => "e0d6dd33dccb9467f02db28b2d390030",
        ],
        'dev'        => [
            'currency'        => "vnd",
            'lang'            => 'vi',
            'receiver_email'  => 'minhchau@imgroup.vn',
            'return_url'      => "http://nganluong.webitop.com/payment/nganluong/callback",
            'check_order_url' => 'https://www.nganluong.vn/public_api.php?wsdl',
            'destination_url' => "https://www.nganluong.vn/checkout.php",
            'website_id'      => "56582",
            'secrect'         => "c3ce570fd816e0f04257d6292281b94b",
        ],
        'production' => [
            'currency'        => "vnd",
            'lang'            => 'vi',
            'receiver_email'  => 'thuylinh@imgroup.vn',
            'return_url'      => "http://pay.imgroup.vn/payment/nganluong/callback",
            'check_order_url' => 'https://www.nganluong.vn/public_api.php?wsdl',
            'destination_url' => "https://www.nganluong.vn/checkout.php",
            'website_id'      => "56582",
            'secrect'         => "c3ce570fd816e0f04257d6292281b94b",
        ],
    ],
    'alepay'=>[
        'dev'        => [
            'currency'        => "vnd",
            'lang'            => 'vi',
            'receiver_email'  => 'ngocsuy@imgroup.vn',
            'website_id'        => "56582",
            'check_order_url'        => "https://alepay-sandbox.nganluong.vn/checkout/v1/request-order",
            'return_url'      => "http://pay.imgroup.vn/payment/nganluong/callback?payment_method=installment",
            'cancelUrl'      => "http://pay.imgroup.vn/payment/nganluong/callback?payment_method=installment&error=1",

            'apiKey' => '7lepGidB9ApN5dvBYQtP5EHmuy48A6',
            'encryptKey' => 'MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQC5YytaZCHoLzOB/VuAgPvwkeGoUrCuH5Maca0VK+WAOdaAwlBWUKtJErS6NHMQN8kHV+eqsKUl/X7igxHjIeLC642U/fX8r/Nh4WuDRkGHXuWRp8nK5I+Az1b8yIjrsg3/QIcu+1XBrSSIMFxVSSklW+r/KfAWSarJOmdy3zQsGwIDAQAB',
            'checksumKey' => 'FIN2aGy8eUkcRMH8seirXNSw9jDXwW',
            'callbackUrl' => 'http://pay.imgroup.vn/payment/nganluong/callback?payment_method=installment',
            "env"         => "test",
        ],
        'production' => [
            'currency'        => "vnd",
            'lang'            => 'vi',
            'website_id'        => "56582",
            'receiver_email'  => 'thuylinh@imgroup.vn',
            'check_order_url'        => "https://alepay.vn/checkout/v1/request-order",
            'return_url'      => "http://pay.imgroup.vn/payment/nganluong/callback?payment_method=installment",
            'cancelUrl'      => "http://pay.imgroup.vn/payment/nganluong/callback?payment_method=installment&error=1",
            'apiKey' => 'YJg3icRWJtn07ouOlCeuyhmQYMWK0c',
            'encryptKey' => 'MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDF2+MWi5Hixr7HJaJ1ghaHMI+Hxw35AzaqOrMwHdcDAmBkDJlEQXCralBltSvIkOPVIgewMvt9bNSdmsSky1AM2YDayofgG5lS9UtP9Q6V0QIBJNJ/YMAzfXy7AFYWCVnpE06fA59DRVvyAyjGxmb1+e1Az1iypVCasZmONEmwuwIDAQAB',
            'checksumKey' => '1TONtGwDRQFTvFuPYSeSx4HMWUKl5S',
            'callbackUrl' => 'http://pay.imgroup.vn/payment/nganluong/callback?payment_method=installment',
            "env"       => "live",
        ],
    ],
    'vnpay' => [
        'dev' => [
            'receiver_email'  => 'ngocsuy@imgroup.vn',
            'code' => '20J5DBMV',
            'hash_secret' => 'KKPKRUECAJICUMVYTCFCDOQVNWZWABUE',
            'check_order_url' => 'http://sandbox.vnpayment.vn/paymentv2/vpcpay.html',
            'return_url' => 'http://pay.hogoweb.com/payment/vnpay/callback',
            'confirm_order_url' => 'http://erp.webitop.com/api/confirm-order'
        ],
        'production' => [
            'receiver_email'  => 'thuylinh@imgroup.vn',
            'code' => '',
            'hash_secret' => '',
            'check_order_url' => 'http://sandbox.vnpayment.vn/paymentv2/vpcpay.html',
            'return_url' => 'http://pay.imgroup.vn/payment/vnpay/callback',
            'confirm_order_url' => 'https://id.kinhdoanhso.com/api/confirm-order'
        ],
    ]

];