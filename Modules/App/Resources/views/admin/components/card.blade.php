@php
$route = explode('.', Route::current()->getName());
$text = $route[array_key_last($route)];
$title = trans(\Route::getCurrentRoute()->action['module'].'::'.$resource.'.module')
@endphp
<template v-if="alert.success">
    <div class="alert alert-success alert-styled-left alert-arrow-left alert-dismissible">
        <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
        @{{ alert.title }}
    </div>
</template>
<template v-if="alert.danger">
    <div class="alert alert-danger alert-styled-left alert-arrow-left alert-dismissible">
        <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
        @{{ alert.title }}
    </div>
</template>
<div class="row">
    <div class="col-sx-12 col-sm-12 {{ !empty($is_full) ? '' : 'col-lg-10 col-md-8 offset-lg-1 offset-md-2' }}">
        <div class="card">
            <div class="card-heading">
                <strong>
                    {{ trans('resource.'.$text) }} <span>{{ $title }}</span>
                </strong>
            </div>
            <div class="card-body">
                @stack('form')
            </div>
            <div class="card-footer text-right">
                <a onclick="history.back();" style="cursor: pointer;" class="btn btn-warning btn-sm">
                    <b><span class="icon-reply"></span></b>
                    {{ trans("resource.back") }}
                </a>
                @if (isset($buttons))
                @php($edit = !empty($edit) ? $edit : [] )
                @foreach($buttons as $view)
                    <button v-on:click="{{ $view }}('{{ route('admin.'.$resource.'.'.$view, $edit) }}')" class="btn {{ config('erp.btn_class.'.$view.'.class') }} btn-sm btn-actions btn-{{ $view }}" style="margin-left: 5px;">
                        <b><span class="{{ config('erp.btn_class.'.$view.'.icon') }}"></span> </b> 
                        {{ trans("resource.{$view}") }}
                    </button>
                    @if($view == 'store')
                        <button v-on:click="{{ $view }}('{{ route('admin.'.$resource.'.'.$view, $edit) }}', true)" class="btn btn-sm btn-actions btn-primary btn-store" style="margin-left: 5px;">
                            <b><span class="{{ config('erp.btn_class.'.$view.'.icon') }}"></span> </b> 
                            {{ trans("resource.store_continue") }}
                        </button>
                    @endif
                @endforeach
                @endif
            </div>
        </div>
        @stack('form_list')
        @if(!empty($seo))
        <div class="card">
            <div class="card-heading">
                <div class="row">
                    <div class="col-lg-6 col-xs-6 col-sm-6">
                        <strong>URL</strong>
                    </div>
                    <div class="col-lg-6 col-xs-6 col-sm-6 text-right">
                        <a href="javascript:void(0)" v-on:click="showURL">{{ trans('core::seo.alert_url') }}</a>
                    </div>
                </div>
            </div>
            <div class="card-body" id="url-data">
                <div>
                    <a href="">{{ url('/') }}/@{{ form.alias }}</a>
                </div>
                <div id="show-edit-url" style="display: none;">
                    <div class="form-group">
                        <label for="code" class="control-label">
                            {!! trans('core::seo.url') !!}: <span class="text-danger">*</span>
                        </label>
                        <div class="input-group input-group-sm">
                            <span class="input-group-prepend">
                                <span class="input-group-text">
                                    {{ url('/') }}
                                </span>
                            </span>
                            <input id="alias" name="alias" v-model="form.alias" type="text" class="form-control">
                        </div>
                        <p style="margin-top: 5px;">
                            <span class="badge badge-danger">NOTE!</span>
                            <span id="title-len">
                                <span class="text-danger">
                                    {!! trans('core::seo.url_note') !!}
                                </span>
                            </span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-heading">
                <div class="row">
                    <div class="col-lg-6 col-xs-6 col-sm-6">
                        <strong>{{ trans('core::seo.alert_seo') }}</strong>
                    </div>
                    <div class="col-lg-6 col-xs-6 col-sm-6 text-right">
                        <a  href="javascript:void(0)" v-on:click="showSeo">
                            {{ trans('core::seo.alert_seo') }}
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div id="seo-data" style="display: none;">
                    <div class="row">
                        <div class="col-sx-12 col-sm-3 col-md-3">
                            <image_change v-model="form.seo.img" :title="'{{ trans('core::seo.img') }}'"></image_change>
                            <div class="form-group">
                                <label for="published_at" class="control-label">
                                    {!! trans('core::seo.published_at') !!}:
                                </label>
                                <datepickertime v-model="form.seo.published_at"></datepickertime>
                            </div>
                        </div>
                        <div class="col-sx-12 col-sm-9 col-md-9">
                            <div class="form-group form-group-feedback form-group-feedback-right">
                                <label class="control-label" for="code">
                                    {{ trans('core::seo.title') }}:
                                </label>
                                <input type="text" class="form-control form-control-sm" name="title" v-model="form.seo.title" />
                                <div class="form-control-feedback form-control-feedback-sm">
                                    @{{ form.seo.title.length }}/80
                                </div>
                                <p style="margin-top:5px;">
                                    <span class="badge badge-danger">NOTE!</span>
                                    <span id="title-len">
                                        <span class="text-danger">
                                            {{ trans('core::seo.title_note') }}
                                        </span>
                                    </span>
                                </p>
                            </div>
                            <div class="form-group form-group-feedback form-group-feedback-right">
                                <label class="control-label" for="code">
                                    {{ trans('core::seo.title') }}:
                                </label>
                                <textarea class="form-control" name="description" id="description" rows="3" v-model="form.seo.description"></textarea>
                                <div class="form-control-feedback form-control-feedback-sm">
                                    @{{ form.seo.description.length }}/160
                                </div>
                                <p style="margin-top:5px;">
                                    <span class="badge badge-danger">NOTE!</span>
                                    <span id="title-len">
                                        <span class="text-danger">
                                            {!! trans('core::seo.description_note') !!}
                                        </span>
                                    </span>
                                </p>
                            </div>
                        </div>
                        <div class="col-sx-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <label class="control-label" for="keywordSeo">
                                    {{ trans('core::seo.keyword') }}: 
                                </label>
                                <textarea class="form-control" name="keyword" id="keyword" rows="3" v-model="form.seo.keyword"></textarea>
                                <p style="margin-top:5px;">
                                    <span class="badge badge-danger">NOTE!</span>
                                    <span id="title-len">
                                        <span class="text-danger">
                                            {!! trans('core::seo.keyword_note') !!}
                                        </span>
                                    </span>
                                </p>
                            </div>
                            <div class="form-group mb-0">
                                <div class="checkbox checkbox-custom">
                                    <input id="status" type="checkbox" name="status" v-model="form.seo.status">
                                    <label for="status">
                                        {!! trans('core::seo.status') !!}
                                    </label>
                                </div>
                            </div>           
                        </div>
                    </div>
                </div>
                <p class="mb-0 pb-0">Thiết lập các thẻ mô tả giúp người dùng dễ dàng tìm thấy trên công cụ tìm kiếm như Google.</p>
            </div>
            <div class="card-footer text-right">
                <a onclick="history.back();" style="cursor: pointer;" class="btn btn-warning btn-sm">
                    <b><span class="icon-reply"></span></b>
                    {{ trans("resource.back") }}
                </a>
                @if (isset($buttons))
                @php($edit = !empty($edit) ? $edit : [] )
                @foreach($buttons as $view)
                <button v-on:click="{{ $view }}('{{ route('admin.'.$resource.'.'.$view, $edit) }}')" class="btn {{ config('erp.btn_class.'.$view.'.class') }} btn-sm btn-actions btn-{{ $view }}" style="margin-left: 5px;">
                    <b><span class="{{ config('erp.btn_class.'.$view.'.icon') }}"></span> </b> 
                    {{ trans("resource.{$view}") }}
                </button>
                    @if($view == 'store')
                        <button v-on:click="{{ $view }}('{{ route('admin.'.$resource.'.'.$view, $edit) }}', true)" class="btn btn-sm btn-actions btn-primary btn-store" style="margin-left: 5px;">
                            <b><span class="{{ config('erp.btn_class.'.$view.'.icon') }}"></span> </b> 
                            {{ trans("resource.store_continue") }}
                        </button>
                    @endif

                @endforeach
                @endif
            </div>
        </div>
        @endif
    </div>
    {{-- <div class="col-md-3 col-xs-12 col-sm-3">
        
        @stack('form_right')
    </div> --}}
</div>