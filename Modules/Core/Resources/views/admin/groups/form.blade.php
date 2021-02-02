<div class="row">
	<div class="col-sx-12 col-sm-2 col-md-2">
		<image_change v-model="form.img" :title="'{{ trans('website::pages.form.img') }}'"></image_change>
	</div>
	<div class="col-sx-12 col-sm-10 col-md-10">
		<div class="form-group">
			<label for="title">{{ trans('core::categorys.form.title') }}<code>*</code></label> 
			<input type="text" class="form-control form-control-sm" v-model="form.title" name="title" placeholder="{{ trans('validation.attributes.title') }}">
		</div>
		<div class="form-group">
			<label for="title">
				{{ trans('core::categorys.form.description') }}<code>*</code>
			</label> 
			<textarea class="form-control" placeholder="{{ trans('validation.attributes.description') }}" v-model="form.description" name="description"></textarea>
		</div>
	</div>
</div>
<div class="form-group">
	<label for="title">{{ trans('core::categorys.form.content') }}</label> 
	<textarea class="form-control" v-model="form.content" v-editor-mini></textarea>
</div>
@push('script')
<script type="text/javascript">
	var mix = {
		data: {
			form: {
				img: '{{ $groups->img }}',
				title: '{{ $groups->title }}',
				description: '{{ $groups->description }}',
				content: `{!! $groups->content !!}`,
				alias: '{{ $groups->seo->alias }}',
				parent_id: '{{ $groups->parent_id }}',
				img: '{{ $groups->seo->img }}',
				seo: {
					img: '{{ $groups->seo->img }}',
					title: '{{ $groups->seo->title }}',
					description: '{{ $groups->seo->description }}',
					keyword: '{{ $groups->seo->keyword }}',
					alias: '{{ $groups->seo->alias }}',
					status: {{ !empty($groups->seo->status) ? 'true' : 'false' }}
				}
			}
		},
		methods: {
			addAnswer: function () {
				this.form.answers.push({
					is_answer : false,
					content : '',
				})
			},
			removeAnswer: function (index){
				this.form.answers.splice(index, 1);
			}
		}
	}
</script>
@endpush