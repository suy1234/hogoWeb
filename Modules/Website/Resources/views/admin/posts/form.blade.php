<div class="row">
	<div class="col-sx-12 col-sm-2 col-md-2">
		<image_change v-model="form.img" :title="'{{ trans('website::pages.form.img') }}'"></image_change>
	</div>
	<div class="col-sx-12 col-sm-10 col-md-10">
		<div class="form-group">
			<label for="title">{{ trans('website::posts.form.title') }}<code>*</code></label> 
			<input type="text" class="form-control form-control-sm" v-model="form.title" name="title" placeholder="{{ trans('validation.attributes.title') }}">
		</div>
		<div class="form-group form-group-feedback form-group-feedback-right">
			<label class="control-label" for="category">
				{{ trans('website::posts.form.category') }}<code>*</code>:
			</label>
			<select2 allowclear v-model="form.category_id" :options="categorys" name="category_id" id="category_id" class="form-control form-control-sm" placeholder="{{ trans('validation.attributes.select') }}" name="category"></select2>
		</div>
		<div class="form-group form-group-feedback form-group-feedback-right">
			<label class="control-label" for="group">
				{{ trans('website::posts.form.group') }}:
			</label>
			<select2 multiple v-model="form.group_ids" name="group" :options="groups" name="group" id="group" class="form-control form-control-sm select" placeholder="{{ trans('validation.attributes.select') }}"></select2>
		</div>
	</div>
</div>
<div class="form-group">
	<label for="title">
		{{ trans('website::posts.form.description') }}<code>*</code>
	</label> 
	<textarea class="form-control" v-model="form.description" name="description" placeholder="{{ trans('validation.attributes.description') }}"></textarea>
</div>

@include('app::admin.components.form.images', ['title' => trans('website::posts.form.gallery'), 'key' => 'form', 'form' => 'gallerys'])
<div class="form-group">
	<label for="title">{{ trans('website::posts.form.content') }}<code>*</code></label> 
	<textarea class="form-control" v-model="form.content" v-editor></textarea>
</div>
@push('script')
@php(request()->merge(['code' => 'post']))
<script type="text/javascript">
	var mix = {
		mixins: [gallerys],
		data: {
			categorys: {!! @$categorys !!},
			groups: {!! groups() !!},
			form: {
				img: '{{ @$post->img }}',
				title: '{{ @$post->title }}',
				description: '{{ @$post->description }}',
				content: `{!! @$post->content !!}`,
				alias: '{{ @$post->seo->alias }}',
				category_id: '{{ @$post->category_id }}',
				group_ids: {!! !empty(@$post->group_ids) ? json_encode(@$post->group_ids) : '[]' !!},
				gallerys: {!! !empty(@$post->gallerys) ? json_encode(@$post->gallerys) : '[]' !!},
				seo: {
					img: '{{ @$post->seo->img }}',
					title: '{{ @$post->seo->title }}',
					description: '{{ @$post->seo->description }}',
					keyword: '{{ @$post->seo->keyword }}',
					alias: '{{ @$post->seo->alias }}',
					status: {{ !empty(@$post->seo->status) ? 'true' : 'false' }}
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