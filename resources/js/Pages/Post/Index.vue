<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Post from "@/Pages/Post/Partials/Post.vue";
import { defineProps, reactive, ref } from "vue";
import CreatePopup from "./Partials/CreatePopup.vue";

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
        <div class="mx-auto bg-gray-100 dark:bg-gray-700 w-full min-h-screen">
            <div
                class="max-w-3xl mx-auto bg-white dark:bg-gray-800 p-2 rounded-b-lg shadow-lg transition-all duration-300 hover:shadow-xl mb-8"
            >
                <div class="flex justify-between items-center">
                    <img
                        :src="userProfilePicture"
                        alt="Profile"
                        class="w-12 h-12 rounded-full bg-gray-300 object-cover"
                    />
                    <CreatePopup />
                </div>
            </div>
            <!-- Feed Section -->
            <div
                class="mx-auto px-4 mt-6 grid grid-cols-1 md:grid-cols-3 gap-6"
            >
                <Post
                    v-for="post in posts"
                    :post="post"
                    :key="post.id"
                    class="mb-6"
                />
                <p
                    v-if="posts.length === 0"
                    class="text-gray-800 dark:text-gray-200 text-center text-2xl font-bold py-40"
                >
                    No Posts Available Right Now
                </p>
            </div>
        </div>
    </AppLayout>
</template>
