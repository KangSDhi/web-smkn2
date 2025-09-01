<template>
    <div>
        <button @click="toggleSidebar" type="button"
                class="inline-flex items-center p-2 mt-2 ml-3 text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200">
            <span class="sr-only">Open sidebar</span>
            <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                 xmlns="http://www.w3.org/2000/svg">
                <path clip-rule="evenodd" fill-rule="evenodd"
                      d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
                </path>
            </svg>
        </button>
        <aside class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform" :class="sidebarComputed">
            <div class="h-full px-3 py-4 bg-gray-50">
                <a href="#" class="flex items-center pl-2.5 mb-5">
                    <img src="../../../../public/assets/img/logo.webp" class="h-5 mr-3 sm:h-7" alt="Ujian Logo"/>
                    <span class="self-center text-gray-900 text-xl font-semibold whitespace-nowrap">
                        Author
                    </span>
                </a>
                <button @click="toggleSidebar" type="button"
                        class="sm:invisible text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 absolute top-2.5 right-2.5 inline-flex items-center">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                         xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                              d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                              clip-rule="evenodd"></path>
                    </svg>
                    <span class="sr-only">Close menu</span>
                </button>
                <ul>
                    <li>
                        <div
                            class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                            </svg>
                            <span class="ml-3">Hai, {{ nama_user }}</span>
                        </div>
                    </li>
                    <li>
                        <router-link :to="{ name: 'Dashboard Author Page' }"
                                     class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"/>
                            </svg>
                            <span class="ml-3">Dashboard</span>
                        </router-link>
                    </li>
                    <li>
                        <router-link :to="{ name: 'Article Author Page' }"
                                     class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100group">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 0 1-2.25 2.25M16.5 7.5V18a2.25 2.25 0 0 0 2.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 0 0 2.25 2.25h13.5M6 7.5h3v3H6v-3Z"/>
                            </svg>
                            <span class="ml-3">Data Artikel</span>
                        </router-link>
                    </li>
                    <li>
                        <a @click="isLogoutOpen = true"
                           class="flex items-center mt-2 p-2 text-gray-900 rounded-lg bg-red-400 dark:text-white hover:bg-red-500 dark:hover:bg-red-500 group cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75"/>
                            </svg>
                            <span class="flex-1 ml-3 whitespace-nowrap">Keluar</span>
                        </a>
                    </li>
                </ul>
            </div>
        </aside>
        <main class="p-4 sm:ml-64">
            <slot name="content"></slot>
        </main>
        <div v-show="isLogoutOpen"
             class="flex justify-center items-center absolute top-0 right-0 bottom-0 left-0">
            <div class="bg-gray-50 px-16 py-14 rounded-md text-center">
                <h1 class="text-xl mb-4 font-bold text-slate-500">Apakah Anda Ingin Keluar?</h1>
                <div class="grid grid-cols-2 gap-1">
                    <button @click="logout" class="bg-red-500 px-4 py-2 rounded-md text-md font-semibold text-white cursor-pointer">Keluar</button>
                    <button @click="isLogoutOpen = false"
                            class="bg-gray-500 px-4 py-2 rounded-md text-md font-semibold text-white ml-1 cursor-pointer">Batal</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: 'BaseLayout',
    data() {
        return {
            token: localStorage.getItem("jwt"),
            isSidebarOpen: false,
            isLogoutOpen: false,
            isLoading: false,
            nama_user: localStorage.getItem("nama_user"),
        }
    },
    computed: {
        sidebarComputed() {
            return this.isSidebarOpen ? '' : '-translate-x-full sm:translate-x-0';
        }
    },
    mounted() {
        this.checkAuth();
    },
    methods: {
        toggleSidebar() {
            this.isSidebarOpen = !this.isSidebarOpen
        },
        checkAuth() {
            axios.get("/api/author/user", {
                headers: {
                    Authorization: "Bearer " + this.token
                }
            })
                .then(({data}) => {
                    console.log(data);
                    const role = data.data.role_user;
                    if (role !== 'author') {
                        localStorage.removeItem("jwt");
                        this.$router.push({name: "Login Page"});
                    }

                })
                .catch(({response}) => {
                    console.error(response);
                    if (response.status === 403 || response.status === 401) {
                        localStorage.removeItem("jwt");
                        this.$router.push({name: "Login Page"});
                    }
                });
        },
        logout(){
            this.isLogoutOpen = false;
            axios.get("/api/author/logout", {
                headers: {
                    Authorization: "Bearer " + this.token
                }
            })
                .then(({data}) => {
                    localStorage.removeItem("jwt");
                    localStorage.removeItem("nama_user");
                    localStorage.removeItem("id_user");
                    this.$router.push({name: "Login Page"});
                })
                .catch(({response}) => {
                    console.error(response);
                })
        }
    }
}
</script>
