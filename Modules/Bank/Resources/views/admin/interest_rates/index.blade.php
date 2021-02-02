@extends('app::admin.layouts.master')

@section('navbar')
	@component('app::admin.components.navbar')
		@slot('buttons', ['create'])
		@slot('resource', 'interest_rates')
	@endcomponent
@endsection

@section('content')
	@component('app::admin.components.table')
		@slot('title', trans('bank::interest_rates.table.list'))
		@slot('route', route('admin.interest_rates.index'))
		@slot('resource', 'interest_rates')
		@slot('checkbox', true)
		@slot('thead', [
			trans('bank::interest_rates.table.group'),
			trans('bank::interest_rates.table.interest_rate'),
			trans('bank::interest_rates.table.endow'),
			trans('bank::interest_rates.form.timeout'),
		])

		@push('tbody')
			<td>@{{ item.title }}</td>
			<td>@{{ item.bank_info.interest_rate.value }} / @{{ item.bank_info.interest_rate.unit }}</td>
			<td>@{{ item.bank_info.endow.value }} / @{{ item.bank_info.endow.unit }}</td>
			<td>@{{ item.bank_info.timeout.value }} / @{{ item.bank_info.timeout.unit }}</td>
		@endpush

	@endcomponent
@endsection
