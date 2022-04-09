<template>
    <div class="mx-auto max-w-7xl">
        <div class="p-10 font-mono">
            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
                <div class="flex flex-col">
                    <h2 class="text-4xl sm:py-5">Rick Sanders</h2>
                    <span class="text-gray-500">+65 98784194</span>
                </div>

                <div class="flex flex-col sm:justify-end sm:items-end">
                    <h2 class="text-4xl text-gray-500 sm:py-5">Receipt</h2>

                    <dl class="max-w-1/2">
                        <div class="grid grid-cols-2 items-end">
                            <dt class="text-gray-500">
                                Receipt number
                            </dt>
                            <dd class="text-right">
                                RF-310205
                            </dd>
                        </div>
                        <div class="grid grid-cols-2">
                            <dt class="text-gray-500">
                                Invoice number
                            </dt>
                            <dd class="text-right">
                                100205
                            </dd>
                        </div>
                        <div class="grid grid-cols-2">
                            <dt class="text-gray-500">
                                Date paid
                            </dt>
                            <dd class="text-right">
                                Dec 14, 2016
                            </dd>
                        </div>
                        <div class="grid grid-cols-2">
                            <dt class="text-gray-500">
                                Payment method
                            </dt>
                            <dd class="text-right">
                                PayPal
                            </dd>
                        </div>
                    </dl>
                </div>

                <div class="md:col-span-2">
                    <h4 class="text-lg">Paid by</h4>
                    <p class="text-gray-500">Pearson Specter Corporation</p>
                    <p class="text-gray-500">payments@deskera.com</p>
                </div>
            </div>

            <div class="flex flex-col">
                <h1 class="py-10 text-3xl sm:py-20">$5000.00 paid on Dec 14, 2016</h1>

                <div class="overflow-scroll">
                    <table class="min-w-full">
                        <thead class="text-bold">
                            <tr>
                                <th class="py-4 w-2/5 text-left sm:px-8"
                                    scope="col">
                                    Description
                                </th>
                                <th class="py-4 w-1/5 text-left sm:px-8"
                                    scope="col">
                                    Qty
                                </th>
                                <th class="py-4 w-1/5 text-left sm:px-8"
                                    scope="col">
                                    Unit price
                                </th>
                                <th class="py-4 w-1/5 text-right sm:px-8"
                                    scope="col">
                                    Amount
                                </th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-200">
                            <tr class="text-left bg-gray-50">
                                <td class="py-4 sm:px-8">
                                    Web Development Service
                                </td>
                                <td class="py-4 sm:px-8">
                                    1
                                </td>
                                <td class="py-4 sm:px-8">
                                    $5000.00
                                </td>
                                <td class="py-4 text-right sm:px-8">
                                    $5000.00
                                </td>
                            </tr>
                            <tr>
                                <td class="" colspan="2">
                                    &nbsp;
                                </td>
                                <td class="py-4 sm:px-8">
                                    Subtotal
                                </td>
                                <td class="py-4 text-right sm:px-8">
                                    $5000.00
                                </td>
                            </tr>
                            <tr>
                                <td class="" colspan="2">
                                    &nbsp;
                                </td>
                                <td class="py-4 bg-gray-50 sm:px-8">
                                    Amount paid
                                </td>
                                <td class="py-4 text-right bg-gray-50 sm:px-8">
                                    $5000.00
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { defineComponent } from 'vue'

    export default defineComponent({
        name: "Three",
        props: {
            receipt: Object,
        },
    })
</script>
