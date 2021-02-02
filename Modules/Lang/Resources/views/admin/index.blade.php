@extends('app::admin.layouts.master')

@section('navbar')
@component('app::admin.components.navbar')
@slot('buttons', ['create'])
@slot('resource', 'langs')
@endcomponent
@endsection

@section('content')
@component('app::admin.components.table')
@slot('title', trans('lang::langs.table.list'))
@slot('route', route('admin.langs.index'))
@slot('resource', 'langs')
@slot('checkbox', true)
@slot('thead', [
	trans('lang::langs.table.code'),
	trans('lang::langs.table.title'),
])

@push('tbody')
	<td>@{{ item.code }}</td>
	<td>@{{ item.title }}</td>
@endpush
@endcomponent
@endsection
