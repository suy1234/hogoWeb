@extends('app::admin.layouts.master')

@section('navbar')
@component('app::admin.components.navbar')
@slot('buttons', ['store'])
@slot('resource', 'classs')
@endcomponent
@endsection

@section('content')
@component('app::admin.components.card')
@slot('buttons', ['store'])
@slot('resource', 'classs')
@push('form')
@include('education::admin.class.form')
@endpush
@endcomponent
@endsection