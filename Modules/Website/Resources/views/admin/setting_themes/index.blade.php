@extends('app::admin.layouts.master')

@section('navbar')
@push('style')
<link href="{{ asset('/public/admin/assets/js/nestable/jquery.nestable.css') }}" rel="stylesheet" />
@endpush
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
		<button class="btn btn-sm btn-success" v-on:click="updateSettingTheme" style="position: absolute;right: 15px;top: 5px;">
			<i class="icon-floppy-disk"></i> {{ trans("resource.update") }}
		</button>
	</div>
	<div class="card-body">
		<div class="d-md-flex">
			<ul class="nav nav-tabs nav-tabs-vertical flex-column mr-md-3 wmin-md-200 mb-md-0 border-bottom-0">
				<li class="nav-item" v-on:click="tab = 'default'">
					<a href="#header" class="nav-link active" data-toggle="tab">
						{{ trans('website::setting_themes.tab.default') }}
					</a>
				</li>
				@foreach($themes as $value)
				<li class="nav-item" v-on:click="tab = '{{ $value['type'] }}'">
					<a href="#{{ $value['type'] }}" class="nav-link" data-toggle="tab">
						{{ trans('website::setting_themes.tab.'.$value['type']) }}
					</a>
				</li>
				@endforeach
			</ul>

			<div class="tab-content" style="width: 100%">
				<div class="tab-pane fade show active" id="header">
					<div class="loader" v-if="isLoadingTab">
						<div class="inner one"></div>
						<div class="inner two"></div>
						<div class="inner three"></div>
					</div>
					<div class="component dd">
						<ol class="dd-list">
							<li v-for="(item, key) in tab_data" :key="key" class="dd-item item-component" data-id="1">
								<a class="down">
									<i class="icon-arrow-down12"></i>
								</a>
								<div class="dd-handle">
									<div class="item">
										<i class="icon-grid3"></i> <strong>@{{ item.config.title }}</strong>
									</div>
									<div class="content-component" style="display: none;">
										<div class="form-group">
											<label for="title">
												{{ trans('website::websites.widget_form.title') }}
											</label> 
											<input type="text" class="form-control form-control-sm" v-model="item.config.title" name="title" placeholder="{{ trans('validation.attributes.title') }}">
										</div>
										<component :is="'form_'+item.widget" :label="item.config.label" v-model="item.config.value"></component>
									</div>
								</div>
							</li>
						</ol>
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

<script src="{{ asset('/public/admin/assets/js/nestable/jquery.nestable.js') }}"></script>
<script type="text/javascript">
	var header = {!! !empty($themes['header']['config']) ? json_encode($themes['header']['config']) : json_encode(['icon'=> '', 'logo' => '', 'title' => '', 'search']) !!};
	var code = {!! !empty($themes['code']['config']) ? json_encode($themes['code']['config']) : json_encode(['code' => '']) !!}
	var mix = {
		data: {
			isLoadingTab: false,
			menus: {!! $menus !!},
			group_posts: {!! $group_posts !!},
			group_products: {!! $group_products !!},
			placeholder: '{{ trans('validation.attributes.select') }}',
			tab: 'header',
			has_show: true,
			style: '1',
			tab_data: {}
		},
		methods: {
			getDataTab: function () {
				var vm = this;
				vm.tab_data = [];
				vm.has_show = true;
				vm.isLoadingTab = true;	
				vm.style = false;
				var data = {
					_token: $('meta[name=csrf-token]').attr('content'),
					tab: vm.tab
				};
				$.ajax({
					type: "POST",
					url: '{{ route('admin.setting_themes.get_tab') }}',
					data: data,                        
				}).done( function(res , status , xhr){
					if(res.success){
						vm.has_show = res.data.default.has_show;
						vm.style = res.data.default.style;
						vm.tab_data = res.data.widgets;
						helper.showNotification("{{ trans('validation.attributes.success') }}", 'success', 1000);
					}else{
						helper.showNotification("{{ trans('validation.attributes.error') }}", 'danger', 1000);
					}
					vm.isLoadingTab = false;	
					return false;
				}).fail(function(err){
					vm.isLoadingTab = false;	
					helper.showNotification("{{ trans('validation.attributes.error') }}", 'danger', 1000);
				});
			},
			updateSettingTheme: function () {
				var vm = this;
				var data = {
					_token: $('meta[name=csrf-token]').attr('content'),
					data: JSON.stringify(vm.tab_data),
					type: vm.tab,
					config: {
						has_show: vm.has_show,
						style: vm.style,
					}
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
		},
		watch: {
			tab: function (val) {
				this.getDataTab();
			},
		},
		mounted() {
			var vm = this;
			$('.component').nestable({
				maxDepth: 1,
			});
			$('.component').on('click', '.down', function () {
				$(this).parent('.item-component').find('.content-component').slideToggle();
				$(this).parent('.item-component').find('.dd-handle').toggleClass('dd-nodrag');
			});
		},
		
		created: function () {        },
	}
</script>
@endpush