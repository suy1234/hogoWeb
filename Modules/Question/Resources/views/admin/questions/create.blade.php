@extends('app::admin.layouts.master')

@section('navbar')
@component('app::admin.components.navbar')
@slot('buttons', ['store'])
@slot('edit', ['cat_id' => request()->cat_id])
@slot('resource', 'questions')
@endcomponent
@endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		@component('app::admin.components.card')
		@slot('buttons', ['store'])
		@slot('resource', 'questions')
		@push('form')
		@include('question::admin.questions.form')
		@endpush
		@endcomponent
	</div>
</div>
@endsection