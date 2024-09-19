

<template>
    <div class="card">
        <div class="card-body">
            <h2 class="card-title">{{itemTitle}}</h2>
            <h5 class="card-title">{{itemContent}} its price is {{itemPrice}}</h5>
        </div>

    </div>
</template>

<script>
export default {
    props: {
        itemTitle: String,
        itemContent: String ,
        itemPrice: Number
    }
}
</script>

