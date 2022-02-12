<template>
    <app-layout title="Invoice">
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                <Link :href="route('dashboard')">
                    <i class="mr-4 text-xl text-black fa-regular fa-circle-left"></i>
                </Link>
                Invoice
            </h2>
        </template>

        <CardLayout>
            <div class="p-6 text-right bg-white border-b border-gray-200">
                <ButtonLink :href="route('invoice.create')">Create</ButtonLink>
            </div>

            <div class="flex flex-col p-6 bg-gray-300 bg-opacity-50">
                <div class="overflow-x-auto -my-2 sm:-mx-6 lg:-mx-8">
                    <div class="inline-block py-2 min-w-full align-middle sm:px-6 lg:px-8">
                        <div class="overflow-hidden border-b border-gray-200 shadow sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                            SN
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                            Serial No
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                            Issue Date
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                            Due Date
                                        </th>
                                        <th scope="col" class="relative px-6 py-3">
                                            <span class="sr-only">Edit</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <tr v-for="invoice in invoices" :key="invoice.id">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">{{ count }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">{{ invoice.serial_no }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">{{ invoice.issue_date }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">{{ invoice.due_date }}</div>
                                        </td>
                                        <td class="px-6 py-4 text-sm font-medium whitespace-nowrap space-x-4">
                                            <a href="#" class="">
                                                <i class="fa-solid fa-eye"></i>
                                            </a>
                                            <a href="#" class="">
                                                <i class="fa-solid fa-paper-plane"></i>
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
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
    import { Link } from "@inertiajs/inertia-vue3";
    import AppLayout from '@/Layouts/AppLayout.vue'
    import ButtonLink from "@/Jetstream/ButtonLink";
    import CardLayout from "@/Jetstream/CardLayout";

    export default defineComponent({
        name: "Index",
        components: {
            CardLayout,
            ButtonLink,
            AppLayout,
            Link
        },
        props: {
            invoices: Object,
            count: {
                type: Number,
                default: 1,
            }
        },
    })
</script>
