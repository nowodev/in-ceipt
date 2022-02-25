<template>
    <app-layout title="Edit Invoice">
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
                Edit Invoice
            </h2>
        </template>

        <CardLayout>
            <div class="flex justify-between p-6 bg-white border-b border-gray-200 sm:px-20">
                <h1 class="text-4xl font-bold text-black">#{{ form.serial_no }}</h1>
            </div>

            <div class="p-6 w-full bg-white sm:px-20">
                <fieldset
                    class="grid grid-cols-1 gap-x-4 px-4 pb-4 space-y-4 rounded-lg border-2 border border-gray-300 md:grid-cols-2">
                    <legend class="text-lg font-semibold">Customer Details</legend>

                    <div>
                        <Label for="fullname">Full Name</Label>
                        <Input id="fullname" v-model="form.fullname"
                               class="w-full bg-gray-200 shadow-md cursor-crosshair"
                               disabled type="text" />
                    </div>

                    <div>
                        <Label for="phone">Mobile Number</Label>
                        <Input id="phone" v-model="form.number" class="w-full bg-gray-200 shadow-md cursor-crosshair"
                               disabled type="tel" />
                    </div>

                    <div>
                        <Label for="email">Email</Label>
                        <Input id="email" v-model="form.email" class="w-full bg-gray-200 shadow-md cursor-crosshair"
                               disabled type="email" />
                    </div>

                    <div>
                        <Label for="address">Address 1</Label>
                        <Input id="address" v-model="form.address_1"
                               class="w-full bg-gray-200 shadow-md cursor-crosshair" disabled
                               type="text" />
                    </div>

                    <div>
                        <Label for="address_2">Address 2</Label>
                        <Input id="address_2" v-model="form.address_2"
                               class="w-full bg-gray-200 shadow-md cursor-crosshair" disabled
                               type="text" />
                    </div>
                </fieldset>

                <fieldset
                    class="grid grid-cols-1 gap-x-4 px-4 pb-4 mt-4 space-y-4 rounded-lg border-2 border border-gray-300 md:grid-cols-3">
                    <legend class="text-lg font-semibold">Invoice Details</legend>

                    <div>
                        <Label for="serial_no">Serial No</Label>
                        <div class="relative">
                            <Input id="serial_no" v-model="form.serial_no"
                                   class="w-full bg-gray-200 shadow-md cursor-crosshair" disabled
                                   placeholder="XXXXXXXXXXXX" type="text" />
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
                        <legend class="text-lg font-semibold">Description {{ index + 1 }}</legend>

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

                    <div class="flex flex-col gap-y-3 mt-3 ml-auto w-fit">
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
                            @click.prevent="submit">Update
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

        props: {
            invoice: Object,
            customers: Object,
            selected_customer: Object,
        },

        mounted() {
            this.invoice.invoice_details.forEach((value, index) => {
                this.form.info.push({
                    description: this.invoice.invoice_details[index].description,
                    unit_price: this.invoice.invoice_details[index].unit_price,
                    quantity: this.invoice.invoice_details[index].quantity,
                    total: this.invoice.invoice_details[index].total,
                })
            })
        },

        setup(props) {
            const form = useForm({
                fullname: props.invoice.customer.fullname,
                number: props.invoice.customer.number,
                email: props.invoice.customer.email,
                address_1: props.invoice.customer.address_1,
                address_2: props.invoice.customer.address_2,
                serial_no: props.invoice.serial_no,
                issue_date: props.invoice.issue_date,
                due_date: props.invoice.due_date,
                info: [],
                sum_total: null,
                discount: props.invoice.discount,
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

                    // console.log(this.invoice.invoice_details[index].description)
                    this.$inertia.delete(route('invoice.delete_info', this.invoice.invoice_details[index].description), {
                        preserveState: false,
                        preserveScroll: true
                    })
            },

            // round to two decimal places
            roundToTwo: function (num) {
                return round(num, 2)
            },

            // submit form
            submit: function () {
                this.form.put(route('invoice.update', this.invoice.id))
            },

            resetForm() {
                this.form.clearErrors();
                this.form.reset();
            },
        }
    })
</script>
