<template>
    <BaseLayout>
        <template #content>
            <h1>Dashboard Author</h1>
        </template>
    </BaseLayout>
</template>

<script>
import BaseLayout from './BaseLayout.vue';
import { useHead } from '@vueuse/head';

export default {
    components: {
        BaseLayout
    },
    methods: {
        head(){
            useHead({
                title: "Dashboard Author",
                meta: [
                    {
                        name: "description",
                        content: "Halaman Dashboard Author"
                    }
                ]
            })
        }
    },
    mounted() {
        this.head();
    }
}
</script>
