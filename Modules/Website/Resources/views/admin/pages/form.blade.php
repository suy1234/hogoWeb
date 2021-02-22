<div class="row">
  <div class="col-sx-12 col-sm-2 col-md-2">
    <image_change v-model="form.img" :title="'{{ trans('website::pages.form.img') }}'"></image_change>
  </div>
  <div class="col-sx-12 col-sm-10 col-md-10">
    <div class="form-group">
      <label for="title">{{ trans('website::pages.form.title') }}<code>*</code></label> 
      <input type="text" class="form-control form-control-sm" v-model="form.title" name="title" placeholder="{{ trans('validation.attributes.title') }}">
    </div>
    <div class="form-group">
      <label for="title">
        {{ trans('website::pages.form.description') }}<code>*</code>
      </label> 
      <textarea class="form-control" v-model="form.description" name="description" placeholder="{{ trans('validation.attributes.description') }}"></textarea>
    </div>
  </div>
</div>
@include('app::admin.components.form.images', ['title' => trans('website::posts.form.gallery'), 'key' => 'form', 'form' => 'gallerys'])

<form_content v-model="form.content" :label="'{{ trans('website::pages.form.content') }}<code>*</code>'"></form_content>
@push('script')
<script type="text/javascript">
  var mix = {
    mixins: [gallerys],
    data: {
      form: {
        img: '{{ @$page->img }}',
        title: '{{ @$page->title }}',
        description: '{{ @$page->description }}',
        content: `{!! @$page->content !!}`,
        alias: '{{ @$page->seo->alias }}',
        gallerys: {!! !empty(@$page->gallerys) ? json_encode(@$page->gallerys) : '[]' !!},
        seo: {
          img: '{{ @$page->seo->img }}',
          title: '{{ @$page->seo->title }}',
          description: '{{ @$page->seo->description }}',
          keyword: '{{ @$page->seo->keyword }}',
          alias: '{{ @$page->seo->alias }}',
          status: {{ !empty(@$page->seo->status) ? 'true' : 'false' }}
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
    },
    mounted() {

    }
  }
</script>
@endpush