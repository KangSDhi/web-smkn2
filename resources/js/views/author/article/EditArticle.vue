<script>
import BaseLayout from '../BaseLayout.vue';
import { QuillEditor } from '@vueup/vue-quill';
import '@vueup/vue-quill/dist/vue-quill.snow.css';
import axios from 'axios';
import { useHead } from '@vueuse/head';

export default {
    name: 'Edit Article',
    components: {
        BaseLayout,
        QuillEditor
    },
    data(){
        return {
            token: null,
            slugArticle: null,
            id: null,
            title: null,
            body: null,
            userId: null,
            imageCover: null,
            imageCoverUrl: null,
            imageArticle: [],
            isTitleError: false,
            titleErrorMessage: null,
            isBodyError: false,
            bodyErrorMessage: null
        }
    },
    created() {
        this.token = localStorage.getItem("jwt");
        this.userId = localStorage.getItem("id_user");
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
                title: `Dashboard Author - Edit Artikel ${this.title}`,
                meta: [
                    {
                        name: 'description',
                        content: `Halaman Edit Artikel ${this.title} Untuk Author`,
                    }
                ]
            })
        },
        getArticleBySlug(){
            axios.get(`/api/author/article/slug/${this.slugArticle}`, {
                headers: {
                    Authorization: `Bearer ${this.token}`
                }
            })
                .then(({ data }) => {
                    const responseData = data.data;
                    this.id = responseData.id;
                    this.title = responseData.title;
                    this.body = responseData.body;
                    this.imageCoverUrl = `/storage/cover_articles/${responseData.image}`;

                    axios.get(`/api/author/images/article/article/${this.id}`, {
                        headers: {
                            Authorization: `Bearer ${this.token}`
                        }
                    })
                        .then(({ data }) => {
                            console.log(data);
                            const responseData = data.data;
                            this.imageArticle = responseData.map(item => ({
                                id: item.id,
                                image: item.image,
                                imageUrl: `/storage/images_article/${item.image}`,
                                description: item.description
                            }));
                        })
                        .catch(({ response }) => {
                            console.error(response);
                        });
                })
                .catch(({ response }) => {
                    console.error(response);
                });
        },
        onFileChangeCoverFile(event){
            const fileInput = event.target;
            const file = fileInput.files[0];
            if (file && file.type.startsWith('image/')){
                this.imageCover = file;

                const reader = new FileReader();
                reader.onload = (e) => {
                    this.imageCoverUrl = e.target.result;
                }

                reader.readAsDataURL(file);
            }

            fileInput.value = '';
        },
        onUploadImageArticle(event){
            const fileInput = event.target;
            const file = fileInput.files[0];
            console.log(file);
            const formData = new FormData();
            formData.append("article_id", this.id);
            formData.append("image", file);
            formData.append("description", null);

            axios.post("/api/author/image/article", formData, {
                headers: {
                    Authorization: `Bearer ${this.token}`
                }
            })
                .then(({ data }) => {
                    console.log(data);
                    this.$router.go();
                })
                .catch(({ response }) => {
                    console.error(response);
                });
        },
        onChangeDescription(id, text){
            console.log(id, text);
            const formData = new FormData();
            formData.append('id', id);
            formData.append('description', text);

            axios.post(`/api/author/image/article/description?_method=PUT`, formData, {
                headers: {
                    Authorization: `Bearer ${this.token}`
                }
            })
                .then(({ data }) => {
                    console.log(data);
                    this.$router.go();
                })
                .catch(({ response }) => {
                    console.error(response);
                });
        },
        onDeleteImageArticle(id){
            console.log(id);
            axios.delete(`/api/author/image/article/${id}`, {
                headers: {
                    Authorization: `Bearer ${this.token}`
                }
            })
                .then(({ data }) => {
                    console.log(data);
                    this.$router.go();
                })
                .catch(({ response }) => {
                    console.error(response);
                });
        },
        async updateArticle(){
            try {
                const formData = new FormData();
                formData.append("title", this.title);
                formData.append("body", this.body);
                formData.append("user_id", this.userId);
                formData.append("image", this.imageCover);

                const articleRes = await axios.post(`/api/author/article/${this.id}?_method=PUT`, formData, {
                    headers: {
                        Authorization: `Bearer ${this.token}`
                    }
                });

                console.log(articleRes);
                this.$router.push({ name: 'Article Author Page' })
            } catch (error) {
                console.error("Gagal Menyimpan Artikel : ", error.response || error);
            }
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
            <h1 class="text-5xl font-black font-mono underline -underline-offset-1">Edit Artikel</h1>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-2">
                <div class="col-span-2">
                    <div class="mb-2">
                        <label for="title_article" class="block mb-2 text-sm font-medium text-gray-900">Judul
                            Artikel
                        </label>
                        <input v-model="title" type="text" id="title_article"
                               :class="[
                                   'bg-gray-50 border text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5',
                                   isTitleError ? 'border-2 border-red-500' : 'border-gray-300'
                               ]"
                               placeholder="Hello World" required/>
                        <span class="text-sm text-red-500">{{ titleErrorMessage }}</span>
                    </div>
                    <div class="mb-2">
                        <label for="content_article" class="block mb-2 text-sm font-medium text-gray-900">Konten
                            Artikel</label>
                        <QuillEditor v-model:content="body" content-type="html" id="content_article" theme="snow"/>
                        <span class="text-sm text-red-500">{{ bodyErrorMessage }}</span>
                    </div>
                    <div class="mb-2">
                        <label for="image_article" class="block mb-2 text-sm font-medium text-gray-900">Gambar
                            Artikel</label>
                        <input type="file" @change="onUploadImageArticle" name="image_article" id="image_article" accept="image/*">
                        <div class="grid grid-cols-3 gap-4">
                            <template v-if="imageArticle.length !== 0">
                                <template v-for="(item, index) in imageArticle">
                                    <div>
                                        <div class="relative">
                                            <button type="button" @click="onDeleteImageArticle(item.id)"
                                                    class="absolute top-1 right-1 bg-transparent items-center justify-center cursor-pointer">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                     stroke-width="1.5" stroke="currentColor"
                                                     class="w-6 h-6 text-red-400 font-bold">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          d="M6 18 18 6M6 6l12 12"/>
                                                </svg>
                                            </button>
                                            <img :src="item.imageUrl" alt="" srcset="" class="w-full max-h-min rounded-lg">
                                            <label for="">Deskripsi</label>
                                            <input v-model="item.description" @change="onChangeDescription(item.id, item.description)" type="text" class="bg-gray-50 border text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                        </div>
                                    </div>
                                </template>
                            </template>
                        </div>
                    </div>
                    <div>
                        <button type="button" @click="updateArticle"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 cursor-pointer">
                            Ubah
                        </button>
                    </div>
                </div>
                <div>
                    <label for="cover_article" class="block mb-2 text-sm font-medium text-gray-900">
                        Cover Artikel
                    </label>
                    <div class="p-2">
                        <template v-if="imageCoverUrl==null">
                            <img src="../../../../../public/assets/img/add-image.png" alt="" srcset=""
                                 class="w-full rounded-lg">
                        </template>
                        <template v-else>
                            <img :src="imageCoverUrl" alt="" srcset="" class="w-full rounded-lg">
                        </template>
                    </div>
                    <div class="p-2">
                        <input type="file" @change="onFileChangeCoverFile" id="cover_article" name="cover_article" accept="image/*">
                    </div>
                </div>
            </div>
        </template>
    </BaseLayout>
</template>

<style scoped>

</style>
