<script type="text/x-template" id="template-croppie">
	<div class="list list-no-header">
		<div class="list-body">
			<div class="row">
				<input type="file" class="sr-only" id="componentUpdateFileResize" @change="changeImage($event)" accept=".jpg,.jpeg,.png,.gif,.bmp,.tiff">
				<div class="col-md-12" >
					<div class="row">
						<div class="col-md-12" id="cropper-img" style="display: none;">
							<div class="cropper-bg cropper-image mg-bottom-20" >
								<img   ref="image_container" class="hide" style="max-width: 100%">
							</div>
							<hr>
							<div class="text-center mg-bottom-10">
								<div class="btn btn-light" style="min-width:150px;">
									x : @{{data.x}} px
								</div>
								<div class="btn btn-light" style="min-width:150px;">
									y : @{{data.y}} px
								</div>
								<div class="btn btn-light" style="min-width:150px;">
									width : @{{data.width}} px
								</div>

								<div class="btn btn-light" style="min-width:150px;">
									height : @{{data.height}} px
								</div>
							</div>
							<div class="text-center mg-bottom-10">
								<template v-if="typeof config.width != 'number' && typeof config.height != 'number'">
									<button v-tooltip @click="setAspectRatio(16/9)" :class="{ 'btn-inverse' : data.ratio == 16/9 } " type="button"  class="btn btn-light"   title="Reset">
										16:9
									</button>
									<button v-tooltip @click="setAspectRatio(4/3)" :class="{ 'btn-inverse' : data.ratio == 4/3 } " type="button"  class="btn btn-light"  title="Reset">
										4:3
									</button>
									<button v-tooltip @click="setAspectRatio(2/3)" :class="{ 'btn-inverse' : data.ratio == 2/3 } " type="button"  class="btn btn-light"  title="Reset">
										2:3
									</button>
									<button v-tooltip @click="setAspectRatio(1)" :class="{ 'btn-inverse' : data.ratio == 1 } " type="button"  class="btn btn-light"  title="Reset">
										1:1
									</button>
									<button v-tooltip @click="setAspectRatio(NaN)" :class="{ 'btn-inverse' : isNaN(data.ratio) } " type="button"  class="btn btn-light"  title="Reset">
										Auto
									</button>
								</template>
								<button v-tooltip @click="reset()" type="button" class="btn btn-light"  title="Reset">
									<i class="icon-reset"></i>
								</button>
								<label v-tooltip class="btn btn-light btn-upload" for="componentUpdateFileResize" title="Change image">
									<i class="icon-upload"></i>
								</label>
							</div>
							<div class="text-center">
								<button v-tooltip @click="zoomIn(0.1)" type="button" class="btn btn-light"  title="Zoom In" >
									<i class="icon-zoomin3"></i>
								</button>
								<button v-tooltip @click="zoomIn(-0.1)" type="button" class="btn btn-light"  title="Zoom Out"  >
									<i class="icon-zoomout3"></i>
								</button>
								<button v-tooltip @click="move(-10, 0)" type="button" class="btn btn-light"  title="Move Left" >
									<i class="icon-arrow-left7"></i>
								</button>
								<button v-tooltip @click="move(10, 0)" type="button" class="btn btn-light"  title="Move Right">
									<i class="icon-arrow-right7"></i>
								</button>
								<button v-tooltip @click="move(0, -10)" type="button" class="btn btn-light"  title="Move Up">
									<i class="icon-arrow-up7"></i>
								</button>
								<button v-tooltip @click="move(0, 10)" type="button" class="btn btn-light"  title="Move Down">
									<i class="icon-arrow-down7"></i>
								</button>
								<button v-tooltip @click="rotate(-45)" type="button" class="btn btn-light"  title="Rotate Left">
									<i class="icon-reply"></i>
								</button>
								<button v-tooltip @click="rotate(45)" type="button" class="btn btn-light" title="Rotate Right">
									<i class="icon-forward"></i>
								</button>
								<button v-tooltip @click="scaleX((data.scaleX ? 1 : -1))" type="button" class="btn btn-light" title="Flip Horizontal">
									<i class="icon-transmission"></i>
								</button>
								<button v-tooltip @click="scaleY((data.scaleY ? 1 : -1))" type="button" class="btn btn-light"  title="Flip Vertical">
									<i class="icon-sort fa-rotate-90"></i>
								</button>
							</div>
						</div>
					</div>
					<label class="drop-container drop-resize" for="componentUpdateFileResize" v-if="showLabel" style="width: 100%;">
						<div class="drop-container-content">
							<i class="icon-upload text-warning"></i>
							<h4 class="mg-top-20 mg-bottom-50">Chọn ảnh cần chỉnh sửa trước khi tải lên !</h4>
							<p >
								<span  class="btn-lg btn-warning">Chỉnh sửa ảnh trước khi tải lên</span>
							</p>
						</div>
					</label>
				</div>
			</div>
		</div>
		<div class="list-footer"  >
			<div class="text-right">
				<button class="btn btn-warning" :disabled="showLabel" @click.stop.prevent="modalConfirm()">
					<i class="icon-upload"></i>
					&nbsp; Tải lên
				</button>
			</div>
		</div>
	</div>


