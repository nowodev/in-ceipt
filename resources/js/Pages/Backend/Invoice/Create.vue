<template>
    <app-layout title="Create Invoice">
        <template #header>
            <h2 class="flex text-xl font-semibold leading-tight text-gray-800">
                <Link :href="route('invoice.index')">
                    <svg class="mr-2 w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                         xmlns="http://www.w3.org/2000/svg">
                        <path d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 01-18 0z" stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2" />
                    </svg>
                </Link>
                Create Invoice
            </h2>
        </template>

        <CardLayout>
            <div class="flex justify-between p-6 bg-white border-b border-gray-200 sm:px-20">
                <h1 class="text-4xl font-bold text-black">Fill the <span
                    class="underline decoration-double decoration decoration-cyan-500">form</span></h1>
            </div>

            <div class="p-6 w-full bg-white sm:px-20">
                <div class="mb-4">
                    <div
                        class="inline-block relative mr-2 w-10 align-middle transition duration-200 ease-in select-none">
                        <input id="toggle"
                               class="block absolute w-6 h-6 bg-white rounded-full border-4 appearance-none cursor-pointer toggle-checkbox"
                               name="toggle" type="checkbox" @click="toggleExisting" />
                        <label class="block overflow-hidden h-6 bg-gray-300 rounded-full cursor-pointer toggle-label"
                               for="toggle"></label>
                    </div>
                    <label class="text-xs text-gray-700" for="toggle">Existing customer</label>
                </div>

                <fieldset
                    class="grid grid-cols-1 gap-x-4 px-4 pb-4 space-y-4 rounded-lg border-2 border border-gray-300 md:grid-cols-2">
                    <legend class="text-lg font-semibold">Customer Details</legend>

                    <div>
                        <Label for="fullname">Full Name</Label>
                        <Input v-show="!existing" id="fullname" v-model="form.fullname" class="w-full"
                               placeholder="John Doe" type="text" />

                        <select
                            v-show="existing" v-model="form.fullname"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <option v-for="customer in customers" @click="updateFields">{{ customer.fullname }}</option>
                        </select>
                        <InputError v-if="form.errors.fullname" :message="form.errors.fullname" />
                    </div>

                    <div>
                        <Label for="phone">Mobile Number</Label>
                        <Input id="phone" v-model="form.number" class="w-full" min="11" placeholder="08000000000"
                               type="tel" />
                        <InputError v-if="form.errors.number" :message="form.errors.number" />
                    </div>

                    <div>
                        <Label for="email">Email</Label>
                        <Input id="email" v-model="form.email" class="w-full" placeholder="johndoe@email.com"
                               type="email" />
                        <InputError v-if="form.errors.email" :message="form.errors.email" />
                    </div>

                    <div>
                        <Label for="address">Address 1</Label>
                        <Input id="address" v-model="form.address_1" class="w-full"
                               placeholder="No. X, Somewhere in China town"
                               type="text" />
                        <InputError v-if="form.errors.address_1" :message="form.errors.address_1" />
                    </div>

                    <div>
                        <Label for="address_2">Address 2</Label>
                        <Input id="address_2" v-model="form.address_2" class="w-full"
                               placeholder="No. X, Somewhere in China town"
                               type="text" />
                        <InputError v-if="form.errors.address_2" :message="form.errors.address_2" />
                    </div>
                </fieldset>

                <fieldset
                    class="grid grid-cols-1 gap-x-4 px-4 pb-4 mt-4 space-y-4 rounded-lg border-2 border border-gray-300 md:grid-cols-3">
                    <legend class="text-lg font-semibold">Invoice Details</legend>

                    <div>
                        <Label for="serial_no">Serial No</Label>
                        <div class="relative">
                            <Input id="serial_no" :value="random_no"
                                   class="w-full bg-gray-200 shadow-md cursor-crosshair" disabled
                                   placeholder="XXXXXXXXXXXX" type="number" />
                            <div class="absolute inset-y-0 right-0">
                                <SecondaryButton class="h-full" @click="generateSN">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path clip-rule="evenodd"
                                              d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z"
                                              fill-rule="evenodd" />
                                    </svg>
                                </SecondaryButton>
                            </div>
                        </div>
                        <InputError v-if="form.errors.serial_no" :message="form.errors.serial_no" />
                    </div>

                    <div>
                        <Label for="issue_date">Issue Date</Label>
                        <Input id="issue_date" v-model="form.issue_date" class="w-full" type="date" />
                        <InputError v-if="form.errors.issue_date" :message="form.errors.issue_date" />
                    </div>

                    <div>
                        <Label for="due_date">Due Date</Label>
                        <Input id="due_date" v-model="form.due_date" class="w-full" type="date" />
                        <InputError v-if="form.errors.due_date" :message="form.errors.due_date" />
                    </div>
                </fieldset>

                <div v-for="(desc, index) in form.info" :key="index">
                    <fieldset
                        class="grid grid-cols-1 gap-x-4 px-4 pb-4 mt-4 space-y-4 rounded-lg border-2 border border-gray-300 md:grid-cols-2">
                        <legend class="text-lg font-semibold">Item Description {{ index + 1 }}</legend>

                        <div>
                            <Label for="description">Description</Label>
                            <Input id="description" v-model="desc.description" class="w-full" placeholder="XXXXXXXXXXXX"
                                   type="text" />
                            <InputError v-if="form.errors[`info.${index}.description`]"
                                        :message="form.errors[`info.${index}.description`]" />
                        </div>

                        <div>
                            <Label for="price">Unit Price</Label>
                            <Input id="price" v-model="desc.unit_price" class="w-full" placeholder="0000.00"
                                   type="number" />
                            <InputError v-if="form.errors[`info.${index}.unit_price`]"
                                        :message="form.errors[`info.${index}.unit_price`]" />
                        </div>

                        <div>
                            <Label for="quantity">Quantity</Label>
                            <Input id="quantity" v-model="desc.quantity" class="w-full" placeholder="10"
                                   type="number" />
                            <InputError v-if="form.errors[`info.${index}.quantity`]"
                                        :message="form.errors[`info.${index}.quantity`]" />
                        </div>

                        <div>
                            <Label>Total</Label>
                            <Input v-model="get_total" :value="roundToTwo(desc.unit_price * desc.quantity)"
                                   class="w-full bg-gray-200 shadow-md cursor-crosshair"
                                   disabled
                                   placeholder="0000.00" type="text" />
                            <InputError v-if="form.errors[`info.${index}.sub_total`]"
                                        :message="form.errors[`info.${index}.sub_total`]" />
                        </div>
                    </fieldset>

                    <div class="flex flex-col gap-y-3 mt-3 mlauto w-fit">
                        <Button v-show="index === form.info.length - 1" @click="addDescription">
                            Add New Description
                        </Button>
                        <DangerButton v-show="index || ( !index && form.info.length > 1)"
                                      @click="removeDescription(index)">
                            Remove Description
                        </DangerButton>
                    </div>
                </div>

                <fieldset
                    class="grid grid-cols-1 gap-x-4 px-4 pb-4 mt-4 space-y-4 rounded-lg border-2 border border-gray-300 md:grid-cols-3">
                    <legend class="text-lg font-semibold">Summary</legend>

                    <div>
                        <Label>Sum Total</Label>
                        <Input v-model="get_sum_total" class="w-full bg-gray-200 shadow-md cursor-crosshair" disabled
                               placeholder="0000.00" type="text" />
                        <InputError v-if="form.errors.sum_total" :message="form.errors.sum_total" />
                    </div>

                    <div>
                        <Label for="discount">Discount (%)</Label>
                        <Input id="discount" v-model="form.discount" class="w-full" placeholder="2%" type="number" />
                        <InputError v-if="form.errors.discount" :message="form.errors.discount" />
                    </div>

                    <div>
                        <Label class="">Sub Total</Label>
                        <Input v-model="get_sub_total" class="w-full bg-gray-200 shadow-md cursor-crosshair" disabled
                               placeholder="0000.00" type="text" />
                        <InputError v-if="form.errors.sub_total" :message="form.errors.sub_total" />
                    </div>
                </fieldset>

                <div class="flex gap-2 justify-end mt-4">
                     <SecondaryButton @click="resetForm">Reset</SecondaryButton>
                    <Button :class="{ 'opacity-25': form.processing }" :disabled="form.processing"
                            @click.prevent="submit">Create
                    </Button>
                </div>
            </div>
        </CardLayout>
    </app-layout>
