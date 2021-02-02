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
<script src="{{ asset('/public/admin/vue/color/vue-color.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/admin/vue/components.js') }}?v={{ rand() }}"></script>
<script type="text/javascript" src="{{ asset('public/admin/vue/component_forms.js') }}?v={{ rand() }}"></script>
<script type="text/javascript" src="{{ asset('public/admin/vue/helper.js') }}?v={{ rand() }}"></script>

<script type="text/x-template" id="template-colorpicker">
	<div class="form-group mb-2 form-group-feedback form-group-feedback-left color-picker" ref="colorpicker">
		<div style="position: relative;">
			<input type="text" class="form-control form-control-sm" v-model="colorValue" @focus="showPicker()" @input="updateFromInput" style="padding-left: 3rem;" placeholder="{{ trans('app::forms.background.default') }}">
			<div class="form-control-feedback form-control-feedback-sm" :style="'background:'+colorValue"><i class="icon-eyedropper"></i></div>
			<chrome-picker :value="colors" @input="updateFromPicker" v-if="displayPicker" />
		</div>
	</div>
</script>
<script>
	var Chrome = VueColor.Chrome;
	Vue.component('colorpicker', {
		components: {
			'chrome-picker': Chrome,
		},
		template: '#template-colorpicker',
		props: ['color'],
		data() {
			return {
				colors: {
					hex: '',
				},
				colorValue: '',
				displayPicker: false,
			}
		},
		mounted() {
			this.setColor(this.color || '');
		},
		methods: {
			setColor(color) {
				this.updateColors(color);
				this.colorValue = color;
			},
			updateColors(color) {
				if(color.slice(0, 1) == '#') {
					this.colors = {
						hex: color
					};
				}
				else if(color.slice(0, 4) == 'rgba') {
					var rgba = color.replace(/^rgba?\(|\s+|\)$/g,'').split(','),
					hex = '#' + ((1 << 24) + (parseInt(rgba[0]) << 16) + (parseInt(rgba[1]) << 8) + parseInt(rgba[2])).toString(16).slice(1);
					this.colors = {
						hex: hex,
						a: rgba[3],
					}
				}
			},
			showPicker() {
				document.addEventListener('click', this.documentClick);
				this.displayPicker = true;
			},
			hidePicker() {
				document.removeEventListener('click', this.documentClick);
				this.displayPicker = false;
			},
			togglePicker() {
				this.displayPicker ? this.hidePicker() : this.showPicker();
			},
			updateFromInput() {
				this.updateColors(this.colorValue);
			},
			updateFromPicker(color) {
				this.colors = color;
				if(color.rgba.a == 1) {
					this.colorValue = color.hex;
				}
				else {
					this.colorValue = 'rgba(' + color.rgba.r + ', ' + color.rgba.g + ', ' + color.rgba.b + ', ' + color.rgba.a + ')';
				}
			},
			documentClick(e) {
				var el = this.$refs.colorpicker,
				target = e.target;
				if(el !== target && !el.contains(target)) {
					this.hidePicker()
				}
			}
		},
		watch: {
			colorValue(val) {
				if(val) {
					this.updateColors(val);
					this.$emit('input', val);
				}
			}
		},
	});
</script>
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
	Vue.component('images_tools', {
		template: `<div class="form-group select-img">
		<label class="control-label">
		{{ trans('website::pages.form.img') }}
		</label>
		<div class="text-center">
		<template v-if="image">
		<a class="remove-img" v-on:click="componentImg()"><i class="fa fa-times-circle fa-2x text-danger"></i></a>
		</template>
		<input type="hidden" v-model="image">
		<img :src="image != '' ? image : '/public/admin/assets/img/uploadCroup.png' " v-on:click="componentGallery()" class="img-responsive cursor">
		</div>
		</div>`,
		props: ['title', 'value'],
		data: function () {
			return {
				image: this.value
			}
		},
		methods: {
			componentGallery: function () {
				var vm = this;
				AppMedia.show({
					current : [],
					multiple: false,
					group: 'product',
					output: function (data) {
						vm.image =  data[0].path;
					}
				});
			},
			componentImg: function () {
				this.setImg('');
			},
			setImg: function (img) {
				this.image = img;
				this.$emit('input', img);
			},
		},
		watch: {
			image: function (val) {
				this.$emit('input', val);
			},
		},
		created: function () {
			this.setImg(this.value);
		},
	});

	new Vue ({
		el: '#app-edit-web-admin',
		data: {
			data_forms: [],
			id: '',
			send_key: 'multiple',
			array_items: {
				max: 0,
				images: []
			},
		},
		methods: {
			addItems: function () {
				this.data_forms[0].items.push({img:'', link:'', title: '', description: ''});
			},
			save: function () {
				var vm = this;
				var param = [];
				if(vm.send_key == 'one'){
					param =  {data : JSON.stringify(vm.data_forms[0]), id: vm.id};
				}else{
					param =  {data : JSON.stringify(vm.data_forms), id: vm.id};
				}
				$.ajax({
					type: "POST",
					url: '{{ route('api.theme.save') }}',
					data: param,                        
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
			tinyMCE.init({
				selector:'.editor',
			});

			$(".close-admin").click(function(event) {
				event.preventDefault();
				vm.data_forms = [];
				vm.send_key = 'multiple';
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
						if(res.data.length){
							vm.data_forms = res.data;
							vm.send_key = 'multiple';
						}else{
							vm.data_forms.push(res.data);
							vm.send_key = 'one';
						}
						vm.id = id;

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