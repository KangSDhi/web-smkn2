<script>
import BaseLayout from "./BaseLayout.vue"
import axios from "axios";
export default {
    name: "Article",
    components: {
        BaseLayout
    },
    data(){
        return {
            slugArtikel: null,
            title: null,
            body: null,
            articleImages: []
        }
    },
    created() {
        this.slugArtikel = this.$route.params.slug;
    },
    methods: {
        getArticleBySlug(){
            axios.get(`/api/article/slug/${this.slugArtikel}`)
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

            </div>
        </template>
    </BaseLayout>
</template>

<style scoped>

</style>
