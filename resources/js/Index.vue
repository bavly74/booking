
<template>

    <div>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <router-link to="/" class="navbar-brand" href="#">Booking</router-link>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li>
                        <router-link class="btn nav-button" :to="{name: 'basket'}">
                            Basket
                            <span v-if="itemsInTheBasket" class="badge bg-secondary">{{ itemsInTheBasket }}</span>
                        </router-link>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container mt-4 mb-4 pr-4 pl-4">
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
import {mapState , mapGetters} from "vuex";

export default {
    data(){
        return{
            lastSearch: this.$store.state.lastSearch
        }
    },
    computed:{
      ...mapState({
          lastSearchComputed: 'lastSearch'
       }),
        ...mapGetters({
          itemsInTheBasket: 'itemsInTheBasket'
        })
    }
}
</script>
