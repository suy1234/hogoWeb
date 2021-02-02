@extends('app::admin.layouts.master')

@section('navbar')
@component('app::admin.components.navbar')
@slot('resource', 'units')
@endcomponent
@endsection

@section('content')
	@include('product::admin.units.form')
	@component('app::admin.components.table')
		@slot('title', trans('product::units.table.list'))
		@slot('route', route('admin.units.index'))
		@slot('resource', 'units')
		@slot('checkbox', true)
		@slot('is_edit', true)
		@slot('mix_children', true)
			@slot('thead', [
				trans('product::units.table.title'),
				''
			])
		@push('tbody')
			<td>@{{ item.title }}</td>
			<td>
				<a v-on:click="getData(item)" class="text-primary" v-tooltip title="{{ trans('resource.edit') }}">
                    <i class="icon-pencil7"></i>
                </a>
			</td>
		@endpush
	@endcomponent
@endsection