</script>
<script>
	Vue.component('vueCroppie',{
		template: '#template-croppie',

		props: {
			config:{
				type: Object,
				required: true,
			},

			'containerStyle': Object,
			'alt': String,
			'imgStyle': Object,
			'preview':{
				type : String,
				default : '.img-preview-component',
			},
			'viewMode': Number,
			'dragMode': {
				type : String,
				default : 'move',
			},
			'aspectRatio': {
				type : Number,
				default :NaN,
			},
			'responsive': {
				type: Boolean,
				default: true
			},
			'restore': {
				type: Boolean,
				default: true
			},
			'checkCrossOrigin': {
				type: Boolean,
				default: true
			},
			'checkOrientation': {
				type: Boolean,
				default: true
			},
			'modal': {
				type: Boolean,
				default: true
			},
			'guides': {
				type: Boolean,
				default: true
			},
			'center': {
				type: Boolean,
				default: true
			},
			'highlight': {
				type: Boolean,
				default: true
			},
			'background': {
				type: Boolean,
				default: true
			},
			'autoCrop': {
				type: Boolean,
				default: true
			},
			'autoCropArea': Number,
			'movable': {
				type: Boolean,
				default: true
			},
			'rotatable': {
				type: Boolean,
				default: true
			},
			'scalable': {
				type: Boolean,
				default: true
			},
			'zoomable': {
				type: Boolean,
				default: true
			},
			'zoomOnTouch': {
				type: Boolean,
				default: true
			},
			'zoomOnWheel': {
				type: Boolean,
				default: true
			},
			'wheelZoomRatio': Number,
			'cropBoxMovable': {
				type: Boolean,
				default: true
			},
			'cropBoxResizable': {
				type: Boolean,
				default: true
			},
			'toggleDragModeOnDblclick': {
				type: Boolean,
				default: false
			},

			'minCanvasWidth': Number,
			'minCanvasHeight': Number,
			'minCropBoxWidth': Number,
			'minCropBoxHeight': Number,
			'minContainerWidth': Number,
			'minContainerHeight': Number,

			'ready': Function,
			'cropstart': Function,
			'cropmove': Function,
			'cropend': Function,
			'crop': Function,
			'zoom': Function,
			'type' : {
				type : Boolean,
				default: true,
			}
		},
		data : function(){
			return {
				id : 'cropper',
				data : {
					scaleX : false,
					scaleY : false,
					ratio  : (this.aspectRatio != undefined) ? this.aspectRatio : NaN,
					rotate : 0 ,
					width : '',
					height: '',
					x:'',
					y:'',
				},
				isLoading : false,
				showLabel: true,
				src : '',
				show : true,
				confirmResize: {}
			}
		},
		mounted: function mounted() {
			var vm = this;
			vm.init();

		},
		watch:{
			config: function(val){
				var vm = this;
				var src = this.src;
				this.destroy();
				$(this.$refs.image_container).attr('src', src);
				this.init();

			},
		},
		methods: {
			_objectWithoutProperties : function(obj, keys){
				var target = {};
				for (var i in obj) {
					if (keys.indexOf(i) >= 0) continue;
					if (!Object.prototype.hasOwnProperty.call(obj, i))
						continue; target[i] = obj[i];
				}
				return target;
			},
			modalConfirm : function(){
				var vm = this;
				this.confirmResize.width = this.data.width;
				this.confirmResize.height = this.data.height;
				this.confirmResize.ratio = this.data.width / this.data.height;
				this.confirmResize.show = true;
				this.upload(this.confirmResize);
			},
			upload(param){
				var vm = this;
				var formData = new FormData();
				var options = {};
				options['imageSmoothingQuality'] = 'high';
				var img =  this.cropper.getCroppedCanvas(options);
				var base64 = (param.type == 'png') ? img.toDataURL("image/png") :  img.toDataURL("image/jpeg");
				formData.append('file', base64);
				formData.append('name', '.png');
				helper.post( "{{ route('admin.medias.store') }}" , formData)
				.done(function(res){
					if( res.status == 403) return;
					$('#showCrop').trigger('click');
					vm.$root._load(1);
					vm.clear();
					vm.$root.tab = 'gallery';
					helper.showNotification('Tải lên thành công !' , 'check' ,'success' , 2000);
				});
			},
			init: function(callback){
				var vm = this;
				var _$options$props = this.$options.props,
				containerStyle = _$options$props.containerStyle,
				src = _$options$props.src,
				alt = _$options$props.alt,
				imgStyle = _$options$props.imgStyle,
				data = vm._objectWithoutProperties(_$options$props, ['containerStyle', 'src', 'alt', 'imgStyle']);

				var props = {};
				props['crop'] = this.update;
				props['ready'] = function(){
					if( typeof callback =='function'){
						callback();
					}
				};
				for (var key in data) {
					if (this[key] !== undefined) {
						props[key] = this[key];
					}
				}
				if( typeof vm.config.aspectRatio == 'number'){
					props['aspectRatio'] = vm.config.aspectRatio;
				}
				if( typeof vm.config.minWidth == 'number'){
					props['minCropBoxWidth'] = vm.config.minWidth;
				}

				if( typeof vm.config.width == 'number' && typeof vm.config.height == 'number'){
					props['minCropBoxWidth'] = vm.config.width;
					props['minCropBoxHeight'] = vm.config.height;
					props['aspectRatio'] = vm.config.width / vm.config.height;
				}
				this.cropper = new Cropper(this.$refs.image_container,props);
			},
			update : function(event){
				var img = this.getCropBoxData();
				var data = event.detail;
				this.data.x = Math.round(data.x);
				this.data.y = Math.round(data.y);
				this.data.height = Math.round(img.height);
				this.data.width = Math.round(img.width);
				this.data.rotate = typeof data.rotate !== 'undefined' ? data.rotate : '';
				this.data.scaleX = typeof data.scaleX !== 'undefined' ? (data.scaleX  == 1 ? false : true ) : false;
				this.data.scaleY = typeof data.scaleY !== 'undefined' ? (data.scaleY  == 1 ? false : true ) : false;
			},
			reset: function reset() {
				return this.cropper.reset();
			},
			clear: function clear() {
				return this.cropper.clear();
			},
			replace: function replace(url) {
				var onlyColorChanged = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : false;
				return this.cropper.replace(url, onlyColorChanged);
			},
			enable: function enable() {
				return this.cropper.enable();
			},
			disable: function disable() {
				return this.cropper.disable();
			},
			destroy: function destroy() {
				return this.cropper.destroy();
			},
			destroyAndReset: function destroy() {
				this.$emit('update:showCropperSubmit' , false);
				this.showLabel = true;
				return this.cropper.destroy();
			},
			move: function move(offsetX, offsetY) {
				return this.cropper.move(offsetX, offsetY);
			},
			moveTo: function moveTo(x) {
				var y = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : x;

				return this.cropper.moveTo(x, y);
			},
			relativeZoom: function relativeZoom(ratio, _originalEvent) {
				return this.cropper.zoom(ratio, _originalEvent);
			},
			zoomTo: function zoomTo(ratio, _originalEvent) {
				return this.cropper.zoomTo(ratio, _originalEvent);
			},
			zoomIn: function zoomIn(ratio) {
				return this.cropper.zoom(ratio);
			},
			rotate: function rotate(degree) {
				return this.cropper.rotate(degree);
			},
			rotateTo: function rotateTo(degree) {
				return this.cropper.rotateTo(degree);
			},
			scaleX: function scaleX(_scaleX) {
				return this.cropper.scaleX(_scaleX);
			},
			scaleY: function scaleY(_scaleY) {
				return this.cropper.scaleY(_scaleY);
			},
			scale: function scale(scaleX) {
				var scaleY = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : scaleX;
				return this.cropper.scale(scaleX, scaleY);
			},
			getData: function getData() {
				var rounded = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : false;

				return this.cropper.getData(rounded);
			},
			setData: function setData(data) {
				return this.cropper.setData(data);
			},
			getContainerData: function getContainerData() {
				return this.cropper.getContainerData();
			},
			getImageData: function getImageData() {
				return this.cropper.getImageData();
			},
			getCanvasData: function getCanvasData() {
				return this.cropper.getCanvasData();
			},
			setCanvasData: function setCanvasData(data) {
				return this.cropper.setCanvasData(data);
			},
			getCropBoxData: function getCropBoxData() {
				return this.cropper.getCropBoxData();
			},
			setCropBoxData: function setCropBoxData(data) {
				return this.cropper.setCropBoxData(data);
			},
			getCroppedCanvas: function getCroppedCanvas() {
				var options = {};
				if( typeof  this.config.height == 'number' && typeof this.config.width == 'number'){
					options['width'] = this.config.width;
					options['height'] = this.config.height;
				}else{
					options['minWidth'] = this.config.minWidth;
					options['maxWidth'] = this.config.maxWidth;
					options['minHeight'] = this.config.minHeight;
					options['maxHeight'] = this.config.maxHeight;
				}
				if( this.type ){
					options['fillColor'] = '#fff';
				}else{
					options['fillColor'] = 'transparent';
				}
				options['imageSmoothingQuality'] = 'high';
				return this.cropper.getCroppedCanvas(options);
			},
			setAspectRatio: function setAspectRatio(aspectRatio) {
				this.data.ratio = aspectRatio;
				return this.cropper.setAspectRatio(aspectRatio);
			},
			setDragMode: function setDragMode(mode) {
				return this.cropper.setDragMode(mode);
			},
			changeImage: function(event){
				var vm = this;
				$('#cropper-img').css('display', 'block');
				var files = event.target.files || event.dataTransfer.files ;
				if( files.length ){
					if( /^image\/\w+/.test(files[0].type)  ){
						var reader = new FileReader();
						reader.onload = function(e){
							vm.replace(e.target.result);
							vm.src = e.target.result;
							vm.showLabel = false;
						};
						reader.readAsDataURL(files[0]);
					}else{
						var msg = files[0].name +' - định dạng này không hợp lệ .';
						helper.showNotification( msg  ,'error' , 'danger',5000);
					}
				}
				$(event.target).val('');

			},
		},
	});
