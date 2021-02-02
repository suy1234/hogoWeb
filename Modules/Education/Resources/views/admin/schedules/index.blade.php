@extends('app::admin.layouts.master')

@section('navbar')
@component('app::admin.components.navbar')
@slot('buttons', ['create'])
@slot('resource', 'schedules')
@endcomponent
@endsection

@section('content')
@component('app::admin.components.table')
@slot('title', trans('education::schedules.table.list'))
@slot('route', route('admin.schedules.index'))
@slot('resource', 'schedules')
@slot('checkbox', true)
@slot('thead', [
	trans('education::schedules.table.teacher'),
	trans('education::schedules.table.subject'),
	trans('education::schedules.table.from_date'),
	trans('education::schedules.table.to_date'),
	trans('education::schedules.table.qty'),
])

@push('tbody')
	<td>@{{ item.title }}</td>
	<td>@{{ item.from_date }}</td>
	<td>@{{ item.subject }}</td>
	<td>@{{ item.to_date }}</td>
	<td>@{{ item.qty }}h</td>
@endpush
@endcomponent
@endsection
