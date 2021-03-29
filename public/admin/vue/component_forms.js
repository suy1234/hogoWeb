var Chrome = VueColor.Chrome;
Vue.component('form_color', {
    components: {
        'chrome-picker': Chrome,
    },
    template: `<div class="form-group form-group-feedback form-group-feedback-left color-picker" ref="colorpicker">
    <label class="control-label">{{ label }}:</label>
    <div style="position: relative;">
    <input type="text" class="form-control form-control-sm" v-model="colorValue" @focus="showPicker()" @input="updateFromInput" style="padding-left: 3rem;" placeholder="">
    <div class="form-control-feedback form-control-feedback-sm" :style="'background:'+colorValue"><i class="icon-eyedropper"></i></div>
    <chrome-picker :value="colors" @input="updateFromPicker" v-if="displayPicker" />
    </div>
    </div>`,
    props: ['value', 'label'],
    data() {
        return {
            colors: {
                hex: this.value,
            },
            colorValue: this.value,
            displayPicker: false,
        }
    },
    mounted() {
        this.setColor(this.value || '');
    },
    methods: {
        setColor(color) {
            this.updateColors(color);
            this.colorValue = color;
        },
        updateColors(color) {
            if(color.slice(0, 1) == '#') {
                this.colors = {
                    hex: color
                };
            }
            else if(color.slice(0, 4) == 'rgba') {
                var rgba = color.replace(/^rgba?\(|\s+|\)$/g,'').split(','),
                hex = '#' + ((1 << 24) + (parseInt(rgba[0]) << 16) + (parseInt(rgba[1]) << 8) + parseInt(rgba[2])).toString(16).slice(1);
                this.colors = {
                    hex: hex,
                    a: rgba[3],
                }
            }
        },
        showPicker() {
            document.addEventListener('click', this.documentClick);
            this.displayPicker = true;
        },
        hidePicker() {
            document.removeEventListener('click', this.documentClick);
            this.displayPicker = false;
        },
        togglePicker() {
            this.displayPicker ? this.hidePicker() : this.showPicker();
        },
        updateFromInput() {
            this.updateColors(this.colorValue);
        },
        updateFromPicker(color) {
            this.colors = color;
            if(color.rgba.a == 1) {
                this.colorValue = color.hex;
            }
            else {
                this.colorValue = 'rgba(' + color.rgba.r + ', ' + color.rgba.g + ', ' + color.rgba.b + ', ' + color.rgba.a + ')';
            }
        },
        documentClick(e) {
            var el = this.$refs.colorpicker,
            target = e.target;
            if(el !== target && !el.contains(target)) {
                this.hidePicker()
            }
        }
    },
    watch: {
        colorValue(val) {
            if(val) {
                this.updateColors(val);
                this.$emit('input', val);
            }
        }
    },
    created: function () { },
});

