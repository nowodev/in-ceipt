<template>
    <app-layout title="Invoice">
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Invoice
            </h2>
        </template>

        <CardLayout>
            <div class="text-right p-6 bg-white border-b border-gray-200">
                <ButtonLink :href="route('invoice.create')">Create</ButtonLink>
            </div>

            <div class="flex flex-col p-6 bg-gray-300 bg-opacity-50">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            SN
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Serial No
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Issue Date
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Due Date
                                        </th>
                                        <!--                                        <th scope="col" class="relative px-6 py-3">-->
                                        <!--                                            <span class="sr-only">Edit</span>-->
                                        <!--                                        </th>-->
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

                                        <!--                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">-->
                                        <!--                                            <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit</a>-->
                                        <!--                                        </td>-->
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
    import AppLayout from '@/Layouts/AppLayout.vue'
    import ButtonLink from "@/Jetstream/ButtonLink";
    import CardLayout from "@/Jetstream/CardLayout";

    export default defineComponent({
        name: "Index",
        components: {
            CardLayout,
            ButtonLink,
            AppLayout,
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
