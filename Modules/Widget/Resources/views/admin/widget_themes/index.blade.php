@extends('app::admin.layouts.master')

@section('navbar')
	@component('app::admin.components.navbar')
		@slot('buttons', ['create'])
		@slot('resource', 'widget_themes')
	@endcomponent
@endsection

@section('content')
	@component('app::admin.components.table')
		@slot('title', trans('widget::widget_themes.table.list'))
		@slot('route', route('admin.widget_themes.index'))
		@slot('resource', 'widget_themes')
		@slot('checkbox', true)
		@slot('is_status', true)
		@slot('thead', [
			trans('widget::widget_themes.table.img'),
			trans('widget::widget_themes.table.type'),
		])

		@push('tbody')
			<td>
				<template v-if="item.img">
					<img :src="item.img" class="img-responsive">
				</template>
			</td>
			<td>@{{ item.type }}</td>
		@endpush

	@endcomponent
@endsection
