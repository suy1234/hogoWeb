@extends('app::admin.layouts.master')

@section('navbar')
@component('app::admin.components.navbar')
@slot('buttons', ['update'])
@slot('edit', ['id' => $lang->id])
@slot('resource', 'langs')
@endcomponent
@endsection

@section('content')
<div class="row">
	<div class="col-md-6 offset-md-3">
		@component('app::admin.components.card')
		@slot('buttons', ['update'])
		@slot('edit', ['id' => $lang->id])
		@slot('resource', 'langs')
		@push('form')
		@include('lang::admin.form')
		@endpush
		@endcomponent
	</div>
</div>
@endsection