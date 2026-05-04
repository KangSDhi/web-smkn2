<template>
    <div class="min-h-screen bg-white font-sans">

        <!-- Hero Header -->
        <header class="relative bg-gradient-to-br from-blue-900 via-blue-800 to-blue-600 overflow-hidden">
            <!-- Decorative circles -->
            <div class="absolute top-0 right-0 w-96 h-96 bg-blue-500 opacity-20 rounded-full -translate-y-1/2 translate-x-1/2"></div>
            <div class="absolute bottom-0 left-0 w-64 h-64 bg-blue-300 opacity-10 rounded-full translate-y-1/2 -translate-x-1/2"></div>
            <div class="absolute top-1/2 left-1/4 w-32 h-32 bg-white opacity-5 rounded-full"></div>

            <div class="relative z-10 max-w-4xl mx-auto px-6 py-16 text-center">
                <!-- Logo / Emblem area -->
                <div class="flex items-center justify-center mb-6">
                    <div class="w-25 h-25 bg-white rounded-full flex items-center justify-center shadow-lg">
                        <img src="../../../../public/assets/img/logo.webp" class="w-20 h-20" alt="SMK Logo" />
                    </div>
                </div>

                <p class="text-blue-200 text-sm tracking-widest uppercase mb-2 font-medium">Pemerintah Provinsi Jawa Timur</p>
                <h1 class="text-white text-4xl md:text-5xl font-bold tracking-tight leading-tight mb-1">
                    SMK Negeri 2 Bojonegoro
                </h1>
                <p class="text-blue-100 text-lg mt-2 mb-8">Jl. Patimura No.3, Sumbang, Kec. Bojonegoro, Kabupaten Bojonegoro, Jawa Timur 62115</p>

                <div class="inline-block bg-white/10 border border-white/30 rounded-2xl px-8 py-4 backdrop-blur-sm">
                    <p class="text-blue-100 text-sm tracking-widest uppercase mb-1">Pengumuman Resmi</p>
                    <h2 class="text-white text-2xl md:text-3xl font-bold">Kelulusan Siswa Tahun Pelajaran 2025/2026</h2>
                </div>
            </div>
        </header>

        <!-- Announcement Banner -->
        <div class="bg-blue-600 py-3 px-6">
            <p class="text-center text-white text-sm font-medium tracking-wide">
                🎓 &nbsp; Selamat kepada seluruh siswa-siswi yang telah berhasil menyelesaikan pendidikan &nbsp; 🎓
            </p>
        </div>

        <!-- Main Content -->
        <main class="max-w-4xl mx-auto px-6 py-12">

            <!-- Info Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
                <div class="bg-blue-50 border border-blue-100 rounded-2xl p-6 text-center">
                    <div class="w-12 h-12 bg-blue-600 rounded-xl flex items-center justify-center mx-auto mb-3">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <p class="text-blue-400 text-xs font-semibold uppercase tracking-wider mb-1">Tanggal Kelulusan</p>
                    <p class="text-blue-900 text-lg font-bold">2 Mei 2026</p>
                </div>

                <div class="bg-blue-50 border border-blue-100 rounded-2xl p-6 text-center">
                    <div class="w-12 h-12 bg-blue-600 rounded-xl flex items-center justify-center mx-auto mb-3">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <p class="text-blue-400 text-xs font-semibold uppercase tracking-wider mb-1">Total Kelulusan</p>
                    <p class="text-blue-900 text-lg font-bold">100%</p>
                </div>

                <div class="bg-blue-50 border border-blue-100 rounded-2xl p-6 text-center">
                    <div class="w-12 h-12 bg-blue-600 rounded-xl flex items-center justify-center mx-auto mb-3">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                        </svg>
                    </div>
                    <p class="text-blue-400 text-xs font-semibold uppercase tracking-wider mb-1">Tahun Pelajaran</p>
                    <p class="text-blue-900 text-lg font-bold">2025 / 2026</p>
                </div>
            </div>

            <!-- PDF Viewer Section -->
            <div class="bg-white border border-blue-100 rounded-3xl overflow-hidden shadow-sm">
                <!-- Section Header -->
                <div class="bg-blue-700 px-8 py-5 flex items-center gap-3">
                    <div class="w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-white font-semibold text-base">Daftar Nama Siswa Lulus</h3>
                        <p class="text-blue-200 text-xs">Dokumen Resmi — Tahun Pelajaran 2025/2026</p>
                    </div>
                    <a
                        href="https://drive.google.com/file/d/1wrJLzEdR2VKcMyawu9e5CB0tAp_ASW8D/view"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="ml-auto flex items-center gap-2 bg-white/15 hover:bg-white/25 text-white text-xs font-medium px-4 py-2 rounded-lg transition-colors"
                    >
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                        </svg>
                        Buka Penuh
                    </a>
                </div>

                <!-- PDF iframe -->
                <div class="pdf-container bg-gray-50">
                    <iframe
                        :src="pdfUrl"
                        width="100%"
                        height="680"
                        frameborder="0"
                        allowfullscreen
                        class="block"
                        title="Daftar Kelulusan Siswa SMK Negeri 2 Bojonegoro 2026"
                    ></iframe>
                </div>

                <!-- PDF Footer Note -->
                <div class="px-8 py-4 bg-blue-50 border-t border-blue-100 flex items-center gap-2">
                    <svg class="w-4 h-4 text-blue-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <p class="text-blue-600 text-xs">Jika dokumen tidak tampil, silakan klik tombol <strong>"Buka Penuh"</strong> di atas atau aktifkan izin cookies pihak ketiga di browser Anda.</p>
                </div>
            </div>

            <!-- Congratulations Section -->
            <div class="mt-12 bg-gradient-to-br from-blue-700 to-blue-900 rounded-3xl p-10 text-center relative overflow-hidden">
                <div class="absolute inset-0 opacity-10">
                    <div class="absolute top-4 right-8 text-8xl">🎓</div>
                    <div class="absolute bottom-4 left-8 text-6xl">⭐</div>
                </div>
                <div class="relative z-10">
                    <p class="text-blue-200 text-sm font-semibold uppercase tracking-widest mb-3">Ucapan Selamat</p>
                    <h3 class="text-white text-2xl md:text-3xl font-bold mb-4">
                        Selamat & Sukses!
                    </h3>
                    <p class="text-blue-100 text-base max-w-xl mx-auto leading-relaxed">
                        Kepada seluruh lulusan SMK Negeri 2 Bojonegoro Angkatan 2026, selamat atas pencapaian luar biasa ini.
                        Semoga ilmu yang diperoleh menjadi bekal terbaik untuk masa depan yang gemilang.
                    </p>
                    <div class="mt-6 flex flex-wrap justify-center gap-3">
                        <span class="bg-white/15 text-white text-xs px-4 py-2 rounded-full border border-white/20">#LulusSMKN2Bojonegoro</span>
                        <span class="bg-white/15 text-white text-xs px-4 py-2 rounded-full border border-white/20">#Angkatan2026</span>
                        <span class="bg-white/15 text-white text-xs px-4 py-2 rounded-full border border-white/20">#SMKBisaBisa</span>
                    </div>
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer class="bg-blue-900 mt-16 py-8 px-6">
            <div class="max-w-4xl mx-auto text-center">
                <p class="text-blue-300 text-sm font-semibold">SMK Negeri 2 Bojonegoro</p>
                <p class="text-blue-500 text-xs mt-1">Jl. Patimura No.3, Sumbang, Kec. Bojonegoro, Kabupaten Bojonegoro, Jawa Timur 62115</p>
                <p class="text-blue-600 text-xs mt-3">© 2026 SMK Negeri 2 Bojonegoro. Hak Cipta Dilindungi.</p>
            </div>
        </footer>

    </div>
</template>

<script setup>
import { ref } from 'vue'

const pdfUrl = ref('https://drive.google.com/file/d/1fjWEf2dfYfc-R27fARc21DrgRTL7WPCH/preview')
</script>

<style scoped>
.pdf-container {
    width: 100%;
    min-height: 680px;
}

.font-sans {
    font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
}
</style>
