@extends('app::admin.layouts.master')
@push('style')
<link href="{{ asset('/public/admin/assets/js/nestable/jquery.nestable.css') }}" rel="stylesheet" />
<style type="text/css">
	#accordion-group .card{
		border-radius: 0;
	}
	#accordion-group .card:last-child {
		border-bottom: 1px solid rgba(0,0,0,.125) !important;
	}
	.create-menu li:first-child a{
		border-top: 1px dashed #48a79b;
	}
	.create-menu li a{
		padding: 5px;
		display: block;
		cursor: pointer;
		position: relative;
		border-bottom: 1px dashed #48a79b;
	}
	.create-menu li a i{
		position: absolute;
	    right: 0;
	    top: 20%;
	}
</style>
@endpush
@section('content')
<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="card">
			<div class="card-heading">
				<strong>{{ trans('website::menus.setting_menu') }}</strong>
			</div>
			<div class="card-body">
				<div class="form-group">
					<div class="col-lg-10">
						<div class="input-group input-group-sm">
							<select2 id="menu" :options="menus" class="form-control" v-model="menu_id" :disabled="isLoading == true" name="menu" placeholder="{{ trans('validation.attributes.select') }}" style="width: 95%;">
								
							</select2>
							<span class="input-group-append">
								<button class="btn btn-light btn-custom waves-effect waves-light" type="button" data-target="#menuParent" data-toggle="modal">
									<i class="fa fa-plus"></i>
								</button>
							</span>
						</div>
					</div>
				</div>

				<div class="text-center">
					<template v-if="isLoading">
						<i class="fa fa-spinner fa-pulse fa-fw"></i>
					</template>
				</div>
				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12" v-if="menu_id">
						<div class="text-right">
							<button type="button" class="btn btn-success btn-sm" @click="saveData()">
								<i v-if="isDataLoad" class="fa fa-spinner fa-pulse fa-fw">
								</i>
								<i v-else class=" fa fa-save"></i>
								{{ trans('validation.attributes.save') }}
							</button>
							<button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#menuCreate">
								<i class="icon-plus3"></i>  
								{{ trans('website::menus.form.crate_menu') }}
							</button>
						</div>
					</div>
					<div class="col-md-5 col-sm-5 col-xs-12">
						<div id="accordion-group" v-if="menu_id">
							@foreach($category_menus as $key => $value)
							<div class="card mb-1 border-teal">
								<div class="card-header bg-teal p-2 rounded-0 border-0" style="border-radius: 0">
									<h6 class="card-title">
										<a data-toggle="collapse" @click="tab_page = '{{ $key }}'" class="text-white" href="#{{ $key }}">
											<strong>{{ $value }}</strong>
										</a>
									</h6>
								</div>

								<div id="{{ $key }}" class="collapse" data-parent="#accordion-group">
									<div class="card-body">
										<ul class="mb-0 create-menu list-unstyled">
											<li class="text-center"  v-if="isLoadingMenu">
												<i class="fa fa-spinner text-success fa-pulse fa-2x fa-fw"></i>
											</li>
											<li class="text-center text-success" v-if="!tab_data.length">
												{{ trans('website::menus.package.no_data') }}
											</li>
										</ul>
										<ul class="mb-0 create-menu list-unstyled">
											<li v-for="(item, key) in tab_data">
												<a v-on:click="addMenuTab(item)">
													@{{ item.title }} 
													<i class="icon-plus-circle2 text-success"></i>
												</a>
											</li>
										</ul>
									</div>
								</div>
							</div>
							@endforeach
						</div>

					</div>
					<div class="col-md-7 col-sm-7 col-xs-12">
						<div id="menuViewSet" class="custom-dd-empty dd"></div>
					</div>
				</div>
				<div class="text-right" v-if="menu_id">
					<button type="button" class="btn btn-success" @click="saveData()">
						<i v-if="isDataLoad" class="fa fa-spinner fa-pulse fa-fw">
						</i>
						<i v-else class=" fa fa-save"></i>
						{{ trans('validation.attributes.save') }}
					</button>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="menuParent" data-backdrop="false" tabindex="-1" aria-modal="true" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<strong class="modal-title text-uppercase">
					{{ trans('website::menus.form.create_parent') }}
				</strong>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="form-group mb-0">
					<label for="title">{{ trans('website::menus.form.title') }}</label>
					<input type="text" id="title" required="" name="title" class="form-control form-control-sm" v-model="form.title">
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" :disabled="isLoadingForm" class="btn btn-sm btn-success" @click="create()">
					<i v-if="isLoadingForm" class="fa fa-spinner fa-pulse fa-fw"></i>
					<i v-else class=" fa fa-save"></i>
					{{ trans('validation.attributes.save') }}
				</button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="menuCreate" data-backdrop="false" tabindex="-1" aria-modal="true" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<strong class="modal-title text-uppercase">
					{{ trans('website::menus.form.update_menu') }}
				</strong>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				{{-- <div class="form-group">
					<label for="icon">{{ trans('website::menus.form.icon') }}</label>
					<input type="text" id="icon" required="" name="icon" class="form-control form-control-sm" v-model="form_menu.icon">
				</div> --}}
				<div class="form-group">
					<label for="title">{{ trans('website::menus.form.title') }}</label>
					<input type="text" id="title" required="" name="title" class="form-control form-control-sm" v-model="form_menu.title">
				</div>
				<div class="form-group mb-0">
					<label for="url">{{ trans('website::menus.form.url') }}</label>
					<input type="text" id="url" required="" name="url" class="form-control form-control-sm" v-model="form_menu.url">
				</div>
			</div>
			<div class="modal-footer">
				<template v-if="form_menu.id != '' ">
					<button type="button" :disabled="isLoadingForm" class="btn btn-sm btn-success" @click="updateMenu()">
						<i v-if="isLoadingForm" class="fa fa-spinner fa-pulse fa-fw"></i>
						<i v-else class=" fa fa-save"></i>
						{{ trans('validation.attributes.save') }}
					</button>
				</template>
				<template v-else>
					<button type="button" :disabled="isLoadingForm" class="btn btn-sm btn-success" @click="createMenu()">
						<i v-if="isLoadingForm" class="fa fa-spinner fa-pulse fa-fw"></i>
						<i v-else class=" fa fa-save"></i>
						{{ trans('validation.attributes.save') }}
					</button>
				</template>
			</div>
		</div>
	</div>
