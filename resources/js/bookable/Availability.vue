<template>
    <div>
        <h6 class="text-uppercase text-secondary font-weight-bolder" >check availability
            <span class="text-success" v-if="this.hasAvailability" style="font-weight: bold"> Available</span>
            <span class="text-danger" v-if="this.hasNoAvailability" style="font-weight: bold"> Not Available</span>
        </h6>
        <div class="form-row">
            <div class="form-group col-md-6" >
                    <label for="from">From</label>
                    <input
                        type="text"
                        class="form-control form-control-sm"
                        name="from"
                        v-model="from"
                        @keydown.enter="checkAvailability"
                        :class="[
                            {
                                'is-invalid': this.displayErrors('from')
                            }
                             ]"
                    >
                <div class="invalid-feedback" v-for="(error , index) in this.displayErrors('from')" :key="'from'+ index" >
                    {{error}}
                </div>
            </div>

                <div class="form-group col-md-6">
                    <label for="to">To</label>
                    <input
                        type="text"
                        class="form-control form-control-sm"
                        name="to"
                        v-model="to"
                        @keydown.enter="checkAvailability"
                        :class="[{'is-invalid':this.displayErrors('to')}]"
                    >
                    <div class="invalid-feedback" v-for="(error , index) in this.displayErrors('to')" :key="'to'+ index" >
                        {{error}}
                    </div>
                </div>

            <button class="btn btn-secondary btn-block" @click="checkAvailability" :disabled="loading" >Check !</button>

        </div>
    </div>

</template>


<script>
export default {
    data(){
        return{
            from:null,
            to:null,
            loading:false,
            errors:null,
            status:null
        }
    },
    methods:{
        checkAvailability(){
            this.loading=true;
            this.status=null;
            this.errors=null;

            axios.get(`/api/bookables/${this.$route.params.id}/availability?from=${this.from}&to=${this.to}`)
                .then(response=>{
                    this.status=response.status
                })
                .catch(error=>{
                    if (422 === error.response.status ){
                        this.errors = error.response.data.errors
                    }
                    this.status = error.response.status;

                })
                .then( () => ( this.loading = false ))
        },
        displayErrors(field){
            return this.hasErrors && this.errors[field] ? this.errors[field] :null;
        }
    },
    computed:{
        hasErrors(){
            return 422 === this.status && this.errors!=null ;
        },
        hasAvailability(){
            return 200 === this.status ;
        },
        hasNoAvailability(){
            return 404 === this.status ;
        }
    }
}
</script>
