<script setup>
import { Head } from "@inertiajs/vue3";
import Banner from "@/Components/Banner.vue";
import Friends from "@/Components/Friends.vue";
import Menu from "@/Components/MenuWrapper.vue";
import NavigationBar from "@/Components/NavigationBar.vue";
import Footer from "@/Components/Footer.vue";

defineProps({
    title: String,
});
</script>

<template>
    <div>
        <Head :title="title" />

        <Banner />

        <NavigationBar class="sticky top-0 z-40" />

        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            <!-- Page Content -->
            <main class="flex items-start shrink-0 gap-4">
                <Menu class="text-text lg:sticky lg:top-[4em]">
                    <i
                        @click="toggle"
                        class="fa-solid cursor-pointer text-right bg-white p-1 rounded-md transition-all duration-700 ease-in ml-auto w-fit text-2xl absolute sm:hidden"
                        :class="{
                            'fa-chevron-right right-3': isOpen,
                            'fa-bars right-[-1.2em] text-text top-12': !isOpen,
                        }"
                    ></i>
                </Menu>
                <slot />
                <Friends class="lg:sticky lg:top-0" />
            </main>
            <Footer />
        </div>
    </div>
</template>
