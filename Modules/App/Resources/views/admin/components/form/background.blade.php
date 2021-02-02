<fieldset class="content-group">
	<legend class="text-bold mb-0 pb-0">
		<div class="form-group mb-0">
			<div class="checkbox checkbox-custom">
				<input id="background_type" type="checkbox" name="background_type" v-model="form.{{ $key }}.background.type" value="1">
				<label for="background_type">
					{{ trans('app::forms.background.title') }}
				</label>
			</div>
		</div>
	</legend>
	<div class="row">
		<div class="col-md-2" v-if="form.{{ $key }}.background.type">
			<div class="form-group mb-2">
				<label class="control-label">
					{{ trans('app::forms.background.img') }}
				</label>
				<div class="text-center">
					<template v-if="form.{{ $key }}.background.data">
						<a class="remove-img" v-on:click="removeImgSeo"><i class="fa fa-times-circle fa-2x text-danger"></i></a>
					</template>
					<img :src="form.{{ $key }}.background.data != '' ? form.{{ $key }}.background.data : '/public/admin/assets/img/uploadCroup.png' " v-on:click="setImgSeo" class="img-responsive cursor">
				</div>
			</div>
		</div>
		<div class="col-md-12" v-else>
			<colorpicker :color="form.{{ $key }}.background.data" v-model="form.{{ $key }}.background.data" />	
		</div>
	</div>
</fieldset>
