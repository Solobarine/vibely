<script setup>
import { reactive, ref } from "vue";
import { formatDistance } from "date-fns";
import { useForm } from "@inertiajs/vue3";
const editor = ref();

const commentField = ref(false);
const toggleComment = () => {
    console.log(editor);

    commentField.value = !commentField.value;

    editor.value.getLength;
};
const liked = reactive(true);
const showReplies = ref(false);

const props = defineProps(["comment", "handleLike"]);

const form = useForm({
    content: "",
    comment_id: props.comment.id,
});

const submit = () => {
    form.post(route("comments"));
};

console.log(props.comment);

const toggleReplies = () => {
    showReplies.value = !showReplies.value;
};
</script>

<template>
    <div class="flex items-start gap-1 mb-5" id="comment">
        <img
            :src="props.comment.user.profile_photo_url"
            :alt="props.comment.user.username"
            class="w-[3em] aspect-square rounded-full bg-primary"
        />
        <div class="grow">
            <div class="bg-slate-100 p-2 rounded-lg">
                <div class="flex items-center justify-between">
                    <p>
                        {{ props.comment.user.first_name }}
                        {{ props.comment.user.last_name }}
                    </p>
                    <small>{{
                        formatDistance(props.comment.created_at, new Date())
                    }}</small>
                </div>
                <small>@{{ props.comment.user.username }}</small>
                <p class="mt-2">{{ props.comment.content }}</p>
            </div>
            <div class="flex mt-2 items-center gap-4 text-sm">
                <div
                    v-if="!props.comment.liked"
                    class="flex items-center gap-2"
                >
                    <button
                        @click="
                            () =>
                                props.handleLike(
                                    'comments.likes',
                                    'comment',
                                    props.comment.id
                                )
                        "
                        preserve-scroll
                    >
                        Like
                    </button>
                    <p class="flex items-center gap-1">
                        <i class="fa-regular fa-heart"></i>
                        {{ props.comment.likes_count }}
                    </p>
                </div>
                <div v-else class="flex items-center gap-2">
                    <button
                        preserve-scroll
                        @click="
                            () =>
                                props.handleLike(
                                    'comments.likes',
                                    'comment',
                                    props.comment.id
                                )
                        "
                    >
                        Unlike
                    </button>
                    <p class="flex items-center gap-1">
                        <i class="fa-solid fa-heart"></i>
                        {{ props.comment.likes_count }}
                    </p>
                </div>
                <div
                    v-if="
                        props.comment.commentable_type === 'App\\Models\\Post'
                    "
                    class="flex items-center gap-2"
                >
                    <button @click="toggleComment">Reply</button>
                    <p class="flex items-center gap-1">
                        {{ props.comment.comments_count }}
                        {{
                            props.comment.comments_count === 1
                                ? "reply"
                                : "replies"
                        }}
                    </p>
                </div>
                <button v-if="props.comment.replies" @click="toggleReplies">
                    {{ showReplies ? "Hide Replies" : "See Replies" }}
                </button>
            </div>
            <div v-if="commentField" class="flex p-2 items-cemter gap-1">
                <input
                    v-model="form.content"
                    type="text"
                    class="p-2 rounded-lg border border-gray-200 outline-0 focus:border-2 focus:border-primary grow"
                />
                <button
                    @click="submit"
                    preserve-scroll
                    class="p-2 aspect-square h-full grid place-items-center bg-white text-primary"
                >
                    <ion-icon name="send" class="text-xl"></ion-icon>
                </button>
            </div>
            <div v-if="props.comment.replies && showReplies" class="py-2">
                <hr class="border-primary mb-2" />
                <Comment
                    v-for="reply in props.comment.replies"
                    :key="reply.id"
                    :comment="reply"
                    :handleLike="props.handleLike"
                />
            </div>
        </div>
    </div>
</template>
