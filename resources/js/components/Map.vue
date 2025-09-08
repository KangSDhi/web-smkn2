<script>
import mapboxgl from 'mapbox-gl'
import 'mapbox-gl/dist/mapbox-gl.css'
import { useHead } from '@vueuse/head';

mapboxgl.accessToken = "pk.eyJ1Ijoia2FuZ3NkaGkiLCJhIjoiY2xzcHN4djVrMDFxeTJrcWtsanZhZzV0cSJ9.R9Y_doL1yNPTpsLrVfLWqw"
export default {
    name: "Map",
    data(){
        return {
            map: null,
            coordinates: [
                {
                    nama: "Bengkel TKP",
                    lngLat: [111.875758, -7.162380],
                    marker: "red",
                    isImage: false,
                    image: [
                        {
                            file:  "BKP.jpeg",
                            description: "Bengkel TKP",
                        }
                    ]
                },
                {
                    nama: "Bengkel TKR 1",
                    lngLat: [111.876209, -7.162195],
                    marker: "red",
                    isImage: false,
                    image: [
                        {
                            file:  "TKR.jpg",
                            description: "Bengkel TKR",
                        },
                        {
                            file:  "TKRO 2.jpg",
                            description: "Bengkel TKR",
                        }
                    ]
                },
                {
                    nama: "Bengkel TKR 2",
                    lngLat: [111.876716, -7.162069],
                    marker: "red",
                    isImage: false,
                    image: []
                },
                {
                    nama: "Bengkel MEKA",
                    lngLat: [111.876496, -7.161375],
                    marker: "red",
                    isImage: false,
                    image: [
                        {
                            file:  "MEKA.jpg",
                            description: "Bengkel MEKA",
                        },
                    ]
                },
                {
                    nama: "Bengkel TITL",
                    lngLat: [111.877021, -7.161798],
                    marker: "red",
                    isImage: false,
                    image: [
                        {
                            file:  "TITL.jpg",
                            description: "Bengkel TITL",
                        },
                    ]
                },
                {
                    nama: "Bengkel TEI",
                    lngLat: [111.877383, -7.161660],
                    marker: "red",
                    isImage: false,
                    image: [
                        {
                            file:   "TEI.jpg",
                            description: "Bengkel TEI",
                        },
                    ]
                },
                {
                    nama: "Bengkel DPIB",
                    lngLat: [111.877702, -7.161625],
                    marker: "red",
                    isImage: false,
                    image: [
                        {
                            file:  "DPIB.jpg",
                            description: "Bengkel DPIB",
                        },
                    ]
                },
                {
                    nama: "Bengkel KI",
                    lngLat: [111.877630, -7.161439],
                    marker: "red",
                    isImage: false,
                    image: [
                        {
                            file:  "KI.jpg",
                            description: "Bengkel KI",
                        },
                    ]
                },
                {
                    nama: "Bengkel TKJ",
                    lngLat: [111.877720, -7.161003],
                    marker: "red",
                    isImage: false,
                    image: [
                        {
                            file:  "TKJ.jpg",
                            description: "Bengkel TKJ",
                        },
                    ]
                },
                {
                    nama: "Bengkel GMT",
                    lngLat: [111.877720, -7.161063],
                    marker: "red",
                    isImage: false,
                    image: [
                        {
                            file:  "GMT.jpg",
                            description: "Bengkel GMT",
                        },

                    ]
                },
                {
                    nama: "Kantor TU",
                    lngLat: [111.876939, -7.161397],
                    marker: "green",
                    isImage: false,
                    image: [
                        {
                            file:  "WhatsApp Image 2022-11-02 at 08.10.55.jpeg",
                            description: "Ruang TU",
                        },
                        {
                            file:  "WhatsApp Image 2022-11-02 at 08.10.55 (1).jpeg",
                            description: "Ruang TU",
                        },
                        {
                            file:  "WhatsApp Image 2022-11-02 at 08.10.56 (1).jpeg",
                            description: "Ruang TU",
                        },
                    ]
                },
                {
                    nama: "Kantor Humas",
                    lngLat: [111.876752, -7.161595],
                    marker: "green",
                    isImage: false,
                    image: []
                },
                {
                    nama: "Kantor Kesiswaan",
                    lngLat: [111.877224, -7.161418],
                    marker: "green",
                    isImage: false,
                    image: []
                }


            ]
        }
    },
    methods:{
        head() {
            useHead({
                title: "Halaman Fasilitas",
                meta: [
                    {
                        name: "description",
                        content: "Halaman - Fasilitas Web SMKN 2 Bojonegoro"
                    }
                ]
            });
        },
        loadMap(){
            this.map = new mapboxgl.Map({
                container: this.$refs.mapContainer,
                style: 'mapbox://styles/mapbox/standard-satellite',
                center: [111.877249, -7.161607], // opsional, set Bojonegoro misalnya
                zoom: 17
            });

            // Loop semua coordinates → buat marker + popup
            this.coordinates.forEach(item => {
                const [lng, lat] = item.lngLat
                const googleMapsUrl = `https://www.google.com/maps/dir/?api=1&destination=${lat},${lng}`

                const popupContent = `
                  <div style="font-size:14px;">
                    <strong>${item.nama}</strong><br/>
                    <a href="${googleMapsUrl}" target="_blank" style="color:blue; text-decoration:underline;">
                      Lihat Rute di Google Maps
                    </a>
                    <button class="popup-button text-blue-900 underline cursor-pointer" data-nama="${item.nama}">
                      Lihat Foto
                    </button>
                  </div>
                `

                const popup = new mapboxgl.Popup({ offset: 25 }).setHTML(popupContent);
                const marker = new mapboxgl.Marker({ color: item.marker })
                    .setLngLat(item.lngLat)
                    .setPopup(popup)
                    .addTo(this.map);

                popup.on('open', () => {
                    const button = document.querySelector('.popup-button[data-nama="' + item.nama + '"]');
                    if (button) {
                        button.addEventListener('click', () => this.showImage(item.nama));
                    }
                });
            })
        },
        showImage(name){
            this.resetShowImage();
            this.coordinates.forEach(item => {
                if (item.nama === name){
                    item.isImage = true;
                }
            })
        },
        resetShowImage(){
            this.coordinates.forEach(item => {
                item.isImage = false;
            })
        }
    },
    mounted() {
        this.head();
        this.loadMap();
    },
    unmounted() {
        this.map.remove();
        this.map = null;
    }
}
</script>

