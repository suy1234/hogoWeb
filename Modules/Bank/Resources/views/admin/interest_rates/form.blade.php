<div class="row">
	<div class="col-sx-12 col-sm-12 col-md-12">
		<div class="form-group">
			<label class="control-label" for="bank_id">
				{{ trans('bank::interest_rates.form.bank') }}<code>*</code>:
			</label>
			<select2 allowclear v-model="form.bank_id" :options="banks" name="bank_id" id="bank_id" class="form-control form-control-sm" placeholder="{{ trans('validation.attributes.select') }}" name="bank_id"></select2>
		</div>
		<div class="form-group">
			<label class="control-label" for="category_id">
				{{ trans('bank::interest_rates.form.category') }}<code>*</code>:
			</label>
			<select2 allowclear v-model="form.category_id" :options="categorys" name="category_id" id="category_id" class="form-control form-control-sm" placeholder="{{ trans('validation.attributes.select') }}" name="category_id"></select2>
		</div>
		<div class="form-group">
			<label class="control-label" for="group_id">
				{{ trans('bank::interest_rates.form.group') }}:
			</label>
			<select2 allowclear v-model="form.group_id" :options="groups" name="group_id" id="group_id" class="form-control form-control-sm" placeholder="{{ trans('validation.attributes.select') }}" name="group_id"></select2>
		</div>
	</div>
	<div class="col-sx-12 col-sm-6 col-md-6" v-for="item in form.bank_info">
		<div class="row">
			<div class="col-sx-4 col-sm-4 col-md-4" v-if="item.unit">
				<div class="form-group">
					<label class="control-label">
						{{ trans('bank::interest_rates.form.follow') }}:
					</label>
					<select v-model="item.unit" name="unit" class="form-control form-control-sm">
						<option value="{{ trans('bank::banks.units.year') }}">{{ trans('bank::banks.units.year') }}</option>
						<option value="{{ trans('bank::banks.units.month') }}">{{ trans('bank::banks.units.month') }}</option>
					</select>
				</div>

			</div>
			<div class="col-sx-8 col-sm-8 col-md-8">
				<div class="form-group">
					<label class="control-label">
						@{{ item.title }}<code>*</code>:
					</label>
					<input type="text" name="value" v-model="item.value" class="form-control form-control-sm">
				</div>
			</div>
		</div>
	</div>
</div>
@push('script')
<script type="text/javascript">
	var mix = {
		data: {
			banks: {!! $banks !!},
			categorys: {!! $categorys !!},
			groups: {!! $groups !!},
			form: {
				bank_id: '{{ @$bankInterestRate->bank_id }}',
				category_id: '{{ @$bankInterestRate->category_id }}',
				group_id: '{{ @$bankInterestRate->group_id }}',
				@if(!empty($bankInterestRate->bank_info))
					bank_info: {!! json_encode($bankInterestRate->bank_info) !!},
				@else
					bank_info: {
						interest_rate: {
							title: '{{ trans('bank::interest_rates.form.interest_rate') }}',
							value: '6.8%',
							unit: '{{ trans('bank::banks.units.year') }}'
						},
						endow: {
							title: '{{ trans('bank::interest_rates.form.endow') }}',
							value: '12',
							unit: '{{ trans('bank::banks.units.month') }}'
						},
						timeout: {
							title: '{{ trans('bank::interest_rates.form.timeout') }}',
							value: '10',
							unit: '{{ trans('bank::banks.units.year') }}'
						},
						interest_rate_last: {
							title: '{{ trans('bank::interest_rates.form.interest_rate_last') }}',
							value: 'LSTK 13T + 3,5%',
							unit: '{{ trans('bank::banks.units.year') }}'
						},
						interest_rate_first: {
							title: '{{ trans('bank::interest_rates.form.interest_rate_first') }}',
							value: '2 - 5%',
							unit: '{{ trans('bank::banks.units.year') }}'
						},
						borrow_full: {
							title: '{{ trans('bank::interest_rates.form.borrow_full') }}',
							value: '2 - 5%'
						},
					},
				@endif
			}
		},
		methods: {

		},
		mounted() {

		}
	}
</script>
@endpush