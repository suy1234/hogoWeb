@extends('app::admin.layouts.master')

@section('navbar')
	@component('app::admin.components.navbar')
		@slot('buttons', ['create'])
		@slot('resource', 'pages')
	@endcomponent
@endsection

@section('content')
	@component('app::admin.components.table')
		@slot('title', trans('website::pages.table.list'))
		@slot('route', route('admin.pages.index'))
		@slot('resource', 'pages')
		@slot('checkbox', true)
		@slot('thead', [
			trans('website::pages.table.img'),
			'',
			trans('website::pages.table.title'),
			trans('website::pages.table.builder'),
			trans('website::layouts.form.design'),
		])

		@push('tbody')
			<td>
				<template v-if="item.img">
					<img :src="item.img" class="img-responsive">
				</template>
			</td>
			<td>
				<template v-if="item.page_default == 1">
					<i class="icon-home2 icon-1x text-success"></i>
				</template>
			</td>			
			<td class="v-html">@{{ item.title }}</td>
			<td>
				<a :href="item.option.url_builder"><i class="icon-embed2"></i></a>
			</td>
			<td>
				@if(auth()->user()->hasAccess('admin.layouts.design'))
				<a :href="item.option.url_design" class="text-info" data-original-title="{{ trans('website::layouts.form.design') }}">
					<i class="icon-design"></i>
				</a>
				@endif
			</td>
		@endpush

	@endcomponent
@endsection
