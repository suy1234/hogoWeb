<?php
namespace Modules\Product\Amin;

use  Modules\Core\Admin\AdminTable;

class ProductTable extends AdminTable
{
	protected $rawColumns = ['created_at', 'customer', 'type', 'status'];

	public function make() {
		return $this->newTable()
		->addColumn('category', function ($product) {
			return $product->category->title;
		})
		// ->editColumn('customer', function ($checkin)  {
		// 	$info = $checkin->customer_name.'<br/>'.$checkin->customer_email;
		// 	if($checkin->customer->id){
		// 		$info='<a href="'.route('admin.customers.show',$checkin->customer->id).'">'.$info.'</a>';
		// 	}
		// 	else {
		// 		$info='<span class="text-danger">'.$info.'</span>';
		// 	}
		// 	return $info;
		// })
		
		// ->addColumn('product', function ($checkin) {
		// 	return $checkin->product->title;
		// })
		// ->editColumn('checkin_date', function ($checkin) {
		// 	return !empty($checkin->checkin_date) ? date('d-m-Y H:i:s', strtotime($checkin->checkin_date)) : '';
		// })
		// ->editColumn('type', function ($checkin){
		// 	return '<span class="font-size-base font-weight-normal badge badge-flat border-danger text-danger">'.$checkin->type.'</span>';
		// })
		// ->editColumn('status', function ($checkin) use ($checkin_statuses){
		// 	return '<span class="font-size-base font-weight-normal badge badge-flat '.$checkin_statuses[$checkin->is_active]['class'].'">'.$checkin_statuses[$checkin->is_active]['title'].'</span>';
		// })
		;
	}
}