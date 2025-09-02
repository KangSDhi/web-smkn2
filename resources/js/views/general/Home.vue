<script>
import BaseLayout from './BaseLayout.vue';
import axios from "axios";
import {useHead} from '@vueuse/head';
import {convertIsoDateTimeToDateString} from "../../utils/Convert.js";

export default {
    components: {
        BaseLayout
    },
    data() {
        return {
            articles: []
        }
    },
    methods: {
        head() {
            useHead({
                title: "Halaman Beranda",
                meta: [
                    {
                        name: "description",
                        content: "Halaman - Beranda Web SMKN 2 Bojonegoro"
                    }
                ]
            });
        },
        getArticles() {
            axios.get(`/api/articles/limit/2`)
                .then(({data}) => {
                    console.log(data);
                    this.articles = data.data;
                })
                .catch(({response}) => {
                    console.error(response);
                })
        },
        truncateText(text) {
            return text.slice(0, 100) + '...';
        },
        extractTextFromHTML(input) {
            const tempDiv = document.createElement('div');
            tempDiv.innerHTML = input;

            const elements = tempDiv.querySelectorAll('p, li');

            return Array.from(elements)
                .map(el => el.textContent.trim())
                .filter(text => text.length > 0)
                .join('\n\n');
        },
        displayParagraph(input) {
            const parser = new DOMParser();
            const doc = parser.parseFromString(input, 'text/html');
            if (doc.querySelector('p') !== null || doc.querySelector('li') !== null) {
                const extract = this.extractTextFromHTML(input);
                return this.truncateText(extract)
            } else {
                return this.truncateText(input)
            }
        },
        convertIsoDateTimeToDateString
    },
    mounted() {
        this.head();
        this.getArticles();
    }
}
</script>

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
                            src="https://www.youtube.com/embed/IuWVvM-4K9I?si=ttkGCPBumDXt0zvL"
                            title="YouTube video player"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>

                    <div class="m-4">
                        <h1 class="text-4xl text-black font-bold underline">Visi</h1>
                    </div>
                    <div>
                        <p class="text-4xl text-black italic">
                            “ Terwujudnya lulusan yang beriman dan bertakwa kepada Tuhan Yang Maha Esa, berakhlak mulia,
                            berbudaya kerja, berjiwa wirausaha dan kompetitif ”
                        </p>
                    </div>
                </div>
                <div class="p-8">
                    <h4 class="text-2xl text-black font-bold">Berita Terbaru</h4>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-1 mb-4">
                        <template v-for="(item, index) in articles">
                            <div
                                class="max-w-sm bg-white border border-gray-200 rounded-lg shadow-sm">
                                <a href="#">
                                    <template v-if="item.image !== null">
                                        <img class="rounded-t-lg h-60 w-full"
                                             :src="`/storage/cover_articles/${item.image}`" alt=""/>
                                    </template>
                                    <template v-else>
                                        <img class="rounded-t-lg h-60"
                                             src="https://flowbite.com/docs/images/blog/image-1.jpg" alt=""/>
                                    </template>

                                </a>
                                <div class="p-5">
                                    <a href="#">
                                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">
                                            {{ item.title }}
                                        </h5>
                                    </a>
                                    <p class="mb-3 font-normal text-gray-700">
                                        {{ displayParagraph(item.body) }}
                                    </p>
                                    <p class="text-sm font-bold mt-2 mb-2">Penulis : {{ item.author }} (
                                        {{ convertIsoDateTimeToDateString(item.updated_at) }} )</p>
                                    <router-link :to="{ name: 'Article Page', params: { slug: item.slug } }"
                                                 class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                                        Baca Selengkapnya ...
                                        <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true"
                                             xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                  stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                                        </svg>
                                    </router-link>
                                </div>
                            </div>
                        </template>
                    </div>
                    <div class="flex">
                        <button type="button"
                                class="w-full text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 cursor-pointer">
                            Lebih Banyak Lagi...
                        </button>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-1 gap-2 pl-8 pr-8">
                <h1 class="text-4xl text-black font-bold underline">Seutas Fasilitas</h1>


                <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                    <div class="relative">
                        <img class="h-auto max-w-full rounded-lg" src="../../../../public/assets/img/facility/bengkel/KELAS.jpg" alt="">
                        <span class="absolute bottom-2 left-2 bg-black/60 text-white text-sm px-3 py-1 rounded">Ruang Kelas</span>
                    </div>
                    <div class="relative">
                        <img class="h-auto max-w-full rounded-lg" src="../../../../public/assets/img/facility/bengkel/LAB.%20KOMPUTER.jpg" alt="">
                        <span class="absolute bottom-2 left-2 bg-black/60 text-white text-sm px-3 py-1 rounded">Laboratorium Komputer</span>
                    </div>
                    <div class="relative">
                        <img class="h-auto max-w-full rounded-lg" src="../../../../public/assets/img/facility/bengkel/GMT.jpg" alt="">
                        <span class="absolute bottom-2 left-2 bg-black/60 text-white text-sm px-3 py-1 rounded">Ruang Praktik Jurusan GMT</span>
                    </div>
                    <div class="relative">
                        <img class="h-auto max-w-full rounded-lg" src="../../../../public/assets/img/facility/bengkel/DPIB.jpg" alt="">
                        <span class="absolute bottom-2 left-2 bg-black/60 text-white text-sm px-3 py-1 rounded">Ruang Praktik Jurusan DPIB</span>
                    </div>
                    <div class="relative">
                        <img class="h-auto max-w-full rounded-lg" src="../../../../public/assets/img/facility/bengkel/BKP.jpeg" alt="">
                        <span class="absolute bottom-2 left-2 bg-black/60 text-white text-sm px-3 py-1 rounded">Ruang Praktik Jurusan TKP</span>
                    </div>
                    <div class="relative">
                        <img class="h-auto max-w-full rounded-lg" src="../../../../public/assets/img/facility/bengkel/TEI.jpg" alt="">
                        <span class="absolute bottom-2 left-2 bg-black/60 text-white text-sm px-3 py-1 rounded">Ruang Praktik Jurusan TEI</span>
                    </div>
                    <div class="relative">
                        <img class="h-auto max-w-full rounded-lg" src="../../../../public/assets/img/facility/bengkel/MEKA.jpg" alt="">
                        <span class="absolute bottom-2 left-2 bg-black/60 text-white text-sm px-3 py-1 rounded">Ruang Praktik Jurusan MEKA</span>
                    </div>
                    <div class="relative">
                        <img class="h-auto max-w-full rounded-lg" src="../../../../public/assets/img/facility/bengkel/TITL.jpg" alt="">
                        <span class="absolute bottom-2 left-2 bg-black/60 text-white text-sm px-3 py-1 rounded">Ruang Praktik Jurusan TITL</span>
                    </div>
                    <div class="relative">
                        <img class="h-auto max-w-full rounded-lg" src="../../../../public/assets/img/facility/bengkel/KI.jpg" alt="">
                        <span class="absolute bottom-2 left-2 bg-black/60 text-white text-sm px-3 py-1 rounded">Ruang Praktik Jurusan KI</span>
                    </div>
                    <div class="relative">
                        <img class="h-auto max-w-full rounded-lg" src="../../../../public/assets/img/facility/bengkel/TKR.jpg" alt="">
                        <span class="absolute bottom-2 left-2 bg-black/60 text-white text-sm px-3 py-1 rounded">Ruang Praktik Jurusan TKR</span>
                    </div>
                    <div class="relative">
                        <img class="h-auto max-w-full rounded-lg" src="../../../../public/assets/img/facility/bengkel/TP.jpg" alt="">
                        <span class="absolute bottom-2 left-2 bg-black/60 text-white text-sm px-3 py-1 rounded">Ruang Praktik Jurusan TP</span>
                    </div>
                    <div class="relative">
                        <img class="h-auto max-w-full rounded-lg" src="../../../../public/assets/img/facility/bengkel/TKJ.jpg" alt="">
                        <span class="absolute bottom-2 left-2 bg-black/60 text-white text-sm px-3 py-1 rounded">Ruang Praktik Jurusan TKJ</span>
                    </div>
                </div>

            </div>
        </template>
    </BaseLayout>
</template>
