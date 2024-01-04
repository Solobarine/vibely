<script setup>
import { Link, useForm } from "@inertiajs/vue3";
import { defineProps } from "vue";

const props = defineProps(["post"]);
const post = props.post;
const images = post.images.length > 2 ? JSON.parse(post.images) : [];

const form = useForm({
    post_id: post.id,
});

const submit = () => {
    form.post(route("posts.likes"), {
        preserveScroll: true,
        preserveState: false,
    });
};
</script>

<template>
    <div
        class="w-full bg-gray-100 shadow-md shadow-stone-200 max-w-[25em] mx-auto rounded text-text mt-4 p-2"
    >
        <div class="flex items-center justify-between p-1">
            <div class="flex items-center gap-2 pr-2">
                <img
                    :src="post.user.profile_photo_url"
                    alt=""
                    class="w-12 p-1 rounded-full aspect-square bg-primary place-self-start"
                />
                <div>
                    <a class="block font-bold"
                        >{{ post.user.first_name }} {{ post.user.last_name }}</a
                    >
                    <small v-if="post.user.username"
                        >@{{ post.user.username }}</small
                    >
                    <small v-else>{{ post.user.email }}</small>
                </div>
            </div>
            <i
                class="text-lg fa-solid fa-ellipsis-vertical place-self-center"
            ></i>
        </div>
        <div class="w-full rounded-2xl overflow-0 flex flex-col">
            <h1 class="p-2 font-bold">{{ post.title }}</h1>
            <swiper-container
                v-if="images.length > 0"
                slidesPerView="1"
                speed="600"
                spaceBetween="20"
                navigation="true"
                loop="true"
                css-mode="true"
                class="w-full grow"
            >
                <swiper-slide
                    v-for="image in images"
                    :key="image"
                    class="grow border rounded-lg w-full shrink-0"
                >
                    <img
                        :src="image"
                        alt=""
                        class="w-full h-full bg-slate-400"
                    />
                </swiper-slide>
            </swiper-container>
            <div v-html="post.content" class="mb-2 pl-2"></div>
        </div>
        <hr />
        <div class="flex items-center gap-1 justify-between p-2">
            <div class="flex items-center gap-1 justify-between">
                <i class="fa-solid fa-heart"></i>
                <small class="ml-2"
                    >{{ post.likes_count }}
                    {{ post.likes_count === 1 ? "like" : "likes" }}</small
                >
            </div>
            <small
                >{{ post.comments_count }}
                {{ post.comments_count === 1 ? "comment" : "comments" }}</small
            >
        </div>
        <div class="grid grid-cols-3 py-2 text-text gap-4">
            <button
                @click="submit"
                preserve-scroll
                class="flex flex-wrap items-center grow justify-center gap-2 p-2"
            >
                <i
                    :class="{
                        'fa-solid fa-heart': !post.liked,
                        'fa-regular fa-heart': post.liked,
                    }"
                ></i>
                <p class="text-sm">{{ post.liked ? "Unlike" : "Like" }}</p>
            </button>
            <Link
                :href="route('post.show', post.id)"
                class="flex flex-wrap items-center grow justify-center gap-2 p-2"
            >
                <i class="fa-regular fa-message"></i>
                <p class="text-sm">Comment</p>
            </Link>
            <button
                class="flex flex-wrap items-center grow justify-center gap-2 p-2"
            >
                <i class="fa-solid fa-share-from-square"></i>
                <p class="text-sm">Share</p>
            </button>
        </div>
    </div>
</template>