Vue.component('image_change', {
    template: `<div class="form-group select-img">
    <label class="control-label">
    {{ label }}
    </label>
    <div class="text-center">
    <template v-if="image">
    <a class="remove-img" v-on:click="componentImg()"><i class="fa fa-times-circle fa-2x text-danger"></i></a>
    </template>
    <input type="hidden" v-model="image" @blur="onChange">
    <img :src="image ? image : '/public/admin/assets/img/uploadCroup.png' " v-on:click="componentGallery()" class="img-responsive cursor">
    </div>
    </div>`,
    props: ['label', 'value'],
    data: function () {
        return {
            image: this.value
        }
    },
    methods: {
        componentGallery: function () {
            var vm = this;
            var AppMedia = new appMedia();
            AppMedia.show({
                current : [],
                multiple: false,
                group: 'product',
                output: function (data) {
                    vm.image =  data[0].path;
                }
            });
        },
        componentImg: function () {
            this.setImg('');
        },
        setImg: function (img) {
            this.image = img;
            this.$emit('input', img);
        },
        onChange() {
            this.$emit('onblurevent');
        },
    },
    watch: {
        image: function (val) {
            this.$emit('input', val);
        },
    },
    created: function () {        },
});
Vue.component('form_image_input', {
    template: `<div>
        <div class="form-group select-img">
            <label class="control-label">
                {{ label }}
            </label>
            <div class="text-center">
                <a class="remove-img" v-if="image.img != ''" v-on:click="componentImg()"><i class="fa fa-times-circle fa-2x text-danger"></i></a>
                <input type="hidden"  v-model="image.img" @blur="onChange">
                <img :src="image.img != '' ? image.img : '/public/admin/assets/img/uploadCroup.png' " v-on:click="componentGallery()" class="img-responsive cursor">
            </div>
        </div>
        <div class="form-group">
            <input type="text" id="title" v-model="image.title" class="form-control" placeholder="Title" />
        </div>
        <div class="form-group">
            <input type="link" id="link" v-model="image.link" class="form-control" placeholder="Link" />
        </div>
    </div>
    `,
    props: ['label', 'value'],
    data: function () {
        return {
            image: (this.value && this.value != 'null') ? this.value : {title : '', img: '', link:''}
        }
    },
    methods: {
        componentGallery: function () {
            var vm = this;
            var AppMedia = new appMedia();
            AppMedia.show({
                current : [],
                multiple: false,
                group: 'product',
                output: function (data) {
                    vm.image.img =  data[0].path;
                }
            });
        },
        componentImg: function () {
            this.setImg('');
        },
        setImg: function (img) {
            this.image.img = img;
        },
        onChange() {
            this.$emit('onblurevent');
        },
    },
    watch: {
        image: function (val) {
            this.$emit('input', val);
        },
    },
    created: function () {        },
});
Vue.component('form_image', {
    template: `<div class="form-group select-img">
    <label class="control-label">
    {{ label }}
    </label>
    <div class="text-center">
    <template v-if="image">
    <a class="remove-img" v-on:click="componentImg()"><i class="fa fa-times-circle fa-2x text-danger"></i></a>
    </template>
    <input type="hidden" v-model="image" @blur="onChange">
    <img :src="image != '' ? image : '/public/admin/assets/img/uploadCroup.png' " v-on:click="componentGallery()" class="img-responsive cursor">
    </div>
    </div>`,
    props: ['label', 'value'],
    data: function () {
        return {
            image: (this.value) ? this.value : ''
        }
    },
    methods: {
        componentGallery: function () {
            var vm = this;
            var AppMedia = new appMedia();
            AppMedia.show({
                current : [],
                multiple: false,
                group: 'product',
                output: function (data) {
                    vm.image =  data[0].path;
                }
            });
        },
        componentImg: function () {
            this.setImg('');
        },
        setImg: function (img) {
            this.image = img;
            this.$emit('input', img);
        },
        onChange() {
            this.$emit('onblurevent');
        },
    },
    watch: {
        image: function (val) {
            this.$emit('input', val);
        },
    },
    created: function () {        },
});
Vue.component('form_breadcrumb', {
    template: `
    <div class="form-group">
    <label v-html="label+':'"></label> 
    <select v-model="val" class="form-control ">
        <option value="default">Mặc định</option>
    </select>
    </div>`,
    props: ['label', 'value'],
    data: function () {
        return {
            val: this.value
        }
    },
    methods: {

    },
    watch: {
        val: function (val) {
            this.$emit('input', val);
        },
    },
    created: function () {        },
});
Vue.component('form_title', {
    template: `
    <div class="form-group">
    <label v-html="label+':'"></label> 
    <input type="text" id="title" v-model="val" class="form-control ">
    </div>`,
    props: ['label', 'value'],
    data: function () {
        return {
            val: this.value
        }
    },
    methods: {

    },
    watch: {
        val: function (val) {
            this.$emit('input', val);
        },
    },
    created: function () {        },
});
Vue.component('form_textarea', {
    template: `
    <div class="form-group">
    <label v-html="label+':'"></label> 
    <textarea class="form-control" rows="3" v-model="val"></textarea>
    </div>`,
    props: ['label', 'value'],
    data: function () {
        return {
            val: this.value
        }
    },
    methods: {

    },
    watch: {
        val: function (val) {
            this.$emit('input', val);
        },
    },
    created: function () {        },
});
Vue.component('form_code_js', {
    template: `
    <div class="form-group">
    <label v-html="label+':'"></label> 
    <textarea class="form-control" :id="id" rows="3" v-model="val"></textarea>
    </div>`,
    props: ['label', 'value'],
    data: function () {
        return {
            val: this.value,
            id: 'codejs'+Math.floor((Math.random() * 10) + 1)
        }
    },
    methods: {
        init: function () {
            var vm = this;
            var editor = ace.edit(vm.id);
            editor.setTheme("ace/theme/monokai");
            editor.getSession().setMode("ace/mode/javascript");
            editor.setShowPrintMargin(false);
            editor.on('change', function () {
                console.log(editor.getValue());
                vm.$emit('input', editor.getValue())
            })
        }
    },
    mounted () {
        this.init();
    },
    watch: {
        val: function (val) {
            this.$emit('input', val);
        },
    },
    created: function () {        },
});
Vue.component('form_code_css', {
    template: `
    <div class="form-group">
    <label v-html="label+':'"></label> 
    <textarea class="form-control" :id="id" rows="3" v-model="val"></textarea>
    </div>`,
    props: ['label', 'value'],
    data: function () {
        return {
            val: this.value,
            id: 'codecss'+Math.floor((Math.random() * 10) + 1)
        }
    },
    methods: {
        init: function () {
            var vm = this;
            var editor = ace.edit(vm.id);
            editor.setTheme('ace/theme/monokai');
            editor.getSession().setMode('ace/mode/css');
            editor.setShowPrintMargin(false);
            editor.on('change', function () {
                vm.$emit('input', editor.getValue())
            })
        }
    },
    mounted () {
        this.init();
    },
    watch: {
        val: function (val) {
            this.$emit('input', val);
        },
    },
    created: function () {        },
});
Vue.component('form_code_html', {
    template: `
    <div class="form-group">
    <label v-html="label+':'"></label> 
    <textarea class="form-control" :id="id" rows="3" v-model="val"></textarea>
    </div>`,
    props: ['label', 'value'],
    data: function () {
        return {
            val: this.value,
            id: 'codehtml'+Math.floor((Math.random() * 10) + 1)
        }
    },
    methods: {
        init: function () {
            var vm = this;
            var editor = ace.edit(vm.id);
            editor.setTheme('ace/theme/monokai');
            editor.getSession().setMode('ace/mode/html');
            editor.setShowPrintMargin(false);
            editor.on('change', function (e) {
                console.log(editor.getValue());
                vm.$emit('input', editor.getValue());
            })
        }
    },
    mounted () {
        this.init();
    },
    watch: {
        val: function (val) {
            this.$emit('input', val);
        },
    },
    created: function () {        },
});

