<template>
    <div>
        <header>
            <nav class="bg-white border-gray-200">
                <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
                    <a href="#" class="flex items-center space-x-3 rtl:space-x-reverse">
                        <img src="../../../../public/assets/img/logo.png.webp" class="h-11" alt="SMK Logo" />
                        <span
                            class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Flowbite</span>
                    </a>
                    <button @click="toggleMenu" data-collapse-toggle="navbar-dropdown" type="button"
                        class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 cursor-pointer"
                        aria-controls="navbar-dropdown" aria-expanded="false">
                        <span class="sr-only">Open main menu</span>
                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 17 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M1 1h15M1 7h15M1 13h15" />
                        </svg>
                    </button>
                    <div :class="['w-full md:block md:w-auto', isMenuOpen ? 'block' : 'hidden']" id="navbar-dropdown" ref="dropdown">
                        <ul
                            class="flex flex-col font-medium p-4 md:p-0 mt-4 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0">
                            <li>
                                <a href="#"
                                    class="block py-2 px-3 text-black bg-blue-700 rounded-sm md:bg-transparent md:text-blue-700 md:p-0 md:dark:text-blue-500 dark:bg-blue-600 md:dark:bg-transparent"
                                    aria-current="page">Beranda</a>
                            </li>
                            <li>
                                <button @click="toggleDropdown" id="dropdownNavbarLink"
                                    data-dropdown-toggle="dropdownNavbar"
                                    class="flex items-center justify-between w-full py-2 px-3 text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 md:w-auto">
                                    Jurusan
                                    <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m1 1 4 4 4-4" />
                                    </svg></button>
                                <!-- Dropdown content -->
                                <div id="dropdownNavbar" v-show="isOpen"
                                    class="absolute z-10 mt-2 font-normal bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-50">
                                    <ul class="py-2 text-sm text-gray-700" aria-labelledby="dropdownLargeButton">
                                        <li>
                                            <a href="#" class="block px-4 py-2 hover:bg-gray-100">Teknik Komputer dan
                                                Jaringan 🖥️</a>
                                        </li>
                                        <li>
                                            <a href="#" class="block px-4 py-2 hover:bg-gray-100">Teknik Geomatika
                                                🌏</a>
                                        </li>
                                        <li>
                                            <a href="#" class="block px-4 py-2 hover:bg-gray-100">Teknik Kimia
                                                Industri ⚗️</a>
                                        </li>
                                        <li>
                                            <a href="#" class="block px-4 py-2 hover:bg-gray-100">Desain Pemodelan dan
                                                Informasi Bangunan 🏠</a>
                                        </li>
                                        <li>
                                            <a href="#" class="block px-4 py-2 hover:bg-gray-100">Teknik Mekatronika
                                                🤖</a>
                                        </li>
                                        <li>
                                            <a href="#" class="block px-4 py-2 hover:bg-gray-100">Teknik Elektronika
                                                Industri 💡</a>
                                        </li>
                                        <li>
                                            <a href="#" class="block px-4 py-2 hover:bg-gray-100">Teknik Installasi
                                                Tenaga Listrik ⚡</a>
                                        </li>
                                        <li>
                                            <a href="#" class="block px-4 py-2 hover:bg-gray-100">Teknik Konstruksi dan
                                                Perumahan 🏠</a>
                                        </li>
                                        <li>
                                            <a href="#" class="block px-4 py-2 hover:bg-gray-100">Teknik Kendaraan
                                                Ringan 🚗</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <a href="#"
                                    class="block py-2 px-3 text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0">Fasilitas</a>
                            </li>
                            <li>
                                <a href="#"
                                    class="block py-2 px-3 text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0">Pengumuman</a>
                            </li>
                            <li>
                                <a href="#"
                                    class="block py-2 px-3 text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0">Kontak</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        <section>
            <slot name="content"></slot>
        </section>


        <footer class="bg-white rounded-lg shadow-sm m-4">
            <div class="w-full max-w-screen-xl mx-auto p-4 md:py-8">
                <div class="sm:flex sm:items-center sm:justify-between">
                    <div>
                        <a href="#" class="flex items-center mb-4 sm:mb-0 space-x-3 rtl:space-x-reverse">
                            <img src="../../../../public/assets/img/logo.png.webp" class="h-8" alt="Flowbite Logo" />
                        </a>
                        <div class="flex gap-2 mt-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 6.75V15m6-6v8.25m.503 3.498 4.875-2.437c.381-.19.622-.58.622-1.006V4.82c0-.836-.88-1.38-1.628-1.006l-3.869 1.934c-.317.159-.69.159-1.006 0L9.503 3.252a1.125 1.125 0 0 0-1.006 0L3.622 5.689C3.24 5.88 3 6.27 3 6.695V19.18c0 .836.88 1.38 1.628 1.006l3.869-1.934c.317-.159.69-.159 1.006 0l4.994 2.497c.317.158.69.158 1.006 0Z" />
                            </svg>
                            <p class="text-sm font-medium text-gray-500">
                                Jl Patimura No.3, Sumbang, Kab. Bojonegoro
                            </p>
                        </div>
                        <div class="flex gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                            </svg>
                            <p class="text-sm font-medium text-gray-500">
                                smkn2.bojonegoro@yahoo.co.id
                            </p>
                        </div>
                        <div class="flex gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                            </svg>
                            <p class="text-sm font-medium text-gray-500">
                                (0353) 881912
                            </p>
                        </div>
                    </div>
                    <ul
                        class="flex flex-wrap items-center mb-6 text-sm font-medium text-gray-500 sm:mb-0 dark:text-gray-400">
                        <li>
                            <a href="#" class="hover:underline me-4 md:me-6">Instagram</a>
                        </li>
                        <li>
                            <a href="#" class="hover:underline me-4 md:me-6">Facebook</a>
                        </li>
                        <li>
                            <a href="#" class="hover:underline me-4 md:me-6">Tiktok</a>
                        </li>
                    </ul>
                </div>
                <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />
                <span class="block text-sm text-gray-500 sm:text-center dark:text-gray-400">© 2025 <a href="#"
                        class="hover:underline">KangSDhi</a>. All Rights Reserved.</span>
            </div>
        </footer>
    </div>
</template>

<script>
export default {
    name: 'BaseLayout',
    data() {
        return {
            isOpen: false,
            isMenuOpen: false
        };
    },
    methods: {
        toggleMenu(){
            this.isMenuOpen = !this.isMenuOpen;
        },
        toggleDropdown() {
            this.isOpen = !this.isOpen;
        },
        handleClickOutside(event) {
            if (this.$refs.dropdown && !this.$refs.dropdown.contains(event.target)) {
                this.isOpen = false;
            }
        },
    },
    mounted() {
        document.addEventListener('click', this.handleClickOutside);
    },
    beforeUnmount() {
        document.removeEventListener('click', this.handleClickOutside);
    },
}
</script>

<style scoped>
/* Optional transition */
#dropdownNavbar {
    transition: all 0.2s ease-in-out;
}
</style>
