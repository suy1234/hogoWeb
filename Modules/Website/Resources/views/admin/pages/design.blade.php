@extends('app::admin.layouts.master')

@section('navbar')
@component('app::admin.components.navbar')
@slot('resource', 'layouts')
@endcomponent
@endsection

@section('content')
<div class="row">
	<div class="col-md-4 col-sm-4 col-xs-12">
		<div class="card">
			<div class="card-heading">
				<strong class="text-uppercase">
					{{ trans('website::layouts.widget_rows') }}
				</strong>
			</div>
			<div class="card-body">
				@foreach(config('widgets.website.rows') as $key => $rows)
					<div class="widget-rows">
						<a v-on:click="addWidget('{{ $key }}')" class="btn btn-icon bg-transparent btn-success widget-btn border-slate-300 text-slate rounded-round border-dashed"><i class="icon-plus22"></i></a>
						<div class="widget row" data-id="1">
							@foreach($rows as $row)
							<div class="widget-item {{ $row }} text-center">
								<div class="widget-content">
									
								</div>
							</div>
							@endforeach
						</div>
					</div>
				@endforeach
			</div>
		</div>
	</div>
	<div class="col-md-8 col-sm-8 col-xs-12">
		<div class="card">
			<div class="card-heading">
				<strong class="text-uppercase">
					{{ trans('website::layouts.layout') }} {{ $page->title }}
				</strong>
			</div>
			<div class="card-body">

				<div class="text-right">
					<button v-on:click="sendPost('{{ route('admin.pages.build') }}')" class="btn btn-warning btn-sm">
						<i class="icon-design"></i>  
						{{ trans('validation.attributes.build') }}
					</button>
					<button v-on:click="update('{{ route('admin.pages.design_store', ['id' =>  $page->id]) }}')" class="btn btn-success btn-sm">
						<i class="icon-floppy-disk"></i>  
						{{ trans('validation.attributes.save') }}
					</button>
				</div>
			</div>
			<div class="card-body">
				<div class="widget row">
					<div v-for="(item, key) in data" :data-id="item.id" :class="item.class" class="widget-item text-center mb-3">
						<div class="widget-content font-12px p-2 pl-0 pr-0 position-relative">
							<a v-on:click="showWidgetForm(item.id)" href="javascript:void(0)" class="btn btn-icon bg-transparent btn-success widget-btn border-slate-300 text-slate rounded-round border-dashed position-absolute" style="top: 0;right: 0;z-index: 9;">
								<i class="icon-plus22"></i>
							</a>
							@{{ item.class }}
							<ul class="list-unstyled text-left">
								<li  v-for="(val, index) in item.widgets">
									<span class="badge badge-flat border-primary text-primary-600">
										@{{ val.widget }} 
										<a v-on:click="removeWidget(val.id, index)" href="javascript:void(0)" class="text-danger">
											<i class="icon-bin"></i>
										</a>
									</span>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="modal-widget" class="modal fade" data-backdrop="false" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Widget</h5>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<div class="modal-body">
				<div class="form-group">
					<label for="widget_id">{{ trans('website::pages.widgets.widget_id') }}<code>*</code></label> 
					<input type="text" id="widget_id" v-model="widgets.widget_id" required="required" value="" class="form-control ">
				</div>
				<div class="form-group">
					<label for="widget">{{ trans('website::pages.widgets.widget') }}<code>*</code></label> 
					<input type="text" id="widget" v-model="widgets.widget" required="required" value="" class="form-control ">
				</div>
				<div class="form-group">
					<label for="widget_type">{{ trans('website::pages.widgets.widget_type') }}<code>*</code></label> 
					<input type="text" id="widget_type" v-model="widgets.widget_type" required="required" value="" class="form-control ">
				</div>
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-link btn-sm" data-dismiss="modal">
					{{ trans('validation.attributes.back') }}
				</button>
				<button type="button" class="btn btn-success btn-sm" v-on:click="saveWidgetParent">
					{{ trans('validation.attributes.save') }}
				</button>
			</div>
		</div>
	</div>
