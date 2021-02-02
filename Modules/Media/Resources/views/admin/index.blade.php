@extends('app::admin.layouts.master')

@section('navbar')
@component('app::admin.components.navbar')
@slot('resource', 'medias')
@endcomponent
@endsection

@section('content')

@include('media::admin.list')

@endsection
