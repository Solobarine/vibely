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
        class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-orange-300 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white"
    >
        <div
            v-if="canLogin"
            class="sm:fixed sm:top-0 w-full flex items-center justify-between bg-white sm:end-0 p-4 text-end z-10"
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
                >Posts Feed</Link
            >

            <template v-else>
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
            </template>
        </div>
        <div class="flex flex-wrap xs:flex-nowrap mt-20 p-2 sm:px-8 gap-y-10">
            <div class="grid place-content-center gap-2">
                <h1 class="text-3xl font-bold">
                    <span class="text-6xl">Vibely</span> is now on the web
                </h1>
                <p class="text-lg font-bold">
                    Create Posts, chat and message your friends no matter where
                    you are.
                </p>
                <div
                    class="flex items-center justify-center gap-2 text-gray-200"
                >
                    <Link
                        :href="route('login')"
                        class="bg-gray-800 rounded-lg px-3 py-2"
                    >
                        <i class="fa-solid fa-right-to-bracket"></i>
                        Log in to start
                    </Link>
                    <Link
                        :href="route('register')"
                        class="bg-gray-800 rounded-lg px-3 py-2"
                    >
                        <i class="fa-solid fa-pen-to-square"></i>
                        Register an account
                    </Link>
                </div>
            </div>
            <div class="flex flex-wrap items-center gap-y-3 justify-around">
                <img
                    src="/landing0.jpg"
                    alt=""
                    class="max-w-[15em] sm:w-full xxs:w-[10em]"
                />
                <img
                    src="/landing1.jpg"
                    alt=""
                    class="max-w-[15em] sm:w-full xxs:w-[10em]"
                />
                <img
                    src="/landing2.jpg"
                    alt=""
                    class="max-w-[15em] sm:w-full xxs:w-[10em]"
                />
            </div>
        </div>
    </div>
</template>
