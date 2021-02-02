@extends('app::admin.layouts.master')

@section('navbar')
@component('app::admin.components.navbar')
@slot('buttons', ['store'])
@slot('resource', 'themes')
@endcomponent
@endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		@component('app::admin.components.card')
		@slot('buttons', ['store'])
		@slot('resource', 'themes')
		@push('form')
		@include('website::admin.themes.form')
		@endpush
		@endcomponent
	</div>
</div>
@endsection