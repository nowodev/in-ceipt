<template>
    <div class="flex justify-center items-center min-h-screen bg-gray-100">
        <div class="w-3/5 bg-white shadow-lg">
            <div class="flex justify-between p-4">
                <div>
                    <h1 class="text-3xl italic font-extrabold tracking-widest text-indigo-500">In-ceipt</h1>
                    <p class="text-base">If account is not paid within 7 days the credits details supplied as
                        confirmation.</p>
                </div>
                <div class="p-2">
                    <ul class="flex">
                        <li class="flex flex-col items-center p-2 border-l-2 border-indigo-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-600" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                            </svg>
                            <span class="text-sm">
                                    www.larainfo.com
                                </span>
                            <span class="text-sm">
                                    www.lorememhh.com
                                </span>
                        </li>
                        <li class="flex flex-col p-2 border-l-2 border-indigo-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-600" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span class="text-sm">
                                    2821 Kensington Road,Avondale Estates, GA 30002 USA
                                </span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="w-full h-0.5 bg-indigo-500"></div>
            <div class="flex justify-between p-4">
                <div>
                    <h6 class="font-bold">Order Date : <span class="text-sm font-medium">{{ invoice.issue_date }}</span>
                    </h6>
                    <h6 class="font-bold">Order ID : <span class="text-sm font-medium">{{ invoice.serial_no }}</span>
                    </h6>
                </div>
                <div class="w-40">
                    <address class="text-sm">
                        <span class="font-bold"> Billed To : </span>
                        {{ invoice.customer.fullname }} <br>
                        {{ invoice.customer.address_1 }} <br>
                        P: {{ invoice.customer.number }}
                    </address>
                </div>
                <div class="w-40">
                    <address class="text-sm">
                        <span class="font-bold">Ship To :</span>
                        {{ invoice.customer.fullname }} <br>
                        {{ invoice.customer.address_1 }} <br>
                        P: {{ invoice.customer.number }}
                    </address>
                </div>
                <div></div>
            </div>
            <div class="flex justify-center p-4">
                <div class="border-b border-gray-200 shadow">
                    <table class="">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-2 text-xs text-gray-500">
                                    #
                                </th>
                                <th class="px-4 py-2 text-xs text-gray-500">
                                    Product Name
                                </th>
                                <th class="px-4 py-2 text-xs text-gray-500">
                                    Quantity
                                </th>
                                <th class="px-4 py-2 text-xs text-gray-500">
                                    Rate
                                </th>
                                <th class="px-4 py-2 text-xs text-gray-500">
                                    Total
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            <tr v-for="(inv, index) in invoice.invoice_details" :key="index" class="whitespace-nowrap">
                                <td class="px-6 py-4 text-sm text-gray-500">
                                    1
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-900">
                                    {{ inv.description }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500">
                                    {{ inv.quantity }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500">
                                    ${{ inv.unit_price }}
                                </td>
                                <td class="px-6 py-4">
                                    ${{ inv.total }}
                                </td>
                            </tr>
                            <tr class="">
                                <td colspan="3"></td>
                                <td class="text-sm font-bold">Sum Total</td>
                                <td class="text-sm font-bold tracking-wider"><b>${{ invoice.sum_total }}</b></td>
                            </tr>
                            <!--end tr-->
                            <tr>
                                <th colspan="3"></th>
                                <td class="text-sm font-bold"><b>Discount</b></td>
                                <td class="text-sm font-bold"><b>{{ invoice.discount }}%</b></td>
                            </tr>
                            <!--end tr-->
                            <tr class="text-white bg-gray-800">
                                <th colspan="3"></th>
                                <td class="text-sm font-bold"><b>Sub Total</b></td>
                                <td class="text-sm font-bold"><b>${{ invoice.sub_total }}</b></td>
                            </tr>
                            <!--end tr-->

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="flex justify-between p-4">
                <div>
                    <h3 class="text-xl">Terms And Condition :</h3>
                    <ul class="text-xs list-disc list-inside">
                        <li>All accounts are to be paid within 7 days from receipt of invoice.</li>
                        <li>To be paid by cheque or credit card or direct payment online.</li>
                        <li>If account is not paid within 7 days the credits details supplied.</li>
                    </ul>
                </div>
                <div class="p-4">
                    <h3>Signature</h3>
                    <div class="text-4xl italic text-indigo-500">AAA</div>
                </div>
            </div>
            <div class="w-full h-0.5 bg-indigo-500"></div>

            <div class="p-4">
                <div class="flex justify-center items-center">
                    Thank you very much for doing business with us.
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { defineComponent } from 'vue'

    export default defineComponent({
        name: "Two",
        props: {
            invoice: Object,
        },
    })
</script>
