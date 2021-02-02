<div class="form-group {{ $form }} mb-1">
	<label for="gallery">
		{{ $title }}
	</label>
	<div class="gallerys {{ $form }}">
		<div class="item {{ $form }}" v-for="(img, index) in {{$key}}.{{ $form }}">
			<div class="select-img">
				<div class="text-center">
					<a class="remove-img" v-if="img != ''" v-on:click="{{ $form }}RemoveImgList(index)"><i class="fa fa-times-circle fa-2x text-danger"></i></a>
					<img :src="img != '' ? img : '/public/admin/assets/img/uploadCroup.png' " v-on:click="{{ $form }}ShowGallery(index)" class="img-responsive cursor">
				</div>
			</div>
		</div>
		<div class="item">
			<div class="select-img">
				<div class="text-center">
					<img src="/public/admin/assets/img/uploadCroup.png" v-on:click="{{ $form }}ShowGallerys()" class="img-responsive cursor">
				</div>
			</div>
		</div>
	</div>
</div>
@push('script')
<script type="text/javascript">
	var {{ $form }} = {
		methods: {
			{{ $form }}ShowGallery: function (index) {
				var vm = this;
				var AppMedia = new appMedia();
				AppMedia.show({
					current : [],
					multiple: false,
					group: 'product',
					output: function (data) {
						vm.{{$key}}.{{ $form }}[index]=data[0].path;
						vm.{{$key}}.{{ $form }}.push();
					}
				});				
			},
			{{ $form }}ShowGallerys: function () {
				var vm = this;
				var AppMedia = new appMedia();
				AppMedia.show({
					current : [],
					multiple: true,
					group: 'product',
					output: function (data) {
						for (var i = 0; i < data.length; i++) {
							vm.{{$key}}.{{ $form }}.push(data[i].path);
						}
						
					}
				});				
			},
			{{ $form }}RemoveImgList: function (index) {
				this.{{$key}}.{{ $form }}.splice (index, 1);
			}
		}
	}
</script>
@endpush