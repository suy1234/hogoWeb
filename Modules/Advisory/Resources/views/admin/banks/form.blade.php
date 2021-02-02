<div class="row">
  <div class="col-sx-12 col-sm-2 col-md-2">
    <image_change v-model="form.img" :title="'{{ trans('website::pages.form.img') }}'"></image_change>
  </div>
  <div class="col-sx-12 col-sm-10 col-md-10">
    <div class="row">
      <div class="col-md-4 col-xs-12 col-sm-4">
        <div class="form-group">
          <label for="code">{{ trans('bank::banks.form.code') }}<code>*</code></label> 
          <input type="text" class="form-control form-control-sm" v-model="form.code" name="code" placeholder="">
        </div>
      </div>
      <div class="col-md-8 col-xs-12 col-sm-8">
        <div class="form-group">
          <label for="title">{{ trans('bank::banks.form.title') }}<code>*</code></label> 
          <input type="text" class="form-control form-control-sm" v-model="form.title" name="title" placeholder="">
        </div>
      </div>
    </div>
    <div class="form-group">
      <label for="title">
        {{ trans('bank::banks.form.description') }}
      </label> 
      <textarea class="form-control" v-model="form.description" name="description" placeholder=""></textarea>
    </div>
  </div>
</div>

<div class="form-group mt-2">
  <label for="title">{{ trans('website::posts.form.content') }}</label> 
  <textarea class="form-control" v-model="form.content" v-editor></textarea>
</div>
@include('app::admin.components.form.images', ['title' => trans('website::posts.form.gallery'), 'key' => 'form', 'form' => 'gallerys'])

@push('script')
<script type="text/javascript">
  var mix = {
    data: {
      form: {
        img: '{{ @$bank->img }}',
        code: '{{ @$bank->code }}',
        title: '{{ @$bank->title }}',
        description: '{{ @$bank->description }}',
        content: `{!! @$bank->content !!}`,
        gallerys: {!! !empty(@$bank->gallerys) ? json_encode(@$bank->gallerys) : '[]' !!},
        seo: {
          img: '{{ @$bank->seo->img }}',
          title: '{{ @$bank->seo->title }}',
          description: '{{ @$bank->seo->description }}',
          keyword: '{{ @$bank->seo->keyword }}',
          alias: '{{ @$bank->seo->alias }}',
          status: {{ !empty(@$bank->seo->status) ? 'true' : 'false' }}
        }
      }
    },
    methods: {

    },
    mounted() {

    }
  }
</script>
@endpush