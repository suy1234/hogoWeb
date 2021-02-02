@extends('app::admin.layouts.master')

@section('navbar')
@component('app::admin.components.navbar')
@slot('buttons', ['update'])
@slot('edit', ['id' => $customers->id])
@slot('resource', 'customers')
@endcomponent
@endsection

@section('content')
@component('app::admin.components.card')
@slot('buttons', ['update'])
@slot('edit', ['id' => $customers->id])
@slot('resource', 'customers')
@push('form')
@include('customer::admin.partials.form')
@endpush
@endcomponent
@endsection