<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Post from "@/Pages/Post/Partials/Post.vue";

import { defineProps } from "vue";

const props = defineProps({
    posts: Array
})
console.log(props.posts)
</script>

<template>
    <AppLayout title="Dashboard">
        <div class="py-12 mx-auto w-full">
            Dashboard
            <div class="mt-6 p-1">
            </div>
        </div>
    </AppLayout>
</template>
