<template>
    <app-layout title="Create Invoice">
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                <Link :href="route('invoice.index')">
                    <i class="mr-4 text-xl text-black fa-regular fa-circle-left"></i>
                </Link>
                Create Invoice
            </h2>
        </template>

        <CardLayout>
            <div class="flex justify-between p-6 bg-white border-b border-gray-200 sm:px-20">
                <h1 class="text-4xl font-bold text-black">Fill the <span
                    class="underline decoration-double decoration decoration-cyan-500">form</span></h1>
            </div>

            <div class="text-center">
                <ValidationErrors />
            </div>

            <div class="p-6 w-full bg-white sm:px-20">
                <fieldset
                    class="grid grid-cols-1 gap-x-4 px-4 pb-4 space-y-4 rounded-lg border-2 border border-gray-300 md:grid-cols-2">
                    <legend class="text-lg font-semibold">Customer Details</legend>

                    <div>
                        <Label class="">Full Name</Label>
                        <!-- add name to input in order to generate actual names when using fake form filler -->
                        <Input type="text" v-model="form.fullname" name="fullname" placeholder="John Doe"
                               class="w-full" />
                        <InputError v-if="form.errors.fullname" :message="form.errors.fullname" />
                    </div>

                    <div>
                        <Label class="">Mobile Number</Label>
                        <Input type="number" v-model="form.number" min="11" placeholder="08000000000" class="w-full" />
                        <InputError v-if="form.errors.number" :message="form.errors.number" />
                    </div>

                    <div>
                        <Label class="">Email</Label>
                        <Input type="email" v-model="form.email" placeholder="johndoe@email.com" class="w-full" />
                        <InputError v-if="form.errors.email" :message="form.errors.email" />
                    </div>

                    <div>
                        <Label class="">Address 1</Label>
                        <Input type="text" v-model="form.address_1" placeholder="No. X, Somewhere in China town"
                               class="w-full" />
                        <InputError v-if="form.errors.address_1" :message="form.errors.address_1" />
                    </div>

                    <div>
                        <Label class="">Address 2</Label>
                        <Input type="text" v-model="form.address_2" placeholder="No. X, Somewhere in China town"
                               class="w-full" />
                        <InputError v-if="form.errors.address_2" :message="form.errors.address_2" />
                    </div>
                </fieldset>

                <fieldset
                    class="grid grid-cols-1 gap-x-4 px-4 pb-4 mt-4 space-y-4 rounded-lg border-2 border border-gray-300 md:grid-cols-3">
                    <legend class="text-lg font-semibold">Invoice Details</legend>
                    <div>
                        <Label class="">Serial No</Label>
                        <div class="relative">
                            <Input type="number" :value="random_no" placeholder="XXXXXXXXXXXX"
                                   class="w-full bg-gray-200 shadow-md cursor-crosshair" disabled />
                            <div class="absolute inset-y-0 right-0">
                                <SecondaryButton class="h-full" @click="generateSN">
                                    <i class="fa-solid fa-rotate"></i>
                                </SecondaryButton>
                            </div>
                        </div>
                        <InputError v-if="form.errors.serial_no" :message="form.errors.serial_no" />
                    </div>

                    <div>
                        <Label class="">Issue Date</Label>
                        <Input type="date" v-model="form.issue_date" class="w-full" />
                        <InputError v-if="form.errors.issue_date" :message="form.errors.issue_date" />
                    </div>

                    <div>
                        <Label class="">Due Date</Label>
                        <Input type="date" v-model="form.due_date" class="w-full" />
                        <InputError v-if="form.errors.due_date" :message="form.errors.due_date" />
                    </div>
                </fieldset>

                <div v-for="(desc, index) in form.info" :key="index">
                    <fieldset
                        class="grid grid-cols-1 gap-x-4 px-4 pb-4 mt-4 space-y-4 rounded-lg border-2 border border-gray-300 md:grid-cols-3">
                        <legend class="text-lg font-semibold">Description</legend>

                        <div>
                            <Label class="">Description</Label>
                            <Input type="text" v-model="desc.description" placeholder="XXXXXXXXXXXX" class="w-full" />
                            <!--                            <InputError v-if="form.errors['desc.${index}.description']" :message="form.errors.description" />-->
                            <InputError v-if="form.errors['info.${index}.description']"
                                        :message="form.errors['info.${index}.description']" />
                            <InputError :message="form.errors['info.0.description']" />

                        </div>

                        <div>
                            <Label class="">Unit Price</Label>
                            <Input type="number" v-model="desc.unit_price" placeholder="0000.00" class="w-full" />
                            <InputError v-if="form.errors.unit_price" :message="form.errors.unit_price" />
                            <InputError :message="form.errors['info.${input}.unit_price']" />
                        </div>

                        <div>
                            <Label class="">Quantity</Label>
                            <Input type="number" v-model="desc.quantity" placeholder="10" class="w-full" />
                            <InputError v-if="form.errors.quantity" :message="form.errors.quantity" />
                        </div>

                        <div>
                            <Label class="">Sub Total</Label>
                            <Input type="text"
                                   :value="(desc.unit_price * desc.quantity).toFixed(2)"
                                   placeholder="0000.00"
                                   class="w-full bg-gray-200 shadow-md cursor-crosshair" disabled />
                            <InputError v-if="form.errors.sub_total" :message="form.errors.sub_total" />
                        </div>

                        <div>
                            <Label class="">Discount (%)</Label>
                            <Input type="number" v-model="desc.discount" placeholder="2%" class="w-full" />
                            <InputError v-if="form.errors.discount" :message="form.errors.discount" />
                        </div>

                        <div>
                            <Label class="">Total</Label>
                            <Input type="text"
                                   :value="((desc.unit_price * desc.quantity) * ((100 - desc.discount) / 100)).toFixed(2)"
                                   placeholder="0000.00"
                                   class="w-full bg-gray-200 shadow-md cursor-crosshair" disabled />
                            <InputError v-if="form.errors.total" :message="form.errors.total" />
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

                <Button class="mt-4" @click.prevent="submit">Submit</Button>
            </div>
        </CardLayout>
    </app-layout>
