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
    <NavigationBar class="sticky top-0 z-40" />
    <section
        class="text-text flex flex-col bg-gray-200 sm:flex-row sm:items-start min-h-screen"
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
        <div v-if="error" class="grow">
            <p class="text-rose-500 text-xl font-bold text-center mt-6">
                {{ props.data }}
            </p>
        </div>
        <div v-else class="grow sticky top-0">
            <p v-if="friendResponse.status">{{ friendResponse.data }}</p>
            <div
                class="relative flex flex-row items-center justify-between py-24 px-4 text-white bg-primary"
            >
                <Link :href="route('posts')">
                    <i class="fa-solid fa-arrow-left text-3xl"></i>
                </Link>
                <p class="text-2xl font-bold">@{{ props.user.username }}</p>
                <i
                    @click="toggle"
                    class="fa-solid fa-ellipsis-vertical text-3xl cursor-pointer"
                ></i>
                <div
                    class="grid bg-gray-200 text-text w-full max-w-[15em] transition-all duration-500 ease-in right-2 top-[60%] gap-2 py-3 px-2 rounded-lg shadow-lg shadow-gray-500 z-50"
                    :class="{
                        'absolute scale-1': option,
                        'absolute scale-0': !option,
                    }"
                >
                    <button
                        class="flex items-center gap-2 p-2 hover:bg-stone-500 hover:text-white"
                    >
                        <i class="fa-solid fa-pen-nib"></i>
                        Update Profile
                    </button>
                    <button
                        class="flex items-center gap-2 p-2 hover:bg-stone-500 hover:text-white"
                    >
                        <i class="fa-solid fa-user-plus"></i>
                        Follow Andre
                    </button>
                    <button
                        class="flex items-center gap-2 p-2 hover:bg-stone-500 hover:text-white"
                    >
                        <i class="fa-solid fa-user-minus"></i>
                        Unfollow Andre
                    </button>
                    <button
                        class="flex items-center gap-2 p-2 hover:bg-stone-500 hover:text-white"
                    >
                        <i class="fa-solid fa-user-minus"></i>
                        Message Andre
                    </button>
                    <button
                        class="flex items-center gap-2 p-2 hover:bg-stone-500 hover:text-white"
                    >
                        <i class="fa-solid fa-user-minus"></i>
                        Befriend Andre
                    </button>
                    <button
                        class="flex items-center gap-2 p-2 hover:bg-stone-500 hover:text-white"
                    >
                        <i class="fa-solid fa-user-minus"></i>
                        Unfriend Andre
                    </button>
                </div>
            </div>
            <div class="relative">
                <img
                    :src="props.user.profile_photo_url"
                    alt=""
                    class="absolute w-32 aspect-square left-2/4 rounded-full translate-x-[-50%] translate-y-[-50%]"
                />
            </div>
            <div class="p-4 pt-16">
                <h2 class="text-center text-2xl font-bold py-4">
                    {{ props.user.first_name }} {{ props.user.last_name }}
                </h2>
                <p class="text-center font-bold text-lg py-2">
                    {{
                        `${props.friends_count} ${
                            props.friends_count === 1 ? "Friend" : "Friends"
                        }`
                    }}
                </p>
                <div class="grid grid-cols-4 py-4 divide-x divide-primary">
                    <div class="grid place-items-center gap-1">
                        <h1 class="text-2xl font-bold">
                            {{ props.posts_count }}
                        </h1>
                        <small>Posts</small>
                    </div>
                    <div class="grid place-items-center gap-1">
                        <h1 class="text-2xl font-bold">
                            {{ props.followers_count }}
                        </h1>
                        <small>{{
                            props.followers_count === 1
                                ? "Follower"
                                : "Followers"
                        }}</small>
                    </div>
                    <div class="grid place-items-center gap-1">
                        <h1 class="text-2xl font-bold">
                            {{ props.following }}
                        </h1>
                        <small>Following</small>
                    </div>
                    <div class="grid place-items-center gap-1">
                        <h1 class="text-2xl font-bold">40K</h1>
                        <small>Likes</small>
                    </div>
                </div>
                <div class="flex items-center justify-center gap-2">
                    <div
                        v-if="user.id === props.auth.user.id"
                        class="flex items-center justify-center gap-8 p-3"
                    >
                        <Link
                            :href="route('profile.show')"
                            class="flex items-center gap-2 text-sm bg-primary text-white px-3 py-2 rounded-2xl"
                            ><i class="fa-solid fa-pen-nib"></i> Edit
                            Profile</Link
                        >
                        <Link
                            :href="route('post.new')"
                            class="flex items-center gap-2 text-sm bg-white text-primary px-3 py-2 rounded-2xl border border-primary"
                            ><i class="fa-solid fa-pen-to-square"></i> Create
                            Post</Link
                        >
                    </div>
                    <div
                        v-if="props.is_friend"
                        class="flex items-center gap-3 justify-center"
                    >
                        <Link
                            :href="route('messenger')"
                            class="flex items-center gap-2 text-sm bg-white text-primary px-3 py-2 rounded-2xl border border-primary"
                        >
                            <i class="fa-solid fa-pen-to-square"></i>
                            Message
                        </Link>
                        <button
                            :href="route('friend.delete', props.user.id)"
                            class="flex items-center gap-2 text-sm bg-white text-primary px-3 py-2 rounded-2xl border border-primary"
                        >
                            <i class="fa-solid fa-pen-to-square"></i>
                            Unfriend
                        </button>
                    </div>
                    <div
                        v-if="
                            props.user.id !== props.auth.user.id &&
                            !props.pending_friend_request
                        "
                    >
                        <button
                            v-if="
                                !props.pending_friend_request &&
                                !props.is_friend
                            "
                            @click="() => submit('send', 'friends.request')"
                            class="flex items-center gap-2 text-sm bg-white text-primary mx-auto px-3 py-2 rounded-2xl border border-primary"
                        >
                            <i class="fa-solid fa-pen-to-square"></i>
                            Send Request
                        </button>
                    </div>
                    <div v-if="props.pending_friend_request">
                        <button
                            v-if="
                                props.pending_friend_request.sender_id ===
                                props.auth.user.id
                            "
                            @click="() => submit('cancel', 'friends.request')"
                            class="flex items-center gap-2 text-sm bg-white text-primary mx-auto px-3 py-2 rounded-2xl border border-primary"
                        >
                            <i class="fa-solid fa-ban"></i>
                            Cancel Request
                        </button>
                        <div
                            v-if="
                                props.pending_friend_request &&
                                props.pending_friend_request.receiver_id ===
                                    props.auth.user.id
                            "
                            class="flex items-center justify-center gap-4"
                        >
                            <button
                                @click="
                                    () => submit('accept', 'friends.request')
                                "
                                class="flex items-center gap-2 text-sm bg-white text-primary px-3 py-2 rounded-2xl border border-primary"
                            >
                                <i class="fa-regular fa-thumbs-up"></i>
                                Accept Request
                            </button>
                            <button
                                @click="
                                    () => submit('reject', 'friends.request')
                                "
                                class="flex items-center gap-2 text-sm bg-white text-primary px-3 py-2 rounded-2xl border border-primary"
                            >
                                <i class="fa-regular fa-thumbs-down"></i>
                                Reject Request
                            </button>
                        </div>
                    </div>
                    <div class="flex items-center justify-center gap-2">
                        <button
                            v-if="props.is_following"
                            @click="() => submit('reject', 'friends.request')"
                            class="flex items-center gap-2 text-sm bg-white text-primary px-3 py-2 rounded-2xl border border-primary"
                        >
                            <i class="fa-regular fa-thumbs-down"></i>
                            Unfollow
                        </button>
                        <button
                            v-else
                            @click="() => submit('accept', 'friends.request')"
                            class="flex items-center gap-2 text-sm bg-white text-primary px-3 py-2 rounded-2xl border border-primary"
                        >
                            <i class="fa-regular fa-thumbs-up"></i>
                            Follow
                        </button>
                    </div>
                </div>
                <div>
                    <h3
                        class="flex gap-2 items-center text-2xl p-2 justify-center"
                    >
                        <ion-icon name="grid"></ion-icon> Posts
                    </h3>
                    <div v-if="props.posts.length > 0" class="flex flex-wrap">
                        <Post
                            v-for="post in props.posts"
                            class="shrink-0 grow-0"
                            :key="post"
                            :post="post"
                        />
                    </div>
                    <p
                        v-else
                        class="text-red-700 text-2xl font-bold mt-6 rounded-lg py-6 bg-gray-200 mx-4 text-center"
                    >
                        No Posts Avaliable Right Now
                    </p>
                </div>
            </div>
        </div>
    </section>
    <Footer />
</template>
