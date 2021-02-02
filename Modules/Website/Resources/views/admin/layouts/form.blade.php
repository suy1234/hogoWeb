<div class="form-group">
    <label for="title">{{ trans('website::layouts.form.title') }}<code>*</code></label>
    <input type="text" class="form-control form-control-sm" v-model="form.title" name="title" placeholder="{{ trans('validation.attributes.title') }}">
</div>
<div class="form-group form-group-feedback form-group-feedback-right">
    <label class="control-label" for="type">
        {{ trans('website::layouts.form.type') }}<code>*</code>:
    </label>
    <select2 allowclear v-model="form.type" :options="settings" name="type" id="type" class="form-control form-control-sm" placeholder="{{ trans('validation.attributes.select') }}" name="type"></select2>
</div>
@push('script')
<script type="text/javascript">
    var mix = {
        data: {
            form: {
                title : '{{ @$layout->title }}',
                type: '{{ @$layout->type }}'
            },
            settings: {
                @if(!empty(get_setting('layouts')->config))
                    @foreach(get_setting('layouts')->config as $config)
                        {{ $config }}: '{{ trans('core::cores.layout_type.'.$config) }}',
                    @endforeach
                @endif
            },
            data: []
        },
        methods: {

        }
    }
</script>
@endpush