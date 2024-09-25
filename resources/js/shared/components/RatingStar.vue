<template>
    <div class="d-flex">
        <i class="fas fa-star" v-for="star in fullStars" :key="'full' + star" @click="$emit('input',star)" ></i>
        <i class="fas fa-star-half-alt" v-if="halfStar"></i>
        <i class="far fa-star" v-for="star in emptyStars" :key="'empty' + star" @click="$emit('input',fullStars + star)" ></i>
    </div>
</template>
<script>
export default {
    props: {
        value: Number
    },
    computed: {
        halfStar() {
            // let the rating is 3.2
            // 3.2 - floor 3.2 (3)  = 0.2222
            // 0.222 * 100 = 20.222
            // round 20.222 = 20
            // a half star will be displayed

            const fraction = Math.round( ( this.value - Math.floor(this.value) )  *100);
            return fraction > 0 && fraction < 50 ;
        },
        fullStars() {
            // let the rating is 3.2
            //round 3.2 is 3
            //3 half stars will be displayed

            return Math.round(this.value);
        },
        emptyStars() {
            // let the rating is 3.2
            // 5 - ceil 3.2 (3) = 4
            // 1 empty stars will be displayed

            return 5 - (Math.ceil(this.value));
        }
    }
};
</script>
