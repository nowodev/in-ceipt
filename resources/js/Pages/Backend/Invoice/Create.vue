<template>
    <app-layout title="Create Invoice">
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Create Invoice
            </h2>
        </template>

        <CardLayout>
            <div class="flex justify-between p-6 bg-white border-b border-gray-200 sm:px-20">
                <h1 class="text-4xl font-bold text-black">Fill the <span
                    class="underline decoration-double decoration decoration-cyan-500">form</span></h1>
            </div>

            <div class="p-6 w-full bg-white sm:px-20">
                <fieldset
                    class="grid grid-cols-1 gap-x-4 px-4 pb-4 space-y-4 rounded-lg border-2 border border-gray-300 md:grid-cols-2">
                    <legend class="text-lg font-semibold">Customer Details</legend>

                    <div>
                        <Label class="">Full Name</Label>
                        <Input type="text" v-model="form.fullname" placeholder="John Doe" class="w-full" />
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
                        <Input type="number" v-model="form.serial_no" placeholder="XXXXXXXXXXXX" class="w-full" />
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

                <fieldset
                    class="grid grid-cols-1 gap-x-4 px-4 pb-4 mt-4 space-y-4 rounded-lg border-2 border border-gray-300 md:grid-cols-3">
                    <legend class="text-lg font-semibold">Description</legend>

                    <div>
                        <Label class="">Description</Label>
                        <Input type="text" v-model="form.description" placeholder="XXXXXXXXXXXX" class="w-full" />
                        <InputError v-if="form.errors.description" :message="form.errors.description" />
                    </div>

                    <div>
                        <Label class="">Unit Price</Label>
                        <Input type="number" v-model="form.unit_price" placeholder="0000.00" class="w-full" />
                        <InputError v-if="form.errors.unit_price" :message="form.errors.unit_price" />
                    </div>

                    <div>
                        <Label class="">Quantity</Label>
                        <Input type="number" v-model="form.quantity" placeholder="10" class="w-full" />
                        <InputError v-if="form.errors.quantity" :message="form.errors.quantity" />
                    </div>

                    <div>
                        <Label class="">Sub Total</Label>
                        <Input type="number" v-model="form.sub_total" placeholder="0000.00" class="w-full" />
                        <InputError v-if="form.errors.sub_total" :message="form.errors.sub_total" />
                    </div>

                    <div>
                        <Label class="">Discount (%)</Label>
                        <Input type="number" v-model="form.discount" placeholder="2%" class="w-full" />
                        <InputError v-if="form.errors.discount" :message="form.errors.discount" />
                    </div>

                    <div>
                        <Label class="">Total</Label>
                        <Input type="number" v-model="form.total" placeholder="0000.00" class="w-full" />
                        <InputError v-if="form.errors.total" :message="form.errors.total" />
                    </div>
                </fieldset>

                <Button class="mt-4" @click.prevent="submit">Submit</Button>
            </div>
        </CardLayout>
    </app-layout>
</template>

<script>

    import { defineComponent } from 'vue'
    import { useForm } from "@inertiajs/inertia-vue3";
    import AppLayout from '@/Layouts/AppLayout.vue'
    import CardLayout from "@/Jetstream/CardLayout";
    import Input from "@/Jetstream/Input";
    import Label from "@/Jetstream/Label";
    import ValidationErrors from "@/Jetstream/ValidationErrors";
    import Button from "@/Jetstream/Button";
    import InputError from "@/Jetstream/InputError";

    export default defineComponent({

        name: "Create.vue",
        components: {
            InputError,
            Button,
            ValidationErrors,
            Label,
            CardLayout,
            AppLayout,
            Input,
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
                description: null,
                unit_price: null,
                quantity: null,
                sub_total: null,
                discount: null,
                total: null,
            })

            return { form }
        },
        methods: {
            submit() {
                this.form.post(route('invoice.store'))
            }
        }
    })
</script>
