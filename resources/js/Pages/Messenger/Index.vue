<script setup>
import { ref } from "vue";
import { VuemojiPicker } from "vuemoji-picker";
import Chats from "./Partials/Chats.vue";
import Friends from "./Partials/Friends.vue";
import Menu from "@/Pages/Messenger/Partials/MenuWrapper.vue";
import UserChatBubble from "@/Pages/Messenger/Components/UserChatBubble.vue";
import FriendChatBubble from "@/Pages/Messenger/Components/FriendChatBubble.vue";
import ApplicationMark from "@/Components/ApplicationMark.vue";

// Declare Refs
const files = ref(null);
const friendInfo = ref({
    fname: "",
});
const chatDetails = ref({
    sender_id: 1,
    receiver_id: 2,
    content: "",
});
const chatOpen = ref(true);
const emojiPanel = ref(false);
const showSplash = ref(true);
const isOpen = ref(true);

const toggle = (value) => {
    chatOpen.value = value;
};

const toggleEmoji = () => {
    emojiPanel.value = !emojiPanel.value;
};

const toggleOpen = () => {
    isOpen.value = !isOpen.value;
};

const toggleSplash = (value) => {
    console.log($event);
    showSplash.value = value.status;
    friendInfo.value = { fname: value.fname };
};

const loadImage = () => {
    console.log(files.value);
    files.value.click();
};
</script>

<template>
    <section
        class="relative flex bg-slate-200 dark:bg-slate-700 text-text min-h-screen py-2"
    >
        <div
            class="xxs:absolute xxs:bg-slate-200 xxs:max-w-full z-20 w-full sm:relative sm:max-w-[20em] sm:left-0 xxs:h-screen shrink-0 transition-all duration-700 ease-in"
            :class="{ 'left-0': isOpen, 'left-[-150%]': !isOpen }"
        >
            <div class="flex items-center grow p-3">
                <img
                    src="user-female.png"
                    alt=""
                    class="w-10 shrink-0 grow-1 aspect-square rounded-full bg-primary"
                />
                <div class="grow flex items-center justify-end pr-10">
                    <button
                        @click="() => toggle(true)"
                        class="relative flex flex-col p-2 items-center justify-center gap-2"
                        :class="{
                            'text-primary': chatOpen,
                            'text-text': !chatOpen,
                        }"
                    >
                        <ion-icon
                            name="chatbubble-ellipses-outline"
                            class="text-2xl hover:text-primary"
                        ></ion-icon>
                        <span class="hidden">Chats</span>
                    </button>
                    <button
                        @click="() => toggle(false)"
                        class="relative flex flex-col p-2 items-center justify-center gap-2"
                        :class="{ 'text-primary': !chatOpen }"
                    >
                        <ion-icon
                            name="people-outline"
                            class="text-2xl hover:text-primary"
                        ></ion-icon>
                        <span class="hidden">New Chat</span>
                    </button>
                    <button
                        @click="toggleOpen"
                        class="aspect-square grid place-items-center"
                    >
                        <ion-icon
                            name="chevron-back-outline"
                            class="sm:hidden text-2xl hover:text-primary"
                        ></ion-icon>
                    </button>
                </div>
            </div>
            <div class="px-2">
                <Chats v-if="chatOpen" />
                <Friends v-else @show-splash="toggleSplash(false)" />
            </div>
        </div>
        <div v-if="!showSplash" class="grow flex flex-col">
            <div class="bg-slate-200">
                <div class="flex p-2 items-center gap-3">
                    <button
                        @click="toggleOpen"
                        class="sm:hidden grid place-items-center"
                    >
                        <i class="fa-solid fa-chevron-left text-lg"></i>
                    </button>
                    <img
                        src="user-female.png"
                        alt=""
                        class="w-10 shrink-0 grow-0 aspect-square rounded-full bg-primary"
                    />
                    <div>
                        <p class="font-bold">Joe</p>
                        <small class="text-xs"
                            >last seen yesterday at 12:50</small
                        >
                    </div>
                </div>
            </div>
            <div
                class="relative grow flex flex-col gap-2 bg-gray-100 dark:bg-grey-900"
            >
                <div class="grow grid gap-3 auto-rows-min p-2 overflow-y-auto">
                    <UserChatBubble>
                        <p>Hello</p>
                    </UserChatBubble>
                    <FriendChatBubble>
                        <p>Hi</p>
                        <p>How are You doing?</p>
                    </FriendChatBubble>
                    <UserChatBubble>
                        <p>Very well. Thank you</p>
                    </UserChatBubble>
                </div>
                <div
                    class="relative w-full bg-orange-400 px-4 py-2 bottom-0 left-0 flex flex-wrap items-center gap-4"
                >
                    <VuemojiPicker
                        @emojiClick="toggleEmoji"
                        class="absolute top-[-25em] left-0 transition-all duration-500 ease-in"
                        :class="{
                            'scale-100 z-10 pointer-events-auto opacity-100':
                                emojiPanel,
                            'scale-0 z-[-10] opacity-0 pointer-events-none':
                                !emojiPanel,
                        }"
                    />
                    <i
                        @click="toggleEmoji"
                        class="fa-regular cursor-pointer fa-face-smile text-2xl"
                    ></i>
                    <i
                        @click="loadImage"
                        class="fa-solid cursor-pointer fa-plus text-2xl"
                    ></i>
                    <input
                        type="file"
                        ref="files"
                        name="files"
                        class="hidden"
                        multiple
                    />
                    <input
                        type="text"
                        name="content"
                        id="content"
                        class="grow rounded-lg focus:border-orange-300 border-0 focus:border-2 ring-0 outline-0"
                    />
                    <button class="grid place-items-center">
                        <ion-icon name="send" class="text-2xl"></ion-icon>
                    </button>
                </div>
            </div>
        </div>
        <div
            v-else
            class="relative grow grid items-center place-content-center gap-2 bg-gray-100 dark:bg-grey-900"
        >
            <ApplicationMark class="max-w-[7em] mx-auto w-full" />
            <h1 class="font-bold text-center text-xl">
                Connect with Friends on
                <span class="text-2xl text-primary">Vibely Messenger</span>.
            </h1>
            <small class="text-center"
                >Chat and Discuss with your loved ones</small
            >
            <h2 class="text-4xl font-bold text-red-500 text-center">
                Coming Soon...
            </h2>
        </div>
        <div class="relative">
            <Menu />
        </div>
    </section>
</template>
