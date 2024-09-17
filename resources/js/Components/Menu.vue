<script setup>
import { Link, useForm } from "@inertiajs/vue3";
import { ref } from "vue";
const isOpen = ref(false);
const form = useForm({});
const toggle = () => {
    isOpen.value = !isOpen.value;
};

const logout = () =>
    form.post(route("logout"), {
        onSuccess: () => {
            console.log("Logout Successful");
        },
    });
const { href } = window.location;
</script>

<template>
    <div
        class="xxs:fixed z-20 bg-white relative p-4 w-full dark:text-white dark:bg-gray-700 transition-all duration-500 ease-in shrink-0 min-w-[10em] max-w-[15em] shadow-text lg:static flex flex-col gap-3 self-stretch"
        :class="{ 'left-0': isOpen, 'left-[-15em]': !isOpen }"
    >
        <slot :toggle="toggle" :isOpen="isOpen" />
        <Link
            :href="route('posts')"
            class="hover:text-primary transition duration-200 mt-6 flex items-center py-2 gap-2"
            :class="route('posts') === href ? 'text-primary' : ''"
        >
            <i class="fa-solid fa-pen"></i>
            Posts
        </Link>
        <Link
            :href="route('messenger')"
            class="hover:text-primary transition duration-200 flex items-center py-2 gap-2"
            :class="route('messenger') === href ? 'text-primary' : ''"
        >
            <i class="fa-solid fa-message"></i>
            Messenger
        </Link>
        <Link
            :href="route('friends')"
            class="hover:text-primary transition duration-200 flex items-center py-2 gap-2"
            :class="route('friends') === href ? 'text-primary' : ''"
        >
            <i class="fa-solid fa-user-group"></i>
            Friends
        </Link>
        <Link
            :href="route('post.new')"
            class="hover:text-primary transition duration-200 flex items-center py-2 gap-2"
            :class="route('post.new') === href ? 'text-primary' : ''"
        >
            <i class="fa-solid fa-pen-to-square"></i>
            New Post
        </Link>
        <Link
            :href="route('notifications')"
            class="hover:text-primary transition duration-200 flex items-center py-2 gap-2"
            :class="route('notifications') === href ? 'text-primary' : ''"
        >
            <i class="fa-solid fa-bell"></i>
            Notifications
        </Link>
        <Link
            :href="route('userprofile')"
            class="hover:text-primary transition duration-200 flex items-center py-2 gap-2"
            :class="route('userprofile') === href ? 'text-primary' : ''"
        >
            <i class="fa-solid fa-user"></i>
            Profile
        </Link>
        <Link
            :href="route('profile.show')"
            class="hover:text-primary transition duration-200 flex items-center py-2 gap-2"
            :class="route('profile.show') === href ? 'text-primary' : ''"
        >
            <i class="fa-solid fa-screwdriver-wrench"></i>
            Settings
        </Link>
        <button
            @click.prevent="logout"
            class="text-red-600 hover:text-red-400 mt-20 dark:text-red-400 transition duration-200 flex items-center py-2 gap-2"
        >
            <i class="fa-solid fa-arrow-right-from-bracket"></i>
            Logout
        </button>
    </div>
</template>
