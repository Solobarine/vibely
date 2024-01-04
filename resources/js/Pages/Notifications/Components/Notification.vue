<script setup lang="ts">
import { Link, useForm } from "@inertiajs/vue3";
import { ref, defineProps } from "vue";

const props = defineProps(["notification"]);

const notification = props.notification;

const markAsReadForm = useForm({
    notification_id: notification.id,
});

const submit = () => {
    console.log("here");
    markAsReadForm.post(route("notification.mark.read"), {
        preserveScroll: true,
    });
};

console.log(notification);
</script>

<template>
    <div
        class="p-2 pb-1 rounded-md bg-white"
        :class="{ 'border border-primary': !notification.read_at }"
    >
        <div class="flex flex-wrap items-center justify-between gap-2">
            <div class="flex items-center gap-2 mb-2">
                <img
                    src="user-female.png"
                    alt=""
                    class="w-10 aspect-square rounded-full bg-primary slot"
                />
                <p>{{ notification.data.content }}</p>
            </div>
            <div>
                <Link
                    v-for="link in notification.data.links"
                    :href="link.link"
                    class="text-white bg-primary rounded-lg p-2"
                    >{{ link.name }}</Link
                >
            </div>
        </div>
        <div class="flex items-center justify-between">
            <button
                @click.prevent="submit"
                class="mark_read grid gap-1 place-items-center p-2 rounded-md relative"
            >
                <ion-icon name="mail-open-outline" class="text-xl"></ion-icon>
                <span class="is_read_text">Mark as read</span>
            </button>
            <ion-icon
                v-if="notification.read_at"
                name="checkmark-done-outline"
                class="text-primary"
            ></ion-icon>
            <ion-icon
                v-else
                name="alert-circle-outline"
                class="text-primary"
            ></ion-icon>
        </div>
    </div>
</template>

<style scoped>
/* code... */
</style>
