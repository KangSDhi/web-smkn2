<script>
import BaseLayout from './BaseLayout.vue'
import axios from 'axios'
import {useHead} from '@vueuse/head'
import { convertIsoDateTimeToDateString } from '../../utils/Convert.js';

export default {
    name: 'Articles',
    components: {
        BaseLayout,
    },
    data(){
        return {
            articles: []
        }
    },
    methods: {
        head(){
            useHead({
                title: 'Halaman Berita',
                meta: [
                    {
                        name: 'description',
                        content: 'Halaman Semua Berita'
                    }
                ]
            })
        },
        getArticles(){
            axios.get('/api/articles')
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
            <div class="p-4">
                <h1 class="text-4xl text-black font-bold underline mb-4">Semua Berita</h1>
                <div class="grid grid-cols-1 sm:grid-cols-4 gap-1 mb-4">
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
            </div>
        </template>
    </BaseLayout>
</template>

<style scoped>

</style>
