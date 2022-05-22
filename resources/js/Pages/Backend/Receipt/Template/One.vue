<template>
    <div class="overflow-hidden bg-white shadow sm:rounded-lg">
        <div class="px-4 py-5 sm:px-6">
            <h3 class="text-lg font-medium leading-6 text-gray-900">Receipt Information</h3>
            <p class="mt-1 max-w-2xl text-sm text-gray-500">Seller & Customer details.</p>
        </div>

        <div class="py-5 border-t">
            <div class="flex justify-between px-4 sm:px-6">
                <div>
                    <h1 class="text-2xl font-bold uppercase">receipt</h1>
                    <h1 class="mt-9 text-lg font-bold">{{ $page.props.user.name }}</h1>
                    <h1 class="text-lg font-bold">{{ $page.props.user.address_1 }}</h1>
                    <h1 class="text-lg font-bold">{{ $page.props.user.email }}</h1>
                    <h1 class="text-lg font-bold">{{
                            ($page.props.user.mobile_no ?? '080-------') + ', ' + ($page.props.user.office_no ?? '090-------')
                        }}</h1>
                </div>

                <div class="mr-4">
                    <h2 class="text-lg">Serial No: {{ receipt.serial_no }}</h2>
                    <h2 class="text-lg">Issue Date: {{ receipt.issue_date }}</h2>
                    <h2 class="mt-3 text-xl">Receipt to:</h2>
                    <h2 class="text-lg font-bold">{{ receipt.customer.fullname }}</h2>
                    <h2 class="text-lg font-bold">{{ receipt.customer.address_1 ?? '---------' }}</h2>
                    <h2 class="text-lg font-bold">{{ receipt.customer.email ?? '---------' }}</h2>
                    <h2 class="text-lg font-bold">{{ receipt.customer.number ?? '090---------' }}</h2>
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
                                    <tr v-for="(rec, index) in receipt.receipt_details" :key="rec.id">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">{{ index + 1 }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">{{ rec.description }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">{{ rec.unit_price }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">{{ rec.quantity }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">{{ rec.total }}</div>
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
                            <th class="px-6 py-3 w-1/2 text-xs font-medium tracking-wider text-left text-gray-500 uppercase"
                                scope="col">
                                Total Due
                            </th>
                            <th class="px-6 py-3 w-1/2 text-xs font-medium tracking-wider text-left text-gray-500 uppercase"
                                scope="col">
                                Amount Paid
                            </th>
                            <th class="px-6 py-3 w-1/2 text-xs font-medium tracking-wider text-left text-gray-500 uppercase"
                                scope="col">
                                Amount Owing
                            </th>
                            <th class="px-6 py-3 w-1/2 text-xs font-medium tracking-wider text-left text-gray-500 uppercase"
                                scope="col">
                                Payment Date
                            </th>
                            <th class="px-6 py-3 w-1/2 text-xs font-medium tracking-wider text-left text-gray-500 uppercase"
                                scope="col">
                                Payment Method
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr class="flex justify-between w-full">
                            <td class="px-6 py-4 w-1/2 whitespace-nowrap">
                                <div class="text-sm text-left text-gray-900">{{ receipt.sub_total }}</div>
                            </td>
                            <td class="px-6 py-4 w-1/2 whitespace-nowrap">
                                <div class="text-sm text-left text-gray-900">{{ receipt.amount_paid }}</div>
                            </td>
                            <td class="px-6 py-4 w-1/2 whitespace-nowrap">
                                <div class="text-sm text-left text-gray-900">{{ receipt.amount_owing }}</div>
                            </td>
                            <td class="px-6 py-4 w-1/2 whitespace-nowrap">
                                <p class="text-sm text-left text-gray-900">{{ receipt.payment_date }}</p>
                            </td>
                            <td class="px-6 py-4 w-1/2 whitespace-nowrap">
                                <p class="text-sm text-left text-gray-900">{{ receipt.payment_method }}</p>
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
            receipt: Object,
        },
    })
</script>
