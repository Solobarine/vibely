<script setup>
import { Link } from "@inertiajs/vue3";

const props = defineProps(["auth", "friend"]);
const friend =
    props.auth.user.id === props.friend.user.id
        ? props.friend.friend
        : props.friend.user;
console.log(props);
</script>

<template>
    <div
        class="relative max-w-[30em] sm:max-w-[20em] rounded-lg shadow-md bg-white w-full"
    >
        <div class="bg-stone-400 py-14 rounded-t-lg"></div>
        <img
            :src="friend.profile_photo_url"
            alt="Friend"
            class="w-[4em] absolute top-20 left-2 aspect-square rounded-full bg-primary"
        />
        <div class="pt-8 px-2 pb-2">
            <Link
                :href="route('user.profile', { username: friend.username })"
                class="block"
                >{{ friend.first_name }} {{ friend.last_name }}</Link
            >
            <small class="font-bold mt-2">@{{ friend.username }}</small>
        </div>
    </div>
</template>
