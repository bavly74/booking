<template>
    <div>
        <h6 class="text-uppercase text-secondary font-weight-bolder" >check availability
            <transition>
                <span class="text-success" v-if="hasAvailability" style="font-weight: bold"> Available</span>
                <span class="text-danger" v-if="hasNoAvailability" style="font-weight: bold"> Not Available</span>
            </transition>

        </h6>
        <div class="row">
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

            <button class="mt-4 btn btn-secondary btn-block" @click="checkAvailability" :disabled="loading" >

                <loading :loading="loading"></loading>

            </button>



        </div>
    </div>

</template>


<script>
import {is422} from "../shared/utils/response";
import ValidationErrors from "../shared/mixins/ValidationErrors";
import loading from "../shared/components/loading";
import PriceBreakDown from "./PriceBreakDown.vue";
export default {
    components:{
        PriceBreakDown,
        loading
    },
    mixins:[ValidationErrors],
    props:{
      bookableId: [String,Number]
    },
    data(){
        return{
            from:  this.$store.state.lastSearch.from, // Use fallback in case store is not ready
            to: this.$store.state.lastSearch.to,
            loading:false,
            // errors:null,
            status:null,
        }
    },
    methods:{

        async checkAvailability(){
           this.$store.dispatch("setLastSearch",{
                from:this.from,
                to:this.to
            });
            this.loading=true;
            this.status=null;
            this.errors=null;

            try {
                this.status = (await axios.get(`/api/bookables/${this.bookableId}/availability?from=${this.from}&to=${this.to}`)).status

                this.$emit("availability", this.hasAvailability);
            }catch (err){
                if (is422(err)){
                    this.errors = err.response.data.errors
                }
                this.status = err.response.status;
                this.$emit("availability", this.hasAvailability);
            }
            this.loading = false

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
    },

}
</script>
