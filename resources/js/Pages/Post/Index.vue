<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Post from "@/Pages/Post/Partials/Post.vue";
import { defineProps } from "vue";

const props = defineProps(["posts"]);
const posts = props.posts;

const sanitize = (word) => {
    let openTag = "";
    let close = undefined;
    let closeTagIndex = undefined;
    console.log(word);
    for (let i = 0; i < word.length; i++) {
        if (word[0] === "<") {
            if (word[i] === ">") {
                openTag = word.substring(0, i + 1);
                close = i;
                break;
            }
        }
        console.log(openTag);
    }

    for (let j = word.length - 1; j >= 0; j--) {
        if (j === 0) {
            closeTagIndex = word.length;
            break;
        }
        if (word[j] === "<") {
            closeTagIndex = j;

            break;
        }
    }

    console.log(close);

    const newWord =
        openTag +
        word.substring(close + 1, closeTagIndex) +
        openTag.slice(0, 1) +
        "/" +
        openTag.slice(1);

    console.log(newWord);
};

const text = sanitize("<section>hello this is this..</se");
</script>

<template>
    <AppLayout title="Posts Feed">
        <div
            class="py-12 mx-auto bg-white shadow-md shadow-text w-full min-h-screen"
        >
            <swiper-container
                slidesPerView="auto"
                speed="600"
                spaceBetween="10"
                loop="true"
                css-mode="true"
                class="mx-2"
            >
                <swiper-slide
                    v-for="i in 4"
                    class="relative h-40 border rounded-lg w-36 shrink-0 grow-0 bg-primary mx-auto"
                >
                    <img src="" alt="image" class="absolute bg-text inset-0" />
                    <div
                        class="p-2 absolute bottom-0 left-0 rounded-lg bg-gray-300 w-full"
                    >
                        <img
                            src="user-male.png"
                            alt=""
                            class="w-8 rounded-full bg-slate-100"
                        />
                    </div>
                </swiper-slide>
            </swiper-container>
            <p>{{ text }}</p>
            <div v-if="posts.length > 0" class="mt-6 p-1">
                <Post v-for="post in posts" :post="post" :key="post.id" />
            </div>

            <p
                v-else
                class="text-red-700 h-full text-2xl font-bold mt-6 rounded-lg py-6 bg-gray-200 mx-4 text-center"
            >
                No Posts Avaliable Right Now
            </p>
        </div>
    </AppLayout>
</template>
