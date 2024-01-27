<script setup>
const { details } = defineProps(["details"]);
</script>

<template>
    <div
        @click="
            $parent.$emit('showSplash', { status: true, name: details.fname })
        "
        class="flex p-2 py-3 items-center gap-3 bg-white"
    >
        <img
            src="user-male.png"
            alt=""
            class="w-10 shrink-0 grow-0 rounded-full bg-primary"
        />
        <p class="text-lg">{{ details.fname }} Sharp</p>
    </div>
</template>

<style scoped>
/* code... */
</style>
