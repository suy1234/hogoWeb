<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Admin 4.0</title>
    <link href="{{ asset('/public/admin/app/css/icons/icomoon/styles.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('/public/admin/app/css/icons/fontawesome/styles.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('/public/admin/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('/public/admin/assets/css/bootstrap_limitless.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('public/admin/app/js/plugins/jquery-confirm/jquery-confirm.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('/public/admin/assets/css/animate.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('/public/admin/assets/css/layout.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('/public/admin/assets/css/components.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('/public/admin/app/cropper/cropper.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('/public/admin/assets/css/colors.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('/public/admin/assets/css/erp.css')}}?v={{ rand() }}" media="all" rel="stylesheet" type="text/css">
    <link href="{{ asset('/public/admin/assets/css/gallery.css')}}?v={{ rand() }}" media="all" rel="stylesheet" type="text/css">
    <script src="{{ asset('/public/admin/app/js/main/jquery.min.js') }}"></script>
    <script src="{{ asset('/public/admin/app/js/main/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('/public/admin/app/js/plugins/loaders/blockui.min.js') }}"></script>

    <script src="{{ asset('/public/admin/app/js/plugins/forms/styling/uniform.min.js') }}"></script>
    <script src="{{ asset('/public/admin/app/js/plugins/forms/styling/switchery.min.js') }}"></script>
    <script src="{{ asset('/public/admin/app/js/plugins/ui/moment/moment.min.js') }}"></script>
    <script src="{{ asset('/public/admin/app/js/plugins/pickers/daterangepicker.js') }}"></script>
    <script src="{{ asset('/public/admin/app/js/plugins/pickers/pickadate/picker.js') }}"></script>
    <script src="{{ asset('/public/admin/app/js/plugins/forms/selects/select2.min.js') }}"></script>
    <script src="{{ asset('/public/admin/app/js/plugins/forms/selects/bootstrap_multiselect.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/admin/app/js/wysiwyg/tinymce.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/admin/app/js/plugins/editors/ace/ace.js') }}"></script>
    <script src="{{ asset('/public/admin/assets/js/app.js') }}"></script>
    <style type="text/css" media="all">
        @-webkit-keyframes rotateInDownRight{0%{
            -webkit-transform:rotate(5deg);
            transform:rotate(5deg);opacity:1
            }to{
                -webkit-transform:translateZ(0);transform:translateZ(0);opacity:1
            }
            }@keyframes rotateInDownRight{0%{-webkit-transform:rotate(5deg);transform:rotate(5deg);opacity:1}
            to{-webkit-transform:translateZ(0);transform:translateZ(0);opacity:1}
        }
        @if(session()->has('color_admin'))
        .navbar-dark{
            background-color: {{ session('color_admin')['navbar_logo_background'] }};
        }
        .sidebar-dark {
            background-color: {{ session('color_admin')['navbar_background'] }};
            color: {{ session('color_admin')['navbar_color'] }};
        }
        .sidebar-dark .nav-sidebar .nav-link:not(.disabled):hover, .sidebar-light .card[class*=bg-]:not(.bg-light):not(.bg-white):not(.bg-transparent) .nav-sidebar .nav-link:not(.disabled):hover {
            background-color: {{ session('color_admin')['navbar_background_hover'] }};
            color: {{ session('color_admin')['navbar_color_hover'] }};
        }
        .navbar-collapse{
            background: {{ session('color_admin')['navbar_top_background'] }};
        }
        .navbar-light .navbar-nav-link:focus, .navbar-light .navbar-nav-link:hover{
            color: {{ session('color_admin')['navbar_top_color_hover'] }};
            background-color: {{ session('color_admin')['navbar_top_background_hover'] }};
        }
        @endif
        #page-header-light{
            z-index: 10 !important;
        }
    </style>
    @stack('style')
