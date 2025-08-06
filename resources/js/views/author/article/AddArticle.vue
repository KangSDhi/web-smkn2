<script>
import BaseLayout from '../BaseLayout.vue';
import {QuillEditor} from '@vueup/vue-quill';
import '@vueup/vue-quill/dist/vue-quill.snow.css';
import axios from "axios";

export default {
    name: 'Add Post',
    components: {
        BaseLayout,
        QuillEditor
    },
    data() {
        return {
            token: localStorage.getItem("jwt"),
            title: null,
            body: null,
            user_id: localStorage.getItem("id_user"),
            imageCover: null,
            imageCoverUrl: null,
            imageArticle: [],
            imageArticleUrl: []
        }
    },
    methods: {
        onFileChangeCoverFile(event) {
            const file = event.target.files[0];
            if (file && file.type.startsWith('image/')) {
                this.imageCover = file;

                const reader = new FileReader();
                reader.onload = (e) => {
                    this.imageCoverUrl = e.target.result;
                };

                reader.readAsDataURL(file);
            } else {
                this.imageCover = null;
                this.imageCoverUrl = null;
                alert('Silahkan Pilih Gambar!');
            }
        },
        onFileChangeImageArticleFile(event) {
            const file = event.target.files[0];
            if (file && file.type.startsWith('image/')) {
                this.imageArticle.push(file);

                const reader = new FileReader();
                reader.onload = (e) => {
                    this.imageArticleUrl.push(e.target.result);
                };

                reader.readAsDataURL(file);
            }
        },
        deleteImageArticle(index) {
            console.log(index);
            this.imageArticle.splice(index, 1);
            this.imageArticleUrl.splice(index, 1);
        },
        async storeArticle() {
            try {
                const formData = new FormData();
                formData.append("title", this.title);
                formData.append("body", this.body);
                formData.append("user_id", this.user_id);
                formData.append("image", this.imageCover);

                const articleRes = await axios.post("/api/author/article", formData, {
                    headers: {
                        Authorization: `Bearer ${this.token}`
                    }
                });

                const articleId = articleRes.data.data.id;

                if (this.imageArticle.length !== 0) {
                    const formData = new FormData();

                    this.imageArticle.forEach((imageFile) => {
                        formData.append("image[]", imageFile);
                    });

                    formData.append("article_id", articleId);

                    const imagesRes = await axios.post("/api/author/images/article", formData, {
                        headers: {
                            Authorization: `Bearer ${this.token}`
                        }
                    });

                    console.log("Images upload :", imagesRes.data);
                }

                this.$router.push({ name: 'Article Author Page' });

            } catch (error) {
                console.error("Gagal Menyimpan Artikel : ", error.response || error);
            }
        }
    }
}
</script>

<template>
    <BaseLayout>
        <template #content>
            <h1>Post</h1>
            <div class="flex flex-row">
                <div class="basis-3/4">
                    <div class="mb-2">
                        <label for="title_article" class="block mb-2 text-sm font-medium text-gray-900">Judul
                            Artikel</label>
                        <input v-model="title" type="text" id="title_article"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                               placeholder="Hello World" required/>
                    </div>
                    <div class="mb-2">
                        <label for="content_article" class="block mb-2 text-sm font-medium text-gray-900">Konten
                            Artikel</label>
                        <QuillEditor v-model:content="body" content-type="html" id="content_article" theme="snow"/>
                    </div>
                    <div class="mb-2">
                        <label for="image_article" class="block mb-2 text-sm font-medium text-gray-900">Gambar
                            Artikel</label>
                        <input type="file" name="image_article" id="image_article" accept="image/*"
                               @change="onFileChangeImageArticleFile">
                        <div class="grid grid-cols-3 gap-4">
                            <template v-if="imageArticleUrl.length !== 0">
                                <template v-for="(imageUrl, index) in imageArticleUrl">
                                    <div class="relative">
                                        <button type="button" @click="deleteImageArticle(index)"
                                                class="absolute top-1 right-1 bg-transparent items-center justify-center cursor-pointer">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                 stroke-width="1.5" stroke="currentColor"
                                                 class="w-6 h-6 text-red-400 font-bold">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M6 18 18 6M6 6l12 12"/>
                                            </svg>
                                        </button>
                                        <img :src="imageUrl" alt="" srcset="" class="w-full max-h-min rounded-lg">
                                    </div>

                                </template>
                            </template>
                        </div>
                    </div>
                    <div>
                        <button type="button" @click="storeArticle"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 cursor-pointer">
                            Simpan
                        </button>
                    </div>
                </div>
                <div class="basis-1/4">
                    <label for="cover_article" class="block mb-2 text-sm font-medium text-gray-900">Cover
                        Artikel</label>
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
                        <input type="file" id="cover_article" name="cover_article" accept="image/*"
                               @change="onFileChangeCoverFile"
                               class="block w-full h-10 text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none">
                    </div>
                </div>
            </div>
        </template>
    </BaseLayout>
</template>
