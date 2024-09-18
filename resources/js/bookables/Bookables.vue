<template>
    <div class="container">
        Rows : {{rows}}


        <div v-if="loading">
            <h2>Items are loading ....</h2>
        </div>

        <div class="row" v-for="row in rows" :key=" 'row' +row" v-else>
            <div class="col"
                 v-for="bookable in calculateItemsInARow(row)"
                 :key="'bookable'+bookable"
            >
                <bookable-item-list
                    :book-title="bookable.title"
                    :book-content="bookable.content"
                    :book-price="bookable.price"
                ></bookable-item-list>

            </div>
            {{addPlaceholder(row)}}

<!--            <div class="col" v-for="p in addPlaceholder(row)" :key="'p'+p"></div>-->
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
    methods :{
      calculateItemsInARow (row){
          return this.bookables.slice((row-1) * this.columns , row * this.columns)
      },

        addPlaceholder(row){
            return this.columns - this.calculateItemsInARow(row).lenght;
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

