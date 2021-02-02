<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
 */
function rest($router,$path, $controller)
{
	// global $router;
	$router->get($path, $controller.'@index');
	$router->get($path.'/{id}', $controller.'@show');
	$router->post($path, $controller.'@store');
	$router->put($path.'/{id}', $controller.'@update');
	$router->delete($path.'/{id}', $controller.'@destroy');
}

$router->get('/',['as' => 'index', 'uses' => 'IndexController@index']);
$router->get('/si',['as' => 'index', 'uses' => 'IndexController@index']);
$router->post('/',['as' => 'index.buyTicket', 'uses' => 'IndexController@buyTicket']);
$router->post('/register',['as' => 'register', 'uses' => 'IndexController@register']);
$router->get('/register',['as' => 'register', 'uses' => 'IndexController@register']);
$router->get('/payment/nganluong/callback',['as' => 'nganluong.callback', 'uses' => 'IndexController@nganluongCallback']);
$router->get('/payment/success',['as' => 'payment.success', 'uses' => 'IndexController@success']);
$router->get('/payment/cancel',['as' => 'payment.cancel', 'uses' => 'IndexController@cancel']);
$router->post('/buyticket',['as' => 'buyticket', 'uses' => 'IndexController@buyTicket']);
$router->get('/buyticket/payment',['as' => 'buyticket.payment', 'uses' => 'IndexController@buyTicketPayment']);
$router->post('/doopage',['as' => 'doopage', 'uses' => 'IndexController@doopage']);

$router->group(['prefix' => 'admin', 'namespace' => 'Admin'], function () use ($router){
	$router->get('', 'IndexController@index');
	$router->get('signin', 'AuthController@signin');

	$router->get('campaign/{campaign_id}/transactions', 'CampaignController@transactions');
	$router->get('campaign/{campaign_id}/coupons', 'CampaignController@coupons');
	$router->get('campaign/{campaign_id}/coupon/create', 'CampaignController@createCoupon');
	$router->post('campaign/{campaign_id}/coupon/create', 'CampaignController@storeCoupon');
	rest($router,'campaign', 'CampaignController');
});

$router->get('/order/payment',['as' => 'order_payment', 'uses' => 'OrderController@payment']);
$router->get('/order/payment/callback',['as' => 'order_payment.callback', 'uses' => 'OrderController@paymentCallback']);

$router->get('/payment/vnpay/inpn',['as' => 'vnpay.inpn', 'uses' => 'IndexController@vnpayInpn']);
$router->get('/payment/vnpay/callback',['as' => 'vnpay.callback', 'uses' => 'IndexController@vnpayCallback']);


