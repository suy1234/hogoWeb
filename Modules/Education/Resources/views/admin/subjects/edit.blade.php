@extends('app::admin.layouts.master')

@section('navbar')
@component('app::admin.components.navbar')
@slot('buttons', ['update'])
@slot('edit', ['id' => $subjects->id])
@slot('resource', 'subjects')
@endcomponent
@endsection

@section('content')
<div class="row">
	<div class="col-md-6 offset-md-3">
		@component('app::admin.components.card')
		@slot('buttons', ['update'])
		@slot('edit', ['id' => $subjects->id])
		@slot('resource', 'subjects')
		@push('form')
		@include('education::admin.subjects.form')
		@endpush
		@endcomponent
	</div>
</div>
@endsection