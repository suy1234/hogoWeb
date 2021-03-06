@extends('app::admin.layouts.master')

@section('navbar')
<div class="page-header page-header-light" id="page-header-light" style="position: fixed;z-index: 1;width: calc(100% - 260px);">
	<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
		<div class="d-flex">
			<div class="breadcrumb">
				<a href="{{ route('admin.dashboard.index') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> {{ trans('resource.home') }}</a>

				<a href="{{ route('admin.categorys.index', ['code' => request()->code]) }}" class="breadcrumb-item">{{ trans('core::functions.'.request()->code) }}</a>
				<span class="breadcrumb-item active">{{ trans('resource.create') }}</span>	
			</div>

			<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>

		</div>
		<div class="header-elements d-none">
			<div class="breadcrumb justify-content-center">
				<a href="{{ route('admin.categorys.update', ['id' => $category->id,'code' => request()->code]) }}" class="btn {{ config('erp.btn_class.update.class') }} btn-sm btn-actions btn-store" style="margin-left: 5px;">
					<b><span class="{{ config('erp.btn_class.update.icon') }}"></span> </b> 
					{{ trans("resource.store") }}
				</a>
			</div>
		</div>
	</div>
</div>
@endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		@component('app::admin.components.card')
		@slot('buttons', ['update'])
		@slot('edit', ['id' => $category->id, 'code' => request()->code])
		@slot('resource', 'categorys')
		@slot('seo', $seo)
		@push('form')
		@include('core::admin.categorys.form')
		@endpush
		@endcomponent
	</div>
</div>
@endsection