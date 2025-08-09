<script>
import BaseLayout from "@/views/author/BaseLayout.vue";
import axios from "axios";

export default {
    name: 'IndexArticle',
    components: {
        BaseLayout
    },
    data() {
        return {
            idAuthor: localStorage.getItem("id_user"),
            token: localStorage.getItem("jwt"),
            data: [],
            dataTemp: [],
            listView: [10, 25, 50, 100],
            view: 10,
            searchInput: '',
            pagination: {
                pages: [],
                total: 0,
                lastPage: 0,
                perPage: 5,
                currentPage: 1,
                offset: 5,
                from: 1,
                to: 10
            },
            sorted: {
                field: 'updated_at',
                rule: 'asc'
            }
        }
    },
    mounted() {
        this.getArticles();
    },
    methods: {
        getArticles() {
            axios.get(`/api/author/articles/user/${this.idAuthor}`, {
                headers: {
                    Authorization: `Bearer ${this.token}`
                }
            })
                .then(({data}) => {
                    console.log(data);
                    this.data = this.dataTemp = data.data;
                    this.pagination.lastPage = Math.ceil(data.data.length / this.view);
                    this.pagination.total = data.data.length;

                    this.showPages();
                })
                .catch(({response}) => {
                    console.error(response);
                });
        },
        checkView(index) {
            return !(index > this.pagination.to || index < this.pagination.from);
        },
        changeView() {
            this.changePage(1);
            this.showPages();
        },
        changePage(page) {
            if (page >= 1 && page <= this.pagination.lastPage) {

                this.showPages();

                const total = this.dataTemp.length;
                const lastPage = Math.ceil(total / this.view) || 1;
                const from = (page - 1) * this.view + 1;
                let to = page * this.view;

                if (page === lastPage) {
                    to = total;
                }

                this.pagination.total = total;
                this.pagination.lastPage = lastPage;
                this.pagination.perPage = this.view;
                this.pagination.currentPage = page;
                this.pagination.from = from;
                this.pagination.to = to;

            }
        },
        showPages() {
            const pages = [];
            let from = this.pagination.currentPage - Math.ceil(this.pagination.offset / 2);

            if (from < 1) {
                from = 1;
            }

            let to = from + this.pagination.offset - 1;

            if (to > this.pagination.lastPage) {
                to = this.pagination.lastPage;
            }

            while (from <= to) {
                pages.push(from);
                from++;
            }

            this.pagination.pages = pages;
        },
        clickPage(page) {
            this.changePage(page);
            this.showPages();
        },
        listViewBinding() {
            const list = [];
            for (let index = 0; index < this.listView.length; index++) {
                if (this.listView[index] < this.dataTemp.length) {
                    list.push(this.listView[index]);
                }
            }

            const itemsLength = parseInt(JSON.stringify(this.dataTemp.length));

            list.push(itemsLength);

            return list;
        },
        containsTagParagraph(input) {
            const parser = new DOMParser();
            const doc = parser.parseFromString(input, 'text/html');
            if (doc.querySelector('p') !== null || doc.querySelector('li') !== null) {
                const extract = this.extractTextFromHTML(input);
                return this.truncateText(extract);
            } else  {
                return this.truncateText(input);
            }
        },
        extractTextFromHTML(input){
            const tempDiv = document.createElement('div');
            tempDiv.innerHTML = input;

            const elements = tempDiv.querySelectorAll('p, li');

            return Array.from(elements)
                .map(el => el.textContent.trim())
                .filter(text => text.length > 0)
                .join('\n\n');
        },
        truncateText(text) {
            return text.slice(0, 50) + '...';
        },
        formatDatetime(input) {
            const date = new Date(input);

            const formatter = new Intl.DateTimeFormat('id-ID', {
                timeZone: 'Asia/Jakarta',
                year: 'numeric',
                month: '2-digit',
                day: '2-digit',
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit',
                hour12: false,
            });

            // Hasilnya dalam format lokal (dd/mm/yyyy, hh:mm:ss), perlu diubah sedikit:
            const parts = formatter.formatToParts(date);

            const getPart = (type) => parts.find(p => p.type === type)?.value;

            return `${getPart('day')}-${getPart('month')}-${getPart('year')} ${getPart('hour')}:${getPart('minute')}:${getPart('second')}`;
        }
    }
}
</script>

