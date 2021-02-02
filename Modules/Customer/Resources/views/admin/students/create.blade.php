@extends('app::admin.layouts.master')

@section('navbar')
@component('app::admin.components.navbar')
@slot('buttons', ['store'])
@slot('resource', 'students')
@endcomponent
@endsection

@section('content')
<div class="row">
	<div class="col-md-12 col-sm-12  col-xs-12">
		@component('app::admin.components.card')
		@slot('buttons', ['store'])
		@slot('resource', 'students')
		@push('form')
		@include('customer::admin.students.form')
		@endpush
		@endcomponent
	</div>
</div>
@endsection