<form action="#">
	<fieldset>
		<legend class="font-weight-semibold text-uppercase font-size-sm">
			<i class="icon-user mr-2"></i>
			{{ trans('customer::students.form.general.title') }}
		</legend>

		<div class="collapse show">
			<div class="row">
				<div class="col-sx-12 col-sm-2 col-md-2">
					<div class="form-group select-img">
						<label class="control-label">
							{{ trans('customer::students.form.general.avatar') }} 
						</label>
						<div class="text-center">
							<template v-if="form.avatar">
								<a class="remove-img" v-on:click="removeImg('form.avatar')"><i class="fa fa-times-circle fa-2x text-danger"></i></a>
							</template>
							<img :src="form.avatar ? form.avatar : '/public/admin/assets/img/uploadCroup.png' " v-on:click="showGallery('primary_image', 'form.avatar')" class="img-responsive cursor">
						</div>
					</div>
				</div>
				<div class="col-sx-12 col-sm-10 col-md-10">
					<div class="form-group">
						<label>
							{{ trans('customer::students.form.general.fullname') }} 
							<code>*</code>
						</label>
						<input type="text" class="form-control" v-model="form.fullname" placeholder="{{ trans('customer::students.form.general.fullname') }}">
					</div>

					<div class="form-group">
						<label>
							{{ trans('customer::students.form.general.phone') }}
							<code>*</code>
						</label>
						<input type="text" class="form-control" maxlength="11" v-model="form.phone" placeholder="{{ trans('customer::students.form.general.phone') }}">
					</div>

				</div>
			</div>

			<div class="form-group">
				<label>
					{{ trans('customer::students.form.general.address') }} 
					<code>*</code>
				</label>
				<input type="address" class="form-control" v-model="form.address" placeholder="{{ trans('customer::students.form.general.address') }}">
			</div>
			<div class="form-group">
				<label>
					{{ trans('customer::students.form.general.password') }} <code>*</code>
				</label>
				<input type="password" class="form-control" v-model="form.password" placeholder="{{ trans('customer::students.form.general.password') }}">
			</div>
			<div class="row">
				<div class="col-md-6 col-sm-6 col-xs-12">
					<div class="form-group">
						<label>
							{{ trans('customer::students.form.general.gender.title') }} <code>*</code>
						</label>
						<select name="gender" v-model="form.gender" class="form-control">
							<option value="1">{{ trans('customer::students.form.general.gender.1') }}</option>
							<option value="2">{{ trans('customer::students.form.general.gender.2') }}</option>
						</select>
					</div>
				</div>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<div class="form-group">
						<label>
							{{ trans('customer::students.form.general.birthday') }} <code>*</code>
						</label>
						<datepicker id="birthday" v-model="form.birthday" required="required"></datepicker>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label>
					{{ trans('customer::students.form.general.email') }}
				</label>
				<input type="email" class="form-control" v-model="form.email" placeholder="{{ trans('customer::students.form.general.email') }}">
			</div>
			
			@include('customer::admin.partials.passport_img')
			
			<div class="form-group">
				<label>
					{{ trans('customer::students.form.general.note') }}
				</label>
				<textarea rows="2" v-model="form.note" class="form-control" placeholder="{{ trans('customer::students.form.general.note') }}"></textarea>
			</div>
		</div>
	</fieldset>

	<fieldset>
		<legend class="font-weight-semibold text-uppercase font-size-sm">
			<i class="icon-reading mr-2"></i>
			{{ trans('customer::students.form.info.title') }}
			<a class="float-right text-default" data-toggle="collapse" data-target="#info">
				<i class="icon-circle-down2"></i>
			</a>
		</legend>

		<div class="collapse" id="info">
			<div class="form-group">
				<label>
					{{ trans('customer::students.form.info.passport') }}
				</label>
				<input type="text" class="form-control" v-model="form.passport" placeholder="{{ trans('customer::students.form.info.passport') }}">
			</div>
			<div class="form-group">
				<label>
					{{ trans('customer::students.form.info.country') }}
				</label>
				<select2 allowclear v-model="form.country_id" :options="countrys" name="country" id="country" class="form-control form-control-sm" placeholder="{{ trans('validation.attributes.select') }}" name="parent"></select2>
			</div>

			<div class="form-group">
				<label>
					{{ trans('customer::students.form.info.province') }}
				</label>
				<select2 allowclear v-model="form.province_id" :options="provinces" name="province" id="province" class="form-control form-control-sm" placeholder="{{ trans('validation.attributes.select') }}" name="parent"></select2>
			</div>

			<div class="form-group">
				<label>
					{{ trans('customer::students.form.info.district') }}
				</label>
				<select2 allowclear v-model="form.district_id" :options="districts" name="district" id="district" class="form-control form-control-sm" placeholder="{{ trans('validation.attributes.select') }}" name="parent"></select2>
			</div>

			<div class="form-group">
				<label>
					{{ trans('customer::students.form.info.ward') }}
				</label>
				<select2 allowclear v-model="form.ward_id" :options="wards" name="ward" id="ward" class="form-control form-control-sm" placeholder="{{ trans('validation.attributes.select') }}" name="parent"></select2>
			</div>
			<div class="form-group">
				<label>
					{{ trans('customer::students.form.info.website') }}
				</label>
				<input type="website" class="form-control" v-model="form.website" placeholder="{{ trans('customer::students.form.info.website') }}">
			</div>
		</div>
	</fieldset>
</form>
@include('customer::admin.script')