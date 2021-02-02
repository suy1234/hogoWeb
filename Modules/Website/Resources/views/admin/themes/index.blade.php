@extends('app::admin.layouts.master')

@section('navbar')
	@component('app::admin.components.navbar')
		@slot('buttons', ['create'])
		@slot('resource', 'themes')
	@endcomponent
@endsection

@section('content')
	@component('app::admin.components.table')
		@slot('title', trans('website::themes.list'))
		@slot('route', route('admin.themes.index'))
		@slot('resource', 'themes')
		@slot('is_status', true)
		@slot('thead', [
			trans('website::themes.table.theme'),
			trans('website::themes.table.default'),
		])

		@push('tbody')
			<td>@{{ item.title }}</td>
			<td>
				<a v-on:click="updateStatusItem(item.status, item.id)" :class="(item.status == 1) ? 'text-success' : 'text-warning'" v-tooltip :title="(item.status != 1) ? '{{ trans('website::themes.table.set_default') }}' : ''">
                                    <i class="icon-home"></i>
                                </a>
			</td>
		@endpush

	@endcomponent
@endsection
