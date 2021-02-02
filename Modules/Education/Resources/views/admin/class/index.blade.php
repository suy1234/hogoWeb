@extends('app::admin.layouts.master')

@section('navbar')
@component('app::admin.components.navbar')
@slot('buttons', ['create'])
@slot('resource', 'classs')
@endcomponent
@endsection

@section('content')
@component('app::admin.components.table')
@slot('title', trans('education::classs.table.list'))
@slot('route', route('admin.classs.index'))
@slot('resource', 'classs')
@slot('checkbox', true)
@slot('thead', [
	trans('education::classs.table.code'),
	trans('education::classs.table.subject').'/'.trans('education::classs.table.course'),
	trans('education::classs.table.exam'),
])

@push('tbody')
	<td>
		@{{ item.code }}<br>
		{{ trans('education::classs.table.count_customer') }}: @{{ item.option.count_customer }}
	</td>
	<td>@{{ item.option.subject }} <br> @{{ item.option.course }}</td>
	<td>
		<p>
			<strong>{{ trans('education::classs.table.graduation_exam') }}:</strong>
			@{{ item.option.graduation_exam }}
		</p>
		<p>
			<strong>{{ trans('education::classs.table.driving_exam_provisional') }}:</strong>
			@{{ item.option.driving_exam_provisional }}
		</p>
		<p>
			<strong>{{ trans('education::classs.table.driving_exam') }}:</strong>
			@{{ item.option.driving_exam }}
		</p>
		
	</td>
@endpush
@endcomponent
@endsection
