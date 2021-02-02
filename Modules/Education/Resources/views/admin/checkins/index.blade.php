@extends('app::admin.layouts.master')

@section('navbar')
@component('app::admin.components.navbar')
@slot('resource', 'checkins')
@endcomponent
@endsection

@section('content')
@component('app::admin.components.table')
@slot('title', trans('education::checkins.table.list'))
@slot('route', route('admin.checkins.index'))
@slot('resource', 'checkins')
@slot('checkbox', true)
@slot('is_edit', true)
@slot('thead', [
	trans('education::checkins.table.teacher'),
	trans('education::checkins.table.from_date'),
	trans('education::checkins.table.to_date'),
	trans('education::checkins.table.qty'),
])

@push('tbody')
	<td>@{{ item.title }}</td>
	<td>@{{ item.form_date }}</td>
	<td>@{{ item.to_date }}</td>
	<td>@{{ item.qty }}h</td>
@endpush
@endcomponent
@endsection
