<script setup lang="ts">
import { Link } from "@inertiajs/vue3";
import ApplicationMark from "./ApplicationMark.vue";
const date = new Date();
const email = "solobarine@gmail.com";
</script>

<template>
    <footer
        class="p-3 rounded-top-3 px-4 sm:px-20 text-gray-600 dark:text-white bg-white dark:bg-gray-900"
    >
        <div
            class="flex flex-wrap-reverse items-center justify-between gap-4 py-6"
        >
            <div class="grid gap-4">
                <div class="w-16">
                    <ApplicationMark />
                </div>
                <div class="grid gap-2">
                    <div class="flex gap-2">
                        <i class="fa-solid fa-location-dot"></i>
                        <p>5 Random Street, City Unknown</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-envelope"></i>
                        <p>solobarine@gmail.com</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-phone-flip"></i>
                        <p>+01 222 2222</p>
                    </div>
                </div>
            </div>
            <div class="max-w-[20em] w-full">
                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    Tenetur fugiat enim tempore odio sint quibusdam est quae
                    cupiditate nulla cum, fugit mollitia recusandae maiores.
                    Provident?
                </p>
                <div class="flex items-center flex-wrap gap-3 mt-4">
                    <a
                        href="https://www.linkedin.com/in/solomon-akpuru"
                        target="_blank"
                        ><i
                            class="fa-brands fa-linkedin transition-all duration-300 ease-in text-xl hover:text-gray-500"
                        ></i
                    ></a>
                    <a href="https://github.com/Solobarine" target="_blank"
                        ><i
                            class="fa-brands fa-github transition-all duration-300 ease-in text-xl hover:text-gray-500"
                        ></i
                    ></a>
                    <a href="https://twitter.com/SolomonAkpuru" target="_blank"
                        ><i
                            class="fa-brands fa-x-twitter text-xl hover:text-gray-500 transition-all duration-300 ease-in"
                        ></i
                    ></a>
                    <a
                        href="https://wellfound.com/u/solomon-akpuru"
                        target="_blank"
                        ><i
                            class="fa-brands fa-angellist text-xl hover:text-gray-500 transition-all duration-300 ease-in"
                        ></i
                    ></a>
                    <a href="`mail:to:${email}`" target="_blank"
                        ><i
                            class="fa-brands fa-google text-xl hover:text-gray-500 transition-all duration-300 ease-in"
                        ></i
                    ></a>
                </div>
            </div>
        </div>
        <hr />
        <div class="flex items-center gap-3 justify-between flex-wrap py-6">
            <p>&copy; {{ date.getFullYear() }} Vibely</p>
            <div class="flex items-center gap-3">
                <Link href="#">Terms of Service</Link>
                <Link href="#">Privacy Policy</Link>
                <Link href="#">Cookies</Link>
            </div>
        </div>
    </footer>
</template>
