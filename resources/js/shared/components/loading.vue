
<template>
    <div>
        <span v-if="!loading">Check !</span>

        <span v-if="loading"> <i class="fa-solid fa-circle-notch fa-spin"></i> checking...</span>
    </div>
</template>




<script>
export default {
    props: {
        loading:Boolean
    }
}
</script>

