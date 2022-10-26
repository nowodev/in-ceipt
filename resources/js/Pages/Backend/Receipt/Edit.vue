<template>
    <app-layout title="Edit Receipt">
        <template #header>
            <h2 class="flex text-xl font-semibold leading-tight text-gray-800">
                <Link :href="route('receipt.index')">
                    <svg class="mr-2 w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                         xmlns="http://www.w3.org/2000/svg">
                        <path d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 01-18 0z" stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2" />
                    </svg>
                </Link>
                Edit Receipt
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
                    <legend class="text-lg font-semibold">Receipt Details</legend>

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
                        <Label for="payment_date">Payment Date</Label>
                        <Input id="payment_date" v-model="form.payment_date" class="w-full" type="date" />
                        <InputError v-if="form.errors.payment_date" :message="form.errors.payment_date" />
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

                            <!-- pass the invoice details id when submitting, in order to use this to update the db -->
                            <Input v-model="desc.receipt_details_id" class="w-full" type="hidden" />

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


                    <!-- BUG TO FIX (FUTURE FEATURE)-->
                    <!-- Currently disable adding new description. Data can only be updated, no insertion for now.-->

                    <!-- <div class="flex flex-col gap-y-3 mt-3 w-fit">-->
                    <!--     <Button v-show="index === form.info.length - 1" @click="addDescription">-->
                    <!--         Add New Description-->
                    <!--     </Button>-->
                    <!--     <DangerButton v-show="index || ( !index && form.info.length > 1)"-->
                    <!--                   @click="removeDescription(index)">-->
                    <!--         Remove Description-->
                    <!--     </DangerButton>-->
                    <!-- </div>-->
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

                    <div>
                        <Label for="amount_paid">Amount Paid</Label>
                        <Input id="amount_paid" v-model="form.amount_paid" class="w-full" placeholder="0" type="number" />
                        <InputError v-if="form.errors.amount_paid" :message="form.errors.amount_paid" />
                    </div>

                    <div>
                        <Label>Amount Owing</Label>
                        <Input v-model="get_owing" class="w-full bg-gray-200 shadow-md cursor-crosshair" disabled
                               placeholder="0" type="text" />
                        <InputError v-if="form.errors.amount_owing" :message="form.errors.amount_owing" />
                    </div>


                    <div>
                        <Label for="payment_method">Payment Method</Label>
                        <v-select id="payment_method" v-model="form.payment_method" :options="payment_options"
                                  class="w-full" />
                        <InputError v-if="form.errors.payment_method" :message="form.errors.payment_method" />
                    </div>
                </fieldset>

                <div class="flex gap-2 justify-end mt-4">
                    <Button @click="showModal">Preview</Button>
                    <!-- fix: Reset functionality removes the description section -->
                    <!-- <SecondaryButton @click="resetForm">Reset</SecondaryButton>-->
                    <Button :class="{ 'opacity-25': form.processing }" :disabled="form.processing"
                            @click.prevent="submit">Update
                    </Button>
                </div>
            </div>

            <DialogModal max-width="4xl" :show="showingModal" @close="closeModal">
                <template #content>
                    <ReceiptPreview :preview="form" />
                </template>

                <template #footer>
                    <SecondaryButton @click="closeModal">
                        Close
                    </SecondaryButton>
                </template>
            </DialogModal>
        </CardLayout>
    </app-layout>
</template>

<script>
    import Button from "@/Jetstream/Button.vue";
    import CardLayout from "@/Jetstream/CardLayout.vue";
    import DangerButton from "@/Jetstream/DangerButton.vue";
    import DialogModal from "@/Jetstream/DialogModal.vue";
    import Input from "@/Jetstream/Input.vue";
    import InputError from "@/Jetstream/InputError.vue";
    import Label from "@/Jetstream/Label.vue";
    import ReceiptPreview from "@/Jetstream/ReceiptPreview.vue";
    import SecondaryButton from "@/Jetstream/SecondaryButton.vue";
    import AppLayout from '@/Layouts/AppLayout.vue'
    import { Link, useForm } from "@inertiajs/inertia-vue3";
    import { round } from "lodash";
    import { defineComponent } from 'vue';
    import vSelect from 'vue-select';
    import 'vue-select/dist/vue-select.css';

    export default defineComponent({
        name: "Create.vue",

        components: {
            ReceiptPreview,
            DialogModal,
            vSelect,
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
            receipt: Object,
            customers: Object,
        },

        data() {
            return {
                payment_options: [
                    {
                        id: 1,
                        label: 'Cash',
                    },
                    {
                        id: 2,
                        label: 'Transfer',
                    },
                ],
                showingModal: null,
            }
        },

        mounted() {
            // since the item description is dynamic and could be 1 or more, we need to fetch the value from the db
            // and push it into the info array declared in the form helper below 👇
            this.receipt.receipt_details.forEach((value, index) => {
                this.form.info.push({
                    receipt_details_id: this.receipt.receipt_details[index].id,
                    description: this.receipt.receipt_details[index].description,
                    unit_price: this.receipt.receipt_details[index].unit_price,
                    quantity: this.receipt.receipt_details[index].quantity,
                    total: this.receipt.receipt_details[index].total,
                })
            })
        },

        setup(props) {
            const form = useForm({
                fullname: props.receipt.customer.fullname,
                number: props.receipt.customer.number,
                email: props.receipt.customer.email,
                address_1: props.receipt.customer.address_1,
                address_2: props.receipt.customer.address_2,
                serial_no: props.receipt.serial_no,
                issue_date: props.receipt.issue_date,
                payment_date: props.receipt.payment_date,
                info: [],
                sum_total: null,
                discount: props.receipt.discount,
                sub_total: null,
                amount_paid: props.receipt.amount_paid,
                amount_owing: null,
                payment_method: props.receipt.payment_method,
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

            get_owing: function () {
                let calculated_owing = this.get_sub_total - this.form.amount_paid
                this.form.amount_owing = calculated_owing

                return calculated_owing
            }
        },

        methods: {
            showModal() {
                this.showingModal = true
            },

            closeModal() {
                this.showingModal = null
            },

            // toggle new or existing customers
            toggleExisting: function () {
                this.existing = !this.existing
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

                // when removing a description field (fieldset), the corresponding data is also removed from the db
                // and the page is reloaded
                this.$inertia.delete(route('receipt.delete_info', this.receipt.receipt_details[index].description), {
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
                this.form.put(route('receipt.update', this.receipt.id), {
                    preserveScroll: true
                })
            },

            resetForm() {
                this.form.clearErrors();
                this.form.reset();
            },
        }
    })
</script>
