
<template>
    <div>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <router-link class="navbar-brand" :to="{name:'home'}">Home</router-link>
            <router-link class="nav-link" :to="{name:'second'}">Second</router-link>
        </nav>

        <div class="mb-4 mt-4 "></div>

        <router-view></router-view>
    </div>
</template>

<script setup lang="ts">
</script>
