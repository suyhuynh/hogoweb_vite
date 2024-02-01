var Chrome = VueColor.Chrome;
Vue.component('form_color', {
    components: {
        'chrome-picker': Chrome,
    },
    template: `<div class="form-group form-group-feedback form-group-feedback-left color-picker" ref="colorpicker">
    <label class="control-label" v-if="label">{{ label }}:</label>
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
Vue.component('form_image_title', {
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
    </div>
    `,
    props: ['label', 'value'],
    data: function () {
        return {
            image: (this.value && this.value != 'null') ? this.value : {title : '', img: ''}
        }
    },
    methods: {
        componentGallery: function () {
            var vm = this;
            var AppMedia = new appMedia();
            AppMedia.show({
                current : [],
                multiple: false,
                group: 'image',
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
Vue.component('image_change', {
    template: `<div class="form-group select-img">
    <label v-if="label" class="control-label">
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
                group: 'image',
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
                group: 'image',
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
                group: 'image',
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
    <label v-if="label" v-html="label+':'"></label>
    <input type="text" id="title" :name="name" v-model="val" class="form-control form-control-sm">
    </div>`,
    props: ['label', 'value', 'name'],
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
Vue.component('form_checkbox', {
    template: `
    <div class="form-group">
    <div class="form-check align-items-center" style="display: flex;">
    <input class="form-check-input mt-0" :name="name" type="checkbox" value="1" true-value="1" false-value="0" :id="id" v-model="val"  />
    <label class="form-check-label ml-2" :for="id" v-html="label" style="font-weight: bold;margin-bottom: 0;margin-left: 10px;margin-top: 4px;"></label>
    </div>
    </div>`,
    props: ['label', 'value', 'name'],
    data: function () {
        return {
            val: this.value,
            id: 'checkbox'+(Math.random())
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
Vue.component('form_password', {
    template: `
    <div class="form-group">
    <label v-html="label+':'"></label>
    <input type="password" :name="name" id="title" v-model="val" class="form-control ">
    </div>`,
    props: ['label', 'value', 'name'],
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
Vue.component('form_number', {
    template: `
    <div class="form-group">
    <label v-html="label+':'"></label>
    <input type="number" id="title" :name="name" v-model="val" class="form-control form-control-sm">
    </div>`,
    props: ['label', 'value', 'name'],
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
    <textarea class="form-control" :name="name" rows="3" v-model="val"></textarea>
    </div>`,
    props: ['label', 'value', 'name'],
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
    <textarea class="form-control" :id="id" rows="1" v-model="val"></textarea>
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
    created: function () {},
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
    <select v-model="val" :name="name" class="form-control form-control-sm select2-from" :id="id">
    <option></option>
    <option v-for="(item, key) in groups" :value="key" >{{item}}</option>
    </select>
    </div>`,
    props: ['label', 'value', 'name'],
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

Vue.component('form_group_category', {
    template: `
    <div>
    <div class="form-group">
    <label v-html="label+':'"></label>
    <select v-model="val.category" class="form-control form-control-sm mb-2 select2-from" id="category-id">
    <option></option>
    <option v-for="(item, key) in categories" :value="key" >{{item}}</option>
    </select>
    </div>
    <div class="form-group">
    <select v-model="val.group" class="form-control form-control-sm select2-from" id="group-id">
    <option></option>
    <option v-for="(item, key) in groups" :value="key" >{{item}}</option>
    </select>
    </div>
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
            $('#category-id').select2({
                allowClear: true,
                placeholder: 'Select Category'
            }).on('change', function(e){
                vm.val.category = this.value;
            });

            $('#group-id').select2({
                allowClear: true,
                placeholder: 'Select group'
            }).on('change', function(e){
                vm.val.group = this.value;
            });
        }
    },
    mounted () {
        this.init();
    },
    watch: {

    },
    created: function () {
        if(this.$root.table_data.categories){
            this.categories = this.$root.table_data.categories;
        }
        if(this.$root.table_data.group_types){
            this.groups = this.$root.table_data.group_types;
        }

        if(this.$root.table_data.groups){
            this.groups = this.$root.table_data.groups;
        }
    }
});

Vue.component('form_slider', {
    template: `
    <div class="form-group">
    <label v-html="label+':'"></label>
    <select v-model="val" class="form-control form-control-sm select2-from" :id="id">
    <option></option>
    <option v-for="(item, key) in sliders" :value="key" >{{item}}</option>
    </select>
    </div>`,
    props: ['label', 'value'],
    data: function () {
        return {
            val: this.value,
            sliders: [],
            id: 'key'+Math.floor((Math.random() * 20) + 1)
        }
    },
    methods: {
        init: function () {
            var vm = this;
            var config = {
                allowClear: true,
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
        this.sliders = this.$root.table_data.sliders;
    },
});
Vue.component('form_layout', {
    template: `
    <div class="form-group">
    <label v-html="label+':'"></label>
    <select v-model="val" class="form-control form-control-sm select2-from" :id="id">
    <option></option>
    <option v-for="(item, key) in layouts" :value="key" >{{item}}</option>
    </select>
    </div>`,
    props: ['label', 'value'],
    data: function () {
        return {
            val: this.value,
            layouts: [],
            id: 'key'+Math.floor((Math.random() * 20) + 1)
        }
    },
    methods: {
        init: function () {
            var vm = this;
            var config = {
                allowClear: true,
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
        this.layouts = this.$root.table_data.layouts;
    },
});
Vue.component('form_library', {
    template: `
    <div class="form-group">
    <label v-html="label+':'"></label>
    <select v-model="val" multiple="multiple" class="form-control form-control-sm select2-from" :id="id">
    <option></option>
    <option v-for="(item, key) in libraries" :value="key" >{{item}}</option>
    </select>
    </div>`,
    props: ['label', 'value'],
    data: function () {
        return {
            val: (this.value.value) ? this.value.value : [],
            libraries: [],
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
                vm.val = $(this).val();
            });
        },onChange() {
            this.$emit('onblurevent');
        },
    },
    mounted () {
        this.init();
    },
    watch: {
        val: function (val) {
            this.value.value = val;
        },
    },
    created: function () {
        this.libraries = this.$root.table_data.libraries;
    },
});
Vue.component('form_category', {
    template: `
    <div class="form-group">
    <label v-html="label+':'"></label>
    <select v-model="val" class="form-control form-control-sm select2-from" :id="id">
    <option></option>
    <option v-for="(item, key) in categories" :value="key" >{{item}}</option>
    </select>
    </div>`,
    props: ['label', 'value'],
    data: function () {
        return {
            val: this.value,
            categories: [],
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
            this.categories = this.$root.category_posts;
        }
        if(this.$root.tab == 'sidebar_product'){
            this.categories = this.$root.category_products;
        }
        if(this.$root.table_data.categories){
            this.categories = this.$root.table_data.categories;
        }
    },
});
Vue.component('form_category_tab', {
    template: `
    <div><div class="form-group">
    <label v-html="label+':'"></label>
    <select multiple="multiple" v-model="val" class="form-control form-control-sm select2-from" :id="id">
    <option></option>
    <option v-for="(item, key) in categories" :value="key" >{{item}}</option>
    </select>
    </div><div class="form-group">
    <label>Limit:</label>
    <input type="text" :id="'limit'+id" v-model="limit" class="form-control ">
    </div></div>`,
    props: ['label', 'value'],
    data: function () {
        return {
            val: (this.value.value) ? this.value.value : [],
            limit: this.value.limit,
            categories: [],
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
                vm.val = $(this).val();
                // vm.$emit('input', vm.val);
            });
        }
    },
    mounted () {
        this.init();
    },
    watch: {
        limit: function (val) {
            this.value.limit = val;
        },
        val: function (val) {
            this.value.value = val;
        },
    },
    created: function () {
        if(this.$root.tab == 'sidebar_post'){
            this.categories = this.$root.category_posts;
        }
        if(this.$root.tab == 'sidebar_product'){
            this.categories = this.$root.category_products;
        }
        if(this.$root.table_data.categories){
            this.categories = this.$root.table_data.categories;
        }
    },
});

Vue.component('form_image_map', {
    template: `
    <div><div class="form-group">
    <label v-html="label+':'"></label>
    <select multiple="multiple" v-model="val" class="form-control form-control-sm select2-from" :id="id">
    <option></option>
    <option v-for="(item, key) in image_maps" :value="key" >{{item}}</option>
    </select>
    <a href="/tkadmin/website/image-maps" target="_blank" style="display:block">Link admin</a>
    </div></div>`,
    props: ['label', 'value'],
    data: function () {
        return {
            val: (this.value) ? this.value : [],
            image_maps: [],
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
                vm.val = $(this).val();
                vm.$emit('input', vm.val);
            });
        }
    },
    mounted () {
        this.init();
    },
    watch: {
        // val: function (val) {
        //     this.value = JSON.parse(val);
        // },
    },
    created: function () {
        if(this.$root.table_data.image_maps){
            this.image_maps = this.$root.table_data.image_maps;
        }
    },
});

Vue.component('form_catalogue', {
    template: `
    <div><div class="form-group">
    <label v-html="label+':'"></label>
    <select multiple="multiple" v-model="val" class="form-control form-control-sm select2-from" :id="id">
    <option></option>
    <option v-for="(item, key) in categories" :value="key" >{{item}}</option>
    </select>
    </div><div class="form-group">
    <label>Limit:</label>
    <input type="text" :id="'limit'+id" v-model="limit" class="form-control ">
    </div></div>`,
    props: ['label', 'value'],
    data: function () {
        return {
            val: (this.value.value) ? this.value.value : [],
            limit: this.value.limit,
            categories: [],
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
                vm.val = $(this).val();
                // vm.$emit('input', vm.val);
            });
        }
    },
    mounted () {
        this.init();
    },
    watch: {
        limit: function (val) {
            this.value.limit = val;
        },
        val: function (val) {
            this.value.value = val;
        },
    },
    created: function () {
        if(this.$root.table_data.categories){
            this.categories = this.$root.table_data.categories;
        }
    },
});

Vue.component('form_category_children', {
    template: `
    <div class="form-group">
    <label v-html="label+':'"></label>
    <select v-model="val" multiple class="form-control form-control-sm select2-from" :id="id">
    <option></option>
    <option v-for="(item, key) in categories" :value="key" >{{item}}</option>
    </select>
    </div>`,
    props: ['label', 'value'],
    data: function () {
        return {
            val: (this.value.value) ? this.value.value : [],
            categories: [],
            id: 'key'+Math.floor((Math.random() * 20) + 1)
        }
    },
    methods: {
        init: function () {
            var vm = this;
            var config = {
                allowClear: false,
                placeholder: vm.$root.placeholder,
            };
            $('#'+vm.id).select2(config)
            .on('change', function(e){
                vm.val = $(this).val();
            });
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
    created: function () {
        if(this.$root.tab == 'sidebar_post'){
            this.categories = this.$root.category_posts;
        }
        if(this.$root.tab == 'sidebar_product'){
            this.categories = this.$root.category_products;
        }
        if(this.$root.table_data.categories){
            this.categories = this.$root.table_data.categories;
        }
    },
});
Vue.component('form_group_type', {
    template: `
    <div class="form-group">
    <label v-html="label+':'"></label>
    <select v-model="val" class="form-control form-control-sm select2-from" :id="id">
    <option></option>
    <option v-for="(item, key) in group_types" :value="key" >{{item}}</option>
    </select>
    </div>`,
    props: ['label', 'value'],
    data: function () {
        return {
            val: this.value,
            categories: [],
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
        this.group_types = this.$root.table_data.group_types;
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
            categories: [],
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
        this.groups = this.$root.table_data.groups;
    },
});

Vue.component('form_content', {
    props: ['value', 'label'],
    template: `<div class="form-group">
    <label for="title" v-html="label+':'"></label>
    <textarea rows="30" :id="'tinymce'+rand_id" class="form-control tinymce" v-bind:value="value"></textarea>
    </div>
    `,
    data: function () {
        return {
            rand_id : Math.floor((Math.random() * 100))
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
            menubar: true,
            relative_urls : false,
            table_border_styles: true,
            table_background_color_map: true,
            content_css: ['/public/web/bootstrap/bootstrap.min.css', '/public/kh/23162362022/1/css/style.css'],
            file_picker_callback: function (callback, value, meta) {
                if (meta.filetype === 'file') {
                    callback('https://www.google.com/logos/google.jpg', { text: 'My text' });
                }
                if (meta.filetype === 'image') {
                    var AppMedia = new appMedia();
                    AppMedia.show({
                        current : [],
                        multiple: false,
                        group: 'image',
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
                // editor.on('init', ()=>{
                //     tinyMCE.activeEditor.setContent(vm.value);
                // });
                editor.on('change input keypress keyup keydown paste', (e) => {
                    var new_value = tinyMCE.activeEditor.getContent();
                    vm.updateValue(new_value);
                });
            }
        });
    },
    created: function () {

    },
});

Vue.component('form_content_full', {
    props: ['value', 'label'],
    template: `<div class="form-group">
    <label for="title" v-html="label+':'"></label>
    <textarea rows="30" :id="'tinymce'+rand_id" class="form-control tinymce" v-bind:value="value"></textarea>
    </div>
    `,
    data: function () {
        return {
            rand_id : Math.floor((Math.random() * 100))
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
            theme: 'silver',
            mobile: { theme: 'mobile' },
            plugins: 'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable charmap quickbars emoticons',
            imagetools_cors_hosts: ['picsum.photos'],
            toolbar: 'image undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile media template link anchor codesample | ltr rtl',
            toolbar_sticky: true,
            image_advtab: true,
            importcss_append: true,
            relative_urls : false,
            content_css: ['/public/web/bootstrap/bootstrap.min.css', '/public/css/content.css'],
            file_picker_callback: function (callback, value, meta) {
                if (meta.filetype === 'file') {
                    callback('https://www.google.com/logos/google.jpg', { text: 'My text' });
                }
                if (meta.filetype === 'image') {
                    var AppMedia = new appMedia();
                    AppMedia.show({
                        current : [],
                        multiple: false,
                        group: 'image',
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
            height: 600,
            image_caption: true,
            quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
            noneditable_noneditable_class: "mceNonEditable",
            toolbar_drawer: 'sliding',
            quickbars_insert_toolbar: '',
            contextmenu: "link image imagetools table",
            setup: function(editor) {
                // editor.on('init', ()=>{
                //     tinyMCE.activeEditor.setContent(vm.value);
                // });
                editor.on('change input keypress keyup keydown paste', (e) => {
                    var new_value = tinyMCE.activeEditor.getContent();
                    vm.updateValue(new_value);
                });
            }
        });
    },
    created: function () {

    },
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
    <span :class="'input-group-prepend '+val.title" style="50px;">
    <span class="input-group-text" style="width: 40px;text-align: center;display: grid;"><i :class="val.icon"></i></span>
    </span>
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
    created: function () {},
});
Vue.component('form_gallery', {
    template: `<div>
    <label v-html="label+':'"></label>
    <div class="form-group select-img">
    <div class="text-center form-group gallery" v-for="(item, index) in images">
    <a class="remove-img" v-on:click="removeItem(index)" v-if="item.img">
    <i class="fa fa-times-circle fa-2x text-danger"></i>
    </a>
    <input type="hidden" v-model="item.img" accept="image/*" @blur="onChange">
    <img :src="item.img != '' ? item.img : '/public/admin/assets/img/uploadCroup.png' " v-on:click="componentGallery(index)" class="img-responsive cursor">
    </div>
    <div class="text-center form-group gallery">
    <input type="hidden">
    <img src="/public/admin/assets/img/uploadCroup.png" v-on:click="componentGallery(-1)" class="img-responsive cursor">
    </div>
    </div>
    </div>`,
    props: ['value', 'label'],
    data: function () {
        return {
            images: (this.value) ? this.value : []
        }
    },
    methods: {
        componentGallery: function (index) {
            var vm = this;
            var index_item = index;
            var AppMedia = new appMedia();
            vm.images = Object.keys(vm.images).map(function (key) { return vm.images[key]; });
            AppMedia.show({
                current : [],
                multiple: false,
                group: 'image',
                output: function (data) {
                    if(index_item == -1){
                        vm.images.push({img: data[0].path});
                    }else{
                        vm.images[index_item].img = data[0].path;
                    }
                    vm.$emit('input', vm.images);

                }
            });
        },
        removeItem: function (index) {
            this.images.splice(index, 1);
        },
        onChange: function() {
            this.$emit('onblurevent');
        },
    },
    watch: {

    },
    created: function () { },
});
Vue.component('form_file', {
    template: `
    <div class="form-group select-img">
    <label class="control-label">
    {{ label }}
    </label>
    <div class="text-center">
    <template v-if="file">
    <a class="remove-img" v-on:click="componentFile()"><i class="fa fa-times-circle fa-2x text-danger"></i></a>
    </template>
    <input type="hidden" v-model="file" @blur="onChange">
    <span v-if="file" class="name-file">{{ file.slice(file.lastIndexOf("/")) }}</span>
    <img :src="file != '' ? '/public/admin/assets/img/'+type+'.png' : '/public/admin/assets/img/uploadFile.png' " v-on:click="componentGalleryFile()" class="img-responsive cursor">
    </div>
    <a v-if="file" :href="file" target="_blank" class="view-file">
    View
    </a>
    </div>`,
    props: ['label', 'value'],
    data: function () {
        return {
            file: (this.value) ? this.value : '',
            type: (this.value) ? this.value.split(".")[(this.value.split(".").length -1)] : '',
        }
    },
    methods: {
        componentGalleryFile: function () {
            var vm = this;
            var AppMedia = new appMedia();
            AppMedia.show({
                group: 'file',
                output: function (data) {
                    vm.file =  data[0].path;
                    vm.type =  data[0].path.split(".")[(data[0].path.split(".").length -1)]
                }
            });
        },
        componentFile: function () {
            this.setFile('');
        },
        setFile: function (file) {
            this.file = file;
            this.$emit('input', file);
        },
        onChange() {
            this.$emit('onblurevent');
        },
    },
    watch: {
        file: function (val) {
            this.$emit('input', val);
        }
    },
    created: function () { },
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
                group: 'image',
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

Vue.component('form_two_banner', {
    template: `<div>
    <div class="form-group select-img" v-for="(item, index) in images">
    <label class="control-label">
    {{ label }} <a class="remove-img" style="position: absolute;right: 0;top: 15px;" v-on:click="removeItem(index)">
    <i class="fa fa-times-circle fa-2x text-danger"></i>
    </a>
    </label>
    <div class="text-center form-group">
    <label>IMG</label>
    <a class="remove-img" v-on:click="componentImg(index, 'image')" v-if="item.image">
    <i class="fa fa-times-circle fa-2x text-danger"></i>
    </a>
    <input type="hidden" v-model="item.image" @blur="onChange">
    <img :src="item.image != '' ? item.image : '/public/admin/assets/img/uploadCroup.png' " v-on:click="componentGallery(index)" class="img-responsive cursor">
    </div>
    <div class="text-center form-group">
    <label>IMG 360</label>
    <a class="remove-img" v-on:click="componentImg(index, 'image_two')" v-if="item.image_two">
    <i class="fa fa-times-circle fa-2x text-danger"></i>
    </a>
    <input type="hidden" v-model="item.image_two" @blur="onChange">
    <img :src="item.image_two != '' ? item.image_two : '/public/admin/assets/img/uploadCroup.png' " v-on:click="componentGallery(index)" class="img-responsive cursor">
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
                image : '',
                image_two : '',
            }]
        }
    },
    methods: {
        componentGallery: function (index, key) {
            var vm = this;
            var AppMedia = new appMedia();
            AppMedia.show({
                current : [],
                multiple: false,
                group: 'image',
                output: function (data) {
                    if(key == 'image'){
                        this.images[index].image = data[0].path;
                    }else{
                        this.images[index].image_two = data[0].path;
                    }
                }
            });
        },
        addImg: function () {
            this.images.push({
                image : '',
                image_two : '',
            });
        },
        componentImg: function (index, key) {
            if(key == 'image'){
                this.images[index].image = '';
            }else{
                this.images[index].image_two = '';
            }

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

Vue.component('form_banners', {
    template: `<div>
    <div class="form-group select-img" v-for="(item, index) in images">
    <label class="control-label">
    {{ label }} <a class="remove-img" style="position: absolute;right: 0;top: 15px;" v-on:click="removeItem(index)">
    <i class="fa fa-times-circle fa-2x text-danger"></i>
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
    <textarea v-model="item.description" class="form-control" placeholder="Description"></textarea>
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
                description : '',
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
                group: 'image',
                output: function (data) {
                    vm.images[index].image = data[0].path;
                }
            });
        },
        addImg: function () {
            this.images.push({
                description : '',
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
Vue.component('form_banners_titles', {
    template: `<div>
    <div class="form-group select-img" v-for="(item, index) in images">
    <label class="control-label">
    {{ label }}
    <a class="remove-img" style="position: absolute;right: 0;top: 15px;" v-on:click="removeItem(index)">
    <i class="fa fa-times-circle fa-2x text-danger"></i>
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
    <textarea v-model="item.description" class="form-control" placeholder="Description"></textarea>
    </div>
    <div class="form-group">
    <input type="link" class="form-control form-control-sm" v-model="item.link" placeholder="Link">
    </div>
    <div>
    <div v-for="(val, i) in item.key">
    <a class="remove-img text-danger" v-on:click="removeRow(index, i)">
    <i class="fa fa-times-circle"></i>
    </a>
    <div class="form-group">
    <input type="text" class="form-control form-control-sm" v-model="val.title" placeholder="Title">
    </div>
    <div class="form-group">
    <textarea v-model="val.description" class="form-control" placeholder="Description"></textarea>
    </div>
    <div class="form-group">
    <input type="link" class="form-control form-control-sm" v-model="val.link" placeholder="Link">
    </div>
    </div>
    <button class="btn btn-sm btn-success" v-on:click="addRow(index)">
    <i class="icon-plus2"></i>
    </button>
    </div>

    </div>
    <div class="text-right">
    <button class="btn btn-sm btn-success" v-on:click="addImg">
    <i class="icon-plus2"></i>
    </button>
    </div>
    </div>`,
    props: ['label', 'value'],
    data: function () {
        return {
            images: (this.value) ? this.value : [{
                link : '',
                image : '',
                title : '',
                description : '',
                key: [
                {
                    description : '',
                    title : '',
                    link : '',
                }
                ]
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
                group: 'image',
                output: function (data) {
                    vm.images[index].image = data[0].path;
                }
            });
        },
        addImg: function () {
            this.images.push({
                link : '',
                image : '',
                title : '',
                description : '',
                key: [
                {
                    description : '',
                    title : '',
                    link : '',
                }
                ]
            });
        },
        addRow: function (key) {
            this.images[key].key.push({
                description : '',
                title : '',
                link : '',
            });
        },
        removeRow: function (key, index) {
            this.images[key].key.splice(index, 1);
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

Vue.component('form_link_default', {
    template: `<div>
    <div class="form-group select-link">
    <label class="control-label">
    {{ label }}
    </label>
    <div class="form-group">
    <input type="link" class="form-control form-control-sm" v-model="val" placeholder="Link">
    </div>
    </div>
    </div>`,
    props: ['label', 'value'],
    data: function () {
        return {
            val: this.value
        }
    },
    methods: {
        onChange() {
            this.$emit('onblurevent');
        },
    },
    watch: {
        val: function (val) {
            this.$emit('input', val);
        },
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
    <input type="text" class="form-control form-control-sm" v-model="value.title" placeholder="Title">
    </div>
    <div class="form-group">
    <input type="link" class="form-control form-control-sm" v-model="value.link" placeholder="Link">
    </div>
    </div>
    </div>`,
    props: ['label', 'value'],
    data: function () {
        return {
            value: {
                title : '',
                link : '',
            }
        }
    },
    methods: {
        onChange() {
            this.$emit('onblurevent');
        },
    },
    watch: {
        value: function (val) {
            this.$emit('input', val);
        },
    },
    created: function () {        },
});

Vue.component('form_image_description', {
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
    <textarea v-model="image.description" class="form-control" placeholder="Description"></textarea>
    </div>
    <div class="form-group">
    <input type="link" class="form-control form-control-sm" v-model="image.link" placeholder="Link">
    </div>
    </div>
    `,
    props: ['label', 'value'],
    data: function () {
        return {
            image: (this.value && this.value != 'null') ? this.value : {title : '', img: '', description:'', link: ''}
        }
    },
    methods: {
        componentGallery: function () {
            var vm = this;
            var AppMedia = new appMedia();
            AppMedia.show({
                current : [],
                multiple: false,
                group: 'image',
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

Vue.component('form_rating', {
    template: `
    <div class="form-group">
    <label v-html="label+':'"></label>
    <div class="star-rating">
    <fieldset>
    <input type="radio" id="star5" name="rating" v-model="val" value="5" />
    <label for="star5" title="Outstanding">5 stars</label>

    <input type="radio" id="star4" name="rating" v-model="val" value="4" />
    <label for="star4" title="Very Good">4 stars</label>

    <input type="radio" id="star3" name="rating" v-model="val" value="3" />
    <label for="star3" title="Good">3 stars</label>

    <input type="radio" id="star2" name="rating" v-model="val" value="2" />
    <label for="star2" title="Poor">2 stars</label>

    <input type="radio" id="star1" name="rating" v-model="val" value="1" />
    <label for="star1" title="Very Poor">1 star</label>
    </fieldset>
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
Vue.component('form_title_description', {
    template: `<div>
    <div class="form-group select-link">
    <label class="control-label">
    {{ label }}
    </label>
    <div class="form-group">
    <input type="text" class="form-control form-control-sm" v-model="value.title" placeholder="Title">
    </div>
    <div class="form-group">
    <textarea v-model="value.description" class="form-control" placeholder="Description"></textarea>
    </div>
    </div>
    </div>`,
    props: ['label', 'value'],
    data: function () {
        return {
            value: {
                title : '',
                description : '',
            }
        }
    },
    methods: {
        onChange() {
            this.$emit('onblurevent');
        },
    },
    watch: {
        value: function (val) {
            this.$emit('input', val);
        },
    },
    created: function () {        },
});
Vue.component('form_title_content', {
    template: `<div>
    <div class="form-group select-link">
    <label class="control-label">
    {{ label }}
    </label>
    <div class="form-group">
    <input type="text" class="form-control form-control-sm" v-model="value.title" placeholder="Title">
    </div>
    <div class="form-group">
    <textarea v-model="value.content" class="form-control" placeholder="Content"></textarea>
    </div>
    </div>
    </div>`,
    props: ['label', 'value'],
    data: function () {
        return {
            value: {
                title : '',
                content : '',
            }
        }
    },
    methods: {
        onChange() {
            this.$emit('onblurevent');
        },
    },
    watch: {
        value: function (val) {
            this.$emit('input', val);
        },
    },
    created: function () {        },
});
Vue.component('form_price', {
    template: `
    <div class="form-group">
    <label v-if="label" v-html="label+':'"></label>
    <div class="input-group input-group-sm mb-3">
    <input type="hidden" v-model="price">
    <input type="text" id="title" v-model="price_format" class="form-control form-control-sm">
    <div class="input-group-prepend">
    <span class="input-group-text" id="inputGroup-sizing-sm">${current_currency}</span>
    </div>
    </div>
    </div>`,
    props: ['label', 'value', 'max', 'min'],
    data: function () {
        return {
            price_format: String(this.value).replace(/\B(?=(\d{3})+(?!\d))/g, ","),
            price: this.value,
        }
    },
    methods: {

    },
    watch: {
        price_format: function (val) {
            if(!val || val === 'NaN'){
                this.price = 0;
            }else{
                let priceInput = parseInt(String(val).replace(/,/g, ""));
                if(this.max < priceInput || priceInput < this.min){
                    priceInput = this.price;
                }
                this.price = priceInput;
                this.price_format = String(this.price).replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            }

            this.$emit('input', this.price);
        },
    },
    created: function () {        },
});
Vue.component('form_links', {
    template: `<div>
    <label class="control-label">{{ label }}:</label>
    <div class="form-group select-img" v-for="(item, index) in list">
    <a class="remove-img text-right" style="display: block;" v-on:click="removeItem(index)">
    <i class="fa fa-times-circle fa-2x text-danger"></i>
    </a>
    <div class="form-group">
    <input type="text" class="form-control form-control-sm" v-model="item.title">
    </div>
    <div class="form-group">
    <input type="text" class="form-control form-control-sm" v-model="item.link">
    </div>
    <hr>
    </div>
    <div class="text-right">
    <button class="btn btn-sm btn-success" v-on:click="add"><i class="icon-plus2"></i></button>
    </div>
    </div>`,
    props: ['label', 'value'],
    data: function () {
        return {
            list: (this.value) ? this.value : [{
                title : '',
                link : '',
            }]
        }
    },
    methods: {
        add: function () {
            this.list.push({
                title: '',
                link: '',
            });
        },
        removeItem: function (index) {
            this.list.splice(index, 1);
        },
        onChange() {
            this.$emit('onblurevent');
        },
    },
    watch: {

    },
    created: function () {        },
});

Vue.component('form_list_title_description', {
    template: `<div>
    <label class="control-label">{{ label }}:</label>
    <div class="form-group select-img" v-for="(item, index) in list">
    <a class="remove-img text-right" style="display: block;" v-on:click="removeItem(index)">
    <i class="fa fa-times-circle fa-2x text-danger"></i>
    </a>
    <div class="form-group">
    <input type="text" class="form-control form-control-sm" v-model="item.title">
    </div>
    <div class="form-group">
    <textarea class="form-control form-control-sm" v-model="item.description"></textarea>
    </div>
    <hr>
    </div>
    <div class="text-right">
    <button class="btn btn-sm btn-success" v-on:click="add"><i class="icon-plus2"></i></button>
    </div>
    </div>`,
    props: ['label', 'value'],
    data: function () {
        return {
            list: (this.value) ? this.value : [{
                title : '',
                description : '',
            }]
        }
    },
    methods: {
        add: function () {
            this.list.push({
                title : '',
                description : '',
            });
        },
        removeItem: function (index) {
            this.list.splice(index, 1);
        },
        onChange() {
            this.$emit('onblurevent');
        },
    },
    watch: {

    },
    created: function () {        },
});
Vue.component('form_list_title_description2', {
    template: `<div>
    <label class="control-label">{{ label }}:</label>
    <div class="form-group select-img" v-for="(item, index) in list">
    <a class="remove-img text-right" style="display: block;" v-on:click="removeItem(index)">
    <i class="fa fa-times-circle fa-2x text-danger"></i>
    </a>
    <div class="form-group">
    <input type="text" class="form-control form-control-sm" v-model="item.title">
    </div>
    <div class="form-group">
    <textarea class="form-control form-control-sm" v-model="item.description"></textarea>
    </div>
    <div class="form-group">
    <textarea class="form-control form-control-sm" v-model="item.description_2"></textarea>
    </div>
    <hr>
    </div>
    <div class="text-right">
    <button class="btn btn-sm btn-success" v-on:click="add"><i class="icon-plus2"></i></button>
    </div>
    </div>`,
    props: ['label', 'value'],
    data: function () {
        return {
            list: (this.value) ? this.value : [{
                title : '',
                description : '',
                description_2 : '',
            }]
        }
    },
    methods: {
        add: function () {
            this.list.push({
                title : '',
                description : '',
                description_2 : '',
            });
        },
        removeItem: function (index) {
            this.list.splice(index, 1);
        },
        onChange() {
            this.$emit('onblurevent');
        },
    },
    watch: {

    },
    created: function () {        },
});
Vue.component('form_list_title', {
    template: `<div>
    <label class="control-label">{{ label }}:</label>
    <div class="form-group select-img" v-for="(item, index) in list">
    <a class="remove-img text-right" style="display: block;" v-on:click="removeItem(index)">
    <i class="fa fa-times-circle fa-2x text-danger"></i>
    </a>
    <div class="form-group">
    <input type="text" class="form-control form-control-sm" v-model="item.title">
    </div>
    <div class="form-group">
    <input type="text" class="form-control form-control-sm" placeholder="Key" v-model="item.key">
    </div>
    <div class="form-group">
    <textarea v-model="item.description"" class="form-control form-control-sm" placeholder="Content"></textarea>
    </div>
    <hr>
    </div>
    <div class="text-right">
    <button class="btn btn-sm btn-success" v-on:click="add"><i class="icon-plus2"></i></button>
    </div>
    </div>`,
    props: ['label', 'value'],
    data: function () {
        return {
            list: (this.value) ? this.value : [{
                title : '',
                key : '',
                description : '',
            }]
        }
    },
    methods: {
        add: function () {
            this.list.push({
                title : '',
                key : '',
                description : '',
            });
        },
        removeItem: function (index) {
            this.list.splice(index, 1);
        },
        onChange() {
            this.$emit('onblurevent');
        },
    },
    watch: {

    },
    created: function () {        },
});
Vue.component('form_list_row', {
    template: `
    <div class="form-group">
    <label v-html="label+':'"></label>
    <select class="form-control form-control-sm" v-model="val">
    <option></option>
    <option>col-md-2 col-sm-4 col-xs-12 col-12</option>
    <option>col-md-3 col-sm-4 col-xs-6 col-6</option>
    <option>col-md-4 col-lg-3 col-sm-4 col-xs-12 col-12</option>
    <option>col-md-3 col-sm-4 col-xs-12 col-12</option>
    <option>col-md-3 col-sm-5 col-xs-6 col-6</option>
    <option>col-md-3 col-sm-6 col-xs-12 col-12</option>
    <option>col-lg-3 col-md-4 col-sm-6 col-xs-12 col-12</option>
    <option>col-md-3 col-sm-12 col-xs-12 col-12</option>
    <option>col-lg-4 col-md-6 col-sm-6 col-xs-12 col-12</option>
    <option>col-md-4 col-sm-6 col-xs-12 col-12</option>
    <option>col-md-4 col-sm-12 col-12</option>
    <option>col-md-8 col-lg-4 col-sm-12 col-12 col-xs-12</option>
    <option>col-md-5 col-sm-6 col-xs-12 col-12</option>
    <option>col-md-5 col-sm-12 col-xs-12 col-12</option>
    <option>col-md-6 col-sm-6 col-xs-12 col-12</option>
    <option>col-md-6 col-sm-8 col-12 col-xs-12</option>
    <option>col-md-6 col-lg-5</option>
    <option>col-md-6 col-sm-7 col-12</option>
    <option>col-md-6 col-sm-12 col-12 col-xs-12</option>
    <option>col-md-4 col-sm-5 col-xs-12 col-12</option>
    <option>col-md-7 col-sm-6 col-xs-12 col-12</option>
    <option>col-md-7 col-sm-12 col-xs-12 col-12</option>
    <option>col-md-7 col-sm-9 col-xs-12 col-12</option>
    <option>col-md-8 col-sm-12 col-xs-12 col-12</option>
    <option>col-md-8 col-sm-12 col-xs-12 col-12 pl</option>
    <option>col-md-8 col-sm-7 col-xs-12 col-12</option>
    <option>col-md-8 col-12 col-sm-12 col-xs-12</option>
    <option>col-lg-8 col-md-10 col-sm-12 col-xs-12 col-12</option>
    <option>col-lg-9 col-md-8 col-sm-6 col-xs-12 col-12</option>
    <option>col-md-9 col-sm-12 col-xs-12 col-12</option>
    <option>col-md-10 col-sm-12 col-xs-12 col-12</option>
    <option>col-md-11 col-sm-12 col-xs-12 col-12</option>
    <option>col-md-12 col-sm-12 col-xs-12 col-12</option>
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

Vue.component('form_text_align', {
    template: `
    <div class="form-group">
    <label v-html="label+':'"></label>
    <select class="form-control form-control-sm" v-model="val">
    <option></option>
    <option>center</option>
    <option>left</option>
    <option>right</option>
    <option>end</option>
    </select>
    </div>`,
    props: ['label', 'value'],
    data: function () {
        return {
            val: (this.value && this.value != '') ? this.value : 'center'
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

Vue.component('form_container', {
    template: `
    <div class="form-group">
    <label v-html="label+':'"></label>
    <select class="form-control form-control-sm" v-model="val">
    <option>container-null</option>
    <option>container</option>
    <option>container pt-3 pb-3</option>
    <option>container pt-3</option>
    <option>container pb-3</option>
    <option>container mt-3 mb-3</option>
    <option>container mt-3</option>
    <option>container mb-3</option>
    <option>container-fluid</option>
    <option>container-fluid pt-3 pb-3</option>
    <option>container-fluid pt-3</option>
    <option>container-fluid pb-3</option>
    <option>container-fluid mt-3 mb-3</option>
    <option>container-fluid mt-3</option>
    <option>container-fluid mb-3</option>
    </select>
    </div>`,
    props: ['label', 'value'],
    data: function () {
        return {
            val: (this.value && this.value != '') ? this.value : 'center'
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

Vue.component('form_padding', {
    template: `
    <div class="form-group">
    <label v-html="label+':'"></label>
    <select class="form-control form-control-sm" v-model="val">
    <option></option>
    <option>m-0</option>
    <option>p-0</option>
    <option>m-0 p-0</option>
    <option>m-1</option>
    <option>m-2</option>
    <option>m-3</option>
    <option>m-4</option>
    <option>m-5</option>
    <option>mb-1</option>
    <option>mb-2</option>
    <option>mb-3</option>
    <option>mb-4</option>
    <option>mb-5</option>
    <option>mt-1</option>
    <option>mt-2</option>
    <option>mt-3</option>
    <option>mt-4</option>
    <option>mt-5</option>
    <option>ml-1</option>
    <option>ml-2</option>
    <option>ml-3</option>
    <option>ml-4</option>
    <option>ml-5</option>
    <option>mr-1</option>
    <option>mr-2</option>
    <option>mr-3</option>
    <option>mr-4</option>
    <option>mr-5</option>
    <option>mr-1 ml-1</option>
    <option>mr-2 ml-2</option>
    <option>mr-3 ml-3</option>
    <option>mr-4 ml-4</option>
    <option>mr-5 ml-5</option>
    <option>mt-1 mb-1</option>
    <option>mt-2 mb-2</option>
    <option>mt-3 mb-3</option>
    <option>mt-4 mb-4</option>
    <option>mt-5 mb-5</option>
    <option>p-1</option>
    <option>p-2</option>
    <option>p-3</option>
    <option>p-4</option>
    <option>p-5</option>
    <option>pb-1</option>
    <option>pb-2</option>
    <option>pb-3</option>
    <option>pb-4</option>
    <option>pb-5</option>
    <option>pt-1</option>
    <option>pt-2</option>
    <option>pt-3</option>
    <option>pt-4</option>
    <option>pt-5</option>
    <option>pl-1</option>
    <option>pl-2</option>
    <option>pl-3</option>
    <option>pl-4</option>
    <option>pl-5</option>
    <option>pr-1</option>
    <option>pr-2</option>
    <option>pr-3</option>
    <option>pr-4</option>
    <option>pr-5</option>
    <option>pr-1 pl-1</option>
    <option>pr-2 pl-2</option>
    <option>pr-3 pl-3</option>
    <option>pr-4 pl-4</option>
    <option>pr-5 pl-5</option>
    <option>pt-1 pb-1</option>
    <option>pt-2 pb-2</option>
    <option>pt-3 pb-3</option>
    <option>pt-4 pb-4</option>
    <option>pt-5 pb-5</option>
    <option>pt-1 pb-0</option>
    <option>pt-2 pb-0</option>
    <option>pt-3 pb-0</option>
    <option>pt-4 pb-0</option>
    <option>pt-5 pb-0</option>
    <option>pt-0 pb-1</option>
    <option>pt-0 pb-2</option>
    <option>pt-0 pb-3</option>
    <option>pt-0 pb-4</option>
    <option>pt-0 pb-5</option>
    </select>
    </div>`,
    props: ['label', 'value'],
    data: function () {
        return {
            val: (this.value && this.value != '') ? this.value : 'center'
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

Vue.component('form_img_effect', {
    template: `
    <div class="form-group">
    <label v-html="label+':'"></label>
    <select class="form-control form-control-sm" v-model="val">
    <option value="">None</option>
    <option>block-img-effect</option>
    <option>banner-effect2</option>
    </select>
    </div>`,
    props: ['label', 'value'],
    data: function () {
        return {
            val: (this.value && this.value != '') ? this.value : 'center'
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

Vue.component('form_link_description', {
    template: `<div>
    <div class="form-group select-link">
    <label class="control-label">
    {{ label }}
    </label>
    <div class="form-group">
    <input type="text" class="form-control form-control-sm" v-model="val.title" placeholder="Title">
    </div>
    <div class="form-group">
    <textarea class="form-control form-control-sm" v-model="val.description"></textarea>
    </div>
    <div class="form-group">
    <input type="link" class="form-control form-control-sm" v-model="val.link" placeholder="Link">
    </div>
    </div>
    </div>`,
    props: ['label', 'value'],
    data: function () {
        return {
            val: {
                description : '',
                title : '',
                link : '',
            }
        }
    },
    methods: {
        onChange() {
            this.$emit('onblurevent');
        },
    },
    watch: {
        val: function (val) {
            this.$emit('input', val);
        },
    },
    created: function () {
        this.val = this.value;
    },
});
Vue.component('form_datepicker', {
    template: `
    <div class="form-group">
    <label v-html="label+':'"></label>
    <input type="text" v-model="val" class="form-control form-control-sm">
    </div>`,
    props: ['label', 'value', 'format'],
    data: function () {
        return {
            val: this.value
        }
    },
    methods: {
        intall: function () {
            var vm = this;
            var defaultdate = vm.$attrs.defaultdate;
            $(this.$el).daterangepicker({
                locale: {
                    format: defaultdate
                },
                drops: "up",
                singleDatePicker: true
            }, function(start, end, label) {
                var startDate = moment(start.format(defaultdate), defaultdate);
                vm.$emit('input',startDate._i);
            });
        },
    },
    mounted: function() {
        var vm = this;
        vm.intall(moment());
    },
    watch: {
        val: function(newval, oldval) {
            var vm = this;
            if (newval != oldval) {
                $(this.$el).data('daterangepicker').remove();
                vm.intall(newval);
            }
        },
    },
    created: function () {        },
});

Vue.component('form_singledatepicker_time', {
    template: `
    <div class="form-group">
    <label v-html="label+':'"></label>
    <input type="text" id="title" v-model="val" :value="val" class="form-control form-control-sm">
    </div>
    `,
    props: ['label', 'value', 'format'],
    data() {
        return {
            val: this.value,
        }
    },
    mounted: function() {
        var vm = this;
        vm.intall();
    },
    methods: {
        intall: function () {
            var vm = this;
            $(this.$el).daterangepicker({
                locale: {
                    format: vm.format+" HH:mm:ss"
                },
                drops: "bottom",
                startDate: vm.val,
                singleDatePicker: true,
                timePicker: true,
                timePicker24Hour: true,
                timePickerSeconds: true,

            }, function(start, end, label) {
                var startDate = moment(start.format(vm.format+' HH:mm:ss'), vm.format+' HH:mm:ss');
                vm.$emit('input',startDate._i);
            });
            $(this.$el).on('apply.daterangepicker', function(ev, picker) {
                var startDate = moment(picker.startDate.format(vm.format+' HH:mm:ss'), vm.format+' HH:mm:ss');
                vm.$emit('input',startDate._i);
            })
        },
        onBlur() {
            this.$emit('onchangeevent');
        },
        onChange() {
            this.$emit('onblurevent');
        },
    },
    watch :{
        value: function(newval, oldval) {
            if (newval != oldval) {
                this.val = newval;
            }
        },
    }
});

Vue.component('form_list_title_layout', {
    template: `<div>
    <label class="control-label">{{ label }}:</label>
    <div class="form-group select-img text-right" v-for="(item, index) in list">
        <a class="remove-img text-right" v-on:click="removeItem(index)">
            <i class="fa fa-times-circle fa-2x text-danger"></i>
        </a>
        <div class="form-group">
            <input type="text" class="form-control form-control-sm" v-model="item.title">
        </div>
        <div class="form-group">
            <select v-model="item.layout_id" class="form-control form-control-sm select2-from">
                <option value="">Select layout</option>
                <option v-for="(item, key) in layouts" :value="key" >{{item}}</option>
            </select>
        </div>
        <hr>
    </div>
    <div class="text-right">
        <button class="btn btn-sm btn-success" v-on:click="add"><i class="icon-plus2"></i></button>
    </div>
</div>`,
    props: ['label', 'value'],
    data: function () {
        return {
            list: (this.value) ? this.value : [{
                title: '',
                layout_id: '',
            }]
        }
    },
    methods: {
        add: function () {
            this.list.push({
                title: '',
                layout_id: '',
            });
        },
        removeItem: function (index) {
            this.list.splice(index, 1);
        },
        onChange() {
            this.$emit('onblurevent');
        },
    },
    watch: {

    },
    created: function () {
        this.layouts = this.$root.table_data.layouts;
    },
});
