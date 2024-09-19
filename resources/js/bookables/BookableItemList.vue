

<template>
    <div class="card">
        <div class="card-body">
            <router-link :to="{ name:'bookable' , params: {id} }">
                <h2 class="card-title">{{itemTitle}}</h2>
            </router-link>
            <h5 class="card-title">{{itemDescription}} its price is {{itemPrice}}</h5>
        </div>

    </div>
</template>

<script>
export default {
    props: {
        itemTitle: String,
        itemDescription: String ,
        itemPrice: Number ,
        id: Number
    }
}
</script>

