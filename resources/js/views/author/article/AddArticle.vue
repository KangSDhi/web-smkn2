<script>
import BaseLayout from '../BaseLayout.vue';
import { QuillEditor } from '@vueup/vue-quill';
import '@vueup/vue-quill/dist/vue-quill.snow.css';
import axios from "axios";

export default {
    name: 'Add Post',
    components: {
        BaseLayout,
        QuillEditor
    },
    data(){
        return {
            token: localStorage.getItem("jwt"),
            title: null,
            body: null,
            user_id: localStorage.getItem("id_user"),
            image: null,
            imageUrl: null
        }
    },
    methods: {
        onFileChange(event) {
            const file = event.target.files[0];
            if (file && file.type.startsWith('image/')) {
                this.image = file;

                const reader = new FileReader();
                reader.onload = (e) => {
                    this.imageUrl = e.target.result;
                };

                reader.readAsDataURL(file);
            } else {
                this.image = null;
                this.imageUrl = null;
                alert('Silahkan Pilih Gambar!');
            }
        },
        addArticle(){
            const formData = new FormData();
            formData.append("title", this.title);
            formData.append("body", this.body);
            formData.append("user_id", this.user_id);
            formData.append("image", this.image);

            axios.post("/api/author/article", formData, {
                headers: {
                    Authorization: `Bearer ${this.token}`
                }
            })
                .then(({ data }) => {
                    console.log(data);
                })
                .catch(({ response }) => {
                    console.error(response)
                });
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
                        <label for="title_article" class="block mb-2 text-sm font-medium text-gray-900">Judul Artikel</label>
                        <input v-model="title" type="text" id="title_article" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Hello World" required />
                    </div>
                    <div class="mb-2">
                        <label for="content_article" class="block mb-2 text-sm font-medium text-gray-900">Konten Artikel</label>
                        <QuillEditor v-model:content="body" content-type="html" id="content_article" theme="snow"/>
                    </div>
                    <div>
                        <button type="button" @click="addArticle" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">Simpan</button>
                    </div>
                </div>
                <div class="basis-1/4">
                    <label for="cover_article" class="block mb-2 text-sm font-medium text-gray-900">Cover Artikel</label>
                    <div class="p-2">
                        <template v-if="imageUrl==null">
                            <img src="../../../../../public/assets/img/empty-img.png" alt="" srcset="" class="w-full rounded-lg">
                        </template>
                        <template v-else>
                            <img :src="imageUrl" alt="" srcset="" class="w-full rounded-lg">
                        </template>
                    </div>
                    <div class="p-2">
                        <input type="file" id="cover_article" name="cover_article" accept="image/*" @change="onFileChange" class="block w-full h-10 text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none">
                    </div>
                </div>
            </div>
        </template>
    </BaseLayout>
</template>
