@extends('app::admin.layouts.master')

@section('navbar')
@component('app::admin.components.navbar')
@slot('buttons', ['create'])
@slot('resource', 'brands')
@endcomponent
@endsection

@section('content')
	@component('app::admin.components.table')
		@slot('title', trans('product::brands.table.list'))
		@slot('route', route('admin.brands.index'))
		@slot('resource', 'brands')
		@slot('checkbox', true)
			@slot('thead', [
				trans('product::brands.table.title'),
				trans('product::brands.table.description'),
			])
		@push('tbody')
			<td>@{{ item.title }}</td>
			<td>@{{ item.description }}</td>
		@endpush
	@endcomponent
@endsection
