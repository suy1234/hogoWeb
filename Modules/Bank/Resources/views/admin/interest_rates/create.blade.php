@extends('app::admin.layouts.master')

@section('navbar')
@component('app::admin.components.navbar')
@slot('buttons', ['store'])
@slot('resource', 'interest_rates')
@endcomponent
@endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		@component('app::admin.components.card')
		@slot('buttons', ['store'])
		@slot('resource', 'interest_rates')
		@push('form')
		@include('bank::admin.interest_rates.form')
		@endpush
		@endcomponent
	</div>
</div>
@endsection