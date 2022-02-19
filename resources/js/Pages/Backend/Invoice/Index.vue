<template>
    <app-layout title="Invoice">
        <template #header>
            <h2 class="flex text-xl font-semibold leading-tight text-gray-800">
                <Link :href="route('dashboard')">
                    <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-6 h-6" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 01-18 0z" />
                    </svg>
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
                                        <td class="flex items-center px-6 py-4 space-x-4 text-sm font-medium whitespace-nowrap">
                                            <Link :href="route('invoice.show', invoice)" class="">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5"
                                                     viewBox="0 0 20 20" fill="currentColor">
                                                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                                    <path fill-rule="evenodd"
                                                          d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                                          clip-rule="evenodd" />
                                                </svg>
                                            </Link>
                                            <a href="#" class="">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5"
                                                     viewBox="0 0 50 50" style=" fill:#000000;">
                                                    <path
                                                        d="M 44.4375 4.15625 L 4.59375 21.28125 C 4.238281 21.433594 4.011719 21.796875 4 22.1875 C 3.988281 22.578125 4.214844 22.917969 4.5625 23.09375 L 18.5 30.0625 Z M 45.84375 5.5625 L 19.9375 31.5 L 26.90625 45.4375 C 27.078125 45.777344 27.433594 46 27.8125 46 L 27.84375 46 C 28.234375 45.988281 28.5625 45.761719 28.71875 45.40625 Z"></path>
                                                </svg>
                                            </a>
                                            <a class="cursor-pointer" @click="deleteInvoice(invoice)">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5"
                                                     viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd"
                                                          d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                          clip-rule="evenodd" />
                                                </svg>
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
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
    import DangerButton from "@/Jetstream/DangerButton";

    export default defineComponent({
        name: "Index",
        components: {
            DangerButton,
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
        methods: {
            deleteInvoice: function (id) {
                this.$inertia.delete(route('invoice.destroy', id), {
                    preserveScroll: true,
                    preserveState: false
                })
            }
        }
    })
</script>
