
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
                    <ReviewList :bookable-id="this.$route.params.id"></ReviewList>
                </div>

                <div class="col-md-4 pt-4">
                    <availability :bookable-id="this.$route.params.id" @availability="checkPrice($event)" ></availability>

                    <transition>
                        <PriceBreakDown  class="mb-4 mt-4" :price="this.price" v-if="this.price"></PriceBreakDown>
                    </transition>

                    <transition>
                        <button class="btn btn-outline-secondary btn-block" style="width: 100%" v-if="this.price" @click="addToBasket" :disabled="inBasketAlready" > Book now </button>
                    </transition>
                    <br>
                    <button
                        class="btn btn-outline-secondary mt-4" style="width: 100%;"
                        v-if="inBasketAlready"
                        @click="removeFromBasket"
                    >Remove from basket</button>
                    <div
                        v-if="inBasketAlready"
                        class="mt-4 text-muted warning"
                    >Seems like you've added this object to basket already. If you want to change dates, remove from the basket first.</div>

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
import ReviewList from "./ReviewList.vue";
import PriceBreakDown from "./PriceBreakDown.vue";
import {mapState} from "vuex";
export default {

    components :{
        Availability,
        ReviewList ,
        PriceBreakDown
    },

    data(){
        return{
            bookable:null,
            loading:false,
            price:null ,

        }
    },

    created(){
        this.loading =true
        const request=axios.get(`/api/bookables/${this.$route.params.id}`)
           .then(response=>{
               this.bookable = response.data.data
               // console.log(this.bookable)
               this.loading =false
           })
    },
    methods:{
      async checkPrice(hasAvailability){

            if (!hasAvailability){
               this.price=null ;
               return ;
            }
            try {
                this.price = (await axios.get(`/api/bookables/${this.bookable.id}/price?from=${this.lastSearch.from}&to=${this.lastSearch.to}`)).data.data

            }catch (err){
                this.price=null


            }

        },
        addToBasket(){
          this.$store.commit("addToBasket",{
              bookable: this.bookable,
              price: this.price ,
              dates: this.lastSearch
          });

        },
        removeFromBasket() {
            this.$store.commit("removeFromBasket", this.bookable.id);
        }
    },
    computed: {
        ...mapState({
            lastSearch: "lastSearch"
        }),
        inBasketAlready() {
            if (null === this.bookable) {
                return false;
            }
            return this.$store.getters.inBasketAlready(this.bookable.id);
        }
    },
}
</script>
