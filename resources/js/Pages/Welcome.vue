<script setup>
import { Head, Link } from "@inertiajs/vue3";
import ApplicationMark from "@/Components/ApplicationMark.vue";

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
});
</script>

<template>
    <Head title="Welcome" />

    <div
        class="relative min-h-screen dark:text-white bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white"
    >
        <div
            v-if="canLogin"
            class="sticky top-0 w-full flex items-center justify-between bg-white dark:bg-gray-800 sm:end-0 p-4 text-end z-10"
        >
            <div class="flex items-center shrink-0 sm:ml-4">
                <Link :href="route('posts')">
                    <ApplicationMark class="block w-auto h-9" />
                </Link>
            </div>
            <Link
                v-if="$page.props.auth.user"
                :href="route('posts')"
                class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                >Feed</Link
            >

            <template v-else>
                <div class="flex items-center gap-3">
                    <Link
                        :href="route('login')"
                        class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                        >Log in</Link
                    >

                    <Link
                        v-if="canRegister"
                        :href="route('register')"
                        class="ms-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                        >Register</Link
                    >
                </div>
            </template>
        </div>
        <div
            class="flex flex-wrap relative sm:px-10 p-2 justify-between max-w-full"
        >
            <div class="grow max-w-xl sticky left-0 z-20 sm:pt-20 pt-3">
                <h1 class="text-5xl">Discover Your Perfect Social Space</h1>
                <p class="text-sm mt-2">
                    Join a vibrant community where your interests come alive.
                    Connect, share, and explore with like-minded individuals in
                    a space designed just for you. Dive into engaging
                    conversations, find inspiration, and make lasting
                    connections. Your new favorite social hub awaits!
                </p>
                <div class="flex flex-wrap gap-3 py-10">
                    <Link
                        :href="route('register')"
                        class="px-4 py-2 rounded-lg shadow-md bg-orange-500 text-white"
                        >Get Started</Link
                    >
                    <Link
                        :href="route('login')"
                        class="px-4 py-2 rounded-lg shadow-md bg-zinc-500 text-white"
                        >Login</Link
                    >
                </div>
            </div>
            <img
                src="emoji_bg.png"
                alt="A Rainbow of emojis"
                className="absolute right-4 grow h-full max-w-[90vh] object-contain"
            />
        </div>
    </div>
</template>
