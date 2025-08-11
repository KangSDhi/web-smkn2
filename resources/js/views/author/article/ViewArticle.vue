<script>
import BaseLayout from "../BaseLayout.vue";
import axios from "axios";

export default {
    name: 'View Article',
    components: {
        BaseLayout
    },
    data(){
        return {
            token: null,
            slugArtikel: null,
            title: null,
            body: null,
            coverImage: null,
            articleImages: []
        }
    },
    created() {
        this.token = localStorage.getItem("jwt");
        this.slugArtikel = this.$route.params.slug;
    },
    methods: {
        getArticleBySlug(){
            axios.get(`/api/author/article/slug/${this.slugArtikel}`, {
                headers: {
                    Authorization: `Bearer ${this.token}`
                }
            })
                .then(({ data }) => {
                    console.log(data);
                    const responseData = data.data;
                    this.title = responseData.title;
                    this.body = responseData.body;
                    this.coverImage = responseData.image;

                    const idArticle = responseData.id;

                    axios.get(`/api/author/images/article/article/${idArticle}`, {
                        headers: {
                            Authorization: `Bearer ${this.token}`
                        }
                    })
                        .then(({ data }) => {
                            this.articleImages = data.data;
                        })
                        .catch(({ response }) => {
                            console.error(response);
                        });
                })
                .catch(({ response }) => {
                    console.error(response);
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
            <h1 class="text-4xl font-bold font-mono mb-4">{{ title }}</h1>
            <div class="grid grid-cols-1 sm:grid-cols-3">
                <div class="col-span-2">
                    <div v-html="body" class="text-lg font-light font-mono"></div>
                </div>
                <div>
                    <template v-for="(item, index) in articleImages">
                        <div class="mb-4">
                            <img :src="`/storage/images_article/${item.image}`" alt="" class="w-full rounded-lg">
                            <p class="text-sm font-bold text-center">{{ item.description }}</p>
                        </div>
                    </template>
                </div>
            </div>
        </template>
    </BaseLayout>
</template>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Google+Sans+Code:ital,wght@0,300..800;1,300..800&display=swap');

</style>
