<form_title v-model="form.title" :label="'{{ trans('widget::widget_themes.form.title') }}'"></form_title>
<image_change v-model="form.img" :title="'{{ trans('widget::widget_themes.form.img') }}'"></image_change>
<div class="form-group form-group-feedback form-group-feedback-right">
    <label class="control-label" for="type">
        {{ trans('widget::widget_themes.form.type') }}<code>*</code>:
    </label>
    <select2 allowclear v-model="form.type" :options="settings" name="type" id="type" class="form-control form-control-sm" placeholder="{{ trans('validation.attributes.select') }}" name="type"></select2>
</div>
<div class="row">
    <div class="col-md-6 col-sm-6 col-xs-12">
        <form_code_php v-model="form.html" :label="'{{ trans('widget::widget_themes.form.html') }}'"></form_code_php>
    </div>
    <div class="col-md-6 col-sm-6 col-xs-12">
        <form_code_php v-model="form.config" :label="'{{ trans('widget::widget_themes.form.config') }}'"></form_code_php>
    </div>
    <div class="col-md-6 col-sm-6 col-xs-12">
        <form_code_css v-model="form.css" :label="'{{ trans('widget::widget_themes.form.css') }}'"></form_code_css>
    </div>
    <div class="col-md-6 col-sm-6 col-xs-12">
        <form_code_html v-model="form.js" :label="'{{ trans('widget::widget_themes.form.js') }}'"></form_code_html>
    </div>
</div>
@push('script')
<script type="text/javascript">
    var mix = {
        data: {
            form: {!! $widgetTheme !!},
            settings: {
                @foreach(config('widget.widget_themes') as $key => $config)
                    {{ $key }}: '{{ $config }}',
                @endforeach
            },
            data: []
        },
        methods: {

        }
    }
</script>
@endpush