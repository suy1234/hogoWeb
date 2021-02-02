@push('script')
<script type="text/javascript">
	var mix = {
		data: {
			careers: {!! collect(config('customer.organization.career')) !!},
			sizes: {!! collect(config('customer.organization.size')) !!},
			types: {!! collect(config('customer.organization.type')) !!},
			organizations: [],
			form: {
				fullname: '',
				avatar: '',
				cmnd_front: '',
				cmnd_back: '',
				phone: '',
				gender: 1,
				birthday: '',
				email: '',
				password: '',
				remember_token: '',
				passport: '',
				country_id: '',
				province_id: '',
				district_id: '',
				ward_id: '',
				address: '',
				note: '',

				is_organization: 0,
				organization_id: '',
				organization_size: '',
				organization_type: '',
				organization_career: '',
				organization_name: '',
				organization_phone: '',
				organization_email: '',

				website: '',
				vat: '',
				level: '',
			}
		},
		methods: {
			
		},
		created: function () {
        	@if(!empty($customers->id))
        		this.form = {!! $customers !!};
        	@endif
        },
	}
</script>
@endpush