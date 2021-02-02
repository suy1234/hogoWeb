@extends('app::admin.layouts.master')

@section('navbar')
@component('app::admin.components.navbar')
@slot('buttons', ['update'])
@slot('edit', ['id' => $widgetTheme->id])
@slot('resource', 'widget_themes')
@endcomponent
@endsection

@section('content')
	@component('app::admin.components.card')
	@slot('buttons', ['update'])
	@slot('is_full', true)
	@slot('edit', ['id' => $widgetTheme->id])
	@slot('resource', 'widget_themes')
		@push('form')
			@include('widget::admin.widget_themes.form')
		@endpush
	@endcomponent
@endsection