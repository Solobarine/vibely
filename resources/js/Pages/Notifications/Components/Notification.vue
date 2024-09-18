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
        class="p-4 pb-3 rounded-md bg-white dark:bg-gray-700 shadow-sm transition-all duration-200"
        :class="{ 'border border-orange-500': !notification.read_at }"
    >
        <div class="flex items-center justify-between mb-3">
            <div class="flex items-center gap-3">
                <img
                    src="user-female.png"
                    alt="User Avatar"
                    class="w-12 h-12 rounded-full object-cover bg-orange-100"
                />
                <p class="text-gray-800 dark:text-gray-200 font-medium">
                    {{ notification.data.content }}
                </p>
            </div>
            <div class="flex gap-2">
                <Link
                    v-for="link in notification.data.links"
                    :key="link.id"
                    :href="link.link"
                    class="text-white bg-orange-500 hover:bg-orange-600 rounded-lg px-3 py-1 text-sm transition-colors duration-300"
                >
                    {{ link.name }}
                </Link>
            </div>
        </div>
        <div class="flex items-center justify-between mt-3">
            <button
                v-if="!notification.read_at"
                @click.prevent="submit"
                class="mark_read flex items-center gap-2 px-3 py-2 rounded-md bg-gray-100 hover:bg-gray-200 dark:bg-gray-600 dark:hover:bg-gray-500 transition-colors duration-200"
            >
                <ion-icon
                    name="mail-open-outline"
                    class="text-lg text-gray-500"
                ></ion-icon>
                <span
                    class="text-sm font-medium text-gray-600 dark:text-gray-300"
                    >Mark as read</span
                >
            </button>
            <ion-icon
                v-if="notification.read_at"
                name="checkmark-done-outline"
                class="text-xl text-orange-500"
            ></ion-icon>
            <ion-icon
                v-else
                name="alert-circle-outline"
                class="text-xl text-yellow-500"
            ></ion-icon>
        </div>
    </div>
</template>
<style scoped>
/* code... */
</style>