</script>

<script type="text/javascript">
	var mix = {
		@if(!empty($modal))
		el: "#media-data",
		@endif
		data: {
			form: {

			},
			upload:{
				isLoading: false,
				data:[],
				title: '',
				size: 1024 * 1024 * 3,
				max : 3,
			},
			config:{
				multiple : false,
				maxFileUpload: 3,
				maxSizeUpload : 1,
			},
			data: [],
			pagination:{
				limit : 0,
				current : 1,
				page : 1,
				total: 0,
				keyword: '',
				data: []
			},
			selected : [],
			options: {
				multiple: false
			},
			cropperConfig : {},
		},
		methods: {
			show : function(options){
				var vm = this;
				this._load(1);

				if( options.hasOwnProperty('multiple') && options['multiple']) {
					vm.selected = JSON.parse(JSON.stringify(options.current));
				}
				if( options.hasOwnProperty('maxFile') && options['maxFile']) {
					vm.config['maxFile'] = options['maxFile'];
				}
				vm.options = options;
				// $(vm.$refs.modal).modal('show');

			},
			filterData: function(event ){

			},
			// cho anh
			_select : function(item){
				item = JSON.parse(JSON.stringify(item));
				if( this.options.multiple == true){
					var index = _.findIndex( this.selected , { 'id' : item.id } );
					if( index == -1){
						if( this.options.hasOwnProperty('maxFile') &&  this.selected.length >= this.options.maxFile){
							var message = 'Cho phép chọn tối đa '+ this.options.maxFile + ' ảnh trong thư viện !';
							$.confirm({
								title : '',
								content : message,
								buttons:{
									close : {
										text : 'Đóng',
										btnClass : 'btn-light'
									}
								}
							})
						}else{
							this.selected.push(item);
						}

					}else{
						this.selected.splice(index ,1 );
					}
				}else{
					if(this.selected.length == 1){
						if(this.selected[0].id == item.id){
							this.selected = [];
						}else{
							this.$set(this.selected, 0 , item)
						}
					}else{
						this.selected = [];
						this.selected.push(item);
					}
				}
			},
			_isSelected : function(id){
				return _.findIndex(this.selected , { 'id' : id}) > -1 ? true : false;
			},
			_useSelect : function(){
				if(  this.selected.length && this.options.hasOwnProperty('output') && typeof this.options.output == 'function'){
					this.options.output(this.selected);
					this.selected = [];
					$('#modal-gallery').modal('hide');
				}
			},
			//
			_load : function(number){
				var vm = this;
				var formdata = new FormData;
				if(vm.pagination.keyword != ''){
					formdata.append('keyword' , vm.pagination.keyword);
					vm.pagination.page = 1;
				}
				if( number != null && number != undefined){
					vm.pagination.page = number;
				}
				vm.pagination.current = vm.pagination.page;
				formdata.append('page' , vm.pagination.page);
				formdata.append('numRow' , 18);
				formdata.append('table' , true);
				if(typeof only_user_id !== 'undefined'){
					formdata.append('create_by' , only_user_id);	
				}
				helper.post( '{{ route('admin.medias.index') }}' , formdata ,15000)
				.done( function(res , status , xhr){
					vm.pagination.data = res.data;
					vm.pagination.limit = res.total;
					vm.pagination.total = res.last_page;
				})
				.fail(function(err){
					helper.showNotification('{{ trans('validation.attributes.error') }}', 'danger', 1000);
				})
			},
			_sendData : function(){
				if(this.upload.data.length){
					var vm = this;
					vm.upload.isLoading = true;
					for (var i = 0; i < vm.upload.data.length; i++) {
						var formData = new FormData();
						formData.append('_token', '{{ csrf_token() }}');
						formData.append('title', vm.upload.data[i].title);
						formData.append('name', vm.upload.data[i].name);
						formData.append('size', vm.upload.data[i].size);
						formData.append('file', vm.upload.data[i].url);
						var index = i;
						var xhr = new XMLHttpRequest();
						xhr.open('POST', "{{ route('admin.medias.store') }}", true);
						xhr.upload.onprogress = function(e) {
							if (e.lengthComputable) {
								var percentValue = (e.loaded / e.total) * 100;
								vm.upload.data[index].complete = percentValue;
							}
						};
						xhr.onload = function() {
							if (this.status == 200) {
								vm.upload.data[index].status = 'success';
								if( index == vm.upload.data.length - 1){
									$('#showCrop').trigger('click');
									helper.showNotification('Tải lên hoàn tất ','success', 5000);
									vm.upload.isLoading = false;
									vm.upload.data = [];
									vm.upload.title = '';
									vm._load(1);
								}
							}else{
								vm.upload.data[index].status = 'fail';
							}
						};
						xhr.send(formData);
					}
					
				}
			},
			_createImage : function(files){
				if (files.length){
					if( (this.upload.data.length + files.length) > this.config.maxFileUpload  ){
						helper.showNotification( 'Chỉ được upload tối đa 10 file' , 'danger', 5000);
					}else{
						for (var i = 0; i < files.length; i++) {
							if( /^image\/\w+/.test(files[i].type)  ){
								console.log(files[i]);
								if(files[i].size <= (this.config.maxSizeUpload * 1024 * 1024)){
									this._readFileData(files[i]);
								}else{
									var msg = files[i].name +' - dung lượng tối đa '+this.config.maxSizeUpload+'Mb .';
									helper.showNotification( msg, 'danger',5000);
								}
							}else{
								var msg = files[i].name +' - định dạng này không hợp lệ .';
								helper.showNotification( msg , 'danger',5000);
							}
						}
					}
				};
			},
			_upload : function(){
				var vm = this;
				if( this.upload.data.length ){
					vm._sendData();
				}else{
					helper.showNotification('Chưa có ảnh để tải lên', 'danger',5000);
				}
			},
			_change : function(event ){
				var files = event.target.files || event.dataTransfer.files ;
				this._createImage(files );
				$(event.target).val('');
			},
			_onDrop : function(event){
				event.stopPropagation();
				event.preventDefault();
				var files = event.dataTransfer.files;
				this._createImage(files);
			},
			_readFileData : function(file){
				var vm = this;
				var reader = new FileReader();
				reader.onload = function(e){
					vm.upload.data.push({
						url : e.target.result,
						name : file.name,
						size: file.size,
						title: vm.upload.title,
						complete: 0,
						status: null
					});
				};
				reader.readAsDataURL(file);
			},
			_readFileResize : function(file){
				var vm = this;
				var reader = new FileReader();
				reader.onload = function(e){
					$(vm.$refs.modalCropImage).modal('show');
					vm.cropper.src = e.target.result;
					vm.cropper.show = true;
				};
				reader.readAsDataURL(file);
			},
		},
		watch: {
			'pagination.page': function (val) {
				this._load(val);
			}
		},
		created: function () {
			this.upload.max = this.config.maxFileUpload;
			@if(empty($modal))
			this._load(1);
			@endif
		},
	};
</script>