</template>

<script>

    import { defineComponent } from 'vue'
    import { Link, useForm } from "@inertiajs/inertia-vue3";
    import AppLayout from '@/Layouts/AppLayout.vue'
    import CardLayout from "@/Jetstream/CardLayout";
    import Input from "@/Jetstream/Input";
    import Label from "@/Jetstream/Label";
    import ValidationErrors from "@/Jetstream/ValidationErrors";
    import Button from "@/Jetstream/Button";
    import InputError from "@/Jetstream/InputError";
    import { round } from "lodash";
    import SecondaryButton from "@/Jetstream/SecondaryButton";
    import DangerButton from "@/Jetstream/DangerButton";


    export default defineComponent({

        name: "Create.vue",
        components: {
            DangerButton,
            SecondaryButton,
            InputError,
            Button,
            ValidationErrors,
            Label,
            CardLayout,
            AppLayout,
            Input,
            Link
        },
        data() {
            return {
                random_no: '',
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
                        sub_total: null,
                        discount: 0,
                        total: null,
                    }
                ]
            })

            return { form }
        },
        computed: {
            // SERIOUS BUG OR ISSUE HERE. WILL COME BACK LATER TO FIX IT.
            // BUG HAS TO DO WITH GETTING SUB TOTAL AND TOTAL PRICE FROM THE COMPUTED PROPERTY
            // AND INSERTING IT INTO THE V-MODEL


            // get sub_total from unit price and quantity when the values are inserted
            get_sub_total: function () {
                return this.form.info.map((a) => {
                    a.sub_total = round(a.unit_price * a.quantity, 2)

                    // convert object to string
                    // console.log(JSON.stringify(a.sub_total))
                    return JSON.stringify(a.sub_total)
                })
            },

            // get total from sub_total and discount when the values are inserted
            get_total: function () {
                return this.form.info.map((a) => {
                    a.total = round(round(a.unit_price * a.quantity, 2) * ((100 - a.discount) / 100), 2)

                    // convert object to string
                    return JSON.stringify(a.total)
                })
            },
        },
        methods: {
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
                    sub_total: null,
                    discount: 0,
                    total: null,
                })
            },

            // remove a description field
            removeDescription: function (index) {
                this.form.info.splice(index, 1)
            },

            // submit form
            submit: function () {
                this.form
                    .post(route('invoice.store'))
            }
        }
    })
</script>
