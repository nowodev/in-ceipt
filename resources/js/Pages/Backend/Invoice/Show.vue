<template>

    <app-layout title="Invoice">
        <template #header>
            <h2 class="flex text-xl font-semibold leading-tight text-gray-800">
                <Link :href="route('invoice.index')">
                    <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-6 h-6" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 01-18 0z" />
                    </svg>
                </Link>
                View Invoice
            </h2>
        </template>

        <CardLayout>

            <!-- This example requires Tailwind CSS v2.0+ -->
            <div class="overflow-hidden bg-white shadow sm:rounded-lg">
                <div class="px-4 py-5 sm:px-6">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Invoice Information</h3>
                    <p class="mt-1 max-w-2xl text-sm text-gray-500">Seller & Customer details.</p>
                </div>

                <div class="py-5 border-t">
                    <div class="flex justify-between px-4 sm:px-6">
                        <div>
                            <h1 class="text-2xl font-bold uppercase">Invoice</h1>
                            <h1 class="mt-9 text-lg font-bold">{{ $page.props.user.name }}</h1>
                            <h1 class="text-lg font-bold">{{ $page.props.user.address_1 }}</h1>
                            <h1 class="text-lg font-bold">{{ $page.props.user.email }}</h1>
                            <h1 class="text-lg font-bold">{{
                                    ($page.props.user.mobile_no ?? '080-------') + ', ' + ($page.props.user.office_no ?? '090-------')
                                }}</h1>
                        </div>

                        <div class="mr-4">
                            <h2 class="text-lg">Serial No: {{ invoice.serial_no }}</h2>
                            <h2 class="text-lg">Issue Date: {{ invoice.issue_date }}</h2>
                            <h2 class="mt-3 text-xl">Invoice to:</h2>
                            <h2 class="text-lg font-bold">{{ invoice.customer.fullname }}</h2>
                            <h2 class="text-lg font-bold">{{ invoice.customer.address_1 ?? '---------' }}</h2>
                            <h2 class="text-lg font-bold">{{ invoice.customer.email ?? '---------' }}</h2>
                            <h2 class="text-lg font-bold">{{ invoice.customer.number ?? '090---------' }}</h2>
                        </div>
                    </div>

                    <div class="flex flex-col p-6 mt-4 bg-gray-300 bg-opacity-50">
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
                                                    Item Description
                                                </th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                                    Price
                                                </th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                                    Qty.
                                                </th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                                    Sub Total
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            <tr v-for="inv in invoice.invoice_details" :key="inv.id">
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">{{ count }}</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">{{ inv.description }}</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">{{ inv.unit_price }}</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">{{ inv.quantity }}</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">{{ inv.sub_total }}</div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div>
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr class="flex justify-between w-full">
                                    <th scope="col"
                                        class="px-6 py-3 w-4/5 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                        Payment Info
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 w-1/2 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                        Due By
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 w-1/2 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                        Total Due
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr class="flex justify-between w-full">
                                    <td class="px-6 py-4 space-y-3 w-4/5 whitespace-nowrap">
                                        <p class="text-sm text-gray-900">Account No:</p>
                                        <p class="text-sm text-gray-900">Bank Name:</p>
                                        <p class="text-sm text-gray-900">Account Name:</p>
                                    </td>
                                    <td class="px-6 py-4 w-1/2 whitespace-nowrap">
                                        <p class="text-sm text-left text-gray-900">{{ invoice.due_date }}</p>
                                    </td>
                                    <td class="px-6 py-4 w-1/2 whitespace-nowrap">
                                        <div class="text-sm text-left text-gray-900">50000</div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
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
        name: "Show",
        components: {
            DangerButton,
            CardLayout,
            ButtonLink,
            AppLayout,
            Link
        },
        data() {
            return {
                count: 1,
            }
        },
        props: {
            invoice: Object,
        },
    })
</script>