</head>
<body>
    <div id="app">
        <div id="loader-wrapper" class="" >
            <div class="loader">
                <div class="inner one"></div>
                <div class="inner two"></div>
                <div class="inner three"></div>
            </div>
        </div>
        @include('app::admin.layouts.header')
        <div class="page-content">
            @include('app::admin.layouts.sidebar')
            <div class="content-wrapper" style="overflow-x: hidden;">
                @yield('navbar')
                <div class="content" id="content-master" style="padding-top: 4em;min-height: calc(100vh - 50px);display: none;">
                    @if(!empty(session()->get('error')))
                    <div class="alert alert-danger alert-styled-left alert-dismissible" style="margin: 0;">
                        <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
                        <span class="font-weight-semibold">Oh no!</span> {!! session()->get('error') !!}.
                    </div>
                    @endif
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(window).scroll(function() {
            if ($(this).scrollTop() > 20) {
                $('#page-header-light').css('top', '0');
            } else {
                $('#page-header-light').css('top', '');
            }
        });
    </script>
    <script type="text/javascript" src="{{ asset('public/admin/app/cropper/cropper.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/admin/vue/vue.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/admin/vue/lodash.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/admin/app/js/plugins/notifications/bootstrap-notify.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/admin/app/js/plugins/jquery-confirm/jquery-confirm.min.js') }}"></script>
    <script src="{{ asset('/public/admin/vue/color/vue-color.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/admin/vue/components.js') }}?v={{ rand() }}"></script>
    <script type="text/javascript" src="{{ asset('public/admin/vue/component_forms.js') }}?v={{ rand() }}"></script>
    <script type="text/javascript" src="{{ asset('public/admin/vue/helper.js') }}?v={{ rand() }}"></script>

    @stack('script')
    <script type="text/javascript">
        var timeout = null;
        new Vue ({
            el: '#app',
            mixins: [mix],
            data: {
                calculating: false,
                isLoading: false,
                countrys: [],
                provinces: [],
                districts: [],
                wards: [],
                array_items: {
                    max: 0,
                    images: []
                },
                alert: {
                    success: false,
                    danger: false,
                    title: '',
                },
                form: {}
            },
            methods: {
                store: function (url, is_continue = false) {
                    var vm = this;
                    vm.isLoading = true;
                    vm.form._token = $('meta[name=csrf-token]').attr('content');
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: vm.form,                        
                    }).done( function(res , status , xhr){
                        vm.isLoading = false;
                        if(res.success){
                            vm.alert.success = true;
                            vm.alert.title = res.resource;
                            helper.showNotification("{{ trans('validation.attributes.success') }}", 'success', 1000);
                            if(is_continue){
                                window.location.reload();
                                return;
                            }
                            window.location = res.url;
                            return true;
                        }else{
                            vm.alert.danger = true;
                            vm.alert.title = res.resource;
                            if(jQuery.type( res.msg ) === "string"){
                                helper.showNotification(res.msg, 'danger', 1000);
                            }
                            else{
                                $.each( res.msg, function( key, value ) {
                                    $("input[name="+key+"]").addClass('red-border').focus();
                                    helper.showNotification(value, 'danger', 1000);
                                    setTimeout(function(){ $("input[name="+key+"]").removeClass('red-border'); }, 3000);
                                });
                            }
                        }
                        return false;
                    }).fail(function(err){
                        // console.log(err);
                        if (typeof err.responseJSON.errors != 'undefined'){
                            $.each( err.responseJSON.errors, function( key, value ) {
                                $("input[name="+key+"]").addClass('red-border').focus();
                                helper.showNotification(value, 'danger', 1000);
                                setTimeout(function(){ $("input[name="+key+"]").removeClass('red-border'); }, 3000);
                            });
                        }
                        vm.alert.danger = true;
                        vm.alert.title = '{{ trans('validation.attributes.error') }}';
                        helper.showNotification("{{ trans('validation.attributes.error') }}", 'danger', 1000);
                        vm.isLoading = false;
                    });                    
                },
                update: function (url) {
                    var vm = this;
                    vm.isLoading = true;
                    vm.form._token = $('meta[name=csrf-token]').attr('content');
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: vm.form,                        
                    }).done( function(res , status , xhr){
                        vm.isLoading = false;
                        if(res.success){
                            vm.alert.success = true;
                            vm.alert.title = res.resource;
                            helper.showNotification("{{ trans('validation.attributes.success') }}", 'success', 1000);
                            return true;
                        }else{
                            vm.alert.danger = true;
                            vm.alert.title = res.resource;
                            if(jQuery.type( res.msg ) === "string"){
                                helper.showNotification(res.msg, 'danger', 1000);
                            }
                            else{
                                $.each( res.msg, function( key, value ) {
                                    $("input[name="+key+"]").addClass('red-border').focus();
                                    helper.showNotification(value, 'danger', 1000);
                                    setTimeout(function(){ $("input[name="+key+"]").removeClass('red-border'); }, 3000);
                                });
                            }
                        }
                        return false;
                    }).fail(function(err){
                        console.log(err);
                        vm.alert.danger = true;
                        vm.alert.title = '{{ trans('validation.attributes.error') }}';
                        if (typeof err.responseJSON.errors != 'undefined'){
                            $.each( err.responseJSON.errors, function( key, value ) {
                                $("input[name="+key+"]").addClass('red-border').focus();
                                helper.showNotification(value, 'danger', 1000);
                                setTimeout(function(){ $("input[name="+key+"]").removeClass('red-border'); }, 3000);
                            });
                        }
                        helper.showNotification("{{ trans('validation.attributes.error') }}", 'danger', 1000);
                        vm.isLoading = false;
                    })   

                },
                showSeo: function () {
                    $('#seo-data').slideToggle();
                },
                showURL: function () {
                    $('#show-edit-url').slideToggle();
                },
                showGallery: function (type, form_data) {
                    var vm = this;
                    var items = form_data.split('.');
                    vm.array_items.max = items.length;
                    vm.array_items.images = items;
                    if (type == 'primary_image') {
                        var arr = [];
                        var img = "";
                            // var AppMedia = new AppMedia();
                            AppMedia.show({
                                current : [],
                                multiple: false,
                                group: 'product',
                                output: function (data) {
                                    if(vm.array_items.max == 2){
                                        vm[vm.array_items.images[0]][vm.array_items.images[1]] = data[0].path;
                                    }else if(vm.array_items.max == 3){
                                        vm[vm.array_items.images[0]][vm.array_items.images[1]][vm.array_items.images[2]] = data[0].path;
                                    }
                                    else if(vm.array_items.max == 4){
                                        vm[vm.array_items.images[0]][vm.array_items.images[1]][vm.array_items.images[2]][vm.array_items.images[4]] = data[0].path;
                                    }else{
                                        vm[vm.array_items.images[0]] = data[0].path;
                                    }
                                }
                            });
                        } else if (type == 'album_images') {
                            if (typeof AppMedia != 'undefined') {
                                var AppMedia = new AppMedia();
                                AppMedia.show({
                                    current : vm.listDataCreate.album_images,
                                    multiple: true,
                                    maxFile : 6,
                                    group: 'product',
                                    output: function (data) {
                                        if (data.length) {
                                            vm.listDataCreate.album_images = data;
                                        }
                                    }
                                });
                            }
                        }
                    },
                    removeImg:function (form_data) {
                        var vm = this;
                        var items = form_data.split('.');
                        if(items.length == 2){
                            vm[items[0]][items[1]] = '';
                        }else if(items.length == 3){
                            vm[items[0]][items[1]][items[2]] = '';
                        }
                        else if(items.length == 4){
                            vm[items[0]][items[1]][items[2]][items[4]] = '';
                        }else{
                            vm[items.images[0]] = '';
                        }
                    },
                    showLoading:function () {
                        if(this.isLoading){
                            $('#loader-wrapper').css('display', 'block');
                        }else{
                            $('#loader-wrapper').css('display', 'none');
                        }
                    },
                },
                mounted() {
                    var vm = this;
                    $( "body" ).on( "click", "a.btn-store", function(event) {
                        event.preventDefault();
                        vm.store($(this).attr('href'));
                    });
                    $( "body" ).on( "click", "a.btn-update", function(event) {
                        event.preventDefault();
                        vm.update($(this).attr('href'));
                    });
                    window.addEventListener('beforeunload', function (e) {
                        delete e['returnValue'];
                    });
                },
                watch: {
                    "form.alias": function (val) {
                        this.form.seo.alias = this.form.alias;
                    },
                    "form.title": function (oldval) {
                        var vm = this;
                        if(oldval != '' && oldval != undefined && oldval != null){
                            if(timeout) {
                                clearTimeout(timeout);
                                timeout = null;
                            }
                            timeout = setTimeout( function() {
                                var formdata = new FormData;
                                formdata.append('text' , vm.form.title);
                                helper.post( '{{ route("convert.url") }}' , formdata ,15000)
                                .done( function(res , status , xhr){
                                    vm.form.seo.alias = res;
                                    vm.form.alias = res;
                                })
                                .fail(function(err){

                                });
                            }, 800);
                        }
                    },
                    "isLoading" : function (oldval) {
                        this.showLoading();   
                    }
                },
                created: function () {
                    $('#content-master').css('display', 'block');
                    $('#loader-wrapper').css('display', 'none');
                    $(window).off('beforeunload');
                },
            });
        </script>
        @if (! request()->routeIs('admin.medias.index'))
        <div id="vue-gallery">
            <div id="modal-gallery" class="modal fade" tabindex="-1">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">{{ trans('media::medias.media') }}</h5>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <div class="modal-body">
                            @include('media::admin.list', ['modal' => true])
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </body>
    </html>
