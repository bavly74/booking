<template>
    <div>
        <h6 class="text-uppercase text-secondary font-weight-bolder" >check availability</h6>
        <div class="form-row">
            <div class="form-group col-md-6" >

                    <label for="from">From</label>
                    <input type="date" class="form-control form-control-sm" name="from" v-model="from" @keydown.enter="checkAvailability">

            </div>

                <div class="form-group col-md-6">
                    <label for="to">To</label>
                    <input type="date" class="form-control form-control-sm" name="to" v-model="to" @keydown.enter="checkAvailability" >
                </div>

            <button class="btn btn-secondary btn-block" @click="checkAvailability">Check !</button>

        </div>
    </div>

</template>


<script>
export default {
    data(){
        return{
            from:null,
            to:null
        }
    },
    methods:{
        checkAvailability(){
            alert('im check')
        }
    }
}
</script>
