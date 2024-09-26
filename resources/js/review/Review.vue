<template>
    <div>
        <div v-if="loading">loading ...</div>
        <div v-else>
            <div v-if="alreadyReviewed">
                <h5>you've already reviewed</h5>
            </div>
            <div v-else >
                <div class="form-group">
                    <label class="text-muted">Select the star rating (1 is worst - 5 is best)</label>
                    <rating-star class="fa-3x" v-model="review.rating" ></rating-star>
                </div>
                <div class="form-group">
                    <label for="content" class="text-muted">Describe your experience with</label>
                    <textarea name="content" cols="30" rows="10" class="form-control"></textarea>
                </div>
                <button class="btn btn-lg btn-primary btn-block">Submit</button>
            </div>

        </div>

    </div>
</template>


<script>
export default {
    data() {
        return {
            review: {
                rating: 5,
                content: null
            },
            loading:false ,
            existingReview:null
        };
    },
    created() {
        this.loadin=true
        axios.get(`/api/reviews/${this.$route.params.id}`)
            .then(response=>{ this.existingReview = response.data.data })
            .catch(error=>{})
            .then( ()=>this.loading=false )
    },
    computed:{
        alreadyReviewed(){
            return this.existingReview!==null
        }
    }

}

</script>
