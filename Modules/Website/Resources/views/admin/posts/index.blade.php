@extends('app::admin.layouts.master')

@section('navbar')
	@component('app::admin.components.navbar')
		@slot('buttons', ['create'])
		@slot('resource', 'posts')
	@endcomponent
@endsection

@section('content')
	@component('app::admin.components.table')
		@slot('title', trans('website::posts.table.list'))
		@slot('route', route('admin.posts.index'))
		@slot('resource', 'posts')
		@slot('checkbox', true)
		@slot('thead', [
			trans('website::posts.table.img'),
			trans('website::posts.table.title'),
			trans('website::posts.table.category'),
		])

		@push('tbody')
			<td>
				<template v-if="item.img">
					<img :src="item.img" class="img-responsive">
				</template>
			</td>
			<td class="v-html">@{{ item.title }}</td>
			<td>@{{ item.option.category }}</td>
		@endpush

	@endcomponent
	{{-- @component('app::admin.components.form')
		@slot('resource', 'posts')
		@push('form')
			@include('website::admin.posts.form')
		@endpush
	@endcomponent --}}

@endsection
