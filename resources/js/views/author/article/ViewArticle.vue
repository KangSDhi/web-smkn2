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
            idArtikel: null,
            title: null,
            body: null,
            coverImage: null
        }
    },
    created() {
        this.token = localStorage.getItem("jwt");
        this.idArtikel = this.$route.params.id;
    },
    methods: {
        getArticleById(){
            axios.get(`/api/author/article/${this.idArtikel}`, {
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
                })
                .catch(({ response }) => {
                    console.error(response);
                });
        }
    },
    mounted() {
        this.getArticleById();
    }
}
</script>

<template>
    <BaseLayout>
        <template #content>
            <h1>{{ title }}</h1>
            <div class="flex flex-row">
                <div class="basis-3/4">
                    <div v-html="body" class="font-[Open_Sans] text-lg"></div>
                </div>
                <div class="basis-1/4">

                </div>
            </div>
        </template>
    </BaseLayout>
</template>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Google+Sans+Code:ital,wght@0,300..800;1,300..800&display=swap');

</style>
