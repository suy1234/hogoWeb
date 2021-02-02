@extends('app::admin.layouts.master')

@section('navbar')
@component('app::admin.components.navbar')
@slot('buttons', ['store'])
@slot('resource', 'widget_themes')
@endcomponent
@endsection

@section('content')
	@component('app::admin.components.card')
	@slot('buttons', ['store'])
	@slot('is_full', true)
	@slot('resource', 'widget_themes')
		@push('form')
			@include('widget::admin.widget_themes.form')
		@endpush
	@endcomponent
@endsection