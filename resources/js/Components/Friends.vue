<script setup>
import { ref } from "vue";

const isOpen = ref(true);
const toggle = () => {
    isOpen.value = !isOpen.value;
};
</script>

<template>
    <div
        class="xxs:fixed p-4 grid gap-4 bg-white shadow-md z-10 transition-all duration-500 ease-in shadow-text w-full max-w-[20em] lg:sticky lg:top-[4em]"
        :class="{
            'right-[-100%] right-1': isOpen,
            'top-[4em] right-1': !isOpen,
        }"
    >
        <div class="flex items-center justify-between pb-2">
            <h1>Friends</h1>
            <i
                @click="toggle"
                class="fa-solid lg:hidden text-lg text-text cursor-pointer"
                :class="{
                    'fa-users fixed right-1 bg-gray-200 p-1 rounded': isOpen,
                    'fa-xmark static right-0 bg-transparent': !isOpen,
                }"
            ></i>
        </div>
        <div v-for="i in 6" class="flex items-center gap-2">
            <img
                src="user-male.png"
                alt=""
                class="w-10 aspect-square rounded-full bg-primary"
            />
            <div>
                <p>Jackson Myers</p>
                <small>@jmyers</small>
            </div>
        </div>
    </div>
</template>
