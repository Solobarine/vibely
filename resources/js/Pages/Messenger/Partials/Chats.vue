<script setup>
import Chat from "../Components/Chat.vue";

defineEmits(["showSplash"]);
const details = [
    {
        name: "Jerry Sienfeld",
    },
    {
        name: "Tom Hanks",
    },
    {
        name: "Luke Faring",
    },
    {
        name: "Terry Crews",
    },
    {
        name: "Howard Stern",
    },
    {
        name: "Dest Johnson",
    },
    {
        name: "Jude Foster",
    },
];
</script>

<template>
    <section class="grid gap-1">
        <Chat v-for="i in 7" :key="i" :details="details[i - 1]" />
    </section>
</template>

<style scoped>
/* code... */
</style>
