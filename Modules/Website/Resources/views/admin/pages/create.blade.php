@extends('app::admin.layouts.master')

@section('navbar')
@component('app::admin.components.navbar')
@slot('buttons', ['store'])
@slot('resource', 'pages')
@endcomponent
@endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		@component('app::admin.components.card')
		@slot('buttons', ['store'])
		@slot('resource', 'pages')
		@slot('seo', $seo)
		@push('form')
		@include('website::admin.pages.form')
		@endpush
		@endcomponent
	</div>
</div>
@endsection