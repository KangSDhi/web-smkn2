<template>
    <div class="mx-auto max-w-screen-md py-12">
        <div class="flex min-h-full flex-1 flex-col justify-center px-6 py-12 lg:px-8">
            <div class="sm:mx-auto sm:w-full sm:max-w-sm">
                <img src="../../../../public/assets/img/logo.png.webp" class="mx-auto h-24 w-auto" alt="Ujian Logo">
                <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">
                    Silahkan Masuk
                </h2>
            </div>

            <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
                <form class="space-y-6" @submit.prevent="login()">
                    <div>
                        <label class="block text-sm font-medium leading-6 text-gray-900">
                            Email
                        </label>
                        <div class="mt-2">
                            <input v-model="email" type="text"
                                class="block w-full rounded-md border-0 py-1.5 px-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-black sm:text-sm sm:leading-6"
                                :class="{
                                    'border-2 border-rose-200':
                                        isEmailError,
                                }" />
                        </div>
                        <span class="text-rose-500 text-sm font-bold">{{
                            emailErrorMessage
                        }}</span>
                    </div>

                    <div>
                        <label class="block text-sm font-medium leading-6 text-gray-900">
                            Password
                        </label>
                        <div class="mt-2">
                            <input v-model="password" type="password"
                                class="block w-full rounded-md border-0 py-1.5 px-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-black sm:text-sm sm:leading-6"
                                :class="{
                                    'border-2 border-rose-200':
                                        isPasswordError,
                                }" />
                        </div>
                        <span class="text-rose-500 text-sm font-bold">{{ passwordErrorMessage }}
                        </span>
                    </div>

                    <div>
                        <button type="submit"
                            class="flex w-full justify-center rounded-md bg-gradient-to-tr from-blue-600 to-blue-400 shadow-blue-500/20 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 cursor-pointer">
                            Masuk
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div v-show="isAuthError"
            class="flex justify-center items-center absolute top-0 right-0 bottom-0 left-0">
            <div class="bg-white px-16 py-14 rounded-md text-center">
                <h1 class="text-xl mb-4 font-bold text-slate-500">Galat!</h1>
                <h3 class="text-lg mb-4 font-semibold text-gray-800">{{ authErrorMessage }}</h3>
                <button @click="isAuthError = false"
                    class="bg-red-500 px-4 py-2 rounded-md text-md font-semibold text-white">Ok</button>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            email: "",
            password: "",
            isEmailError: false,
            isPasswordError: false,
            emailErrorMessage: "",
            passwordErrorMessage: "",
            isAuthError: false,
            authErrorMessage: ""
        }
    },
    methods: {
        login(){
            this.resetForm();

            const postData = async () => {
                const promise = axios.post("/api/login", {
                    email: this.email,
                    password: this.password
                });

                try {
                    const response = await promise;
                    console.log(response);
                    localStorage.setItem("jwt", response.data.data.token);
                    localStorage.setItem("id_user", response.data.data.user.id);
                    localStorage.setItem("nama_user", response.data.data.user.name);
                    if (response.data.data.user.role_user === "admin") {
                        console.log("admin");
                    } else if (response.data.data.user.role_user === "author") {
                        console.log("author");
                        this.$router.push({ name: "Dashboard Author Page" });
                    }
                } catch ({ response }) {
                    // console.error(response);
                    const errorMessages = response.data.errors;
                    // console.log(errorMessages);
                    if (this.isObject(errorMessages)) {
                        Object.keys(errorMessages).forEach((key) => {
                            if (key === "email") {
                                this.isEmailError = true;
                                this.emailErrorMessage = errorMessages[key][0];
                            }

                            if (key === "password") {
                                this.isPasswordError = true;
                                this.passwordErrorMessage = errorMessages[key][0];
                            }
                        })
                    } else {
                        this.isAuthError = true;
                        this.authErrorMessage = errorMessages;
                    }

                }
            }

            postData();
        },
        resetForm(){
            this.isEmailError = false;
            this.isPasswordError = false;
            this.emailErrorMessage = "";
            this.passwordErrorMessage = "";
        },
        isObject(value) {
            return (
                typeof value === 'object' && value !== null && !Array.isArray(value)
            );
        },
    }
}
</script>
