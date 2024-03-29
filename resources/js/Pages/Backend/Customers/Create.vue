<template>
    <app-layout title="Add Customer">
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
                Add Customer
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
                        <Label for="fullname">Full Name</Label>
                        <Input id="fullname" v-model="form.fullname" class="w-full"
                               placeholder="John Doe" type="text" />
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
    import Button from "@/Jetstream/Button.vue";
    import CardLayout from "@/Jetstream/CardLayout.vue";
    import Input from "@/Jetstream/Input.vue";
    import InputError from "@/Jetstream/InputError.vue";
    import Label from "@/Jetstream/Label.vue";
    import SecondaryButton from "@/Jetstream/SecondaryButton.vue";
    import AppLayout from '@/Layouts/AppLayout.vue'
    import { Link, useForm } from "@inertiajs/inertia-vue3";
    import { defineComponent } from 'vue'

    export default defineComponent({
        name: "Create.vue",

        components: {
            SecondaryButton,
            InputError,
            Button,
            Label,
            CardLayout,
            AppLayout,
            Input,
            Link
        },

        setup() {
            const form = useForm({
                fullname: null,
                number: null,
                email: null,
                address_1: null,
                address_2: null,
            })

            return { form }
        },

        methods: {
            // submit form
            submit: function () {
                this.form.post(route('customers.store'))
            },

            resetForm() {
                this.form.clearErrors();
                this.form.reset();
            },
        }
    })
</script>
