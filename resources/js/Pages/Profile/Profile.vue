<script setup>
import { Link, useForm } from "@inertiajs/vue3";
import { defineProps, ref } from "vue";
import Post from "@/Pages/Post/Partials/Post.vue";
import NavigationBar from "@/Components/NavigationBar.vue";
import Menu from "@/Components/Menu.vue";
import Footer from "@/Components/Footer.vue";

const props = defineProps([
    "user",
    "auth",
    "posts_count",
    "likes_count",
    "friends_count",
    "posts",
    "is_friend",
    "pending_friend_request",
    "followers_count",
    "following",
    "is_following",
    "error",
    "data",
]);

const option = ref(false);

const form = useForm({
    condition: "",
    friend_id: props.user.id,
    friend_request_id: props.pending_friend_request
        ? props.pending_friend_request.id
        : null,
});

console.log(props);
const friendResponse = ref({
    status: false,
    data: "",
    condition: "",
});

const submit = async (condition, route_name) => {
    form.transform((data) => ({
        ...data,
        condition,
    })).post(route(route_name), {});
};

const toggle = () => {
    option.value = !option.value;
};
</script>

<template>
    <NavigationBar class="sticky top-0 z-50" />
    <section class="flex bg-gray-100 dark:bg-gray-700 min-h-screen">
        <Menu v-slot="{ toggle, isOpen }">
            <i
                @click="toggle"
                class="fa-solid cursor-pointer transition-transform duration-300 ease-in ml-auto text-2xl absolute lg:hidden right-4 top-4"
                :class="isOpen ? 'fa-chevron-right rotate-90' : 'fa-bars'"
            ></i>
        </Menu>

        <div class="w-full mx-auto px-4 py-6">
            <div v-if="error" class="text-center">
                <p class="text-red-600 text-lg font-semibold">
                    {{ props.data }}
                </p>
            </div>

            <div
                class="relative bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6 w-full"
            >
                <!-- Header with Background Image -->
                <div
                    class="relative bg-gradient-to-r from-amber-600 to-orange-600 rounded-lg h-40 mb-6"
                >
                    <img
                        :src="props.user.profile_photo_url"
                        alt="Profile"
                        class="absolute w-24 h-24 rounded-full border-4 border-white left-1/2 transform -translate-x-1/2 bottom-0 -mb-12"
                    />
                </div>

                <!-- User Info -->
                <div class="text-center mt-16">
                    <h2
                        class="text-3xl font-bold text-gray-900 dark:text-white"
                    >
                        {{ props.user.first_name }} {{ props.user.last_name }}
                    </h2>
                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        @{{ props.user.username }}
                    </p>
                    <p
                        class="mt-4 text-lg text-gray-700 dark:text-gray-300 font-semibold"
                    >
                        {{ props.friends_count }}
                        {{ props.friends_count === 1 ? "Friend" : "Friends" }}
                    </p>

                    <!-- Stats Grid -->
                    <div
                        class="grid grid-cols-4 mt-6 gap-6 text-center text-gray-800 dark:text-gray-200"
                    >
                        <div>
                            <h3 class="text-2xl font-semibold">
                                {{ props.posts_count }}
                            </h3>
                            <p class="text-sm">Posts</p>
                        </div>
                        <div>
                            <h3 class="text-2xl font-semibold">
                                {{ props.followers_count }}
                            </h3>
                            <p class="text-sm">
                                {{
                                    props.followers_count === 1
                                        ? "Follower"
                                        : "Followers"
                                }}
                            </p>
                        </div>
                        <div>
                            <h3 class="text-2xl font-semibold">
                                {{ props.following }}
                            </h3>
                            <p class="text-sm">Following</p>
                        </div>
                        <div>
                            <h3 class="text-2xl font-semibold">40K</h3>
                            <p class="text-sm">Likes</p>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-center gap-4 mt-8">
                    <Link
                        v-if="user.id === props.auth.user.id"
                        :href="route('profile.show')"
                        class="btn btn-primary"
                    >
                        Edit Profile
                    </Link>
                    <Link :href="route('messenger')" class="btn btn-outline"
                        >Message</Link
                    >
                </div>

                <!-- Post Section -->
                <div class="posts-section mt-10">
                    <h3
                        class="text-2xl text-gray-800 dark:text-gray-200 font-bold mb-4"
                    >
                        Posts
                    </h3>
                    <div
                        v-if="props.posts.length > 0"
                        class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3"
                    >
                        <Post
                            v-for="post in props.posts"
                            :key="post.id"
                            :post="post"
                            class="post-card bg-white dark:bg-gray-900 p-4 rounded-lg shadow-lg"
                        />
                    </div>
                    <p
                        v-else
                        class="text-center text-red-600 dark:text-red-400 font-bold"
                    >
                        No Posts Available
                    </p>
                </div>
            </div>
        </div>
    </section>
    <Footer />
</template>