Vue.component('form_code_php', {
    template: `
    <div class="form-group">
    <label v-html="label+':'"></label> 
    <textarea class="form-control" :id="id" rows="3" v-model="val"></textarea>
    </div>`,
    props: ['label', 'value'],
    data: function () {
        return {
            val: this.value,
            id: 'code'+Math.floor((Math.random() * 10) + 1)
        }
    },
    methods: {
        init: function () {
            var vm = this;
            var editor = ace.edit(vm.id);
            editor.setTheme('ace/theme/monokai');
            editor.getSession().setMode('ace/mode/php');
            editor.setShowPrintMargin(false);
            editor.on('change', function (e) {
                console.log(editor.getValue());
                vm.$emit('input', editor.getValue());
            })
        }
    },
    mounted () {
        this.init();
    },
    watch: {
        val: function (val) {
            this.$emit('input', val);
        },
    },
    created: function () {        },
});

Vue.component('form_menu', {
    template: `
    <div class="form-group">
    <label v-html="label+':'"></label>
    <select v-model="val" :id="id" class="form-control form-control-sm select2-from">
    <option></option>
    <option v-for="(item, key) in menus" :value="key" >{{item}}</option>
    </select>
    </div>`,
    props: ['label', 'value'],
    data: function () {
        return {
            val: this.value,
            menus: [],
            id: 'key'+Math.floor((Math.random() * 20) + 1)
        }
    },
    methods: {
        init: function () {
            var vm = this;
            var config = {
                allowClear: true,
                allowClear : true,
                placeholder: vm.$root.placeholder,
            };
            $('#'+vm.id).select2(config)
            .on('change', function(e){
                vm.$emit('input', this.value);
            });
        }
    },
    mounted () {
        this.init();
    },
    watch: {

    },
    created: function () {
        if(this.$root.table_data.menus){
            this.menus = this.$root.table_data.menus;
        }
    },
});
Vue.component('form_group', {
    template: `
    <div class="form-group">
    <label v-html="label+':'"></label>
    <select v-model="val" class="form-control form-control-sm select2-from" :id="id">
    <option></option>
    <option v-for="(item, key) in groups" :value="key" >{{item}}</option>
    </select>
    </div>`,
    props: ['label', 'value'],
    data: function () {
        return {
            val: this.value,
            groups: [],
            id: 'key'+Math.floor((Math.random() * 20) + 1)
        }
    },
    methods: {
        init: function () {
            var vm = this;
            var config = {
                allowClear: true,
                allowClear : true,
                placeholder: vm.$root.placeholder,
            };
            $('#'+vm.id).select2(config)
            .on('change', function(e){
                vm.$emit('input', this.value);
            });
        }
    },
    mounted () {
        this.init();
    },
    watch: {

    },
    created: function () {
        if(this.$root.tab == 'sidebar_post'){
            this.groups = this.$root.group_posts;
        }
        if(this.$root.tab == 'sidebar_product'){
            this.groups = this.$root.group_products;
        }
        if(this.$root.table_data){
            this.groups = this.$root.table_data.groups;
        }
    }
});
Vue.component('form_category', {
    template: `
    <div class="form-group">
    <label v-html="label+':'"></label>
    <select v-model="val" class="form-control form-control-sm select2-from" :id="id">
    <option></option>
    <option v-for="(item, key) in categorys" :value="key" >{{item}}</option>
    </select>
    </div>`,
    props: ['label', 'value'],
    data: function () {
        return {
            val: this.value,
            categorys: [],
            id: 'key'+Math.floor((Math.random() * 20) + 1)
        }
    },
    methods: {
        init: function () {
            var vm = this;
            var config = {
                allowClear: true,
                allowClear : true,
                placeholder: vm.$root.placeholder,
            };
            $('#'+vm.id).select2(config)
            .on('change', function(e){
                vm.$emit('input', this.value);
            });
        }
    },
    mounted () {
        this.init();
    },
    watch: {

    },
    created: function () {
        if(this.$root.tab == 'sidebar_post'){
            this.categorys = this.$root.category_posts;
        }
        if(this.$root.tab == 'sidebar_product'){
            this.categorys = this.$root.category_products;
        }
        if(this.$root.table_data.categorys){
            this.categorys = this.$root.table_data.categorys;
        }
    },
});
Vue.component('form_content', {
    props: ['value', 'label'],
    template: `<div class="form-group">
    <label for="title" v-html="label+':'"></label>
    <textarea rows="2" :id="'tinymce'+rand_id" class="form-control tinymce" v-bind:value="value"></textarea>
    </div>
    `,
    data: function () {
        return {
            rand_id : Math.floor((Math.random() * 100) + 1)
        }
    },
    methods: {
        updateValue: function (value) {
            this.$emit('input', value.trim());
        }
    },
    mounted: function(){
        var vm = this;
        tinyMCE.baseURL = `/public/admin/app/js/wysiwyg`;

        tinyMCE.init({
            selector: '#tinymce'+vm.rand_id,
            plugins: 'preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount textpattern noneditable charmap emoticons',
            imagetools_cors_hosts: ['picsum.photos'],
            toolbar: 'insertfile image fullscreen template link anchor codesample undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | ltr rtl',
            menubar: false,
            relative_urls : false,
            file_picker_callback: function (callback, value, meta) {
                if (meta.filetype === 'file') {
                    callback('https://www.google.com/logos/google.jpg', { text: 'My text' });
                }
                if (meta.filetype === 'image') {
                    var AppMedia = new appMedia();
                    AppMedia.show({
                        current : [],
                        multiple: false,
                        group: 'product',
                        output: function (data) {
                            callback(data[0].path, { alt: data[0].title });
                        }
                    });

                }
                if (meta.filetype === 'media') {
                    callback('movie.mp4', { source2: 'alt.ogg', poster: 'https://www.google.com/logos/google.jpg' });
                }
            },
            template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
            template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
            quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
            setup: function(editor) {
                editor.on('init', ()=>{
                    tinyMCE.activeEditor.setContent(vm.value);
                });
                editor.on('change input keypress keyup keydown paste', (e) => {
                    var new_value = tinyMCE.activeEditor.getContent();
                    vm.updateValue(new_value);
                });
            }
        });
    },
    created: function () {},
});
Vue.component('form_icon', {
    template: `
    <div class="form-group">
    <label v-html="label+':'"></label>
        <input type="text" class="form-control form-control-sm" v-model="val">
    </div>`,
    props: ['label', 'value'],
    data: function () {
        return {
            val: this.value
        }
    },
    methods: {

    },
    watch: {
        val: function (val) {
            this.$emit('input', val);
        },
    },
    created: function () {        },
});
Vue.component('form_form_icon', {
    template: `
    <div class="form-group">
        <div class="input-group input-group-sm">
            <span :class="'input-group-addon '+label" style="50px;"></span>
            <input type="link" class="form-control form-control-sm" v-model="val">
        </div>
    </div>`,
    props: ['label', 'value'],
    data: function () {
        return {
            val: this.value
        }
    },
    methods: {

    },
    watch: {
        val: function (val) {
            this.$emit('input', val);
        },
    },
    created: function () {        },
});
Vue.component('form_social', {
    template: `
    <div>
    <div class="form-group" v-for="(val, index) in vals">
        <div class="input-group input-group-sm">
            <span :class="'input-group-addon '+val.title" style="50px;">{{ val.title }}</span>
            <input type="link" class="form-control form-control-sm" v-model="val.value">
        </div>
    </div></div>`,
    props: ['label', 'value'],
    data: function () {
        return {
            vals: this.value
        }
    },
    methods: {

    },
    watch: {
        val: function (val) {
            this.$emit('input', val);
        },
    },
    created: function () {        },
});
Vue.component('form_textarea', {
    template: `
    <div class="form-group">
    <label v-html="label+':'"></label>
        <textarea rows="2" class="form-control" v-model="val"></textarea>
    </div>`,
    props: ['label', 'value'],
    data: function () {
        return {
            val: this.value
        }
    },
    methods: {

    },
    watch: {
        val: function (val) {
            this.$emit('input', val);
        },
    },
    created: function () {        },
});

