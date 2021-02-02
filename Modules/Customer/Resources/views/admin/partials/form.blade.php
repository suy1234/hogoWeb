<fieldset>
	<legend class="font-weight-semibold text-uppercase font-size-sm">
		<i class="icon-user mr-2"></i>
		{{ trans('customer::customers.form.general.title') }}
	</legend>

	<div class="collapse show">
		<div class="form-group">
			<label class="d-block">
				{{ trans('customer::customers.form.general.organization.title') }}:
			</label>
			<div class="form-check form-check-inline">
				<div class="radio radio-custom">
					<label for="is_organization1">
						<input value="0" id="is_organization1" type="radio" v-model="form.is_organization" name="organization">
						{{ trans('customer::customers.form.general.organization.personal') }}
					</label>
				</div>
			</div>

			<div class="form-check form-check-inline">
				<div class="radio radio-custom">
					<label for="organization">
						<input value="1" id="organization" type="radio" v-model="form.is_organization" name="organization">
						{{ trans('customer::customers.form.general.organization.company') }}
					</label>
				</div>
			</div>

		</div>
		<template v-if="form.is_organization == 0">
			<div class="row">
				<div class="col-sx-12 col-sm-2 col-md-2">
					<image_change v-model="form.avatar" :title="'{{ trans('customer::customers.form.general.avatar') }}'"></image_change>
				</div>
				<div class="col-sx-12 col-sm-10 col-md-10">
					<div class="form-group">
						<label>
							{{ trans('customer::customers.form.general.fullname') }} 
							<code>*</code>
						</label>
						<input type="text" class="form-control" v-model="form.fullname" placeholder="{{ trans('customer::customers.form.general.fullname') }}">
					</div>

					<div class="form-group">
						<label>
							{{ trans('customer::customers.form.general.phone') }}
							<code>*</code>
						</label>
						<input type="text" class="form-control" maxlength="11" v-model="form.phone" placeholder="{{ trans('customer::customers.form.general.phone') }}">
					</div>

				</div>
			</div>

			<div class="form-group">
				<label>
					{{ trans('customer::customers.form.general.address') }} 
					<code>*</code>
				</label>
				<input type="address" class="form-control" v-model="form.address" placeholder="{{ trans('customer::customers.form.general.address') }}">
			</div>
			<div class="form-group">
				<label>
					{{ trans('customer::customers.form.general.password') }} <code>*</code>
				</label>
				<input type="password" class="form-control" v-model="form.password" placeholder="{{ trans('customer::customers.form.general.password') }}">
			</div>
			<div class="row">
				<div class="col-md-6 col-sm-6 col-xs-12">
					<div class="form-group">
						<label>
							{{ trans('customer::customers.form.general.gender.title') }} <code>*</code>
						</label>
						<select name="gender" v-model="form.gender" class="form-control">
							<option value="1">{{ trans('customer::customers.form.general.gender.1') }}</option>
							<option value="2">{{ trans('customer::customers.form.general.gender.2') }}</option>
						</select>
					</div>
				</div>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<div class="form-group">
						<label>
							{{ trans('customer::customers.form.general.birthday') }} <code>*</code>
						</label>
						<datepicker id="birthday" v-model="form.birthday" required="required"></datepicker>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label>
					{{ trans('customer::customers.form.general.email') }}
				</label>
				<input type="email" class="form-control" v-model="form.email" placeholder="{{ trans('customer::customers.form.general.email') }}">
			</div>
		</template>
		<template v-else>
			@include('customer::admin.partials.company')
		</template>
		@include('customer::admin.partials.passport_img')
		<div class="form-group">
			<label>
				{{ trans('customer::customers.form.general.vat') }}
			</label>
			<input type="vat" class="form-control" v-model="form.vat" placeholder="{{ trans('customer::customers.form.general.vat') }}">
		</div>
		<div class="form-group">
			<label>
				{{ trans('customer::customers.form.general.note') }}
			</label>
			<textarea rows="2" v-model="form.note" class="form-control" placeholder="{{ trans('customer::customers.form.general.note') }}"></textarea>
		</div>
	</div>
</fieldset>

<fieldset>
	<legend class="font-weight-semibold text-uppercase font-size-sm">
		<i class="icon-reading mr-2"></i>
		{{ trans('customer::customers.form.info.title') }}
		<a class="float-right text-default" data-toggle="collapse" data-target="#info">
			<i class="icon-circle-down2"></i>
		</a>
	</legend>

	<div class="collapse" id="info">
		<div class="form-group">
			<label>
				{{ trans('customer::customers.form.info.passport') }}
			</label>
			<input type="text" class="form-control" v-model="form.passport" placeholder="{{ trans('customer::customers.form.info.passport') }}">
		</div>
		<div class="form-group">
			<label>
				{{ trans('customer::customers.form.info.organization') }}
			</label>
			<select2 allowclear v-model="form.organization" :options="organizations" name="organization" id="organization" class="form-control form-control-sm" placeholder="{{ trans('validation.attributes.select') }}" name="parent"></select2>
		</div>
		<div class="form-group">
			<label>
				{{ trans('customer::customers.form.info.organization') }}
			</label>
			<select2 allowclear v-model="form.organization" :options="organizations" name="organization" id="organization" class="form-control form-control-sm" placeholder="{{ trans('validation.attributes.select') }}" name="parent"></select2>
		</div>

		<div class="form-group">
			<label>
				{{ trans('customer::customers.form.info.country') }}
			</label>
			<select2 allowclear v-model="form.country_id" :options="countrys" name="country" id="country" class="form-control form-control-sm" placeholder="{{ trans('validation.attributes.select') }}" name="parent"></select2>
		</div>

		<div class="form-group">
			<label>
				{{ trans('customer::customers.form.info.province') }}
			</label>
			<select2 allowclear v-model="form.province_id" :options="provinces" name="province" id="province" class="form-control form-control-sm" placeholder="{{ trans('validation.attributes.select') }}" name="parent"></select2>
		</div>

		<div class="form-group">
			<label>
				{{ trans('customer::customers.form.info.district') }}
			</label>
			<select2 allowclear v-model="form.district_id" :options="districts" name="district" id="district" class="form-control form-control-sm" placeholder="{{ trans('validation.attributes.select') }}" name="parent"></select2>
		</div>

		<div class="form-group">
			<label>
				{{ trans('customer::customers.form.info.ward') }}
			</label>
			<select2 allowclear v-model="form.ward_id" :options="wards" name="ward" id="ward" class="form-control form-control-sm" placeholder="{{ trans('validation.attributes.select') }}" name="parent"></select2>
		</div>
		<div class="form-group">
			<label>
				{{ trans('customer::customers.form.info.website') }}
			</label>
			<input type="website" class="form-control" v-model="form.website" placeholder="{{ trans('customer::customers.form.info.website') }}">
		</div>
	</div>
</fieldset>
	@include('customer::admin.partials.script')