</div>
@endsection
@push('script')
<script type="text/javascript">
	var Chrome = VueColor.Chrome;
	var mix = {
		components: {
			'chrome-picker': Chrome,
		},
		data: {
			form: {
				title: '{{ $page->title }}',
				config: {!! !empty($page->layouts) ? json_encode($page->layouts, true) : [] !!}
			},
			data: [],
			widgets: {
				parent_id: '',
				widget_id: '',
				widget: 'widget_theme',
				widget_type: '',
			}
		},
		methods: {
			removeWidget: function (id, index) {
				var vm = this;
				vm.isLoading = true;
				$.ajax({
					type: "POST",
					url: '{{ route("admin.layouts.destroy") }}',
					data: {ids: id, _token: $('meta[name=csrf-token]').attr('content')},                        
				}).done( function(res , status , xhr){
					vm.isLoading = false;
					if(res.success){
						this.listWidget({{ request()->id }});
						helper.showNotification("{{ trans('validation.attributes.success') }}", 'success', 1000);
						return true;
					}else{
						helper.showNotification("{{ trans('validation.attributes.error') }}", 'danger', 1000);
					}
					return false;
				}).fail(function(err){
					helper.showNotification("{{ trans('validation.attributes.error') }}", 'danger', 1000);
					vm.isLoading = false;
				});
			},
			showWidgetForm: function (id) {
				$('#modal-widget').modal('show');
				this.widgets.parent_id = id;
			},
			saveWidgetParent: function () {
				var vm = this;
				vm.isLoading = true;
				vm.widgets._token = $('meta[name=csrf-token]').attr('content');
				$.ajax({
					type: "POST",
					url: '{{ route("admin.layouts.store") }}',
					data: vm.widgets,                        
				}).done( function(res , status , xhr){
					vm.isLoading = false;
					if(res.success){
						helper.showNotification("{{ trans('validation.attributes.success') }}", 'success', 1000);
						return true;
					}else{
						helper.showNotification("{{ trans('validation.attributes.error') }}", 'danger', 1000);
					}
					return false;
				}).fail(function(err){
					helper.showNotification("{{ trans('validation.attributes.error') }}", 'danger', 1000);
					vm.isLoading = false;
				});
			},
			addWidget: function (val) {
				var vm = this;
				vm.isLoading = true;
				vm.form._token = $('meta[name=csrf-token]').attr('content');
				vm.form.widget = val;
				vm.form.page_id = {{ request()->id }};
				$.ajax({
					type: "POST",
					url: '{{ route("admin.pages_layouts.save") }}',
					data: vm.form,                        
				}).done( function(res , status , xhr){
					vm.isLoading = false;
					if(res.success){
						vm.listWidget({{ request()->id }});
						helper.showNotification("{{ trans('validation.attributes.success') }}", 'success', 1000);
						return true;
					}else{
						helper.showNotification("{{ trans('validation.attributes.error') }}", 'danger', 1000);
					}
					return false;
				}).fail(function(err){
					helper.showNotification("{{ trans('validation.attributes.error') }}", 'danger', 1000);
					vm.isLoading = false;
				});
			},
			listWidget: function (id) {
				var vm = this;
				vm.form._token = $('meta[name=csrf-token]').attr('content');
				vm.form.id = id;
				$.ajax({
					type: "POST",
					url: '{{ route("admin.pages_layouts.list") }}',
					data: vm.form,                        
				}).done( function(res , status , xhr){
					vm.isLoading = false;
					if(res.success){
						vm.data = res.data;
						return true;
					}
					return false;
				}).fail(function(err){

				});
			},
			sendPost: function (url) {
				$.ajax({
					type: "POST",
					url: url,
					data: {_token : $('meta[name=csrf-token]').attr('content')},                        
				}).done( function(res , status , xhr){
					helper.showNotification("{{ trans('validation.attributes.success') }}", 'success', 1000);
				}).fail(function(err){
					helper.showNotification("{{ trans('validation.attributes.error') }}", 'danger', 1000);
				});
			}
		},
		mounted() {

		},
		created: function () {
			this.listWidget({{ request()->id }});
		},
	};
</script>
@endpush