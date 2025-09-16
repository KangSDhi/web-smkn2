<!-- FacilityCarouselOptions.vue -->
<template>
    <div
        class="relative w-full h-3/4 overflow-hidden rounded-2xl shadow"
        @mouseenter="pause"
        @mouseleave="play"
        @touchstart="onTouchStart"
        @touchend="onTouchEnd"
    >
        <!-- Slides -->
        <div
            class="whitespace-nowrap transition-transform duration-700 ease-in-out"
            :style="{ transform: `translateX(-${currentIndex * 100}%)` }"
        >
            <div
                v-for="(s, idx) in slides"
                :key="idx"
                class="inline-block align-top w-full"
            >
                <div class="relative">
                    <img
                        :src="s.src"
                        :alt="s.caption"
                        class="block w-full aspect-[16/9] object-cover"
                        loading="lazy"
                    />
                    <span
                        class="absolute top-3 left-3 bg-black/60 text-white text-sm md:text-base px-3 py-1 rounded"
                    >
            {{ s.caption }}
          </span>
                </div>
            </div>
        </div>

        <!-- Controls -->
        <button
            type="button"
            class="absolute left-2 top-1/2 -translate-y-1/2 bg-white/70 hover:bg-white rounded-full px-3 py-2 shadow"
            @click="prev"
            aria-label="Sebelumnya"
        >
            ‹
        </button>
        <button
            type="button"
            class="absolute right-2 top-1/2 -translate-y-1/2 bg-white/70 hover:bg-white rounded-full px-3 py-2 shadow"
            @click="next"
            aria-label="Berikutnya"
        >
            ›
        </button>

        <!-- Dots -->
        <div class="absolute bottom-3 left-0 right-0 flex justify-center gap-2">
            <button
                v-for="(s, idx) in slides"
                :key="'dot-' + idx"
                class="h-2.5 w-2.5 rounded-full"
                :class="idx === currentIndex ? 'bg-white' : 'bg-white/50 hover:bg-white/80'"
                @click="goTo(idx)"
                :aria-label="'Slide ' + (idx+1)"
            />
        </div>
    </div>
</template>

<script>
export default {
    name: "FacilityCarouselOptions",
    data() {
        return {
            slides: [
                { src: "/assets/img/facility/bengkel/KELAS.jpg", caption: "Ruang Kelas" },
                { src: "/assets/img/facility/bengkel/LAB.%20KOMPUTER.jpg", caption: "Laboratorium Komputer" },
                { src: "/assets/img/facility/bengkel/GMT.jpg", caption: "Ruang Praktik Jurusan GMT" },
                { src: "/assets/img/facility/bengkel/DPIB.jpg", caption: "Ruang Praktik Jurusan DPIB" },
                { src: "/assets/img/facility/bengkel/BKP.jpeg", caption: "Ruang Praktik Jurusan TKP" },
                { src: "/assets/img/facility/bengkel/TEI.jpg", caption: "Ruang Praktik Jurusan TEI" },
                { src: "/assets/img/facility/bengkel/MEKA.jpg", caption: "Ruang Praktik Jurusan MEKA" },
                { src: "/assets/img/facility/bengkel/TITL.jpg", caption: "Ruang Praktik Jurusan TITL" },
                { src: "/assets/img/facility/bengkel/KI.jpg", caption: "Ruang Praktik Jurusan KI" },
                { src: "/assets/img/facility/bengkel/TKR.jpg", caption: "Ruang Praktik Jurusan TKR" },
                { src: "/assets/img/facility/bengkel/TP.jpg", caption: "Ruang Praktik Jurusan TP" },
                { src: "/assets/img/facility/bengkel/TKJ.jpg", caption: "Ruang Praktik Jurusan TKJ" }
            ],
            currentIndex: 0,
            timer: null,
            intervalMs: 3000,
            touchStartX: 0
        };
    },
    mounted() {
        this.play();
        window.addEventListener("keydown", this.onKey);
    },
    beforeUnmount() {
        this.stop();
        window.removeEventListener("keydown", this.onKey);
    },
    methods: {
        next() {
            this.currentIndex = (this.currentIndex + 1) % this.slides.length;
        },
        prev() {
            this.currentIndex =
                (this.currentIndex - 1 + this.slides.length) % this.slides.length;
        },
        goTo(i) {
            this.currentIndex = i;
        },
        play() {
            this.stop();
            this.timer = setInterval(this.next, this.intervalMs);
        },
        pause() {
            this.stop();
        },
        stop() {
            if (this.timer) {
                clearInterval(this.timer);
                this.timer = null;
            }
        },
        onKey(e) {
            if (e.key === "ArrowRight") this.next();
            else if (e.key === "ArrowLeft") this.prev();
        },
        onTouchStart(e) {
            this.touchStartX = e.changedTouches[0].clientX;
            this.pause();
        },
        onTouchEnd(e) {
            const dx = e.changedTouches[0].clientX - this.touchStartX;
            if (Math.abs(dx) > 40) {
                if (dx < 0) this.next();
                else this.prev();
            }
            this.play();
        }
    }
};
</script>

<style scoped>
button {
    outline: none;
}
</style>
