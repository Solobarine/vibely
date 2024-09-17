<script setup>
const props = defineProps({
    class: {
        type: String,
    },
});
</script>

<template>
    <div
        class="relative min-h-screen flex flex-col justify-center items-start pt-6 sm:pt-0 dark:bg-gray-900 sm:px-20 px-4"
    >
        <img
            src="emoji_bg.png"
            alt=""
            class="absolute inset-0 object-contain w-full max-w-[90vh] top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2"
        />
        <div
            class="w-full my-6 px-6 py-4 bg-gray-100/40 backdrop-blur-sm dark:bg-gray-800/40 shadow-md z-20 overflow-hidden sm:rounded-lg"
            :class="props.class"
        >
            <slot />
        </div>
    </div>
</template>
