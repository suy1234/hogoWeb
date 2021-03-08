@extends('app::admin.layouts.master')

@section('navbar')
@component('app::admin.components.navbar')
@slot('buttons', ['create'])
@slot('resource', 'products')
@endcomponent
@endsection

@section('content')
	@component('app::admin.components.table')
		@slot('filter')
			@include('product::admin.brands.filters.brands')
			@include('core::admin.categorys.filters.categories', ['type' => 'product', 'title' => trans('product::products.filters.category')])
			@include('core::admin.groups.filters.groups', ['type' => 'product', 'title' => trans('product::products.filters.group')])
		@endslot

		@slot('title', trans('product::products.table.list'))
		@slot('route', route('admin.products.index'))
		@slot('resource', 'products')
		@slot('checkbox', true)
			@slot('thead', [
				trans('product::products.table.img'),
				trans('product::products.table.title'),
				trans('product::products.table.sku'),
				trans('product::products.table.category'),
			])
		@push('tbody')
			<td>
				<template v-if="item.img">
					<img :src="item.img" class="img-responsive">
				</template>
			</td>
			<td>
				@{{ item.title }} <br>
				<span class="text-success">@{{ item.price | money }}</span> - 
				<span class="text-warning">@{{ item.price_sale | money }}</span>
			</td>
			<td>@{{ item.sku }}</td>
			<td>@{{ item.category }}</td>
		@endpush
	@endcomponent
@endsection
