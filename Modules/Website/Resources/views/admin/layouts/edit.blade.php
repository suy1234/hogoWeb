@extends('app::admin.layouts.master')

@section('navbar')
@component('app::admin.components.navbar')
@slot('buttons', ['update'])
@slot('edit', ['id' => $layout->id])
@slot('resource', 'layouts')
@endcomponent
@endsection

@section('content')
	@component('app::admin.components.card')
	@slot('buttons', ['update'])
	@slot('edit', ['id' => $layout->id])
	@slot('resource', 'layouts')
		@push('form')
			@include('website::admin.layouts.form')
		@endpush
	@endcomponent
@endsection