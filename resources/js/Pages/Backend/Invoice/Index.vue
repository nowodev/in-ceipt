<template>

    <app-layout title="Invoice">
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Invoice
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200 sm:px-20">
                        <h1 class="text-4xl font-bold text-black">Choose an <span
                            class="underline decoration-double decoration decoration-cyan-500">Option</span></h1>

                        <Button>Create</Button>

                    </div>

                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import { defineComponent } from 'vue'
    import AppLayout from '@/Layouts/AppLayout.vue'
    import Button from "@/Jetstream/Button";

    export default defineComponent({
        name: "Index",
        components: {
            AppLayout,
            Button
        }
    })
</script>

<style scoped>

</style>
