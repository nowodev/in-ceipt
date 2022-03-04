<template>
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
                                        <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase"
                                            scope="col">
                                            SN
                                        </th>
                                        <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase"
                                            scope="col">
                                            Item Description
                                        </th>
                                        <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase"
                                            scope="col">
                                            Price
                                        </th>
                                        <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase"
                                            scope="col">
                                            Qty.
                                        </th>
                                        <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase"
                                            scope="col">
                                            Total
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <tr v-for="(inv, index) in invoice.invoice_details" :key="inv.id">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">{{ index + 1 }}</div>
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
                                            <div class="text-sm text-gray-900">{{ inv.total }}</div>
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
                            <th class="px-6 py-3 w-4/5 text-xs font-medium tracking-wider text-left text-gray-500 uppercase"
                                scope="col">
                                Payment Info
                            </th>
                            <th class="px-6 py-3 w-1/2 text-xs font-medium tracking-wider text-left text-gray-500 uppercase"
                                scope="col">
                                Due By
                            </th>
                            <th class="px-6 py-3 w-1/2 text-xs font-medium tracking-wider text-left text-gray-500 uppercase"
                                scope="col">
                                Sum Total
                            </th>
                            <th class="px-6 py-3 w-1/2 text-xs font-medium tracking-wider text-left text-gray-500 uppercase"
                                scope="col">
                                Discount (%)
                            </th>
                            <th class="px-6 py-3 w-1/2 text-xs font-medium tracking-wider text-left text-gray-500 uppercase"
                                scope="col">
                                Total Due
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr class="flex justify-between w-full">
                            <td class="px-6 py-4 space-y-3 w-4/5 whitespace-nowrap">
                                <p class="text-sm text-gray-900 flex justify-between">
                                    Bank Name: <strong>{{ $page.props.user.bank_name }}</strong>
                                </p>
                                <p class="text-sm text-gray-900 flex justify-between">
                                    Acc. Name: <strong>{{ $page.props.user.account_name }}</strong>
                                </p>
                                <p class="text-sm text-gray-900 flex justify-between">
                                    Acc. No.: <strong>{{ $page.props.user.account_number }}</strong>
                                </p>
                            </td>
                            <td class="px-6 py-4 w-1/2 whitespace-nowrap">
                                <p class="text-sm text-left text-gray-900">{{ invoice.due_date }}</p>
                            </td>
                            <td class="px-6 py-4 w-1/2 whitespace-nowrap">
                                <div class="text-sm text-left text-gray-900">{{ invoice.sum_total }}</div>
                            </td>
                            <td class="px-6 py-4 w-1/2 whitespace-nowrap">
                                <div class="text-sm text-left text-gray-900">{{ invoice.discount }}</div>
                            </td>
                            <td class="px-6 py-4 w-1/2 whitespace-nowrap">
                                <div class="text-sm text-left text-gray-900">{{ invoice.sub_total }}</div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
    import { defineComponent } from 'vue'

    export default defineComponent({
        name: "One",
        props: {
            invoice: Object,
        },
    })
</script>
