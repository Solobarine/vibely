<script setup>
import { Link } from "@inertiajs/vue3";
import { ref } from "vue";

const isOpen = ref(false);
const toggle = () => {
    isOpen.value = !isOpen.value;
};

const { href } = window.location;
</script>

<template>
    <div
        class="xxs:fixed z-20 bg-white relative p-4 pt-8 grid gap-5 w-full transition-all duration-500 ease-in shrink-0 min-w-[10em] max-w-[15em] shadow-md shadow-text"
        :class="{ 'right-0': isOpen, 'right-[-15em]': !isOpen }"
    >
        <i
            @click="toggle"
            class="fa-solid cursor-pointer text-right transition-all duration-300 ease-in ml-auto w-fit text-2xl absolute"
            :class="{
                'fa-xmark left-3 top-2': isOpen,
                'fa-bars left-[-1.2em] top-4': !isOpen,
            }"
        ></i>
        <Link
            :href="route('posts')"
            class="hover:text-primary transition duration-200 mt-6"
            :class="route('posts') === href ? 'text-primary' : ''"
        >
            <i class="fa-solid fa-pen"></i>
            Posts
        </Link>
        <Link
            :href="route('messenger')"
            class="hover:text-primary transition duration-200"
            :class="route('messenger') === href ? 'text-primary' : ''"
        >
            <i class="fa-solid fa-message"></i>
            Messenger
        </Link>
        <Link
            :href="route('friends')"
            class="hover:text-primary transition duration-200"
            :class="route('friends') === href ? 'text-primary' : ''"
        >
            <i class="fa-solid fa-user-group"></i>
            Friends
        </Link>
        <Link
            :href="route('post.new')"
            class="hover:text-primary transition duration-200"
            :class="route('post.new') === href ? 'text-primary' : ''"
        >
            <i class="fa-solid fa-pen-to-square"></i>
            New Post
        </Link>
        <Link
            :href="route('notifications')"
            class="hover:text-primary transition duration-200"
            :class="route('notifications') === href ? 'text-primary' : ''"
        >
            <i class="fa-solid fa-bell"></i>
            Notifications
        </Link>
        <Link
            :href="route('userprofile')"
            class="hover:text-primary transition duration-200"
            :class="route('userprofile') === href ? 'text-primary' : ''"
        >
            <i class="fa-solid fa-user"></i>
            Profile
        </Link>
        <Link
            :href="route('profile.show')"
            class="hover:text-primary transition duration-200"
            :class="route('profile.show') === href ? 'text-primary' : ''"
        >
            <i class="fa-solid fa-screwdriver-wrench"></i>
            Settings
        </Link>
        <Link
            :href="route('logout')"
            class="text-red-600 hover:text-red-400 mt-16 transition duration-200"
        >
            <i class="fa-solid fa-arrow-right-from-bracket"></i>
            Logout
        </Link>
    </div>
</template>