</div>
@endsection
@push('script')
<script src="{{ asset('/public/admin/assets/js/nestable/jquery.nestable.js') }}"></script>
<script type="text/javascript">
	var mix = {
		data: {
			isLoadingMenu: false,
			isLoading: false,
			isLoadingForm: false,
			isDataLoad: false,
			menus: {!! $menus !!},
			menu_id: '',
			tab_page: '',
			tab_data: [],
			form: {
				title: '',
			},
			form_menu: {
				icon: '',
				title: '',
				url: '',
				img: '',
				id: '',
			},
			details: []
		},
		methods: {
			create: function (key) {
				var vm = this;
				vm.isLoadingForm = false;
				vm.form._token = $('meta[name=csrf-token]').attr('content');
				$.ajax({
					type: "POST",
					url: '{{ route('admin.menus.store') }}',
					data: vm.form,                        
				}).done( function(res , status , xhr){
					vm.isLoadingForm = false;
					if(res.success){
						helper.showNotification("{{ trans('validation.attributes.success') }}", 'success', 1000);
						location.reload();
					}else{
						helper.showNotification("{{ trans('validation.attributes.error') }}", 'danger', 1000);
					}
					return false;
				}).fail(function(err){
					vm.alert.danger = true;
					vm.alert.title = '{{ trans('validation.attributes.error') }}';
					if (typeof err.responseJSON.errors != 'undefined'){
						$.each( err.responseJSON.errors, function( key, value ) {
							$("input[name="+key+"]").addClass('red-border').focus();
							helper.showNotification(value, 'danger', 1000);
							setTimeout(function(){ $("input[name="+key+"]").removeClass('red-border'); }, 3000);
						});
					}
					helper.showNotification("{{ trans('validation.attributes.error') }}", 'danger', 1000);
				});   
			},
			updateMenu: function (key) {
				var vm = this;
				vm.isLoadingForm = false;
				vm.form_menu._token = $('meta[name=csrf-token]').attr('content');
				$.ajax({
					type: "POST",
					url: '{{ route('admin.menus.update') }}',
					data: vm.form_menu,                        
				}).done( function(res , status , xhr){
					vm.isLoadingForm = false;
					if(res.success){
						helper.showNotification("{{ trans('validation.attributes.success') }}", 'success', 1000);
						vm.loadMenu();
					}else{
						helper.showNotification("{{ trans('validation.attributes.error') }}", 'danger', 1000);
					}
					return false;
				}).fail(function(err){
					vm.alert.danger = true;
					vm.alert.title = '{{ trans('validation.attributes.error') }}';
					if (typeof err.responseJSON.errors != 'undefined'){
						$.each( err.responseJSON.errors, function( key, value ) {
							$("input[name="+key+"]").addClass('red-border').focus();
							helper.showNotification(value, 'danger', 1000);
							setTimeout(function(){ $("input[name="+key+"]").removeClass('red-border'); }, 3000);
						});
					}
					helper.showNotification("{{ trans('validation.attributes.error') }}", 'danger', 1000);
				});   
			},
			createMenu: function () {
				var vm = this;
				vm.isLoadingForm = false;
				vm.form_menu._token = $('meta[name=csrf-token]').attr('content');
				vm.form_menu.menu_id = vm.menu_id;
				$.ajax({
					type: "POST",
					url: '{{ route('admin.menus.store') }}',
					data: vm.form_menu,                        
				}).done( function(res , status , xhr){
					vm.isLoadingForm = false;
					if(res.success){
						vm.form_menu = {
							icon: '',
							title: '',
							url: '',
							img: '',
							id: '',
						};
						vm.loadMenu();
						helper.showNotification("{{ trans('validation.attributes.success') }}", 'success', 1000);
					}else{
						helper.showNotification("{{ trans('validation.attributes.error') }}", 'danger', 1000);
					}
					return false;
				}).fail(function(err){
					vm.alert.danger = true;
					vm.alert.title = '{{ trans('validation.attributes.error') }}';
					if (typeof err.responseJSON.errors != 'undefined'){
						$.each( err.responseJSON.errors, function( key, value ) {
							$("input[name="+key+"]").addClass('red-border').focus();
							helper.showNotification(value, 'danger', 1000);
							setTimeout(function(){ $("input[name="+key+"]").removeClass('red-border'); }, 3000);
						});
					}
					helper.showNotification("{{ trans('validation.attributes.error') }}", 'danger', 1000);
				});   
			},
			multiMenu: function (arr) {
                // BƯỚC 2.2: HIỂN THỊ DANH SÁCH CHUYÊN MỤC CON NẾU CÓ
                var htmlGet = "";
                if (arr.length) {
                    // console.log(arr);
                    htmlGet = '<ol class="dd-list">';
                    for (var i = 0; i < arr.length; i++) {
                    	htmlGet += '<li class="dd-item dd3-item" id="dataID'+arr[i].id+'" data-id="'+arr[i].id+'" data-code="'+arr[i].order+'">\
                    	<div class="dd-handle dd3-handle"></div>\
                    	<div class="dd3-content">\
                    	'+arr[i].title+'\
                    	<a class="badge btn-warning text-right text-white edit" data-id="'+arr[i].id+'"  href="javascript:void(0)"><i class="fa fa-edit"></i></a>\
                    	<a class="badge badge-danger text-right text-white btn-danger delete" data-id="'+arr[i].id+'" title="Xóa" href="javascript:void(0)">\
                    	<i class="fa fa-trash"></i>\
                    	</a>\
                    	</div>\
                    	';
                    	if(arr[i].children_sub != undefined && arr[i].children_sub.length){
                    		htmlGet += this.multiMenu(arr[i].children_sub);
                    	}
                    	htmlGet += '</li>';
                    }
                    htmlGet += '</ol>';
                }
                return htmlGet;
            },
            saveData: function(){
            	var vm = this;
            	vm.isDataLoad = true;
            	$.ajax({
            		method: "POST",
            		url: "{{ route('admin.menus.store_menu') }}",
            		dataType: 'json',
            		data: {
            			list: $('.dd').nestable('serialize'),
            			_token: $('meta[name=csrf-token]').attr('content')
            		}
            	}).done( function(res){
            		vm.isDataLoad = false;
            		helper.showNotification('Đã lưu', 'success', 1000);
            	})
            	.fail(function(err){
            		vm.isDataLoad = false;
            	})
            },
            deleteMenu: function(key) {
            	var vm = this;
            	$.confirm({
            		title: '{{ trans('validation.attributes.alert') }}',
            		content:'{{ trans('validation.delete_alert', ['resource' => 'menu']) }}',
            		type: "red",
            		draggable: false,
            		theme: 'material',
            		buttons: {
            			ok: {
            				text:'{{ trans('validation.attributes.alert_success') }}',
            				btnClass: 'btn btn-success btn-rounded w-md waves-effect waves-light',
            				keys: ['enter'],
            				action: function() {
            					$.ajax({
            						type: 'POST',
            						data: {id: key, _token: $('meta[name=csrf-token]').attr('content')},
            						url: '{{ route("admin.menus.delete") }}'
            					})
            					.done(function(response, status, xhr) {
            						vm.loadMenu();
            					})
            					.fail(function(xhr, status, err) {

            					});
            				}
            			},
            			cancel: {
            				text: '{{ trans('validation.attributes.alert_cancel') }}',
            				keys: ['esc'],
            				btnClass: 'btn btn-danger waves-effect w-md waves-light',
            				action: function() {
            				},
            			}
            		}
            	});
            },
            updateMenu: function(key) {
            	var vm = this;
            	vm.isLoadingForm = true;
            	$.ajax({
            		type: 'POST',
            		data: {data: vm.form_menu, _token: $('meta[name=csrf-token]').attr('content')},
            		url: '{{ route("admin.menus.update") }}',
            	})
            	.done(function(res, status, xhr) {
            		vm.isLoadingForm = false;
            		if(res.success){
            			$('#menuCreate').modal('hide');
            			vm.loadMenu();
            			helper.showNotification("{{ trans('validation.attributes.success') }}", 'success', 1000);
            		}else{
            			helper.showNotification("{{ trans('validation.attributes.error') }}", 'danger', 1000);
            		}
            	})
            	.fail(function(xhr, status, err) {

            	});
            },
            getMenu: function (id) {
            	var vm = this;
            	$.ajax({
            		type: 'POST',
            		data: {id: id, _token: $('meta[name=csrf-token]').attr('content')},
            		url: '{{ route("admin.menus.get") }}',
            	})
            	.done(function(res, status, xhr) {
            		if(res.success){
            			vm.form_menu = res.data;
            			vm.form_menu.key = id;
            			$('#menuCreate').modal('show');
            		}
            	})
            	.fail(function(xhr, status, err) {

            	});	
            },
            loadMenu: function () {
            	var vm = this;
            	$.ajax({
            		type: 'POST',
            		data: {menu_id: vm.menu_id, _token: $('meta[name=csrf-token]').attr('content')},
            		url: '{{ route("admin.menus.get_list") }}',
            	})
            	.done(function(res, status, xhr) {
            		if(res.success){
            			vm.details = res.data;
            			vm.form_menu = {
            				icon: '',
            				title: '',
            				url: '',
            				img: '',
            				id: '',
            			};
            			var html = vm.multiMenu(vm.details);
            			$('#menuParent').modal('hide');
            			$('#menuCreate').modal('hide');
            			$("#menuViewSet").html(html);

            			$('#menuViewSet').nestable('destroy');
            			$('#menuViewSet').nestable({
            				maxDepth: 3,
            			});
            		}
            	})
            	.fail(function(xhr, status, err) {

            	});	
            },
            addMenuTab: function (data) {
            	var vm = this;
            	vm.form_menu = {
            		icon: '',
            		title: data.title,
            		url: data.alias,
            		img: '',
            		id: '',
            	};
            	vm.createMenu();
            },
            getDataTab: function () {
            	var vm = this;
            	vm.tab_data = [];
            	vm.isLoadingMenu = true;
            	$.ajax({
            		type: 'POST',
            		data: {tab: vm.tab_page, _token: $('meta[name=csrf-token]').attr('content')},
            		url: '{{ route("admin.menus.get_data_package") }}',
            	})
            	.done(function(res, status, xhr) {
            		vm.isLoadingMenu = false;
            		if(res.success){
            			vm.tab_data = res.data;
            		}
            	})
            	.fail(function(xhr, status, err) {
            		vm.isLoadingMenu = false;
            	});	
            }
        },
        mounted() {
        	var vm = this;
        	$('#content-master').css('padding-top', '1.25em');
        	$('#menuViewSet').nestable({
        		maxDepth: 3,
        	});
        	$('#menuViewSet').on('click', '.edit', function(event) {
        		event.preventDefault();
        		vm.getMenu(parseInt($(this).attr('data-id')));
        	});
        	$('#menuViewSet').on('click', '.delete', function(event) {
        		event.preventDefault();
        		vm.deleteMenu( $(this).attr('data-id') );
        	});
        },
        watch:{
        	'menu_id': function (newval) {
        		if(newval != ""){
        			this.loadMenu();
        		}    
        	},
        	'tab_page': function (newval) {
        		if(newval != ""){
        			this.getDataTab();
        		}    
        	}
        },
        created: function () {
        	
        }
    }
</script>
@endpush