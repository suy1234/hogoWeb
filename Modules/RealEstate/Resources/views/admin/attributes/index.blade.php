@extends('app::admin.layouts.master')

@push('style')
<link href="{{ asset('/public/admin/assets/js/nestable/jquery.nestable.css') }}" rel="stylesheet" />
@endpush

@section('navbar')
@component('app::admin.components.navbar')
@slot('resource', 'attributes')
@endcomponent
@endsection

@section('content')

<div class="row">
	<div class="col-md-4 col-xs-12 col-sm-5">
		@include('product::admin.attributes.form')
	</div>
	<div class="col-md-8 col-xs-12 col-sm-7">
		<div class="card">
			<div class="card-body">
				<ol class="dd-list" v-for="(item, key) in data">
					<li class="dd-item dd3-item">
						<div class="dd-handle dd3-handle"></div>
						<div class="dd3-content">
							@{{ item.title }} 
							<a v-on:click="getData(item)" href="javascript:void(0)" class="text-success ml-1">
								<i class="icon-pencil7"></i>
							</a>
							<a v-on:click="destroy(key, item.id)" href="javascript:void(0)" class="text-danger ml-1">
								<i class="icon-trash"></i>
							</a>
						</div>
						<template v-if="item.children">
							<ol class="dd-list" v-for="(val, k) in item.children">
								<li class="dd-item dd3-item">
									<div class="dd-handle dd3-handle"></div>
									<div class="dd3-content">
										@{{ val.title }} - @{{ val.type }}
										<a v-on:click="getData(val)" href="javascript:void(0)" class="text-success ml-1">
											<i class="icon-pencil7"></i>
										</a>
										<a v-on:click="destroy(k, val.id)" href="javascript:void(0)" class="text-danger ml-1">
											<i class="icon-trash"></i>
										</a>
									</div>
								</li>
							</ol>
						</template>
					</li>
				</ol>
			</div>
		</div>
	</div>
</div>
@endsection
@push('script')
<script type="text/javascript">
	var mix = {
		mixins: [mix_children],
		data: {
			data: {!! $attributes !!},
		},
		methods: {
			getData: function (data) {
				this.form_input = data;
			},
			destroy: function(key, id) {    
                var vm = this;
                var callbacktrue = function(){
                    vm.isLoading = true;
                    var formdata = new FormData;
                    formdata.append('id' , id);
                    helper.post( '{{ route("admin.attributes.destroy") }}' , formdata ,15000)
                    .done( function(res , status , xhr){
                        vm.isLoading = false;
                        if(res.success){
                        	vm.data.splice(key, 1);
                        	vm.destroyParent(key);
                            helper.showNotification('{{ trans('validation.attributes.success') }}', 'success', 1000);
                        }else{
                            helper.showNotification('{{ trans('validation.attributes.error') }}', 'danger', 1000);
                        }
                    })
                    .fail(function(err){
                        vm.isLoading  = false;
                        helper.showNotification('{{ trans('validation.attributes.error') }}', 'danger', 1000);
                    })
                };
                var callbackfalse = function(){};
                helper.confirmDialogMulti(
                    '{{ trans('validation.attributes.alert') }}',
                    '{{ trans('validation.delete_alert', ['resource' => trans('product::attributes.module')]) }}', 
                    'red', 
                    '{{ trans('validation.attributes.alert_cancel') }}', 
                    'btn btn-danger waves-effect w-md waves-light', 
                    '{{ trans('validation.attributes.alert_success') }}', 
                    'btn btn-success btn-rounded w-md waves-effect waves-light', 
                    callbackfalse,
                    callbacktrue
                    );
            },
		}
	}
</script>
@endpush