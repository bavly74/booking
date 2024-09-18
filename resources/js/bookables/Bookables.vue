<template>
    <div class="container">
        Rows : {{rows}}
        <div v-if="loading">
            <h2>Items are loading ....</h2>
        </div>

        <div v-else>
            <bookable-item-list v-for="(bookable , index) in bookables"
                                :key="index"
                                :book-title="bookable.title"
                                :book-content="bookable.content"
                                :book-price="bookable.price"
            ></bookable-item-list>
        </div>


    </div>
</template>

<script>
import BookableItemList from "./BookableItemList";

export default {
    components: {
        BookableItemList
    },
    data(){
        return{
            bookables: null ,
            loading:false ,
            columns : 3
        }
    },

    computed: {
      rows(){
          return this.bookables == null ? 0 : Math.ceil(this.bookables.length / this.columns);
      }
    },

    created() {
        this.loading = true;
        setTimeout(()=>{
            this.bookables=[
                {title: "new title 1" , content : "new content 1" , price:1500} ,
                {title: "new title 2" , content : "new content 2" , price:2500},
                {title: "new title 3" , content : "new content 3" , price:3500},
                {title: "new title 1" , content : "new content 1" , price:1500} ,
                {title: "new title 2" , content : "new content 2" , price:2500},
                {title: "new title 3" , content : "new content 3" , price:3500}
            ] ;
            this.loading = false;
        },2000)

    }
}
</script>

