<template>
<div>
    <div class="col-md-12">
        <form class="form" id="[TNAME]_form" method="POST" :action='this.module.store_route' @submit.prevent="onSubmit">
            <input type="hidden" name="_token" :value='token'>
            <input type="hidden" name="id" :value='this.model_data.id' v-if="this.model_data.id">

            <div class="row">
                [FORM_FIELDS]
            </div>
            <div class="row">
            <!-- [GridVueElement-1] -->
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <file_upload ref="file_upload" :module='this.module'></file_upload>
                </div>
            </div>
            
            <div class="clearfix">&nbsp;</div>
            
            <div class="card-actionbar">
                <div class="card-actionbar-row">

                    <button v-if="!is_save" type="submit" class="btn btn-flat btn-primary theme-btn">{{this.module.common.save}}</button>

                    <button v-else class="btn btn-primary" type="submit" disabled>
                        <span class="spinner-border spinner-border-sm theme-btn" role="status" aria-hidden="true"></span>
                        <span>{{this.module.id != 0 ? 'Updating':'Saving'}}...</span>
                    </button>

                </div>
            </div>
        </form>
    </div>

    <div class="clearfix">&nbsp;</div>
            
    <template v-if="this.module.id > 0 && this.module.permissions['activity_'+this.module.dir]">
        <activity :module="this.module" ref="child"></activity>
    </template>
</div>
</template>

<script>
import moment from 'moment';

export default {
    
    props:['module'],

    data(){
        return {
            token:$('meta[name="csrf-token"]').attr('content'),
            model_data:[],
            is_save:false,
            // [OptionsData]
        }
    },
    methods: {
        onSubmit() {
            this.is_save = true;
            var data = new FormData($("#[TNAME]_form")[0]);

            axios.post(this.module.store_route, data).then(response => {
                if(response.data.meta.code == 200) {
                    new Message().successMessage(response.data.meta.message);

                    this.$refs.file_upload.submitFiles(this.module.dir, response.data.id);
                    
                    // [GRID_RESET]
                    if(this.module.id == 0) {
                        this.model_data = [];
                        $("#[TNAME]_form")[0].reset();
                        this.$refs.file_upload.files = [];
                        this.$refs.file_upload.name = [];
                    } else {
                        this.activity_init();
                        // // this.$refs.file_upload.init();
                    }
                    this.$root.$emit('[TNAME]Created', response);
                } else {
                    new Message().errorMessage(response.data.meta.message);
                }
                this.is_save = false;

            }).catch(error => {
                var a = '';
                this.is_save = false;
                
                for(var key in error.response.data.errors){
                    a += error.response.data.errors[key][0] + "<br />";
                }
                if(error.response.data.meta) {                    
                    new Message().errorMessage(error.response.data.meta.message);
                } else {
                    new Message().errorMessage(a.replace(/\n/g, "<br />"));
                }
            });
        },

        activity_init() {
            this.$refs.child.init();
        },
    },

    mounted() {
        if(this.module.formData != null) {
            this.model_data = this.module.formData
        }
        // [DropdownSearch]
    }
}
</script>