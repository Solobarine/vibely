<template>
    <div>
        <!-- Trigger Button -->
        <button
            @click="openModal = true"
            class="bg-primary text-white px-4 py-2 rounded-full hover:bg-orange-700 transition"
        >
            Create new post
        </button>

        <!-- Post Creation Modal -->
        <transition name="modal">
            <div
                v-if="openModal"
                class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50"
            >
                <div
                    class="bg-white dark:bg-gray-800 text-gray-900 dark:text-white w-full max-w-xl rounded-lg shadow-lg p-6"
                >
                    <!-- Modal Header -->
                    <div
                        class="flex justify-between items-center border-b pb-3"
                    >
                        <h3 class="text-lg font-semibold">Create a Post</h3>
                        <button
                            @click="openModal = false"
                            class="text-gray-500 hover:text-gray-700 transition"
                        >
                            <svg
                                class="w-6 h-6"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"
                                ></path>
                            </svg>
                        </button>
                    </div>

                    <!-- User Info -->
                    <div class="flex items-center my-4">
                        <img
                            :src="userProfilePicture"
                            alt="Profile"
                            class="w-10 h-10 rounded-full object-cover"
                        />
                        <div class="ml-4">
                            <p class="font-medium">{{ userName }}</p>
                            <div
                                class="flex items-center space-x-2 text-sm text-gray-500"
                            >
                                <span class="flex items-center space-x-1">
                                    <svg
                                        class="w-4 h-4"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M12 12c2.28 0 4-1.72 4-4V5c0-2.28-1.72-4-4-4S8 2.72 8 5v3c0 2.28 1.72 4 4 4z"
                                        ></path>
                                    </svg>
                                    <span>Everyone</span>
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Post Input -->
                    <textarea
                        v-model="postContent"
                        rows="4"
                        placeholder="What do you want to talk about?"
                        class="w-full bg-gray-100 dark:bg-gray-700 p-4 rounded-lg resize-none text-gray-600 focus:outline-none focus:ring-2 focus:ring-orange-500 transition"
                    ></textarea>

                    <!-- Media and Post Options -->
                    <div class="flex justify-between items-center mt-4">
                        <div class="flex space-x-4">
                            <button
                                class="flex items-center space-x-2 text-orange-500 hover:text-orange-700 transition"
                            >
                                <svg
                                    class="w-6 h-6"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M15.172 7l-6.586 6.586a2 2 0 01-2.828 0l-.586-.586a2 2 0 010-2.828L9.172 7h6m0 0l3 3m-3-3V5a2 2 0 012-2h3a2 2 0 012 2v3a2 2 0 01-2 2h-3a2 2 0 01-2-2V7z"
                                    ></path>
                                </svg>
                                <span>Photo</span>
                            </button>
                        </div>

                        <button
                            class="bg-orange-500 text-white px-6 py-2 rounded-full hover:bg-primary transition"
                            @click="createPost"
                        >
                            Post
                        </button>
                    </div>
                </div>
            </div>
        </transition>
    </div>
</template>

<script>
export default {
    data() {
        return {
            openModal: false,
            userName: "Solly", // Replace with the actual user name
            userProfilePicture: "https://via.placeholder.com/150", // Replace with the actual user profile picture URL
            postContent: "",
        };
    },
    methods: {
        createPost() {
            if (this.postContent.trim()) {
                // Handle post creation logic here
                console.log("Post created:", this.postContent);
                this.postContent = "";
                this.openModal = false;
            }
        },
    },
};
</script>

<style scoped>
.modal-enter-active,
.modal-leave-active {
    transition: opacity 0.5s ease;
}
.modal-enter,
.modal-leave-to {
    opacity: 0;
}
</style>