<template>
    <div>
        <div class="relative">
            <div ref="mapContainer" class="w-full h-[500px] rounded-lg shadow-md"></div>

            <!-- Legend -->
            <div class="absolute bottom-4 left-4 bg-white/90 p-3 rounded-lg shadow-md text-sm">
                <h3 class="font-semibold mb-2">Legenda</h3>
                <div class="flex items-center space-x-2 mb-1">
                    <span class="w-4 h-4 rounded-full bg-red-500"></span>
                    <span>Bengkel Jurusan</span>
                </div>
                <div class="flex items-center space-x-2">
                    <span class="w-4 h-4 rounded-full bg-green-500"></span>
                    <span>Kantor</span>
                </div>
            </div>
        </div>
        <div class="mt-4">
            <div class="grid grid-cols-3 gap-4">
                <template v-for="(item, index) in coordinates">
                    <template v-if="item.isImage">
                        <template v-for="(it, index) in item.image">
                            <div>
                                <img :src="'/assets/img/facility/bengkel/'+it.file" class="rounded-lg shadow" :alt="'Gambar '+it.description" srcset="">
                                <p class="text-center text-lg text-black font-bold underline mb-4">{{ it.description }}</p>
                            </div>
                        </template>
                    </template>
                </template>
            </div>
        </div>
    </div>
</template>

