@extends('app::admin.layouts.master')

@section('navbar')
@component('app::admin.components.navbar')
@slot('buttons', ['create'])
@slot('resource', 'questions')
@endcomponent
@endsection

@section('content')
@component('app::admin.components.table')
@slot('title', trans('question::questions.table.list'))
@slot('route', route('admin.questions.index'))
@slot('resource', 'questions')
@slot('checkbox', true)
@slot('thead', [
	trans('question::questions.table.title'),
	trans('question::questions.table.category'),
	trans('question::questions.table.group'),
	trans('question::questions.table.exam'),
])

@push('tbody')
	<td v-html="item.content" class="v-html"></td>
	<td>@{{ item.option.category }}</td>
	<td>@{{ item.option.group }}</td>
	<td>@{{ item.option.group_type }}</td>
@endpush
@endcomponent
@endsection
