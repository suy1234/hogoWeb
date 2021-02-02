<template v-if="alert.success">
    <div class="alert alert-success alert-styled-left alert-arrow-left alert-dismissible">
        <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
        @{{ alert.title }}
    </div>
</template>
<template v-if="alert.danger">
    <div class="alert alert-danger alert-styled-left alert-arrow-left alert-dismissible">
        <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
        @{{ alert.title }}
    </div>
</template>
<div class="row">
    {{-- <div class="col-sx-12 col-sm-12 col-lg-10 col-md-8 offset-lg-1 offset-md-2"> --}}
    <div class="col-sx-12 col-sm-12 col-lg-12 col-md-12">
        <div class="card">
            <div class="card-heading">
                <strong>
                    sfsdfsd
                </strong>
            </div>
            <div class="card-body">
                @stack('form')
            </div>
            <div class="card-footer text-right">
                <a class="btn btn-custom btn-sm btn-actions btn-create text-white" style="margin-left: 5px;">
                    <b><span class="icon-floppy-disk"></span> </b> 
                    {{ trans('resource.store') }}
                </a>
            </div>
        </div>
    </div>
</div>