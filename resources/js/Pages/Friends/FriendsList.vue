<script setup>
import { defineProps, ref } from "vue";
import NavigationBar from "@/Components/NavigationBar.vue";
import Friend from "./Components/Friend.vue";
import Menu from "@/Components/Menu.vue";
import Footer from "@/Components/Footer.vue";

const props = defineProps(["auth", "friends", "friend_requests"]);
console.log(props);
const isOpen = ref(true);
const toggle = (value) => {
    isOpen.value = value;
};
</script>

<template>
    <NavigationBar class="sticky top-0 z-40" />
    <section
        class="text-text flex flex-col bg-gray-200 sm:flex-row sm:items-start min-h-screen"
    >
        <Menu v-slot="{ toggle, isOpen }" class="text-text sm:sticky sm:top-10">
            <i
                @click="toggle"
                class="fa-solid cursor-pointer text-right transition-all duration-700 ease-in ml-auto w-fit text-2xl absolute sm:hidden"
                :class="{
                    'fa-chevron-right right-3': isOpen,
                    'fa-bars right-[-1.2em] text-text top-12': !isOpen,
                }"
            ></i>
        </Menu>
        <div class="grow flex flex-col">
            <div class="bg-primary pt-12 pb-3">
                <div
                    class="px-4 py-2 flex items-center justify-between text-white"
                >
                    <i
                        class="fa-solid fa-arrow-left xxs:opacity-0 xxs:pointer-events-all sm:opacicty-1, sm:pointer-events-all"
                    ></i>
                    <h1 class="text-2xl font-bold">Friends</h1>
                    <i class="fa-solid fa-ellipsis-vertical text-xl"></i>
                </div>
                <div
                    class="flex items-center justify-center pt-10 flex-wrap gap-x-3 gap-y-1"
                >
                    <button
                        @click="() => toggle(true)"
                        class="px-3 py-2 text-primary bg-gray-200 rounded-lg"
                    >
                        <i class="fa-solid fa-user-group"></i>
                        Friends
                    </button>
                    <button @click="() => toggle(false)">
                        <i class="fa-regular fa-handshake"></i>
                        Requests
                    </button>
                </div>
            </div>
            <div class="h-full text-text grow min-h-screen px-2 pt-2">
                <div v-if="isOpen">
                    <h1 class="text-center text-lg font-bold py-2">Friends</h1>
                    <div
                        class="flex flex-wrap items-start gap-2 justify-around sm:justify-start"
                    >
                        <Friend
                            v-for="friend in props.friends"
                            :key="friend.id"
                            :friend="friend"
                            :auth="props.auth"
                        />
                    </div>
                </div>
                <div v-else>
                    <h1 class="text-center text-lg font-bold py-2">
                        Friends Request
                    </h1>
                </div>
            </div>
        </div>
    </section>
    <Footer />
</template>
