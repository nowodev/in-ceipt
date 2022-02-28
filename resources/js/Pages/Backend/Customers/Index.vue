<template>
    <app-layout title="Customers">
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
                Customers
            </h2>
        </template>

        <CardLayout>
            <div class="p-6 text-right bg-white border-b border-gray-200">
                <ButtonLink :href="route('customers.create')">Create</ButtonLink>
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
                                            Fullname
                                        </th>
                                        <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase"
                                            scope="col">
                                            Email
                                        </th>
                                        <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase"
                                            scope="col">
                                            Number
                                        </th>
                                        <th class="relative px-6 py-3" scope="col">
                                            <span class="sr-only">Edit</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <tr v-for="(customer, index) in customers.data" :key="customer.id">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">{{ index + 1 }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">{{ customer.fullname }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">{{ customer.email }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">{{ customer.number }}</div>
                                        </td>
                                        <td class="flex items-center px-6 py-4 space-x-4 text-sm font-medium whitespace-nowrap">
                                            <Link :href="route('customers.show', customer)" class="">
                                                <svg class="w-5 h-5" fill="currentColor"
                                                     viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                                    <path clip-rule="evenodd"
                                                          d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                                          fill-rule="evenodd" />
                                                </svg>
                                            </Link>
                                            <Link :href="route('customers.edit', customer)" class="">
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
                                            <a class="cursor-pointer" @click="confirmDelete(customer)">
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
                                    <tr v-if="customers.data == ''">
                                        <td class="px-6 py-4 whitespace-nowrap" colspan="5">
                                            <div class="text-sm text-center text-gray-900">No Records Found</div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <Pagination :links="customers.links" />
                        </div>
                    </div>
                </div>
            </div>

            <DialogModal :show="confirmingDelete" @close="closeModal">
                <template #title>
                    Delete Customer
                </template>

                <template #content>
                    Are you sure you want to delete this customer?
                </template>

                <template #footer>
                    <SecondaryButton @click="closeModal">
                        Cancel
                    </SecondaryButton>

                    <Button class="ml-3" @click="deleteCustomer(delete_data)">
                        Delete Customer
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
            customers: Object,
        },

        data() {
            return {
                confirmingDelete: false,
                delete_data: null,
            }
        },

        methods: {
            confirmDelete(customer) {
                this.delete_data = customer
                this.confirmingDelete = true
            },

            closeModal() {
                this.confirmingDelete = false
            },

            deleteCustomer: function (customer) {
                this.$inertia.delete(route('customers.destroy', customer), {
                    preserveScroll: true,
                    preserveState: false
                })
            }
        }
    })
</script>