</template>

<script>
    import Button from "@/Jetstream/Button";
    import CardLayout from "@/Jetstream/CardLayout";
    import DangerButton from "@/Jetstream/DangerButton";
    import Input from "@/Jetstream/Input";
    import InputError from "@/Jetstream/InputError";
    import Label from "@/Jetstream/Label";
    import SecondaryButton from "@/Jetstream/SecondaryButton";
    import AppLayout from '@/Layouts/AppLayout.vue'
    import { Link, useForm } from "@inertiajs/inertia-vue3";
    import { round } from "lodash";
    import { defineComponent } from 'vue'

    export default defineComponent({
        name: "Create.vue",

        components: {
            DangerButton,
            SecondaryButton,
            InputError,
            Button,
            Label,
            CardLayout,
            AppLayout,
            Input,
            Link
        },

        props: ['customers', 'selected_customer'],

        mounted() {
            // populate customer fields on select existing customer
            this.form.fullname = this.selected_customer.fullname
            this.form.number = this.selected_customer.number
            this.form.email = this.selected_customer.email
            this.form.address_1 = this.selected_customer.address_1
            this.form.address_2 = this.selected_customer.address_2
        },

        data() {
            return {
                existing: false, // set existing to false on start
                random_no: null,
            }
        },

        setup() {
            const form = useForm({
                fullname: null,
                number: null,
                email: null,
                address_1: null,
                address_2: null,
                serial_no: null,
                issue_date: null,
                due_date: null,
                info: [
                    {
                        description: null,
                        unit_price: null,
                        quantity: null,
                        total: null,
                    }
                ],
                sum_total: null,
                discount: 0,
                sub_total: null,
            })

            return { form }
        },

        computed: {
            // dynamically get total from unit price and quantity
            get_total: function () {
                return this.form.info.map((a) => {
                    a.total = round(a.unit_price * a.quantity, 2)

                    // convert object to string
                    // console.log(JSON.stringify(a.sub_total))
                    return JSON.stringify(a.total)
                })
            },

            // dynamically get sum of all totals
            get_sum_total: function () {
                let calculated_sum_total = (this.form.info).reduce((x, y) => x + (y['total'] || 0), 0)
                this.form.sum_total = calculated_sum_total

                return calculated_sum_total
            },

            // dynamically get total from overall_sub_total and discount
            get_sub_total: function () {
                let calculated_sub_total = round(this.get_sum_total * ((100 - this.form.discount) / 100), 2)
                this.form.sub_total = calculated_sub_total
                return calculated_sub_total
            },
        },

        methods: {
            // toggle new or existing customers
            toggleExisting: function () {
                this.existing = !this.existing
            },

            // populate fields with customer data
            updateFields: function () {
                this.$inertia.get(route('invoice.create'), {
                    fullname: this.form.fullname,
                    page: this.customers.current_page,
                    preserveScroll: true,
                    preserveState: true
                })
            },

            // generate random number to use as serial number
            generateSN: function () {
                this.form.serial_no = this.random_no = Math.floor(Math.random() * (99999999 - 999999999998 + 1) + 999999999998)
            },

            // add more description field
            addDescription: function () {
                this.form.info.push({
                    description: null,
                    unit_price: null,
                    quantity: null,
                    total: null,
                })
            },

            // remove a description field
            removeDescription: function (index) {
                this.form.info.splice(index, 1)
            },

            // round to two decimal places
            roundToTwo: function (num) {
                return round(num, 2)
            },

            // submit form
            submit: function () {
                this.form.post(route('invoice.store'))
            },

            resetForm() {
                this.form.clearErrors();
                this.form.reset();
                this.random_no = '';
            },
        }
    })
</script>

<style scoped>
    .toggle-checkbox:checked {
        @apply: right-0 border-green-400;
        right: 0;
        border-color: #68D391;
    }

    .toggle-checkbox:checked + .toggle-label {
        @apply: bg-green-400;
        background-color: #68D391;
    }
</style>
