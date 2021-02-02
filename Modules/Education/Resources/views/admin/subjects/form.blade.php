<div class="form-group">
	<label for="title">
		{{ trans('education::subjects.module') }}<code>*</code>
	</label> 
	<input type="text" id="title" v-model="form.title" required="required" value="" class="form-control form-control-sm">
</div>
<div class="row">
	<div class="col-md-6 col-xs-6 col-ms-6">
		<div class="form-group">
			<label for="title">
				{{ trans('education::subjects.form.time') }}<code>*</code>
			</label> 
			<input type="number" id="time" v-model="form.time" required="required" value="" class="form-control form-control-sm" min="1">
		</div>
	</div>
	<div class="col-md-6 col-xs-6 col-ms-6">
		<div class="form-group">
			<label for="title">
				{{ trans('education::subjects.form.unit') }}<code>*</code>
			</label> 
			<select2 id="unit" v-model="form.unit_id" :options="units" name="unit" placeholder="{{ trans('validation.attributes.select') }}"></select2>
		</div>
	</div>
</div>
@push('script')
<script type="text/javascript">
	var mix = {
		data: {
			units: {!! $units !!},
			form: {
				title: '{{ @$subjects->title }}',
				time: '{{ @$subjects->time }}',
				unit_id: '{{ @$subjects->unit_id }}',
			}
		},
		methods: {
			
		}
	}
</script>
@endpush