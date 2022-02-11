<template>
    <app-layout title="Invoice">
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Invoice
            </h2>
        </template>

        <CardLayout>
            <div class="flex justify-between p-6 bg-white border-b border-gray-200 sm:px-20">
                <h1 class="text-4xl font-bold text-black">Choose an <span
                    class="underline decoration-double decoration decoration-cyan-500">Option</span></h1>

                <ButtonLink :href="route('invoice.create')">Create</ButtonLink>
            </div>

            <div>
                <table class="table">
                    <thead></thead>
                    <tbody></tbody>
                </table>
            </div>
        </CardLayout>
    </app-layout>
</template>

<script>
    import { defineComponent } from 'vue'
    import AppLayout from '@/Layouts/AppLayout.vue'
    import ButtonLink from "@/Jetstream/ButtonLink";
    import CardLayout from "@/Jetstream/CardLayout";

    export default defineComponent({
        name: "Index",
        components: {
            CardLayout,
            ButtonLink,
            AppLayout,
        }
    })
</script>

<style scoped>

</style>
