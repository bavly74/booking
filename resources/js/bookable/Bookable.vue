
<template>
    <div class="container">
            <div class="col-md-8">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">{{bookable.title}}</h5>
                        <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
                        <p class="card-text">{{bookable.description}}</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
            </div>


    </div>
</template>

<script>
export default {
    data(){
        return{
            bookable:null
        }
    },
    created(){
       const request=axios.get(`/api/bookable/${this.$route.params.id}`)
           .then(response=>{
               this.bookable = response.data

           })
    }
}
</script>
