<div class="row">
	<div class="col-sx-12 col-sm-2 col-md-2">
		<image_change v-model="form.img" :title="'{{ trans('website::pages.form.img') }}'"></image_change>
	</div>
	<div class="col-sx-12 col-sm-10 col-md-10">
		<div class="form-group">
			<label for="title">{{ trans('product::brands.form.title') }}<code>*</code></label> 
			<input type="text" class="form-control form-control-sm" v-model="form.title" name="title" placeholder="{{ trans('validation.attributes.title') }}">
		</div>
		<div class="form-group">
			<label for="title">
				{{ trans('product::brands.form.description') }}<code>*</code>
			</label> 
			<textarea class="form-control" v-model="form.description" name="description" placeholder="{{ trans('validation.attributes.description') }}"></textarea>
		</div>
	</div>
</div>

<div class="form-group">
	<label for="title">{{ trans('product::brands.form.content') }}</label> 
	<textarea class="form-control" v-model="form.content" v-editor-mini></textarea>
</div>
@push('script')
<script type="text/javascript">
	var mix = {
		data: {
			form: {
				img: '{{ $brand->img }}',
				title: '{{ $brand->title }}',
				description: '{{ $brand->description }}',
				content: `{!! $brand->content !!}`,
				alias: '{{ $brand->seo->alias }}',
				seo: {
					img: '{{ $brand->seo->img }}',
					title: '{{ $brand->seo->title }}',
					description: '{{ $brand->seo->description }}',
					keyword: '{{ $brand->seo->keyword }}',
					alias: '{{ $brand->seo->alias }}',
					status: {{ !empty($brand->seo->status) ? 'true' : 'false' }}
				}
			}
		},
		methods: {
			
		}
	}
</script>
@endpush