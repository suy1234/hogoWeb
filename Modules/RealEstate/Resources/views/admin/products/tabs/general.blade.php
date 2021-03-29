<div class="row">
	<div class="col-sx-12 col-sm-2 col-md-2">
		<image_change v-model="form.img" :title="'{{ trans('website::pages.form.img') }}'"></image_change>
	</div>
	<div class="col-sx-12 col-sm-10 col-md-10">
		<div class="form-group">
			<label for="title">{{ trans('product::products.form.title') }}:<code>*</code></label> 
			<input type="text" class="form-control form-control-sm" v-model="form.title" name="title" placeholder="{{ trans('validation.attributes.title') }}">
		</div>
		<div class="row">
			<div class="col-sx-12 col-sm-6 col-md-6">
				<div class="form-group">
					<label for="price">{{ trans('product::products.form.price') }}:</label> 
					<input type="text" class="form-control form-control-sm" v-model="form.price" name="price" placeholder="">
				</div>
			</div>
			<div class="col-sx-12 col-sm-6 col-md-6">
				<div class="form-group">
					<label for="price_sale">{{ trans('product::products.form.price_sale') }}:</label> 
					<input type="text" class="form-control form-control-sm" v-model="form.price_sale" name="price_sale" placeholder="">
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-sx-12 col-sm-4 col-md-4">
		<div class="form-group form-group-feedback form-group-feedback-right">
			<label class="control-label" for="category">
				{{ trans('product::products.form.category') }}<code>*</code>:
			</label>
			<select2 allowclear v-model="form.category_id" :options="categorys" name="category_id" id="category_id" class="form-control form-control-sm" placeholder="{{ trans('validation.attributes.select') }}" name="category"></select2>
		</div>
	</div>
	<div class="col-sx-12 col-sm-4 col-md-4">
		<div class="form-group form-group-feedback form-group-feedback-right">
			<label class="control-label" for="group">
				{{ trans('product::products.form.group') }}<code>*</code>:
			</label>
			<select2 allowclear v-model="form.group_id" :options="groups" name="group_id" id="group_id" class="form-control form-control-sm" placeholder="{{ trans('validation.attributes.select') }}" name="group"></select2>
		</div>
	</div>
	<div class="col-sx-12 col-sm-4 col-md-4">
		<div class="form-group form-group-feedback form-group-feedback-right">
			<label class="control-label" for="brand">
				{{ trans('product::products.form.brand') }}:
			</label>
			<select2 allowclear v-model="form.brand_id" :options="brands" name="brand_id" id="brand_id" class="form-control form-control-sm" placeholder="{{ trans('validation.attributes.select') }}" name="brand"></select2>
		</div>
	</div>
</div>
<div class="form-group">
	<label for="title">
		{{ trans('product::products.form.description') }}:
	</label> 
	<textarea class="form-control" v-model="form.description" name="description" placeholder="{{ trans('validation.attributes.description') }}"></textarea>
</div>
@include('app::admin.components.form.images', ['title' => trans('product::products.form.gallery'), 'key' => 'form', 'form' => 'gallerys'])
<div class="form-group">
	<label for="title">{{ trans('product::products.form.content') }}:</label> 
	<textarea class="form-control" v-model="form.content" v-editor></textarea>
</div>
