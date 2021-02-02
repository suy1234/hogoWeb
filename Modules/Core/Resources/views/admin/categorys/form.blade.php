<div class="row">
	<div class="col-sx-12 col-sm-2 col-md-2">
		<image_change v-model="form.img" :title="'{{ trans('website::pages.form.img') }}'"></image_change>
	</div>
	<div class="col-sx-12 col-sm-10 col-md-10">
		<div class="form-group">
			<label for="title">{{ trans('core::categorys.form.title') }}<code>*</code></label> 
			<input type="text" class="form-control form-control-sm" v-model="form.title" name="title" placeholder="{{ trans('validation.attributes.title') }}">
		</div>
		<div class="form-group form-group-feedback form-group-feedback-right">
			<label class="control-label" for="parent">
				{{ trans('core::categorys.form.parent') }}:
			</label>
			<select2 allowclear v-model="form.parent_id" :options="categorys" name="parent_id" id="parent_id" class="form-control form-control-sm" placeholder="{{ trans('validation.attributes.select') }}" name="parent"></select2>
		</div>
		@if(request()->code == 'question')
			<div class="form-group form-group-feedback form-group-feedback-right">
				<label class="control-label" for="group">
					{{ trans('core::categorys.form.group') }}:
				</label>
				<select2 multiple v-model="form.group_ids" name="group" :options="groups" name="group" id="group" class="form-control form-control-sm select" placeholder="{{ trans('validation.attributes.select') }}"></select2>
			</div>
		@endif
	</div>
</div>
@if(request()->code == 'bank')
<div class="form-group form-group-feedback form-group-feedback-right">
	<label class="control-label" for="group">
		{{ trans('core::categorys.form.group_type') }}:
	</label>
	<select2 multiple v-model="form.group_type_ids" name="group_types" :options="group_types" name="group_type" id="group_type" class="form-control form-control-sm select" placeholder="{{ trans('validation.attributes.select') }}"></select2>
</div>
@endif
<div class="form-group">
	<label for="title">
		{{ trans('core::categorys.form.description') }}<code>*</code>
	</label> 
	<textarea class="form-control" v-model="form.description" name="description" placeholder="{{ trans('validation.attributes.description') }}"></textarea>
</div>
<div class="form-group">
	<label for="title">{{ trans('core::categorys.form.content') }}</label> 
	<textarea class="form-control" v-model="form.content" v-editor-mini></textarea>
</div>
@push('script')
<script type="text/javascript">
	var mix = {
		data: {
			categorys: {!! $categorys !!},
			groups: {!! groups() !!},
			group_types: {!! group_types() !!},
			form: {
				img: '{{ $category->img }}',
				title: '{{ $category->title }}',
				description: '{{ $category->description }}',
				content: `{!! $category->content !!}`,
				alias: '{{ $category->seo->alias }}',
				parent_id: '{{ $category->parent_id }}',
				group_ids: {!! !empty($category->group_ids) ? json_encode($category->group_ids) : '[]' !!},
				group_type_ids: {!! !empty($category->group_type_ids) ? json_encode($category->group_type_ids) : '[]' !!},
				seo: {
					img: '{{ $category->seo->img }}',
					title: '{{ $category->seo->title }}',
					description: '{{ $category->seo->description }}',
					keyword: '{{ $category->seo->keyword }}',
					alias: '{{ $category->seo->alias }}',
					status: {{ !empty($category->seo->status) ? 'true' : 'false' }}
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