@extends('app::admin.layouts.master')

@section('navbar')
@component('app::admin.components.navbar')
@slot('buttons', ['update'])
@slot('edit', ['id' => $bank->id])
@slot('resource', 'banks')
@endcomponent
@endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		@component('app::admin.components.card')
			@slot('buttons', ['update'])
			@slot('edit', ['id' => $bank->id])
			@slot('resource', 'banks')
			@slot('seo', $seo)
			@push('form')
				@include('bank::admin.banks.form')
			@endpush
		@endcomponent
	</div>
</div>
@endsection