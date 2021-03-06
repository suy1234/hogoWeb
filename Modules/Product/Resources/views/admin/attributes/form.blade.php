<div class="card">
	<div class="card-body">
		<div class="form-group">
			<label class="control-label" for="category">
				{{ trans('product::attributes.form.title') }}<code>*</code>:
			</label>
			<input type="text" class="form-control form-control-sm" v-model="form_input.title" name="title" placeholder="{{ trans('product::attributes.form.title') }}">
		</div>
		<div class="form-group form-group-feedback form-group-feedback-right">
			<label class="control-label" for="category">
				{{ trans('product::attributes.form.parent') }}:
			</label>
			<select2 allowclear :disabled="form_input.id" v-model="form_input.parent_id" :options="parents" name="parent_id" id="category_id" class="form-control form-control-sm" placeholder="{{ trans('validation.attributes.select') }}"></select2>
		</div>
		<div class="form-group form-group-feedback form-group-feedback-right mb-0">
			<label class="control-label" for="type">
				{{ trans('product::attributes.form.type') }}:
			</label>
			<select2 allowclear v-model="form_input.type" :options="configs" name="key" class="form-control form-control-sm" placeholder="{{ trans('validation.attributes.select') }}"></select2>
		</div>
		<template v-if="form_input.type == 'color'">
			<div class="form-group mb-0 mt-2">
				<form_color :color="form_input.value" v-model="form_input.value" :label="'{{ trans('product::attributes.form.color') }}'" /> 
			</div>
		</template>
	</div>
	<div class="card-footer text-right">
		<button class="btn btn-sm btn-success" v-on:click="save">
			<i class="icon-floppy-disk"></i> {{ trans('validation.attributes.save') }}
		</button>
	</div>
</div>
@push('script')
<script type="text/javascript">
	var mix_children = {
		data: {
			form_input: {
				title: '',
				parent_id: '',
				type: 'text',
				value: '',
			},
			configs: {
				color: '{{ trans('product::attributes.configs.color') }}',
				text: '{{ trans('product::attributes.configs.text') }}',
			},
			parents: {!! $attributes !!},
		},
		methods: {
			destroyParent: function (key) {
				this.parents.splice(key, 1);
			},
			save: function () {
				var vm = this;
				vm.isLoading = true;
				vm.form_input._token = $('meta[name=csrf-token]').attr('content');
				$.ajax({
					type: "POST",
					url: '{{ route("admin.attributes.store") }}',
					data: vm.form_input,                        
				}).done( function(res , status , xhr){
					vm.isLoading = false;
					if(res.success){
						vm.alert.success = true;
						vm.alert.title = res.resource;
						if(!vm.form_input.id){
							if(!res.data.parent_id){
								vm.parents.push(res.data);
							}
							if(vm.data.length){
								var has_add_data = false;
								for (var i = 0; i < vm.data.length; i++) {
									if(vm.data[i].id == res.data.parent_id){
										if(!vm.data[i].children){
											vm.data[i].children = [];
										}
										vm.data[i].children.push(res.data);
										has_add_data = true;
									}
								}
								if(!has_add_data){
									vm.data.push(res.data);
								}
							}else{
								vm.data.push(res.data);
							}
						}
						vm.form_input = {
							title: '',
							parent_id: '',
							type: 'text',
							value: '',
						};
						helper.showNotification("{{ trans('validation.attributes.success') }}", 'success', 1000);
						return true;
					}else{
						vm.form_input = {
							title: '',
							parent_id: '',
							type: 'text',
							value: '',
						};
						vm.alert.danger = true;
						vm.alert.title = res.resource;
						if(jQuery.type( res.msg ) === "string"){
							helper.showNotification(res.msg, 'danger', 1000);
						}
						else{
							$.each( res.msg, function( key, value ) {
								$("input[name="+key+"]").addClass('red-border').focus();
								helper.showNotification(value, 'danger', 1000);
								setTimeout(function(){ $("input[name="+key+"]").removeClass('red-border'); }, 3000);
							});
						}
					}
					return false;
				}).fail(function(err){
					console.log(err);
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
					vm.isLoading = false;
				});
			},
		}
	}
</script>
@endpush