<div class="form-group">
	<label class="control-label">
		{{ trans('core::seo.img') }}
	</label>
	<div class="text-center">
		<template v-if="form.seo.img">
			<a class="remove-img" v-on:click="removeImgSeo"><i class="fa fa-times-circle fa-2x text-danger"></i></a>
		</template>
		<img :src="form.seo.img != '' ? form.seo.img : '/public/admin/assets/img/uploadCroup.png' " v-on:click="setImgSeo" class="img-responsive cursor">
	</div>
</div>