<div class="form-group">
	<label for="code">{{ trans('education::classs.form.code') }}<code>*</code></label>
	<input type="text" id="code" v-model="form.code" required="required" value="" class="form-control ">
</div>
<div class="form-group">
	<label for="user_id">{{ trans('education::classs.form.homeroom_teacher') }}<code>*</code></label>
	<select2 id="teacher" v-model="form.teacher_id" :options="teachers" name="teacher" placeholder="{{ trans('validation.attributes.select') }}"></select2>
</div>

<div class="row">
	<div class="col-md-6 col-xs-12 col-sm-6">
		<div class="form-group">
			<label for="course_id">{{ trans('education::classs.form.course') }}<code>*</code></label>
			<select2 id="course" v-model="form.course_id" :options="courses" name="course" placeholder="{{ trans('validation.attributes.select') }}"></select2>
		</div>
	</div>
	<div class="col-md-6 col-xs-12 col-sm-6">
		<div class="form-group">
			<label for="subject_id">{{ trans('education::classs.form.subject') }}<code>*</code></label>
			<select2 id="subject" v-model="form.subject_id" :options="subjects" name="subject" placeholder="{{ trans('validation.attributes.select') }}"></select2>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-4 col-xs-12 col-sm-4">
		<div class="form-group">
			<label for="max">{{ trans('education::classs.form.max') }}<code>*</code></label>
			<number class="form-control " v-model="form.max" required="required"></number>
		</div>
	</div>
	<div class="col-md-4 col-xs-12 col-sm-4">
		<div class="form-group">
			<label for="time_theory">{{ trans('education::classs.form.time_theory') }}<code>*</code></label>
			<number class="form-control " v-model="form.time_theory" required="required"></number>
		</div>
	</div>
	<div class="col-md-4 col-xs-12 col-sm-4">
		<div class="form-group">
			<label for="time_practice">{{ trans('education::classs.form.time_practice') }}<code>*</code></label>
			<number class="form-control " v-model="form.time_practice" required="required"></number>
		</div>
	</div>
</div>
<div class="form-group">
	<label for="graduation_exam">
		{{ trans('education::classs.form.graduation_exam') }}
	</label> 
	<datepicker id="graduation_exam" v-model="form.graduation_exam" required="required"></datepicker>
</div>

<div class="row">
	<div class="col-md-6 col-xs-12 col-sm-6">
		<div class="form-group">
			<label for="driving_exam_provisional">
				{{ trans('education::classs.form.driving_exam_provisional') }}
			</label> 
			<datepicker id="driving_exam_provisional" v-model="form.driving_exam_provisional" required="required"></datepicker>
		</div>
	</div>
	<div class="col-md-6 col-xs-12 col-sm-6">
		<div class="form-group">
			<label for="driving_exam">
				{{ trans('education::classs.form.driving_exam') }}
			</label> 
			<datepicker id="driving_exam" v-model="form.driving_exam" required="required"></datepicker>
		</div>
	</div>
</div>
@push('script')
<script type="text/javascript">
	var mix = {
		data: {
			courses: {!! $courses !!},
			subjects: {!! $subjects !!},
			teachers: {!! $teachers !!},
			form: {
				code: '',
				course_id: '',
				subject_id: '',
				teacher_id: '',
				max: 30,
				time_theory: 3,
				time_practice: 18,
				graduation_exam: '',
				driving_exam_provisional: '',
				driving_exam: '',
			}
		},
		methods: {
			subjectCal: function () {
				var vm = this;
				$.ajax({
					type: "POST",
					url: '{{ route('admin.classs.subject') }}',
					data: {id: vm.form.subject_id, _token : $('meta[name=csrf-token]').attr('content')},                        
				}).done( function(res , status , xhr){
					if(res.success){
						vm.form.graduation_exam = res.data.graduation_exam;
						vm.form.driving_exam_provisional = res.data.driving_exam_provisional;
					}else{
						helper.showNotification("{{ trans('validation.attributes.error') }}", 'danger', 1000);
					}
				}).fail(function(err){
					helper.showNotification("{{ trans('validation.attributes.error') }}", 'danger', 1000);
				})   

			},
		},
		watch: {
			"form.subject_id": function(id) {
				this.subjectCal();
			},
		},
		created: function () {
			this.form = {!! $classs !!};
		},
	}
</script>
@endpush