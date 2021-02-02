<div class="card">
	<div class="card-body">
		<div class="row">
			<div class="col-sx-12 col-sm-6 col-md-6">
				<div class="form-group mb-0">
					<input type="text" class="form-control form-control-sm" v-model="form.title" name="title" placeholder="{{ trans('product::units.form.title') }}">
				</div>
			</div>
			<div class="col-sx-12 col-sm-2 col-md-2">
				<button class="btn btn-sm btn-success" v-on:click="saveUnit">
					<i class="icon-floppy-disk"></i> 
					{{ trans('resource.store') }}
				</button>
			</div>
		</div>
	</div>
</div>
@push('script')
<script type="text/javascript">
	var mix_children = {
		data: {
			form: {title: ''}
		},
		methods: {
			getData: function (data) {
				this.form = {title: data.title, id: data.id};
				$("html, body").animate({scrollTop: 0}, 1000);
			},
			saveUnit: function () {
				var vm = this;
				vm.isLoading = true;
				vm.form._token = $('meta[name=csrf-token]').attr('content');
				$.ajax({
					type: "POST",
					url: '{{ route("admin.units.store") }}',
					data: vm.form,                        
				}).done( function(res , status , xhr){
					vm.isLoading = false;
					if(res.success){
						vm.alert.success = true;
						vm.alert.title = res.resource;
						helper.showNotification("{{ trans('validation.attributes.success') }}", 'success', 1000);
						vm.form = {title: ''};
						vm.load();
						return true;
					}else{
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
				})  
			}
		}
	}
</script>
@endpush