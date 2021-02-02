<div class="form-group">
  <label>
    {{ trans('customer::customers.form.organization.fullname') }} 
    <code>*</code>
  </label>
  <input type="text" class="form-control" v-model="form.fullname" placeholder="{{ trans('customer::customers.form.organization.fullname') }}">
</div>

<div class="form-group">
  <label>
    {{ trans('customer::customers.form.organization.phone') }}
    <code>*</code>
  </label>
  <input type="text" class="form-control" maxlength="11" v-model="form.phone" placeholder="{{ trans('customer::customers.form.organization.phone') }}">
</div>
<div class="form-group">
  <label>
    {{ trans('customer::customers.form.organization.organization_phone') }}
    <code>*</code>
  </label>
  <input type="text" class="form-control" maxlength="11" v-model="form.organization_phone" placeholder="{{ trans('customer::customers.form.organization.organization_phone') }}">
</div>
<div class="form-group">
  <label>
    {{ trans('customer::customers.form.organization.address') }} 
    <code>*</code>
  </label>
  <input type="address" class="form-control" v-model="form.address" placeholder="{{ trans('customer::customers.form.organization.address') }}">
</div>
<div class="form-group">
  <label>
    {{ trans('customer::customers.form.organization.password') }} <code>*</code>
  </label>
  <input type="password" class="form-control" v-model="form.password" placeholder="{{ trans('customer::customers.form.organization.password') }}">
</div>
<div class="row">
  <div class="col-md-6 col-sm-6 col-xs-12">
    <div class="form-group">
      <label>
        {{ trans('customer::customers.form.organization.organization_size') }}
      </label>
      <select2 allowclear v-model="form.organization_size" :options="sizes" name="organization_size" id="organization_size" class="form-control form-control-sm" placeholder="{{ trans('validation.attributes.select') }}" name="parent"></select2>
    </div>
  </div>
  <div class="col-md-6 col-sm-6 col-xs-12">
    <div class="form-group">
      <label>
        {{ trans('customer::customers.form.organization.birthday') }}
      </label>
      <datepicker id="birthday" v-model="form.birthday" required="required"></datepicker>
    </div>
  </div>
</div>
<div class="form-group">
  <label>
    {{ trans('customer::customers.form.organization.email') }}
  </label>
  <input type="email" class="form-control" v-model="form.email" placeholder="{{ trans('customer::customers.form.organization.email') }}">
</div>

<div class="row">
  <div class="col-md-6 col-sm-6 col-xs-12">
    <div class="form-group">
      <label>
        {{ trans('customer::customers.form.organization.organization_type') }}
      </label>
      <select2 allowclear v-model="form.organization_type" :options="types" name="organization_type" id="organization_type" class="form-control form-control-sm" placeholder="{{ trans('validation.attributes.select') }}" name="parent"></select2>
    </div>
  </div>
  <div class="col-md-6 col-sm-6 col-xs-12">
    <div class="form-group">
      <label>
        {{ trans('customer::customers.form.organization.organization_career') }}
      </label>
      <select2 allowclear v-model="form.organization_career" :options="careers" name="organization_career" id="organization_career" class="form-control form-control-sm" placeholder="{{ trans('validation.attributes.select') }}" name="parent"></select2>
    </div>
  </div>
</div>