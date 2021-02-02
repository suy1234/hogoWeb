@extends('app::admin.layouts.master')

@section('navbar')
@component('app::admin.components.navbar')
@slot('buttons', ['update'])
@slot('edit', ['id' => $brand->id])
@slot('resource', 'brands')
@endcomponent
@endsection

@section('content')
	@component('app::admin.components.card')
		@slot('buttons', ['update'])
		@slot('edit', ['id' => $brand->id])
		@slot('resource', 'brands')
		@slot('seo', $seo)
		@push('form')
			@include('product::admin.brands.tabs.general')
		@endpush
	@endcomponent
@endsection