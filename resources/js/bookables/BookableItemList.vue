

<template>
    <div class="card">
        <div class="card-body">
            <h2 class="card-title">{{bookTitle}}</h2>
            <h5 class="card-title">{{bookContent}} its price is {{bookPrice}}</h5>
        </div>

    </div>
</template>

<script>
export default {
    props: {
        bookTitle: String,
        bookContent: String ,
        bookPrice: Number
    }
}
</script>

