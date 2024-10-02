<template>
    <div>
        <fatal-error v-if="error"></fatal-error>
        <success v-if="success"> Thank your for your review ! </success>
        <div v-if="!success && !error" class="row">
            <div
                :class="[{'col-md-4': twoColumns}, {'d-none': oneColumn}]"
            >
                <div class="card">
                    <div class="card-body">
                        <div v-if="loading">Loading...</div>
                        <div v-if="hasBooking">
                            <p>
                                Stayed at
                                <router-link
                                    :to="{name: 'bookable', params: { id: booking.bookable.id}}"
                                >{{ booking.bookable.title }}</router-link>
                            </p>
                            <p>From {{ booking.from }} to {{ booking.to }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div
                :class="[{'col-md-8': twoColumns}, {'col-md-12': oneColumn}]"
            >
                <div v-if="loading">Loading...</div>
                <div v-else>
                    <div v-if="alreadyReviewed">
                        <h3>You've already left a review for this booking!</h3>
                    </div>
                    <div v-else>

                            <div class="form-group">
                                <label class="text-muted">Select the star rating (1 is worst - 5 is best)</label>
                                <rating-star class="fa-3x" v-model="review.rating"></rating-star>
                            </div>
                            <div class="form-group">
                                <label for="content" class="text-muted">Describe your expirience with</label>
                                <textarea
                                    name="content"
                                    cols="30"
                                    rows="10"
                                    class="form-control"
                                    v-model="review.content"
                                    :class="[{'is-invalid':errorFor('content')}]"
                                ></textarea>

                                <v-error v-if="errors" :errors="errorFor('content')"></v-error>

                            </div>


                            <button class="btn btn-lg btn-primary btn-block" @click.prevent="submit" :disabled="sending" >Submit</button>


                    </div>

                </div>
            </div>
        </div>
    </div>

</template>

<script>
import {is404, is422} from "../shared/utils/response";
import ValidationErrors from "../shared/mixins/ValidationErrors";
export default {
    mixins:[ValidationErrors],
    data() {
        return {
            review: {
                id:null,
                rating: 5,
                content: null
            },
            existingReview: null,
            loading: false,
            booking: null ,
            error: false ,
            success: null ,
            sending: false
        };
    },

   async created() {
        this.review.id = this.$route.params.id;
        this.loading = true;
        // 1. If review already exists (in reviews table by id)
       try {
           this.existingReview = (await axios.get(`/api/reviews/${this.review.id}`) ).data.data ;
       }catch (err){
           if ( is404(err) ) {
               try {
                   this.booking = (await axios.get(`/api/bookingsByReview/${this.review.id}`)).data.data;

               }catch (err){
                   this.error = !is404(err)
               }
           }else{
               this.error = true ;
           }
       }

       this.loading = false;



        // 3. Store the review
    },
    computed: {
        alreadyReviewed() {
            return this.hasReview || !this.booking;
        },
        hasReview() {
            return this.existingReview !== null;
        },
        hasBooking() {
            return this.booking !== null;
        },
        oneColumn(){
            return !this.loading && this.alreadyReviewed ;
        },
        twoColumns(){
           return this.loading || !this.alreadyReviewed
        }
    },
    methods :{
       async submit(){
            this.sending = true ;
            this.errors=null;

            try {
                const res =  await axios.post(`/api/reviews`,this.review);

                if (201===res.status){
                    this.success = true
                }
            }catch (err){
                if (is422(err)){
                    const errors = err.response.data.errors
                    if (errors['content'] && _.size(errors) === 1 ) {
                        this.errors=errors ;
                        return;
                    }
                }
                this.error= true;

            }
           this.sending=false;


        },


    }
};
</script>
