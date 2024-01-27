<script setup>
import { defineProps } from "vue";
import NavigationBar from "@/Components/NavigationBar.vue";
import Menu from "@/Components/Menu.vue";
import Notification from "./Components/Notification.vue";
import Footer from "@/Components/Footer.vue";

const props = defineProps(["notifications"]);

const notifications = props.notifications;
</script>

<template>
    <NavigationBar class="sticky top-0" />
    <section
        class="text-text flex flex-col sm:flex-row sm:items-start min-h-screen bg-gray-200"
    >
        <Menu v-slot="{ toggle, isOpen }">
            <i
                @click="toggle"
                class="fa-solid cursor-pointer text-right transition-all duration-300 ease-in ml-auto w-fit text-2xl absolute lg:hidden"
                :class="{
                    'fa-chevron-right right-3 top-4': isOpen,
                    'fa-bars right-[-1.6em] top-4 text-white bg-primary px-1':
                        !isOpen,
                }"
            ></i>
        </Menu>
        <div class="grow flex flex-col">
            <div class="bg-primary py-24">
                <div
                    class="px-4 py-2 flex items-center justify-between text-white"
                >
                    <i
                        class="fa-solid fa-arrow-left xxs:opacity-0 xxs:pointer-events-all sm:opacicty-1, sm:pointer-events-all"
                    ></i>
                    <h1 class="text-2xl font-bold">Notifications</h1>
                    <i class="fa-solid fa-ellipsis-vertical text-xl"></i>
                </div>
                <div
                    class="flex items-center justify-center flex-wrap gap-x-3 gap-y-1"
                ></div>
            </div>
            <div
                v-if="notifications.length > 0"
                class="grow p-2 flex flex-col gap-1 w-full max-w-[40em] mx-auto"
            >
                <Notification
                    v-for="notification in notifications"
                    :notification="notification"
                    :key="notification"
                />
            </div>
        </div>
    </section>
    <Footer />
</template>
