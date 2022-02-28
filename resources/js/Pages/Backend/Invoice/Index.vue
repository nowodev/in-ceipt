<template>
    <app-layout title="Invoice">
        <template #header>
            <h2 class="flex text-xl font-semibold leading-tight text-gray-800">
                <Link :href="route('dashboard')">
                    <svg class="mr-2 w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                         xmlns="http://www.w3.org/2000/svg">
                        <path d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 01-18 0z" stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2" />
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
                                        <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase"
                                            scope="col">
                                            SN
                                        </th>
                                        <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase"
                                            scope="col">
                                            Serial No
                                        </th>
                                        <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase"
                                            scope="col">
                                            Issue Date
                                        </th>
                                        <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase"
                                            scope="col">
                                            Due Date
                                        </th>
                                        <th class="relative px-6 py-3" scope="col">
                                            <span class="sr-only">Edit</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <tr v-for="(invoice, index) in invoices.data" :key="invoice.id">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">{{ index + 1 }}</div>
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
                                                <svg class="w-5 h-5" fill="currentColor"
                                                     viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                                    <path clip-rule="evenodd"
                                                          d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                                          fill-rule="evenodd" />
                                                </svg>
                                            </Link>
                                            <a href="#" @click="sendMail(invoice.id)">
                                                <svg class="w-5 h-5" style=" fill:#000000;"
                                                     viewBox="0 0 50 50" xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M 44.4375 4.15625 L 4.59375 21.28125 C 4.238281 21.433594 4.011719 21.796875 4 22.1875 C 3.988281 22.578125 4.214844 22.917969 4.5625 23.09375 L 18.5 30.0625 Z M 45.84375 5.5625 L 19.9375 31.5 L 26.90625 45.4375 C 27.078125 45.777344 27.433594 46 27.8125 46 L 27.84375 46 C 28.234375 45.988281 28.5625 45.761719 28.71875 45.40625 Z"></path>
                                                </svg>
                                            </a>
                                            <Link :href="route('invoice.edit', invoice)" class="">
                                                <svg class="w-5 h-5" fill="currentColor"
                                                     stroke="currentColor" viewBox="0 0 24 24"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="2" />
                                                </svg>
                                            </Link>
                                            <a class="cursor-pointer" @click="confirmDelete(invoice)">
                                                <svg class="w-5 h-5" fill="currentColor"
                                                     viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                    <path clip-rule="evenodd"
                                                          d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                          fill-rule="evenodd" />
                                                </svg>
                                            </a>
                                        </td>
                                    </tr>

                                    <!-- show no record when table is empty -->
                                    <tr v-if="invoices.data == ''">
                                        <td class="px-6 py-4 whitespace-nowrap" colspan="5">
                                            <div class="text-sm text-center text-gray-900">No Records Found</div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <Pagination :links="invoices.links" />
                        </div>
                    </div>
                </div>
            </div>

            <DialogModal :show="confirmingDelete" @close="closeModal">
                <template #title>
                    Delete Invoice
                </template>

                <template #content>
                    Are you sure you want to delete this invoice?
                </template>

                <template #footer>
                    <SecondaryButton @click="closeModal">
                        Cancel
                    </SecondaryButton>

                    <Button class="ml-3" @click="deleteInvoice(delete_data)">
                        Delete Invoice
                    </Button>
                </template>
            </DialogModal>
        </CardLayout>
    </app-layout>
</template>

<script>
    import Button from "@/Jetstream/Button";
    import ButtonLink from "@/Jetstream/ButtonLink";
    import CardLayout from "@/Jetstream/CardLayout";
    import DangerButton from "@/Jetstream/DangerButton";
    import DialogModal from "@/Jetstream/DialogModal";
    import Pagination from "@/Jetstream/Pagination";
    import SecondaryButton from "@/Jetstream/SecondaryButton";
    import AppLayout from '@/Layouts/AppLayout.vue'
    import { Link } from "@inertiajs/inertia-vue3";
    import { defineComponent } from 'vue'

    export default defineComponent({
        name: "Index",

        components: {
            Button,
            SecondaryButton,
            DialogModal,
            Pagination,
            DangerButton,
            CardLayout,
            ButtonLink,
            AppLayout,
            Link
        },

        props: {
            invoices: Object,
        },

        data() {
            return {
                confirmingDelete: false,
                delete_data: null,
            }
        },

        methods: {
            confirmDelete(invoice) {
                this.delete_data = invoice
                this.confirmingDelete = true
            },

            closeModal() {
                this.confirmingDelete = false
            },

            sendMail: function (id) {
                this.$inertia.get(route('invoice.send_mail', id), {
                    preserveScroll: true,
                    preserveState: false
                })
            },

            deleteInvoice: function (invoice) {
                this.$inertia.delete(route('invoice.destroy', invoice), {
                    preserveScroll: true,
                    preserveState: false
                })
            }
        }
    })
</script>
