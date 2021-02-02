@extends('app::admin.layouts.master')

@section('navbar')
@component('app::admin.components.navbar')
@slot('buttons', ['store'])
@slot('resource', 'customers')
@endcomponent
@endsection

@section('content')
<div class="row">
	<div class="col-md-12 col-sm-12  col-xs-12">
		@component('app::admin.components.card')
		@slot('buttons', ['store'])
		@slot('edit', ['code' => 'customer'])
		@slot('resource', 'customers')
		@push('form')
		@include('customer::admin.partials.form')
		@endpush
		@endcomponent
	</div>
</div>
@endsection