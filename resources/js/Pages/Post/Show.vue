<script setup>
import Comment from "@/Pages/Post/Partials/Comment.vue";
import NavigationBar from "@/Components/NavigationBar.vue";
import Menu from "@/Components/Menu.vue";
import Footer from "@/Components/Footer.vue";
import { useForm, usePage } from "@inertiajs/vue3";

const pageProps = usePage();
const { user } = pageProps.props.auth;
const props = defineProps(["post", "comment_count", "likes_count", "liked"]);
const post = props.post;
const { images } = post;
const postImages = JSON.parse(images);
console.log(props);

const form = useForm({
    content: "",
    post_id: post.id,
});

const likeForm = useForm({});

const handleLike = (route_name, condition, id) => {
    likeForm
        .transform((data) => ({
            ...data,
            post_id: condition === "post" ? id : null,
            comment_id: condition === "comment" ? id : null,
        }))
        .post(route(route_name), {
            preserveState: true,
            preserveScroll: true,
        });
};

const submit = () => {
    form.post(route("comments"), {
        preserveScroll: true,
        preserveState: false,
    });
};
</script>

<template>
    <NavigationBar class="sticky top-0 z-50" />
    <section class="flex items-start bg-gray-200">
        <Menu v-slot="{ toggle, isOpen }">
            <i
                @click="toggle"
                class="fa-solid cursor-pointer text-right transition-all duration-300 ease-in ml-auto w-fit text-2xl absolute lg:hidden"
                :class="{
                    'fa-chevron-right right-3 top-4': isOpen,
                    'fa-bars right-[-1.2em]': !isOpen,
                }"
            ></i>
        </Menu>
        <div
            class="rounded text-text mt-4 p-2 grow max-w-[40em] bg-white shadow-md shadow-gray-200 w-full mx-auto"
        >
            <div class="flex items-center justify-between p-1">
                <div class="flex items-center gap-2 pr-2">
                    <img
                        :src="user.profile_photo_url"
                        alt=""
                        class="w-12 p-1 rounded-full aspect-square bg-primary place-self-start"
                    />
                    <div>
                        <p>
                            {{ post.user.first_name }} {{ post.user.last_name }}
                        </p>
                        <small>@{{ post.user.username }}</small>
                    </div>
                </div>
                <i
                    class="text-lg fa-solid fa-ellipsis-vertical place-self-center"
                ></i>
            </div>
            <div class="w-full rounded-2xl flex flex-col bg-gray-100">
                <h1 class="p-3 font-bold">{{ post.title }}</h1>
                <swiper-container
                    navigation="true"
                    slidesPerView="1"
                    speed="600"
                    spaceBetween="10"
                    loop="true"
                    css-mode="true"
                    class="w-full grow items-center"
                >
                    <swiper-slide
                        v-for="image in postImages"
                        class="border rounded-lg w-full w-auto shrink-0 grow"
                    >
                        <img
                            :src="`${image}`"
                            alt=""
                            class="rounded-lg w-full bg-primary"
                        />
                    </swiper-slide>
                </swiper-container>
                <div v-html="post.content" class="p-3"></div>
            </div>
            <div class="flex items-center gap-1 justify-between p-2">
                <div class="flex items-center gap-1 justify-between">
                    <i class="fa-solid fa-face-smile"></i>
                    <i class="fa-solid fa-heart"></i>
                    <i class="fa-solid fa-thumbs-up"></i>
                    <small class="ml-2">{{ props.likes_count }}</small>
                </div>
                <small
                    >{{ props.comment_count }}
                    {{
                        props.comment_count === 1 ? "comment" : "comments"
                    }}</small
                >
            </div>
            <div class="grid grid-cols-3 items-center py-2 text-text gap-2">
                <button
                    v-if="props.liked"
                    @click="() => handleLike('posts.likes', 'post', post.id)"
                    preserve-scroll
                    class="flex flex-wrap items-center justify-center gap-2 p-2"
                >
                    <i class="fa-solid fa-heart"></i>
                    <p>Unlike</p>
                </button>
                <button
                    v-else
                    preserve-scroll
                    @click="() => handleLike('posts.likes', 'post', post.id)"
                    class="flex flex-wrap items-center justify-center gap-2 p-2"
                >
                    <i class="fa-regular fa-heart"></i>
                    <p>Like</p>
                </button>
                <div
                    class="flex flex-wrap items-center justify-center gap-2 p-2"
                >
                    <i class="fa-regular fa-message"></i>
                    <p>Comment</p>
                </div>
                <div
                    class="flex flex-wrap items-center justify-center gap-2 p-2"
                >
                    <i class="fa-solid fa-share-from-square"></i>
                    <p>Share</p>
                </div>
            </div>
            <div class="flex items-center gap-2">
                <img
                    :src="user.profile_photo_url"
                    :alt="user.username"
                    class="w-12 aspect-square place-self-start rounded-full bg-primary"
                />
                <div class="grow">
                    <div class="relative grid grow">
                        <i
                            class="fa-solid fa-comment absolute bg-primary text-white p-2 border-2 border-text border-r-0 text-lg rounded-s-full h-full grid place-items-center aspect-square"
                        ></i>
                        <input
                            v-model="form.content"
                            type="text"
                            class="p-3 pl-14 rounded-full border-2 border-text"
                            placeholder="Add a comment"
                        />
                    </div>
                    <button
                        @click="submit"
                        preserve-scroll
                        class="mt-3 p-2 px-5 text-white bg-primary rounded-lg"
                    >
                        Post
                    </button>
                </div>
            </div>
            <div v-if="post.comments" class="mt-6">
                <Comment
                    v-for="comment in post.comments"
                    :key="comment.id"
                    :comment="comment"
                    :handleLike="handleLike"
                />
            </div>
        </div>
    </section>
    <Footer />
</template>
