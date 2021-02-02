@extends('app::admin.layouts.master')

@section('navbar')
	@component('app::admin.components.navbar')
		@slot('buttons', ['create'])
		@slot('resource', 'banks')
	@endcomponent
@endsection

@section('content')
	@component('app::admin.components.table')
		@slot('title', trans('bank::banks.table.list'))
		@slot('route', route('admin.banks.index'))
		@slot('resource', 'banks')
		@slot('checkbox', true)
		@slot('thead', [
			trans('bank::banks.table.img'),
			trans('bank::banks.table.title'),
		])

		@push('tbody')
			<td>
				<template v-if="item.img">
					<img :src="item.img" class="img-responsive">
				</template>
			</td>
			<td class="v-html">@{{ item.title }}</td>
		@endpush

	@endcomponent
@endsection
