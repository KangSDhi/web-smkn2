<script>
import BaseLayout from './BaseLayout.vue'
import Map from '../../components/Map.vue'
export default {
    name: 'Facility',
    components: {
        BaseLayout,
        Map
    }
}
</script>

<template>
    <BaseLayout>
        <template #content>
            <div class="p-8">
                <h1 class="text-4xl text-black font-bold underline mb-4">Fasilitas</h1>
                <Map/>
            </div>
        </template>
    </BaseLayout>
</template>

<style scoped>

</style>
