<div class="form-group">
	<label for="title">{{ trans('lang::langs.table.code') }}<code>*</code></label> 
	<input type="text" id="title" v-model="form.code" required="required" value="" class="form-control ">
</div>
<div class="form-group">
	<label for="title">{{ trans('lang::langs.table.title') }}<code>*</code></label> 
	<input type="text" id="title" v-model="form.title" required="required" value="" class="form-control ">
</div>
@push('script')
<script type="text/javascript">
	var mix = {
		data: {
			form: {
				code: '{{ @$lang->code }}',
				title: '{{ @$lang->title }}',
			}
		},
		methods: {
			
		}
	}
</script>
@endpush