<template>
    <BaseLayout>
        <template #content>
            <h1 class="text-5xl font-black font-mono underline -underline-offset-1">Artikel</h1>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div class="justify-self-center sm:justify-self-start">
                    <select v-model="view" @change="changeView()"
                        class="block w-20 p-2 mb-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50">
                        <template v-for="(item, index) in listViewBinding()">
                            <option :value="item">{{ item }}</option>
                        </template>
                    </select>
                </div>
                <div class="grid grid-cols-1">
                    <router-link :to="{ name: 'Add Article Author Page' }" target="_blank"
                        class="px-5 py-2 h-10 w-40 justify-self-center bg-blue-200 text-sm me-2 rounded-lg inline-flex items-center cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                        </svg>
                        Tambah Artikel
                    </router-link>
                </div>
                <div class="justify-self-center mb-2 sm:justify-self-end">
                    <label for="search-data-table"
                           class="mb-2 text-sm font-medium text-gray-900 sr-only">Search</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500" aria-hidden="true"
                                 xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                      stroke-width="2"
                                      d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                            </svg>
                        </div>
                        <input id="search-data-table" type="search"
                               class="block w-full p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                               placeholder="Cari ">
                    </div>
                </div>
            </div>
            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            #
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Judul Artikel
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Cover
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Konten
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Tanggal
                        </th>
                        <th scope="col" class="px-6 py-3 text-end">
                            Aksi
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <template v-if="dataTemp.length === 0">
                        <tr
                            class="bg-white hover:bg-gray-50">
                            <th class="text-xl text-center py-2.5" colspan="6">Data Kosong</th>
                        </tr>
                    </template>
                    <template v-for="(item, index) in dataTemp" :key="index">
                        <tr v-show="checkView(index + 1)"
                            class="bg-white hover:bg-gray-50">
                            <th scope="row" class="px-4 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{ index + 1 }}
                            </th>
                            <td class="px-4 py-4 text-sm">
                                {{ item.title }}
                            </td>
                            <td class="px-4 py-4">
                                <template v-if="item.image != null">
                                    ✅
                                </template>
                                <template v-else>
                                    ❌
                                </template>
                            </td>
                            <td class="px-4 py-4 text-sm">
                                {{ containsTagParagraph(item.body) }}
                            </td>
                            <td class="px-4 py-4 text-sm">
                                {{ formatDatetime(item.updated_at) }}
                            </td>
                            <td class="px-4 py-4 space-x-2 text-right">
                                <router-link :to="{ name: 'View Article Author Page', params: { slug: item.slug } }" target="_blank"
                                    class="bg-gray-200 px-2.5 py-1 text-gray-900 rounded-md inline-flex items-center cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                         class="w-4 h-4">
                                        <path d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"/>
                                        <path fill-rule="evenodd"
                                              d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 0 1 0-1.113ZM17.25 12a5.25 5.25 0 1 1-10.5 0 5.25 5.25 0 0 1 10.5 0Z"
                                              clip-rule="evenodd"/>
                                    </svg>
                                    Preview
                                </router-link>
                                <button
                                    class="bg-blue-200 px-2.5 py-1 text-gray-900 rounded-md inline-flex items-center cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5"
                                         stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10"/>
                                    </svg>
                                    Edit
                                </button>
                                <button
                                    class="bg-red-200 px-2.5 py-1 text-gray-900 rounded-md inline-flex items-center cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                         class="w-4 h-4">
                                        <path fill-rule="evenodd"
                                              d="M16.5 4.478v.227a48.816 48.816 0 0 1 3.878.512.75.75 0 1 1-.256 1.478l-.209-.035-1.005 13.07a3 3 0 0 1-2.991 2.77H8.084a3 3 0 0 1-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 0 1-.256-1.478A48.567 48.567 0 0 1 7.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 0 1 3.369 0c1.603.051 2.815 1.387 2.815 2.951Zm-6.136-1.452a51.196 51.196 0 0 1 3.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 0 0-6 0v-.113c0-.794.609-1.428 1.364-1.452Zm-.355 5.945a.75.75 0 1 0-1.5.058l.347 9a.75.75 0 1 0 1.499-.058l-.346-9Zm5.48.058a.75.75 0 1 0-1.498-.058l-.347 9a.75.75 0 0 0 1.5.058l.345-9Z"
                                              clip-rule="evenodd"/>
                                    </svg>
                                    Hapus
                                </button>
                            </td>
                        </tr>
                    </template>
                    </tbody>
                </table>
            </div>
            <nav aria-label="table navigation">
                <ul class="flex items-center -space-x-px h-10 text-base">
                    <li>
                        <button @click.prevent="clickPage(1)"
                                class="flex items-center justify-center px-4 h-10 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-bl-lg hover:bg-gray-100 hover:text-gray-700">
                            Awal
                        </button>
                    </li>
                    <li>
                        <button @click.prevent="clickPage(pagination.currentPage - 1)"
                                class="flex items-center justify-center px-4 h-10 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 hover:bg-gray-100 hover:text-gray-700">
                            <span class="sr-only">Previous</span>
                            <svg class="w-2.5 h-2.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                 fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M5 1 1 5l4 4" />
                            </svg>
                        </button>
                    </li>
                    <template v-for="(item, index) in pagination.pages" :key="index">
                        <li>
                            <button @click="clickPage(item)"
                                    class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 hover:cursor-pointer"
                                    :class="{ 'dark:bg-white dark:text-gray-800': pagination.currentPage === item }">
                                {{ item }}
                            </button>
                        </li>
                    </template>
                    <li>
                        <button @click.prevent="clickPage(pagination.currentPage + 1)"
                                class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700">
                            <span class="sr-only">Next</span>
                            <svg class="w-2.5 h-2.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                 fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="m1 9 4-4-4-4" />
                            </svg>
                        </button>
                    </li>
                    <li>
                        <button @click="clickPage(pagination.lastPage)"
                                class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 rounded-br-lg hover:bg-gray-100 hover:text-gray-700">
                            Akhir
                        </button>
                    </li>
                </ul>
            </nav>
        </template>
    </BaseLayout>
</template>

<style scoped>

</style>
