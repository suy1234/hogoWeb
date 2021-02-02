@extends('app::admin.layouts.master')

@section('navbar')
@component('app::admin.components.navbar')
@slot('buttons', ['create'])
@slot('resource', 'students')
@endcomponent
@endsection

@section('content')
@component('app::admin.components.table')
@slot('title', trans('customer::students.table.list'))
@slot('route', route('admin.students.index'))
@slot('resource', 'students')
@slot('checkbox', true)
@slot('thead', [
	trans('customer::students.table.code'),
	trans('customer::students.table.info'),
	trans('customer::students.table.more_information'),
])

@push('tbody')
	<td>@{{ item.code }}</td>
	<td>
		<p>@{{ item.fullname }}</p>
		<p>@{{ item.phone }}</p>
		<p>@{{ item.email }}</p>
	</td>
	<td>@{{ item.title }}</td>
@endpush
@endcomponent
@endsection
