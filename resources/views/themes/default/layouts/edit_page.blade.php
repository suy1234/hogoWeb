<link href="{{ asset('/public/admin/assets/css/components.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('/public/admin/app/css/icons/icomoon/styles.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('/public/admin/app/cropper/cropper.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('/public/admin/assets/css/colors.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('/public/admin/assets/css/erp.css')}}?v={{ rand() }}" media="all" rel="stylesheet" type="text/css">
<link href="{{ asset('/public/admin/assets/css/gallery.css')}}?v={{ rand() }}" media="all" rel="stylesheet" type="text/css">
<script src="{{ asset('/public/admin/app/js/plugins/forms/styling/uniform.min.js') }}"></script>
<script src="{{ asset('/public/admin/app/js/plugins/forms/styling/switchery.min.js') }}"></script>
<script src="{{ asset('/public/admin/app/js/plugins/ui/moment/moment.min.js') }}"></script>
<script src="{{ asset('/public/admin/app/js/plugins/pickers/daterangepicker.js') }}"></script>
<script src="{{ asset('/public/admin/app/js/plugins/pickers/pickadate/picker.js') }}"></script>
<script src="{{ asset('/public/admin/app/js/plugins/forms/selects/select2.min.js') }}"></script>
<script src="{{ asset('/public/admin/app/js/plugins/forms/selects/bootstrap_multiselect.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/admin/app/js/wysiwyg/tinymce.min.js') }}"></script>
<script src="{{ asset('/public/admin/assets/js/app.js') }}"></script>

<script type="text/javascript" src="{{ asset('public/admin/app/cropper/cropper.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/admin/vue/vue.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/admin/vue/lodash.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/admin/app/js/plugins/notifications/bootstrap-notify.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/admin/app/js/plugins/jquery-confirm/jquery-confirm.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/admin/app/js/plugins/editors/ace/ace.js') }}"></script>
<script src="{{ asset('/public/admin/vue/color/vue-color.min.js') }}"></script>

<script type="text/javascript" src="{{ asset('public/admin/vue/components.js') }}?v={{ rand() }}"></script>
<script type="text/javascript" src="{{ asset('public/admin/vue/component_forms.js') }}?v={{ rand() }}"></script>
<script type="text/javascript" src="{{ asset('public/admin/vue/helper.js') }}?v={{ rand() }}"></script>

<style type="text/css" rel="stylesheet">
	.admin-edit-page{
		position: fixed;
		right: -500px;
		width: 400px;
		height: 100vh;
		z-index: 99;
		background: #FFF;
		border: 1px solid #CCC;
		top: 0;
		transition:all 1s;
		animation: all 1s;
		-webkit-animation: all 1s;
	}
	#form-html .card .collapse{
		border-top: 1px solid #CCC;
		padding-bottom: 10px;
	}
	#form-html .card-title a{
		color: #000;
		text-transform: uppercase;
	}
	.admin-edit-page .close-admin{
		color: #000;
		position: absolute;
		right: 0;
		opacity: 1;
		z-index: 999;
	}
	.admin-edit-page .close-admin i{
		font-size: 20px;
		color: #000;
		line-height: 0;
	}
	.admin-edit-page #form-html{
		height: calc(100vh - 42px);
		border-bottom: 1px solid #ccc;
		padding: 10px;
		overflow-y: auto;
	}
	.admin-edit-page .submit-btn{
		background: #ededed;
		text-align: right;
		padding: 5px;
	}
	.admin-website-edit{
		position: relative;
	}
	.admin-website-edit .admin-icon-edit-web{
		display: block;
		position: absolute;
		right: 0;
		top: 30%;
		font-size: 18px;
		width: 30px;
		height: 30px;
		line-height: 30px;
		border-radius: 50px;
		background: #4caf50;
		z-index: 1;
		text-align: center;
		color: #FFF !important;
		cursor: pointer;
	}
	.admin-page-backgroup{
		position: fixed;
		z-index: 999999;
		height: 100%;
		width: 100%;
		overflow-x: hidden;
		background: #d4d4d463;
		top: 0;
		text-align: center;
		display: none;
	}
	.admin-page-backgroup i{
		font-size: 60px;
		text-align: center;
		position: absolute;
		top: 38%;
		color: #00aff2;
	}
	.admin-edit-page .view{
		border: 1px solid #ccc;
		border-left: none;
		border-right: none;
		padding-top: 10px;
	}
</style>

<script type="text/javascript">
	new Vue ({
		el: '#app-edit-web-admin',
		data: {
			form: {
				config: [],
				id: '',
				widget: '',
				widget_type: '',
			},
			has_database: false,
			array_items: {
				max: 0,
				images: []
			},
			table_data: [],
			placeholder: '{{ trans('validation.attributes.select') }}',
		},
		methods: {
			addItems: function () {
				this.data_forms[0].items.push({img:'', link:'', title: '', description: ''});
			},
			save: function () {
				var vm = this;
				var param = [];
				$.ajax({
					type: "POST",
					url: '{{ route('api.theme.save') }}',
					data: vm.form,                        
				}).done( function(res , status , xhr){
					if(res.success){
						helper.showNotification("{{ trans('validation.attributes.success') }}", 'success', 1000);
						location.reload();
					}else{
						helper.showNotification(res.msg, 'danger', 1000);
					}
					return false;
				}).fail(function(err){
					console.log(err);
					helper.showNotification("{{ trans('validation.attributes.error') }}", 'danger', 1000);
				})
			},					
		},
		mounted() {
			var vm = this;
			$(".close-admin").click(function(event) {
				event.preventDefault();
				vm.config = [];
				$('.admin-edit-page').css('right', '-500px');
			});
			$('.admin-website-edit').append('<span class="fa fa-pencil admin-icon-edit-web"></span>');
			$('body').on('click', '.admin-icon-edit-web', function(event) {
				event.preventDefault();
				var id = $(this).parents('.admin-website-edit').attr('data-id');
				$.ajax({
					type: 'POST',
					url: '{{ route('api.theme.config') }}',
					data: {id : id},
					dataType: "json",
				}).done( function(res , status , xhr){
					if(res.success){
						res.form.id = id;
						vm.form = res.form;
						vm.has_database = res.has_database;
						vm.table_data = res.form.table_data;
						$('.admin-page-backgroup').css('display', 'none');
						$('.admin-edit-page').css('right', '0px');
					}
				}).fail(function(xhr, textStatus, errorThrown){
					alert('fail');
				});
				$('.admin-edit-page').css('right', '0px');
			});
		},
		watch: {
			
		},
		created: function () {

		},
	});
</script>
<div id="vue-gallery">
	<div id="modal-gallery" class="modal fade" tabindex="-1">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">{{ trans('media::medias.media') }}</h5>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>

				<div class="modal-body">
					@include('media::admin.list_web', ['modal' => true])
				</div>
			</div>
		</div>
	</div>
</div>