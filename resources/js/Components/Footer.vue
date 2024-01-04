<script setup lang="ts">
const date = new Date();
const email = "solobarine@gmail.com";
</script>

<template>
    <footer class="lg:static bottom-0 z-50 bg-primary p-3 rounded-top-3">
        <div
            class="flex flex-wrap-reverse items-center justify-between text-gray-200 gap-4"
        >
            <div>
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
            <div class="max-w-[20em] w-full">
                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    Tenetur fugiat enim tempore odio sint quibusdam est quae
                    cupiditate nulla cum, fugit mollitia recusandae maiores.
                    Provident?
                </p>
                <div
                    class="flex items-center flex-wrap gap-3 mt-4 text-gray-200"
                >
                    <a
                        href="https://www.linkedin.com/in/solomon-akpuru"
                        target="_blank"
                        ><i
                            class="fa-brands fa-linkedin transition-all duration-300 ease-in text-2xl hover:text-gray-500"
                        ></i
                    ></a>
                    <a href="https://github.com/Solobarine" target="_blank"
                        ><i
                            class="fa-brands fa-github transition-all duration-300 ease-in text-2xl hover:text-gray-500"
                        ></i
                    ></a>
                    <a href="https://twitter.com/SolomonAkpuru" target="_blank"
                        ><i
                            class="fa-brands fa-x-twitter text-2xl hover:text-gray-500 transition-all duration-300 ease-in"
                        ></i
                    ></a>
                    <a
                        href="https://wellfound.com/u/solomon-akpuru"
                        target="_blank"
                        ><i
                            class="fa-brands fa-angellist text-2xl hover:text-gray-500 transition-all duration-300 ease-in"
                        ></i
                    ></a>
                    <a href="`mail:to:${email}`" target="_blank"
                        ><i
                            class="fa-brands fa-google text-2xl hover:text-gray-500 transition-all duration-300 ease-in"
                        ></i
                    ></a>
                </div>
            </div>
        </div>
        <p class="text-gray-200 text-center mt-2">
            Copyright &copy; {{ date.getFullYear() }}. Vibely by Solomon Barine
            Akpuru.
        </p>
    </footer>
</template>
