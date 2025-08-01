<template>
    <BaseLayout>
        <template #content>
            <h1>Post</h1>
            <QuillEditor theme="snow"/>
        </template>
    </BaseLayout>
</template>

<script>
import BaseLayout from '../BaseLayout.vue';
import { QuillEditor } from '@vueup/vue-quill';
import '@vueup/vue-quill/dist/vue-quill.snow.css';

export default {
    name: 'Add Post',
    components: {
        BaseLayout,
        QuillEditor
    }
}
</script>