Vue.component('form_banner', {
    template: `<div>
        <div class="form-group select-img" v-for="(item, index) in images">
            <label class="control-label">
            {{ label }} <a class="remove-img" v-on:click="removeItem(index)">
                    <i class="fa fa-times-circle fa-4x text-danger"></i>
                </a>
            </label>
            <div class="text-center form-group">
                <a class="remove-img" v-on:click="componentImg(index)" v-if="item.image">
                    <i class="fa fa-times-circle fa-2x text-danger"></i>
                </a>
                <input type="hidden" v-model="item.image" @blur="onChange">
                <img :src="item.image != '' ? item.image : '/public/admin/assets/img/uploadCroup.png' " v-on:click="componentGallery(index)" class="img-responsive cursor">
            </div>
            <div class="form-group">
                <input type="text" class="form-control form-control-sm" v-model="item.title" placeholder="Title">
            </div>
            <div class="form-group">
                <input type="link" class="form-control form-control-sm" v-model="item.link" placeholder="Link">
            </div>
        </div>
        <div class="text-right">
            <button class="btn btn-sm btn-success" v-on:click="addImg"><i class="icon-plus2"></i></button>
        </div>
    </div>`,
    props: ['label', 'value'],
    data: function () {
        return {
            images: (this.value) ? this.value : [{
                title : '',
                link : '',
                image : '',
            }]
        }
    },
    methods: {
        componentGallery: function (index) {
            var vm = this;
            var AppMedia = new appMedia();
            AppMedia.show({
                current : [],
                multiple: false,
                group: 'product',
                output: function (data) {
                    vm.images[index].image = data[0].path;
                }
            });
        },
        addImg: function () {
            this.images.push({
                title : '',
                link : '',
                image : '',
            });
        },
        componentImg: function (index) {
            this.images[index].image = '';
        },
        removeItem: function (index) {
            this.images.splice(index, 1);
        },
        onChange() {
            this.$emit('onblurevent');
        },
    },
    watch: {

    },
    created: function () {        },
});
Vue.component('form_link', {
    template: `<div>
        <div class="form-group select-link">
            <label class="control-label">
                {{ label }}
            </label>
            <div class="form-group">
                <input type="text" class="form-control form-control-sm" v-model="title" placeholder="Title">
            </div>
            <div class="form-group">
                <input type="link" class="form-control form-control-sm" v-model="link" placeholder="Link">
            </div>
        </div>
    </div>`,
    props: ['label', 'value'],
    data: function () {
        return {
            title : '',
            link : '',
        }
    },
    methods: {
        onChange() {
            this.$emit('onblurevent');
        },
    },
    watch: {

    },
    created: function () {        },
});