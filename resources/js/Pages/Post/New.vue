<script setup>
import { QuillEditor } from "@vueup/vue-quill";
import AppLayout from "@/Layouts/AppLayout.vue";
import TextInput from "@/Components/TextInput.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import "@vueup/vue-quill/dist/vue-quill.snow.css";
import { ref } from "vue";
import { useForm } from "@inertiajs/vue3";

const editor = ref("");
const form = useForm({
    title: "",
    content: "",
    files: {},
});

const addFiles = (e) => {
    form.files = e.target.files;
};

const submit = () => {
    form.content = editor.value.getHTML();
    console.log(form.data());
    form.post(route("post.store"));
};
</script>

<template>
    <AppLayout title="New">
        <section class="w-full min-h-screen mx-auto p-2 py-12 max-w-[40em]">
            <h3 class="text-center text-2xl font-bold">Create Your Posts</h3>
            <small class="text-center block"
                >Express Yourself or Inspire Someone</small
            >
            <form @submit.prevent="submit">
                <div id="editor" class="grid gap-2 p-2 pt-4">
                    <TextInput
                        placeholder="Add a Title.."
                        v-model="form.title"
                    />
                    <QuillEditor
                        ref="editor"
                        theme="snow"
                        toolbar="essential"
                    />
                    <input
                        @change="addFiles"
                        type="file"
                        name="images"
                        id="images"
                        multiple
                        class="border-0 outline-0 focus:border-1 focus:border-primary focus:outline-0"
                    />
                    <PrimaryButton
                        class="w-fit ml-auto"
                        @click="console.log(form)"
                    >
                        Post
                    </PrimaryButton>
                </div>
            </form>
        </section>
    </AppLayout>
</template>
