<script setup>
import Menu from "./Menu.vue";

defineProps({
    toggle: Function,
});
</script>

<template>
    <Menu v-slot="{ toggle, isOpen }">
        <i
            @click="toggle"
            class="fa-solid cursor-pointer text-right transition-all duration-300 ease-in ml-auto w-fit text-2xl absolute lg:hidden"
            :class="{
                'fa-chevron-right right-3 top-4': isOpen,
                'fa-bars right-[-1.5em] bg-gray-200 p-2 rounded-md': !isOpen,
            }"
        ></i>
    </Menu>
</template>
