@extends('app::admin.layouts.master')

@section('navbar')
	@component('app::admin.components.navbar')
		@slot('buttons', ['create'])
		@slot('resource', 'layouts')
	@endcomponent
@endsection

@section('content')
	@component('app::admin.components.table')
		@slot('title', trans('website::page_layouts.table.list'))
		@slot('route', route('admin.layouts.index'))
		@slot('resource', 'layouts')
		@slot('checkbox', true)
		@slot('thead', [
			trans('website::page_layouts.table.title'),
			trans('website::layouts.form.type'),
			trans('website::layouts.form.design'),
		])

		@push('tbody')
			<td class="v-html">@{{ item.title }}</td>
			<td class="v-html">@{{ item.option.type }}</td>
			<td>
				@if(auth()->user()->hasAccess('admin.layouts.design'))
				<a :href="item.option.url_widget" class="text-info" data-original-title="{{ trans('website::layouts.form.design') }}">
					<i class="icon-design"></i>
				</a>
				@endif
			</td>
		@endpush

	@endcomponent
@endsection
