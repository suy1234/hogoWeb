@extends('app::admin.layouts.master')

@section('navbar')
@component('app::admin.components.navbar')
@slot('buttons', ['create'])
@slot('resource', 'courses')
@endcomponent
@endsection

@section('content')
@component('app::admin.components.table')
@slot('title', trans('education::courses.table.list'))
@slot('route', route('admin.courses.index'))
@slot('resource', 'courses')
@slot('checkbox', true)
@slot('thead', [
	trans('education::courses.table.title'),
	trans('education::courses.table.year'),
])

@push('tbody')
	<td>@{{ item.title }}</td>
	<td>@{{ item.school_from_year }} - @{{ item.school_to_year }}</td>
@endpush
@endcomponent
@endsection
