@extends('app::admin.layouts.master')

@section('navbar')
@component('app::admin.components.navbar')
@slot('buttons', ['update'])
@slot('edit', ['id' => $classs->id])
@slot('resource', 'classs')
@endcomponent
@endsection

@section('content')
@component('app::admin.components.card')
@slot('buttons', ['update'])
@slot('resource', 'classs')
@slot('edit', ['id' => $classs->id])
@push('form')
@include('education::admin.class.form')
@endpush
@endcomponent
@endsection