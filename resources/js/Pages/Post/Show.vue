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
            class="rounded-lg text-text mt-4 p-4 max-w-[40em] bg-white shadow-lg shadow-gray-300 w-full mx-auto"
        >
            <!-- Header with User Info -->
            <div class="flex items-center justify-between p-2">
                <div class="flex items-center gap-3">
                    <img
                        :src="user.profile_photo_url"
                        alt="Profile"
                        class="w-12 h-12 p-1 rounded-full bg-primary"
                    />
                    <div>
                        <p class="text-lg font-bold">
                            {{ post.user.first_name }} {{ post.user.last_name }}
                        </p>
                        <small class="text-gray-500"
                            >@{{ post.user.username }}</small
                        >
                    </div>
                </div>
                <i
                    class="text-xl fa-solid fa-ellipsis-vertical text-gray-600"
                ></i>
            </div>

            <!-- Post Content -->
            <div class="w-full rounded-2xl bg-gray-100 mt-3">
                <h1 class="p-4 text-xl font-bold">{{ post.title }}</h1>
                <swiper-container
                    navigation="true"
                    slidesPerView="1"
                    speed="600"
                    spaceBetween="10"
                    loop="true"
                    class="w-full rounded-lg overflow-hidden"
                >
                    <swiper-slide
                        v-for="image in postImages"
                        class="w-full h-auto"
                    >
                        <img
                            :src="`${image}`"
                            alt="Post Image"
                            class="rounded-lg w-full object-cover"
                        />
                    </swiper-slide>
                </swiper-container>
                <div v-html="post.content" class="p-4 text-base"></div>
            </div>

            <!-- Post Actions -->
            <div class="flex items-center justify-between p-3">
                <div class="flex items-center gap-2">
                    <i class="fa-solid fa-face-smile text-xl text-gray-600"></i>
                    <i class="fa-solid fa-heart text-xl text-gray-600"></i>
                    <i class="fa-solid fa-thumbs-up text-xl text-gray-600"></i>
                    <small class="ml-2 text-gray-500">{{
                        props.likes_count
                    }}</small>
                </div>
                <small class="text-gray-500">
                    {{ props.comment_count }}
                    {{ props.comment_count === 1 ? "comment" : "comments" }}
                </small>
            </div>

            <!-- Like, Comment, Share Buttons -->
            <div
                class="grid grid-cols-3 items-center py-2 gap-4 text-gray-600 border-t border-gray-200"
            >
                <button
                    v-if="props.liked"
                    @click="() => handleLike('posts.likes', 'post', post.id)"
                    class="flex items-center justify-center gap-2 p-2 hover:bg-gray-50 rounded-md transition"
                >
                    <i class="fa-solid fa-heart text-primary"></i>
                    <p>Unlike</p>
                </button>
                <button
                    v-else
                    @click="() => handleLike('posts.likes', 'post', post.id)"
                    class="flex items-center justify-center gap-2 p-2 hover:bg-gray-50 rounded-md transition"
                >
                    <i class="fa-regular fa-heart"></i>
                    <p>Like</p>
                </button>
                <div
                    class="flex items-center justify-center gap-2 p-2 hover:bg-gray-50 rounded-md transition"
                >
                    <i class="fa-regular fa-message"></i>
                    <p>Comment</p>
                </div>
                <div
                    class="flex items-center justify-center gap-2 p-2 hover:bg-gray-50 rounded-md transition"
                >
                    <i class="fa-solid fa-share-from-square"></i>
                    <p>Share</p>
                </div>
            </div>

            <!-- Comment Input -->
            <div class="flex items-center gap-3 mt-4">
                <img
                    :src="user.profile_photo_url"
                    :alt="user.username"
                    class="w-10 h-10 rounded-full bg-primary"
                />
                <div class="grow">
                    <div class="relative flex">
                        <i
                            class="fa-solid fa-comment absolute bg-primary text-white p-2 border-2 border-text rounded-l-full h-full grid place-items-center"
                        ></i>
                        <input
                            v-model="form.content"
                            type="text"
                            class="p-3 pl-12 w-full rounded-full border-2 border-gray-300 focus:border-primary transition"
                            placeholder="Add a comment"
                        />
                    </div>
                    <button
                        @click="submit"
                        class="mt-3 p-2 px-6 bg-primary text-white rounded-lg hover:bg-primary-dark transition"
                    >
                        Post
                    </button>
                </div>
            </div>

            <!-- Comments Section -->
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
