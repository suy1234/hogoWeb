@php($brands = brands())
<li class="list-inline-item">
	<select name="brand_id" class="form-control form-control-sm select2-js">
		<option value="">{{ trans('product::products.filters.brand') }}</option>
		@foreach($brands as $id => $value)
			<option value="{{ $id }}" {{ @request()->brand_id == $id ? 'selected' : '' }}>{{ $value }}</option>
		@endforeach
	</select>
</li>