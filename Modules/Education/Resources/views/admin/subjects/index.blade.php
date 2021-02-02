@extends('app::admin.layouts.master')

@section('navbar')
@component('app::admin.components.navbar')
@slot('buttons', ['create'])
@slot('resource', 'subjects')
@endcomponent
@endsection

@section('content')
@component('app::admin.components.table')
@slot('title', trans('education::subjects.table.list'))
@slot('route', route('admin.subjects.index'))
@slot('resource', 'subjects')
@slot('checkbox', true)
@slot('thead', [
	trans('education::subjects.table.title'),
])

@push('tbody')
	<td>@{{ item.title }}</td>
@endpush
@endcomponent
@endsection
