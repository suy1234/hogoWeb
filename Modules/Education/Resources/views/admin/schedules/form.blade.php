<div class="form-group">
	<label>
		{{ trans('education::schedules.form.user') }}<code>*</code>
	</label>
	<select2 allowclear v-model="form.user_id" :options="users" name="users" id="users" class="form-control form-control-sm" placeholder="{{ trans('validation.attributes.select') }}" name="user_id"></select2>
</div>
<div class="form-group">
	<label>
		{{ trans('education::schedules.form.subject') }}<code>*</code>
	</label>
	<select2 allowclear v-model="form.subject_id" :options="subjects" name="subjects" id="subjects" class="form-control form-control-sm" placeholder="{{ trans('validation.attributes.select') }}" name="subject_id"></select2>
</div>
<div class="form-group">
	<label for="title">{{ trans('education::schedules.form.qty') }}<code>*</code></label>
	<number v-model="form.qty" max="4" class="form-control form-control-sm"></number>
</div>
<div class="form-group">
	<label for="from_date">{{ trans('education::schedules.form.from_date') }}<code>*</code></label> 
	<datepickertime id="from_date" class="form-control form-control-sm" v-model="form.from_date" required="required"></datepickertime>
</div>
<div class="form-group">
	<label for="to_date">{{ trans('education::schedules.form.to_date') }}<code>*</code></label> 
	<datepickertime id="to_date" class="form-control form-control-sm" v-model="form.to_date" required="required"></datepickertime>
</div>
@push('script')
<script type="text/javascript">
	var users = {!! $users !!};
	var subjects = {!! $subjects !!};
	var mix = {
		data: {
			users: users,
			subjects: subjects,
			form: {
				user_id: '{{ @$schedules->user_id }}',
				subject_id: '{{ @$schedules->subject_id }}',
				from_date: '{{ @$schedules->from_date }}',
				to_date: '{{ @$schedules->to_date }}',
				qty: 0,
			}
		},
		methods: {
			
		}
	}
</script>
@endpush