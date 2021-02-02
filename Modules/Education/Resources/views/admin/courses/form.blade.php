<div class="form-group">
	<label for="title">{{ trans('education::courses.module') }}<code>*</code></label> 
	<input type="text" id="title" v-model="form.title" required="required" value="" class="form-control ">
</div>
<div class="form-group">
	<label for="school_from_year">{{ trans('education::courses.form.from_date') }}<code>*</code></label> 
	<datepicker id="school_from_year" v-model="form.school_from_year" required="required"></datepicker>
</div>
<div class="form-group">
	<label for="school_to_year">{{ trans('education::courses.form.to_date') }}<code>*</code></label> 
	<datepicker id="school_to_year" v-model="form.school_to_year" required="required"></datepicker>
</div>
@push('script')
<script type="text/javascript">
	var mix = {
		data: {
			form: {
				title: '{{ @$courses->title }}',
				school_from_year: '{{ @$courses->school_from_year }}',
				school_to_year: '{{ @$courses->school_to_year }}',

			}
		},
		methods: {
			
		}
	}
</script>
@endpush