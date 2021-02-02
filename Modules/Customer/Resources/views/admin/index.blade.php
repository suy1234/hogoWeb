@extends('app::admin.layouts.master')

@section('navbar')
@component('app::admin.components.navbar')
@slot('buttons', ['create'])
@slot('resource', 'customers')
@endcomponent
@endsection

@section('content')
@component('app::admin.components.table')

	@slot('filter')
		@include('customer::admin.filter.status')
		@slot('export', true)
	@endslot

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
		<td>
			<p>@{{ item.fullname }}</p>
			<p>@{{ item.phone }}</p>
			<p>@{{ item.email }}</p>
		</td>
		<td></td>
		<td>@{{ item.title }}</td>
	@endpush
	@endcomponent
@endsection
