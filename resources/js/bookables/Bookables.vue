<template>
    <div class="container">
        Rows : {{rows}}
        <div v-if="loading">
            <div class="spinner-border" role="status">
                <span class="visually-hidden"></span>
            </div>
        </div>
        <div class="row mb-4" v-for="row in rows" :key="'row' + row">
            <div
                class="col d-flex align-items-stretch"
                v-for="(bookable, column) in bookablesInRow(row)"
                :key="'row' + row + column"
            >
                <bookable-item-list
                    :item-title="bookable.title"
                    :item-description="bookable.description"
                    :item-price="1000"
                    :id="bookable.id"
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
        const request = axios.get('/api/bookables')
            .then(result=>{
                this.bookables=result.data.data
                this.loading = false;
            })
    }
}
</script>

