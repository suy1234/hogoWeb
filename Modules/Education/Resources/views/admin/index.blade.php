@extends('app::admin.layouts.master')

@section('navbar')
@component('app::admin.components.navbar')
@slot('buttons', ['create'])
@slot('resource', 'customers')
@endcomponent
@endsection

@section('content')
@component('app::admin.components.table')
@slot('title', trans('customer::customers.table.list'))
@slot('route', route('admin.customers.index'))
@slot('resource', 'customers')
@slot('checkbox', true)
@slot('thead', [
	trans('customer::customers.table.code'),
	trans('customer::customers.table.info'),
	trans('customer::customers.table.sale'),
	trans('customer::customers.table.more_information'),
])

@push('tbody')
	<td>@{{ item.code }}</td>
	<td>@{{ item.title }}</td>
	<td>@{{ item.title }}</td>
	<td>@{{ item.title }}</td>
@endpush
@endcomponent
@endsection
