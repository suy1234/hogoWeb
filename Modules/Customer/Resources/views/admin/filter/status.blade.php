<li class="list-inline-item">
	<select name="status" class="form-control form-control-sm select2">
		<option value="">{{ trans('validation.attributes.select_status') }}</option>
		@foreach([-1, 1] as $value)
			<option value="{{ $value }}" {{ @request()->status == $value ? 'selected' : '' }}>{{ trans('customer::customers.status.'.$value) }}</option>
		@endforeach
	</select>
</li>