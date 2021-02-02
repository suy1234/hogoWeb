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
					{{ trans('website::layouts.layout') }} {{ $layout->title }}
				</strong>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-md-3 col-sm-3 col-xs-12">
						<form_image v-model="form.config.background.image" :label="'{{ trans('website::layouts.form.background_image') }}'"></form_image>
					</div>
					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="row">
							<div class="col-md-4 col-sm-4 col-xs-6">
								<form_color v-model="form.config.background.color" :label="'{{ trans('website::layouts.form.background_color') }}'"></form_color>
							</div>
							<div class="col-md-4 col-sm-4 col-xs-6">
								<form_color v-model="form.config.color.title" :label="'{{ trans('website::layouts.form.color.title') }}'"></form_color>
							</div>
							<div class="col-md-4 col-sm-4 col-xs-6">
								<form_color v-model="form.config.color.text" :label="'{{ trans('website::layouts.form.color.text') }}'"></form_color>
							</div>
						</div>
						
					</div>
				</div>
				<div class="text-right">
					<button v-on:click="update('{{ route('admin.layouts.update', ['id' =>  $layout->id]) }}')" class="btn btn-success btn-sm">
						<i class="icon-floppy-disk"></i>  
						{{ trans('validation.attributes.save') }}
					</button>
				</div>
			</div>
			<div class="card-body">
				<div class="widget row">
					<div v-for="(item, key) in data" :data-id="item.id" :class="item.class" class="widget-item text-center mb-3">
						<div class="widget-content font-12px">
							@{{ item.class }}
						</div>
					</div>
				</div>
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
				title: '{{ $layout->title }}',
				config: {!! !empty($layout->config) ? json_encode($layout->config, true) : json_encode(config('widgets.website.footer'), true) !!}
			},
			data: []
		},
		methods: {
			addWidget: function (val) {
				var vm = this;
				vm.isLoading = true;
				vm.form._token = $('meta[name=csrf-token]').attr('content');
				vm.form.widget = val;
				vm.form.parent_id = {{ request()->id }};
				$.ajax({
					type: "POST",
					url: '{{ route("admin.layouts.save") }}',
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
					url: '{{ route("admin.layouts.list") }}',
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
		},
		mounted() {

		},
		created: function () {
			this.listWidget({{ request()->id }});
		},
	};
</script>
@endpush