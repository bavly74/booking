
<template>
    <div class="container">
        <div v-if="!loading">
            <div class="row">
                <div class="col-md-8 pt-4">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title">{{bookable.title}}</h5>
                            <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
                            <p class="card-text">{{bookable.description}}</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 pt-4">
                    <availability></availability>
                </div>
            </div>

        </div>


        <div v-else>
            <div class="spinner-border" role="status">
                <span class="visually-hidden"></span>
            </div>
        </div>

    </div>



</template>

<script>
import Availability from "./Availability";
export default {

    components :{
        Availability
    },

    data(){
        return{
            bookable:null,
            loading:false
        }
    },

    created(){
        this.loading =true
        const request=axios.get(`/api/bookables/${this.$route.params.id}`)
           .then(response=>{
               this.bookable = response.data.data
               console.log(this.bookable)
               this.loading =false
           })
    }

}
</script>
