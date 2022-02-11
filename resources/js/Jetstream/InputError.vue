<template>
    <div v-show="message">
        <p class="mt-2 text-sm text-red-600">
            {{ message }}
        </p>
    </div>
</template>

<script>
    import { defineComponent } from 'vue'

    export default defineComponent({
        props: ['message']
    })
</script>
