<script setup>
import Chat from '../Components/Chat.vue';
</script>

<template>
    <section class="grid gap-1">
        <Chat v-for="i in 7" :key="i" />
    </section>
</template>

<style scoped>
/* code... */
</style>
