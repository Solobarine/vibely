<script setup>
import Friend from "../Components/Friend.vue";
defineEmits(["showSplash"]);
const details = [
    {
        fname: "Jerry",
    },
    {
        fname: "Tom",
    },
    {
        fname: "Luke",
    },
    {
        fname: "Terry",
    },
    {
        fname: "Howard",
    },
    {
        fname: "Dest",
    },
    {
        fname: "Jude",
    },
];
</script>

<template>
    <section class="grid gap-1">
        <Friend v-for="i in 7" :key="i" :details="details[i - 1]" />
    </section>
</template>
