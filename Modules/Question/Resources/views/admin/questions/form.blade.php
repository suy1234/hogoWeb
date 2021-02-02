<div class="form-group form-group-feedback form-group-feedback-right">
	<label class="control-label" for="parent">
		{{ trans('question::questions.form.group_type') }}<code>*</code>:
	</label>
	<select2 allowclear v-model="form.group_type_id" :options="group_types" name="group_type_id" id="group_type_id" class="form-control form-control-sm" placeholder="{{ trans('validation.attributes.select') }}" name="parent"></select2>
</div>

<div class="form-group form-group-feedback form-group-feedback-right">
	<label class="control-label" for="parent">
		{{ trans('question::questions.form.category') }}<code>*</code>:
	</label>
	<select class="form-control form-control-sm select2-one" placeholder="{{ trans('validation.attributes.select') }}" name="category_id" id="category_id" v-model="form.category_id" >
		<option></option>
		@foreach($categorys as $value)
		<optgroup label="{{ $value['title'] }}" class="select2-result-selectable">
			@if(count($value['children']))
			@foreach($value['children'] as $item)
			<option value="{{ $item['id'] }}">{{ $item['title'] }}</option>
			@endforeach
			@endif
		</optgroup>
		@endforeach
	</select>
</div>

<div class="form-group form-group-feedback form-group-feedback-right">
	<label class="control-label" for="parent">
		{{ trans('question::questions.form.group') }}<code>*</code>:
	</label>
	<select2 allowclear v-model="form.group_id" :options="groups" name="group_id" id="group_id" class="form-control form-control-sm" placeholder="{{ trans('validation.attributes.select') }}" name="parent"></select2>
</div>

<div class="form-group">
	<label for="title">
		{{ trans('question::questions.form.content') }}<code>*</code>:
	</label> 
	<textarea class="form-control" v-model="form.content" v-editor-mini></textarea>
</div>
<button class="btn btn-success" v-on:click="addAnswer">
	<i class="icon-plus-circle2"></i> {{ trans('question::questions.form.create_answer') }}
</button>
<hr>
<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12" v-for="(item, index) in form.answers">
		<div class="input-group" style="margin-bottom: 15px;">
			<span class="input-group-prepend" v-on:click="removeAnswer(index)">
				<span class="input-group-text" style="cursor: pointer;">
					<i class="icon-cancel-circle2 text-danger"></i>
				</span>
			</span>
			<input type="text" class="form-control" :name="'title['+index+']'" v-model="item.title" placeholder="{{ trans('question::questions.form.answer') }}">
			<span class="input-group-prepend">
				<span class="input-group-text" :for="'item'+index">
					<input type="checkbox" value="true" :name="'is_answer['+index+']'" :for="'item'+index" v-model="item.is_answer" style="margin-right: 5px;"> {{ trans('question::questions.form.is_answer') }}
				</span>
			</span>
		</div>
	</div>
</div>
@push('script')
<script type="text/javascript">
	var category_childrens = {!! $category_childrens !!};
	var groups = {!! $groups !!};
	var mix = {
		data: {
			groups: [],
			group_types: {!! $group_types !!},
			form: {
				category_id: '{{ $question->category_id}}',
				group_id: '{{ $question->group_id}}',
				group_type_id: '{{ $question->group_type_id}}',
				title: '',
				img: `{!! $question->img !!}`,
				content: `{!! $question->content !!}`,
				answers: <?php echo json_encode($question->answers) ?>,
			}
		},
		methods: {
			addAnswer: function () {
				this.form.answers.push({
					is_answer : false,
					title : '',
				})
			},
			removeAnswer: function (index){
				this.form.answers.splice(index, 1);
			}
		},
		watch: {
			"form.category_id": function(id) {
				var vm = this;
				vm.groups = [];
				if(category_childrens[id]){
					$.each(category_childrens[id], function(index, val) {
						if(groups[parseInt(val)]){
							vm.groups.push({
								id: val,
								title: groups[parseInt(val)]
							});
						}
					});
				}
			},
		},
		created: function () {
			var vm = this;
			vm.groups = [];
			if(category_childrens[vm.form.category_id]){
				$.each(category_childrens[vm.form.category_id], function(index, val) {
					if(groups[parseInt(val)]){
						vm.groups.push({
							id: val,
							title: groups[parseInt(val)]
						});
					}
				});
			}
		}
	}
</script>
@endpush