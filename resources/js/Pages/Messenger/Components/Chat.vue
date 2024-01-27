<script setup>
const { details } = defineProps(["details"]);
</script>

<template>
    <div
        @click="
            $parent.$emit('showSplash', { status: true, name: details.name })
        "
        class="flex items-start gap-2 py-3 px-2 bg-white"
    >
        <img
            src="user-female.png"
            alt=""
            class="w-10 shrink-0 grow-0 aspect-square rounded-full bg-primary"
        />
        <div class="grow">
            <div class="grow flex items-center justify-between">
                <p>{{ details.name }}</p>
                <small>Thursday</small>
            </div>
            <small>Let's do this</small>
        </div>
    </div>
</template>

<style scoped>
/* code... */
</style>
