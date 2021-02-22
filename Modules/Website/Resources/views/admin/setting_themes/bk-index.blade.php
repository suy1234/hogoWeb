@extends('app::admin.layouts.master')

@section('navbar')
@component('app::admin.components.navbar')
@slot('resource', 'setting_themes')
@endcomponent
@endsection

@section('content')
<div class="card">
	<div class="card-heading">
		<strong class="text-uppercase">
			{{ trans('website::setting_themes.setting_theme') }}
		</strong>
	</div>
	<div class="card-body">
		<div class="d-md-flex">
			<ul class="nav nav-tabs nav-tabs-vertical flex-column mr-md-3 wmin-md-200 mb-md-0 border-bottom-0">
				<li class="nav-item" v-on:click="tab = 'header'">
					<a href="#header" class="nav-link active" data-toggle="tab">
						{{ trans('website::setting_themes.tab.header') }}
					</a>
				</li>
				<li class="nav-item" v-on:click="tab = 'footer'">
					<a href="#footer" class="nav-link" data-toggle="tab">
						{{ trans('website::setting_themes.tab.footer') }}
					</a>
				</li>
				<li class="nav-item" v-on:click="tab = 'code'">
					<a href="#code" class="nav-link" data-toggle="tab">
						{{ trans('website::setting_themes.tab.code') }}
					</a>
				</li>
			</ul>

			<div class="tab-content" style="width: 100%">
				<div class="tab-pane fade show active" id="header">
					<div class="form-group">
						<label for="title">{{ trans('website::setting_themes.form.title') }}</label>
						<input type="text" class="form-control form-control-sm" v-model="form.header.title" placeholder="{{ trans('validation.attributes.title') }}" />
					</div>
					<div class="row">
						<div class="col-md-3 col-sm-6 col-xs-6">
							<image_change v-model="form.header.icon" :title="'{{ trans('website::setting_themes.form.icon') }}'"></image_change>
						</div>
						<div class="col-md-3 col-sm-6 col-xs-6">
							<image_change v-model="form.header.logo" :title="'{{ trans('website::setting_themes.form.logo') }}'"></image_change>
						</div>
					</div>
					<div class="row">
						<div class="col-md-7 col-sm-6 col-xs-6">
							<div class="form-group">
								<label class="control-label" for="header_menu_id">
									{{ trans('website::menus.menu') }}<code>*</code>:
								</label>
								<select2 allowclear v-model="form.header.menu_id" :options="menus" name="menu_id" id="header_menu_id" class="form-control form-control-sm" placeholder="{{ trans('validation.attributes.select') }}" name="category"></select2>
							</div>
							<div class="form-group">
								<label for="search">{{ trans('website::setting_themes.form.search') }}</label> 
								<input type="text" class="form-control form-control-sm" v-model="form.header.search" name="search" placeholder="{{ trans('validation.attributes.title') }}">
							</div>
						</div>
					</div>
				</div>
				<div class="tab-pane fade show" id="footer">
					@foreach(config('widgets.website.footer.1') as $key_item => $item)
					<div>
						<strong class="text-uppercase bg-secondary p-2 mb-2 d-block">{{ trans('website::setting_themes.form.colunm') }} {{ $key_item }}</strong>
						@foreach($item as $key => $value)

						@includeIf('core::admin.form.'.$key, ['key' => 'form.footer['.$key_item.'].'.$key])

						@endforeach
					</div>
					@endforeach
					<hr />
					<div class="form-group">
						<label for="title">
							{{ trans('website::setting_themes.form.footer_bottom') }}<code>*</code>
						</label>
						<tinymce v-model="form.footer.footer_bottom"></tinymce>
					</div>
				</div>
				<div class="tab-pane fade show" id="code">
					<div class="form-group">
						<label for="title">
							{{ trans('website::setting_themes.form.code') }}<code>*</code>
						</label> 
						<textarea class="form-control" rows="10" v-model="form.code.code" name="footer_bottom"></textarea>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="card-footer text-right">
		<button class="btn btn-sm btn-success" v-on:click="updateSettingTheme">
			<i class="icon-floppy-disk"></i> {{ trans("resource.update") }}
		</button>
	</div>
</div>
@endsection
@push('script')
<script type="text/javascript">
	var header = {!! !empty($themes['header']['config']) ? json_encode($themes['header']['config']) : json_encode(['icon'=> '', 'logo' => '', 'title' => '', 'search']) !!};
	var code = {!! !empty($themes['code']['config']) ? json_encode($themes['code']['config']) : json_encode(['code' => '']) !!}
	var mix = {
		data: {
			menus: {!! $menus !!},
			tab: 'header',
			form: {
				header: header,
				footer: {
					@foreach(config('widgets.website.footer.1') as $key_item => $item)
					{{ $key_item }}: {
						@foreach($item as $key => $value)
						{{ $key }}:  `{!! !empty($themes['footer']['config'][$key_item][$key]) ? $themes['footer']['config'][$key_item][$key] : $value !!}`,
						@endforeach
					},
					@endforeach
					footer_bottom: `{!! @$themes['footer']['config']['footer_bottom'] !!}`,
					@if(!empty($themes['footer']['config']['social']))
					social: {!! json_encode($themes['footer']['config']['social']) !!},
					@else
					social: [
						{
							"title" : "Facebook",
							"icon" : "fa fa-facebook",
							"link" : ""
						},
						{
							"title" : "Google",
							"icon" : "fa fa-google-plus",
							"link" : ""
						},
						{
							"title" : "Youtube",
							"icon" : "fa fa-youtube",
							"link" : ""
						},
						{
							"title" : "Twitter",
							"icon" : "fa fa-twitter",
							"link" : ""
						},
						{
							"title" : "Pinterest",
							"icon" : "fa fa-pinterest",
							"link" : ""
						},
						{
							"title" : "Instagram",
							"icon" : "fa fa-instagram",
							"link" : ""
						},
						{
							"title" : "Flickr",
							"icon" : "fa fa-flickr",
							"link" : ""
						},
						{
							"title" : "Slide Share",
							"icon" : "fa fa-slideshare",
							"link" : ""
						},
						{
							"title" : "Tumblr",
							"icon" : "fa fa-tumblr",
							"link" : ""
						},
						{
							"title" : "Linked in",
							"icon" : "fa fa-linkedin",
							"link" : ""
						},

					],
					@endif
					
				},
				code: code
			}
		},
		methods: {
			updateSettingTheme: function () {
				var vm = this;
				var data = {
					_token: $('meta[name=csrf-token]').attr('content'),
					config: vm.form[vm.tab],
					type: vm.tab
				};
				$.ajax({
					type: "POST",
					url: '{{ route('admin.setting_themes.update') }}',
					data: data,                        
				}).done( function(res , status , xhr){
					if(res.success){
						helper.showNotification("{{ trans('validation.attributes.success') }}", 'success', 1000);
					}else{
						helper.showNotification("{{ trans('validation.attributes.error') }}", 'danger', 1000);
					}
					return false;
				}).fail(function(err){
					helper.showNotification("{{ trans('validation.attributes.error') }}", 'danger', 1000);
				});   
			}
		}
	}
</script>
@endpush