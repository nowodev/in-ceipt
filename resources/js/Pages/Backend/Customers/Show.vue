<template>
    <app-layout title="Customer">
        <template #header>
            <h2 class="flex text-xl font-semibold leading-tight text-gray-800">
                <Link :href="route('customers.index')">
                    <svg class="mr-2 w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                         xmlns="http://www.w3.org/2000/svg">
                        <path d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 01-18 0z" stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2" />
                    </svg>
                </Link>
                View Customer
            </h2>
        </template>

        <CardLayout>
            <div class="container p-5 mx-auto my-5">
                <div class="md:flex no-wrap md:-mx-2">
                    <!-- Left Side -->
                    <div class="w-full md:w-3/12 md:mx-2">
                        <!-- Profile Card -->
                        <div class="p-3 bg-white border-t-4 border-green-400">
                            <div class="overflow-hidden image">
                                <img alt=""
                                     class="mx-auto w-full h-auto"
                                     src="https://lavinephotography.com.au/wp-content/uploads/2017/01/PROFILE-Photography-112.jpg">
                            </div>
                            <h1 class="my-1 text-xl font-bold leading-8 text-gray-900">{{ customer.fullname }}</h1>
                            <h3 class="leading-6 text-gray-600 font-lg text-semibold">Owner at Company Inc.</h3>
                            <p class="text-sm leading-6 text-gray-500 hover:text-gray-600">Lorem ipsum dolor sit amet
                                consectetur adipisicing elit.
                                Reprehenderit, eligendi dolorum sequi illum qui unde aspernatur non deserunt</p>
                            <ul
                                class="px-3 py-2 mt-3 text-gray-600 bg-gray-100 rounded divide-y shadow-sm hover:text-gray-700 hover:shadow">
                                <li class="flex items-center py-3">
                                    <span>Status</span>
                                    <span class="ml-auto"><span
                                        class="px-2 py-1 text-sm text-white bg-green-500 rounded">Active</span></span>
                                </li>
                                <li class="flex items-center py-3">
                                    <span>Member since</span>
                                    <span class="ml-auto">{{ customer.created_at }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- Right Side -->
                    <div class="mx-2 w-full md:w-9/12">
                        <!-- Profile tab -->
                        <!-- About Section -->
                        <div class="p-3 bg-white rounded-sm shadow-sm">
                            <div class="flex items-center space-x-2 font-semibold leading-8 text-gray-900">
                                <span class="text-green-500">
                                    <svg class="h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                                              stroke-linecap="round" stroke-linejoin="round"
                                              stroke-width="2" />
                                    </svg>
                                </span>
                                <span class="tracking-wide">About</span>
                            </div>
                            <div class="text-gray-700">
                                <div class="grid text-sm md:grid-cols-2">
                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold">Full Name</div>
                                        <div class="px-4 py-2 font-bold">{{ customer.fullname }}</div>
                                    </div>
                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold">Contact No.</div>
                                        <div class="px-4 py-2 font-bold">{{ customer.number }}</div>
                                    </div>
                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold">Current Address</div>
                                        <div class="px-4 py-2 font-bold">{{ customer.address_1 }}</div>
                                    </div>
                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold">Permanent Address</div>
                                        <div class="px-4 py-2 font-bold">{{ customer.address_2 }}</div>
                                    </div>
                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold">Email</div>
                                        <div class="px-4 py-2">
                                            <a :href="`mailto:${customer.email}`"
                                               class="text-blue-800">{{ customer.email }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End of about section -->

                        <!-- Invoice related information-->
                        <div class="p-3 bg-white rounded-sm shadow-sm">
                            <div>
                                <div class="flex items-center mb-3 space-x-2 font-semibold leading-8 text-gray-900">
                                    <span class="text-green-500">
                                        <svg class="h-5" fill="none" stroke="currentColor"
                                             viewBox="0 0 24 24"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" />
                                        </svg>
                                    </span>
                                    <span class="tracking-wide">Invoice(s)</span>
                                </div>

                                <div class="grid grid-cols-2 gap-x-5">
                                    <article v-for="(invoice, index) in customer.invoices" :key="invoice.id"
                                             class="relative w-full rounded-md shadow-2xl duration-500 transform cursor-pointer hover:-translate-y-2">
                                        <div class="flex absolute top-0 right-0 w-10 h-10 fill-blue-600">
                                            <Link :href="route('invoice.show', invoice.id)" class="mx-auto my-auto">
                                                <svg viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">
                                                    <!--! Font Awesome Pro 6.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                                                    <path
                                                        d="M384 320c-17.67 0-32 14.33-32 32v96H64V160h96c17.67 0 32-14.32 32-32s-14.33-32-32-32L64 96c-35.35 0-64 28.65-64 64V448c0 35.34 28.65 64 64 64h288c35.35 0 64-28.66 64-64v-96C416 334.3 401.7 320 384 320zM502.6 9.367C496.8 3.578 488.8 0 480 0h-160c-17.67 0-31.1 14.32-31.1 31.1c0 17.67 14.32 31.1 31.99 31.1h82.75L178.7 290.7c-12.5 12.5-12.5 32.76 0 45.26C191.2 348.5 211.5 348.5 224 336l224-226.8V192c0 17.67 14.33 31.1 31.1 31.1S512 209.7 512 192V31.1C512 23.16 508.4 15.16 502.6 9.367z" />
                                                </svg>
                                            </Link>
                                        </div>
                                        <div class="p-8 pb-3 my-2">
                                            <p class="text-xl text-gray-500">{{ index + 1 }}.</p>
                                            <h2 class="mt-2 text-xl">{{ invoice.serial_no }}</h2>
                                            <dl class="mt-2">
                                                <div class="grid grid-cols-2 bg-gray-50">
                                                    <dt class="text-sm font-medium text-gray-500">Issue Date</dt>
                                                    <dd class="text-gray-900">{{ invoice.issue_date }}</dd>
                                                </div>
                                                <div class="grid grid-cols-2 bg-gray-50">
                                                    <dt class="text-sm font-medium text-gray-500">Due Date</dt>
                                                    <dd class="text-gray-900">{{ invoice.due_date }}</dd>
                                                </div>
                                                <div class="grid grid-cols-2 bg-gray-50">
                                                    <dt class="text-sm font-medium text-gray-500">Sub Total</dt>
                                                    <dd class="text-gray-900">{{ invoice.sub_total }}</dd>
                                                </div>
                                            </dl>
                                        </div>
                                    </article>
                                </div>
                            </div>
                        </div>
                        <!-- End of invoice related information-->
                        <!-- End of profile tab -->
                    </div>
                </div>
            </div>
        </CardLayout>
    </app-layout>
</template>

<script>
    import CardLayout from "@/Jetstream/CardLayout";
    import AppLayout from '@/Layouts/AppLayout.vue';
    import { Link } from "@inertiajs/inertia-vue3";
    import { defineComponent } from 'vue';

    export default defineComponent({
        name: "Show",
        components: {
            CardLayout,
            AppLayout,
            Link,
        },
        props: {
            customer: Object,
        },
    })
</script>
