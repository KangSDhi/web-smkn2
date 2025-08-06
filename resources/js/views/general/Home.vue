<template>
    <BaseLayout>
        <template #content>
            <div class="flex">
                <img src="../../../../public/assets/img/Your paragraph text.png" alt="Banner">
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2">
                <div class="p-8">
                    <h4 class="text-2xl text-black font-bold">Video Profil</h4>
                    <iframe class="w-full" height="315"
                        src="https://www.youtube.com/embed/IuWVvM-4K9I?si=ttkGCPBumDXt0zvL" title="YouTube video player"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>

                    <div class="m-4">
                        <h1 class="text-4xl text-black font-bold underline">Visi</h1>
                    </div>
                    <div>
                        <p class="text-4xl text-black italic">
                           “ Terwujudnya lulusan yang beriman dan bertakwa kepada Tuhan Yang Maha Esa, berakhlak mulia, berbudaya kerja, berjiwa wirausaha dan kompetitif ”
                        </p>
                    </div>
                </div>
                <div class="p-8">
                    <h4 class="text-2xl text-black font-bold">Berita Terbaru</h4>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-1 mb-4">
                        <div
                            class="max-w-sm bg-white border border-gray-200 rounded-lg shadow-sm">
                            <a href="#">
                                <img class="rounded-t-lg" src="https://flowbite.com/docs/images/blog/image-1.jpg" alt="" />
                            </a>
                            <div class="p-5">
                                <a href="#">
                                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">
                                        Noteworthy technology acquisitions 2021</h5>
                                </a>
                                <p class="mb-3 font-normal text-gray-700">Here are the biggest
                                    enterprise technology acquisitions of 2021 so far, in reverse chronological order.
                                </p>
                                <a href="#"
                                    class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                                    Read more
                                    <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                                    </svg>
                                </a>
                            </div>
                        </div>

                        <div
                            class="max-w-sm bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                            <a href="#">
                                <img class="rounded-t-lg" src="https://flowbite.com/docs/images/blog/image-1.jpg" alt="" />
                            </a>
                            <div class="p-5">
                                <a href="#">
                                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                        Noteworthy technology acquisitions 2021</h5>
                                </a>
                                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Here are the biggest
                                    enterprise technology acquisitions of 2021 so far, in reverse chronological order.
                                </p>
                                <a href="#"
                                    class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    Read more
                                    <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                                    </svg>
                                </a>
                            </div>
                        </div>

                    </div>
                    <div class="flex">
                        <button type="button" class="w-full text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 cursor-pointer">Lebih Banyak Lagi...</button>
                    </div>
                </div>
            </div>
        </template>
    </BaseLayout>
</template>

<script>
import BaseLayout from './BaseLayout.vue';

export default {
    components: {
        BaseLayout
    }
}
</script>
