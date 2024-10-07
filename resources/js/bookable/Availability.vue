<template>
    <div>
        <h6 class="text-uppercase text-secondary font-weight-bolder" >check availability
            <span class="text-success" v-if="hasAvailability" style="font-weight: bold"> Available</span>
            <span class="text-danger" v-if="hasNoAvailability" style="font-weight: bold"> Not Available</span>
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
                                'is-invalid': this.errorFor('from')
                            }
                             ]"
                    >
                <v-error :errors="errorFor('from')"></v-error>

            </div>

                <div class="form-group col-md-6">
                    <label for="to">To</label>
                    <input
                        type="text"
                        class="form-control form-control-sm"
                        name="to"
                        v-model="to"
                        @keydown.enter="checkAvailability"
                        :class="[{'is-invalid':this.errorFor('to')}]"
                    >

                    <v-error :errors="errorFor('to')"></v-error>
                </div>

            <button class="btn btn-secondary btn-block" @click="checkAvailability" :disabled="loading" >Check !</button>

        </div>
    </div>

</template>


<script>
import {is422} from "../shared/utils/response";
import ValidationErrors from "../shared/mixins/ValidationErrors";
export default {
    mixins:[ValidationErrors],
    props:{
      bookableId: [String,Number]
    },
    data(){
        return{
            from:  null, // Use fallback in case store is not ready
            to: null,
            loading:false,
            // errors:null,
            status:null
        }
    },
    methods:{
        checkAvailability(){
            this.loading=true;
            this.status=null;
            this.errors=null;

            console.log(this.$store);  // Check if store is accessible

            // this.$store.commit('setLastSearch', { from: this.from, to: this.to });


            axios.get(`/api/bookables/${this.bookableId}/availability?from=${this.from}&to=${this.to}`)
                .then(response=>{
                    this.status=response.status
                })
                .catch(error=>{
                    if (is422(error)){
                        this.errors = error.response.data.errors
                    }
                    this.status = error.response.status;

                })
                .then( () => ( this.loading = false ))
        },
        // errorFor(field){
        //     return this.hasErrors && this.errors[field] ? this.errors[field] :null;
        // }
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
