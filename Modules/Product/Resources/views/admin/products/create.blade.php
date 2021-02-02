@extends('app::admin.layouts.master')

@section('navbar')
@component('app::admin.components.navbar')
@slot('buttons', ['store'])
@slot('resource', 'products')
@endcomponent
@endsection

@section('content')
	@component('app::admin.components.card')
		@slot('buttons', ['store'])
		@slot('resource', 'products')
		@slot('seo', $seo)
		@push('form')
			@include('product::admin.products.tabs.general')
			@include('product::admin.products.script')
		@endpush
	@endcomponent
@endsection