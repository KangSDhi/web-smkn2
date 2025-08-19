<script>
import BaseLayout from './BaseLayout.vue'
import axios from 'axios';
import { useHead } from '@vueuse/head';

export default {
    name: "Article",
    components: {
        BaseLayout
    },
    data(){
        return {
            slugArticle: null,
            title: null,
            body: null,
            articleImages: []
        }
    },
    created() {
        this.slugArticle = this.$route.params.slug;
    },
    watch: {
        title(newTitle){
            if (newTitle) {
                this.head();
            }
        }
    },
    methods: {
        head(){
            useHead({
                title: `Halaman Artikel ${this.title}`,
                meta: [
                    {
                        name: 'description',
                        content: `Halaman Artikel ${this.title}`
                    }
                ]
            })
        },
        getArticleBySlug(){
            axios.get(`/api/article/slug/${this.slugArticle}`)
                .then(({ data }) => {
                    console.log(data);
                    const responseData = data.data;
                    this.title = responseData.title;
                    this.body = responseData.body;

                    const idArticle = responseData.id;

                    axios.get(`/api/images/article/article/${idArticle}`)
                        .then(({ data }) => {
                            console.log(data);
                            this.articleImages = data.data;
                        })
                        .catch(({ response }) => {
                            console.error(response);
                        })
                })
                .catch(({ response }) => {
                    console.error(response)
                });
        }
    },
    mounted() {
        this.getArticleBySlug();
    }
}
</script>

<template>
    <BaseLayout>
        <template #content>
            <div class="p-4">
                <h1 class="text-4xl font-bold font-libertius-serif mb-4">{{ title }}</h1>
                <div class="grid grid-cols-1 sm:grid-cols-3">
                    <div class="col-span-2 p-4">
                        <div v-html="body" class="text-lg font-libertius-serif"></div>
                    </div>
                    <div>
                        <template v-for="(item, index) in articleImages">
                            <div class="mb-4">
                                <img :src="`/storage/images_article/${item.image}`" alt="" class="w-full rounded-lg">
                                <p class="text-sm font-libertius-serif font-bold text-center">{{ item.description }}</p>
                            </div>
                        </template>
                    </div>
                </div>

            </div>
        </template>
    </BaseLayout>
</template>

<style scoped>

</style>
