@extends('emails.layout')

@section('content')
    <div class="overflow-hidden bg-white shadow sm:rounded-lg" style="overflow: hidden; --tw-bg-opacity: 1; background-color: rgb(255 255 255 / var(--tw-bg-opacity)); --tw-shadow: 0 1px 3px 0 rgb(0 0 0 / 0.1), 0 1px 2px -1px rgb(0 0 0 / 0.1); --tw-shadow-colored: 0 1px 3px 0 var(--tw-shadow-color), 0 1px 2px -1px var(--tw-shadow-color); box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow);">
        <div class="px-4 py-5 sm:px-6" style="padding-left: 16px; padding-right: 16px; padding-top: 20px; padding-bottom: 20px;">
            <h3 class="text-lg font-medium leading-6 text-gray-900" style="font-size: 18px; font-weight: 500; line-height: 24px; --tw-text-opacity: 1; color: rgb(17 24 39 / var(--tw-text-opacity));">Invoice Information</h3>
            <p class="mt-1 max-w-2xl text-sm text-gray-500" style="margin-top: 4px; max-width: 42rem; font-size: 14px; --tw-text-opacity: 1; color: rgb(107 114 128 / var(--tw-text-opacity));">Seller & Customer details.</p>
        </div>

        <div class="py-5 border-t" style="border-top-width: 1px; padding-top: 20px; padding-bottom: 20px;">
            <div class="flex justify-between px-4 sm:px-6" style="display: flex; justify-content: space-between; padding-left: 16px; padding-right: 16px;">
                <div>
                    <h1 class="text-2xl font-bold uppercase" style="font-size: 24px; font-weight: 700; text-transform: uppercase;">Invoice</h1>
                    <h1 class="mt-9 text-lg font-bold" style="margin-top: 36px; font-size: 18px; font-weight: 700;">{{ $invoice->user->name }}</h1>
                    <h1 class="text-lg font-bold" style="font-size: 18px; font-weight: 700;">{{ $invoice->user->address_1 }}</h1>
                    <h1 class="text-lg font-bold" style="font-size: 18px; font-weight: 700;">{{ $invoice->user->email }}</h1>
                    <h1 class="text-lg font-bold" style="font-size: 18px; font-weight: 700;">{{
                            ($invoice->user->mobile_no ?? '080-------') . ', ' . ($invoice->user->office_no ?? '090-------')
                        }}</h1>
                </div>

                <div class="mr-4" style="margin-right: 16px;">
                    <h2 class="text-lg" style="font-size: 18px;">Serial No: {{ $invoice->serial_no }}</h2>
                    <h2 class="text-lg" style="font-size: 18px;">Issue Date: {{ $invoice->issue_date }}</h2>
                    <h2 class="mt-3 text-xl" style="margin-top: 12px; font-size: 20px;">Invoice to:</h2>
                    <h2 class="text-lg font-bold" style="font-size: 18px; font-weight: 700;">{{ $invoice->customer->fullname }}</h2>
                    <h2 class="text-lg font-bold" style="font-size: 18px; font-weight: 700;">{{ $invoice->customer->address_1 ?? '---------' }}</h2>
                    <h2 class="text-lg font-bold" style="font-size: 18px; font-weight: 700;">{{ $invoice->customer->email ?? '---------' }}</h2>
                    <h2 class="text-lg font-bold" style="font-size: 18px; font-weight: 700;">{{ $invoice->customer->number ?? '090---------' }}</h2>
                </div>
            </div>

            <div class="flex flex-col p-6 mt-4 bg-gray-300 bg-opacity-50" style="margin-top: 16px; display: flex; flex-direction: column; background-color: rgb(209 213 219 / var(--tw-bg-opacity)); --tw-bg-opacity: 0.5; padding: 24px;">
                <div class="overflow-x-auto -my-2 sm:-mx-6 lg:-mx-8" style="margin-top: -8px; margin-bottom: -8px; overflow-x: auto;">
                    <div class="inline-block py-2 min-w-full align-middle sm:px-6 lg:px-8" style="display: inline-block; min-width: 100%; padding-top: 8px; padding-bottom: 8px; vertical-align: middle;">
                        <div class="overflow-hidden border-b border-gray-200 shadow sm:rounded-lg" style="overflow: hidden; border-bottom-width: 1px; --tw-border-opacity: 1; border-color: rgb(229 231 235 / var(--tw-border-opacity)); --tw-shadow: 0 1px 3px 0 rgb(0 0 0 / 0.1), 0 1px 2px -1px rgb(0 0 0 / 0.1); --tw-shadow-colored: 0 1px 3px 0 var(--tw-shadow-color), 0 1px 2px -1px var(--tw-shadow-color); box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow);">
                            <table class="min-w-full divide-y divide-gray-200" style="min-width: 100%;">
                                <thead class="bg-gray-50" style="--tw-bg-opacity: 1; background-color: rgb(249 250 251 / var(--tw-bg-opacity));">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase" style="padding-left: 24px; padding-right: 24px; padding-top: 12px; padding-bottom: 12px; text-align: left; font-size: 12px; font-weight: 500; text-transform: uppercase; letter-spacing: 0.05em; --tw-text-opacity: 1; color: rgb(107 114 128 / var(--tw-text-opacity));">
                                            SN
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase" style="padding-left: 24px; padding-right: 24px; padding-top: 12px; padding-bottom: 12px; text-align: left; font-size: 12px; font-weight: 500; text-transform: uppercase; letter-spacing: 0.05em; --tw-text-opacity: 1; color: rgb(107 114 128 / var(--tw-text-opacity));">
                                            Item Description
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase" style="padding-left: 24px; padding-right: 24px; padding-top: 12px; padding-bottom: 12px; text-align: left; font-size: 12px; font-weight: 500; text-transform: uppercase; letter-spacing: 0.05em; --tw-text-opacity: 1; color: rgb(107 114 128 / var(--tw-text-opacity));">
                                            Price
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase" style="padding-left: 24px; padding-right: 24px; padding-top: 12px; padding-bottom: 12px; text-align: left; font-size: 12px; font-weight: 500; text-transform: uppercase; letter-spacing: 0.05em; --tw-text-opacity: 1; color: rgb(107 114 128 / var(--tw-text-opacity));">
                                            Qty.
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase" style="padding-left: 24px; padding-right: 24px; padding-top: 12px; padding-bottom: 12px; text-align: left; font-size: 12px; font-weight: 500; text-transform: uppercase; letter-spacing: 0.05em; --tw-text-opacity: 1; color: rgb(107 114 128 / var(--tw-text-opacity));">
                                            Total
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200" style="--tw-bg-opacity: 1; background-color: rgb(255 255 255 / var(--tw-bg-opacity)); --tw-divide-y-reverse: 0; border-top-width: calc(1px * calc(1 - var(--tw-divide-y-reverse))); border-bottom-width: calc(1px * var(--tw-divide-y-reverse)); --tw-divide-opacity: 1; border-color: rgb(229 231 235 / var(--tw-divide-opacity));">
                                    @foreach ($invoice->invoice_details as $inv)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap" style="white-space: nowrap; padding-left: 24px; padding-right: 24px; padding-top: 16px; padding-bottom: 16px;">
                                                <div class="text-sm text-gray-900" style="font-size: 14px; --tw-text-opacity: 1; color: rgb(17 24 39 / var(--tw-text-opacity));">{{ $loop->iteration }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap" style="white-space: nowrap; padding-left: 24px; padding-right: 24px; padding-top: 16px; padding-bottom: 16px;">
                                                <div class="text-sm text-gray-900" style="font-size: 14px; --tw-text-opacity: 1; color: rgb(17 24 39 / var(--tw-text-opacity));">{{ $inv->description }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap" style="white-space: nowrap; padding-left: 24px; padding-right: 24px; padding-top: 16px; padding-bottom: 16px;">
                                                <div class="text-sm text-gray-900" style="font-size: 14px; --tw-text-opacity: 1; color: rgb(17 24 39 / var(--tw-text-opacity));">{{ $inv->unit_price }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap" style="white-space: nowrap; padding-left: 24px; padding-right: 24px; padding-top: 16px; padding-bottom: 16px;">
                                                <div class="text-sm text-gray-900" style="font-size: 14px; --tw-text-opacity: 1; color: rgb(17 24 39 / var(--tw-text-opacity));">{{ $inv->quantity }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap" style="white-space: nowrap; padding-left: 24px; padding-right: 24px; padding-top: 16px; padding-bottom: 16px;">
                                                <div class="text-sm text-gray-900" style="font-size: 14px; --tw-text-opacity: 1; color: rgb(17 24 39 / var(--tw-text-opacity));">{{ $inv->total }}</div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <table class="min-w-full divide-y divide-gray-200" style="min-width: 100%;">
                    <thead class="bg-gray-50" style="--tw-bg-opacity: 1; background-color: rgb(249 250 251 / var(--tw-bg-opacity));">
                        <tr class="flex justify-between w-full" style="display: flex; width: 100%; justify-content: space-between;">
                            <th scope="col" class="px-6 py-3 w-4/5 text-xs font-medium tracking-wider text-left text-gray-500 uppercase" style="width: 80%; padding-left: 24px; padding-right: 24px; padding-top: 12px; padding-bottom: 12px; text-align: left; font-size: 12px; font-weight: 500; text-transform: uppercase; letter-spacing: 0.05em; --tw-text-opacity: 1; color: rgb(107 114 128 / var(--tw-text-opacity));">
                                Payment Info
                            </th>
                            <th scope="col" class="px-6 py-3 w-1/2 text-xs font-medium tracking-wider text-left text-gray-500 uppercase" style="width: 50%; padding-left: 24px; padding-right: 24px; padding-top: 12px; padding-bottom: 12px; text-align: left; font-size: 12px; font-weight: 500; text-transform: uppercase; letter-spacing: 0.05em; --tw-text-opacity: 1; color: rgb(107 114 128 / var(--tw-text-opacity));">
                                Due By
                            </th>
                            <th scope="col" class="px-6 py-3 w-1/2 text-xs font-medium tracking-wider text-left text-gray-500 uppercase" style="width: 50%; padding-left: 24px; padding-right: 24px; padding-top: 12px; padding-bottom: 12px; text-align: left; font-size: 12px; font-weight: 500; text-transform: uppercase; letter-spacing: 0.05em; --tw-text-opacity: 1; color: rgb(107 114 128 / var(--tw-text-opacity));">
                                Sum Total
                            </th>
                            <th scope="col" class="px-6 py-3 w-1/2 text-xs font-medium tracking-wider text-left text-gray-500 uppercase" style="width: 50%; padding-left: 24px; padding-right: 24px; padding-top: 12px; padding-bottom: 12px; text-align: left; font-size: 12px; font-weight: 500; text-transform: uppercase; letter-spacing: 0.05em; --tw-text-opacity: 1; color: rgb(107 114 128 / var(--tw-text-opacity));">
                                Discount (%)
                            </th>
                            <th scope="col" class="px-6 py-3 w-1/2 text-xs font-medium tracking-wider text-left text-gray-500 uppercase" style="width: 50%; padding-left: 24px; padding-right: 24px; padding-top: 12px; padding-bottom: 12px; text-align: left; font-size: 12px; font-weight: 500; text-transform: uppercase; letter-spacing: 0.05em; --tw-text-opacity: 1; color: rgb(107 114 128 / var(--tw-text-opacity));">
                                Total Due
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200" style="--tw-bg-opacity: 1; background-color: rgb(255 255 255 / var(--tw-bg-opacity)); --tw-divide-y-reverse: 0; border-top-width: calc(1px * calc(1 - var(--tw-divide-y-reverse))); border-bottom-width: calc(1px * var(--tw-divide-y-reverse)); --tw-divide-opacity: 1; border-color: rgb(229 231 235 / var(--tw-divide-opacity));">
                        <tr class="flex justify-between w-full" style="display: flex; width: 100%; justify-content: space-between;">
                            <td class="px-6 py-4 space-y-3 w-4/5 whitespace-nowrap" style="width: 80%; white-space: nowrap; padding-left: 24px; padding-right: 24px; padding-top: 16px; padding-bottom: 16px;">
                                <p class="text-sm text-gray-900" style="font-size: 14px; --tw-text-opacity: 1; color: rgb(17 24 39 / var(--tw-text-opacity));">Account No:</p>
                                <p class="text-sm text-gray-900" style="font-size: 14px; --tw-text-opacity: 1; color: rgb(17 24 39 / var(--tw-text-opacity)); --tw-space-y-reverse: 0; margin-top: calc(12px * calc(1 - var(--tw-space-y-reverse))); margin-bottom: calc(12px * var(--tw-space-y-reverse));">Bank Name:</p>
                                <p class="text-sm text-gray-900" style="font-size: 14px; --tw-text-opacity: 1; color: rgb(17 24 39 / var(--tw-text-opacity)); --tw-space-y-reverse: 0; margin-top: calc(12px * calc(1 - var(--tw-space-y-reverse))); margin-bottom: calc(12px * var(--tw-space-y-reverse));">Account Name:</p>
                            </td>
                            <td class="px-6 py-4 w-1/2 whitespace-nowrap" style="width: 50%; white-space: nowrap; padding-left: 24px; padding-right: 24px; padding-top: 16px; padding-bottom: 16px;">
                                <p class="text-sm text-left text-gray-900" style="text-align: left; font-size: 14px; --tw-text-opacity: 1; color: rgb(17 24 39 / var(--tw-text-opacity));">{{ $invoice->due_date }}</p>
                            </td>
                            <td class="px-6 py-4 w-1/2 whitespace-nowrap" style="width: 50%; white-space: nowrap; padding-left: 24px; padding-right: 24px; padding-top: 16px; padding-bottom: 16px;">
                                <div class="text-sm text-left text-gray-900" style="text-align: left; font-size: 14px; --tw-text-opacity: 1; color: rgb(17 24 39 / var(--tw-text-opacity));">{{ $invoice->sum_total }}</div>
                            </td>
                            <td class="px-6 py-4 w-1/2 whitespace-nowrap" style="width: 50%; white-space: nowrap; padding-left: 24px; padding-right: 24px; padding-top: 16px; padding-bottom: 16px;">
                                <div class="text-sm text-left text-gray-900" style="text-align: left; font-size: 14px; --tw-text-opacity: 1; color: rgb(17 24 39 / var(--tw-text-opacity));">{{ $invoice->discount }}</div>
                            </td>
                            <td class="px-6 py-4 w-1/2 whitespace-nowrap" style="width: 50%; white-space: nowrap; padding-left: 24px; padding-right: 24px; padding-top: 16px; padding-bottom: 16px;">
                                <div class="text-sm text-left text-gray-900" style="text-align: left; font-size: 14px; --tw-text-opacity: 1; color: rgb(17 24 39 / var(--tw-text-opacity));">{{ $invoice->sub_total }}</div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
