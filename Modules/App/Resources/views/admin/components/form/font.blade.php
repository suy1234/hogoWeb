<div class="form-group form-group-feedback form-group-feedback-right">
	<label class="control-label" for="category">
		Danh mục<code>*</code>:
	</label>
	<select class="form-control form-control-sm select2">
		<option value="">{{ trans('validation.attributes.select') }}</option>
		@foreach(config('website.font') as $value)
		<option value="{{ $value }}">{{ $value }}</option>
		@endforeach
	</select>
</div>