@push('script')
<script type="text/javascript">
	var mix = {
		mixins: [gallerys],
		data: {
			categorys: {!! @$categorys !!},
			groups: {!! $groups !!},
			brands: {!! $brands !!},
			form: {
				parent_id : '',
				barcode : '',
				sku : '',
				title : '',
				rating : '',
				alias : '',
				description : '',
				content : '',
				img : '',
				gallerys : [],
				category_id : '',
				brand_id : '',
				group_ids : [],
				properties_id : '',
				unit_id : '',
				price : '',
				price_sale : '',
				price_percent : '',
				price_sort : '',
				price_customer_1 : '',
				price_customer_2 : '',
				price_customer_3 : '',
				price_customer_4 : '',
				price_customer_5 : '',
				price_customer_6 : '',
				price_from_date : '',
				price_to_date : '',
				by_pos : '',
				by_website : '',
				inventory_quantity : '',
				warehouses_quantity_set : '',
				warehouses_quantity_warning : '',
				published_at : '',
				created_by : '',
				seo: {
					img: '{{ $product->seo->img }}',
					title: '{{ $product->seo->title }}',
					description: '{{ $product->seo->description }}',
					keyword: '{{ $product->seo->keyword }}',
					alias: '{{ $product->seo->alias }}',
					status: {{ !empty($product->seo->status) ? 'true' : 'false' }}
				}
			}
		},
		methods: {
			
		}
	}
</script>
@endpush