@extends('app::admin.layouts.master')

@section('navbar')
@component('app::admin.components.navbar')
@slot('buttons', ['update'])
@slot('edit', ['id' => $page->id])
@slot('resource', 'pages')
@endcomponent
@endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		@component('app::admin.components.card')
			@slot('buttons', ['update'])
			@slot('edit', ['id' => $page->id])
			@slot('resource', 'pages')
			@slot('seo', $seo)
			@push('form')
				@include('website::admin.pages.form')
			@endpush
		@endcomponent
	</div>
</div>
@endsection