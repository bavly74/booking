<template>
    <div class="container">
        Rows : {{rows}}


        <div v-if="loading">
            <h2>Items are loading ....</h2>
        </div>
        <div class="row mb-4" v-for="row in rows" :key="'row' + row">
            <div
                class="col"
                v-for="(bookable, column) in bookablesInRow(row)"
                :key="'row' + row + column"
            >
                <bookable-item-list
                    :item-title="bookable.title"
                    :item-content="bookable.content"
                    :item-price="1000"
                ></bookable-item-list>
            </div>
            <div class="col" v-for="p in placeholdersInRow(row)" :key="'placeholder' + row + p"></div>
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
    methods: {
        bookablesInRow(row) {
            return this.bookables.slice((row - 1) * this.columns, row * this.columns);
        },
        placeholdersInRow(row) {
            return this.columns - this.bookablesInRow(row).length;
        }
    },
    created() {
        this.loading = true;
        setTimeout(()=>{
            this.bookables=[
                {title: "new title 1" , content : "new content 1" , price:1500} ,
                {title: "new title 2" , content : "new content 2" , price:2500} ,
                {title: "new title 3" , content : "new content 3" , price:3500} ,
                {title: "new title 1" , content : "new content 1" , price:1500} ,
                {title: "new title 2" , content : "new content 2" , price:2500} ,
                {title: "new title 3" , content : "new content 3" , price:3500} ,
                {title: "new title 3" , content : "new content 3" , price:3500}

            ] ;
            this.loading = false;
        },2000)

    }
}
</script>

