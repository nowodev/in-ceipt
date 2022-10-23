<template>
    <div class="flex items-center min-h-screen bg-gray-50">
        <div
            class="flex-1 mx-auto max-w-4xl h-full bg-white rounded-xl shadow-xl"
        >
            <div class="flex flex-col md:flex-row">
                <div class="h-32 md:h-auto md:w-1/2">
                    <img
                        alt="img"
                        class="object-cover w-full h-full"
                        src="../../../../public/storage/account_setup.jpg"
                    />
                </div>
                <div class="flex justify-center items-center p-6 sm:p-12 md:w-1/2">
                    <div class="w-full">
                        <h3 class="mb-4 text-xl font-bold text-gray-800">Account Setup</h3>

                        <div class="flex w-full bg-gray-200 rounded-full">
                            <div
                                :class="page === 1 ? '' : 'invisible'"
                                class="p-1 w-1/2 text-xs font-medium leading-none text-center text-white bg-gray-800 rounded-full"
                            >
                                Step 1
                            </div>
                            <div
                                :class="page === 2 ? '' : 'invisible'"
                                class="p-1 w-1/2 text-xs font-medium leading-none text-center text-white bg-gray-800 rounded-full"
                            >
                                Step 2
                            </div>
                        </div>

                        <div :class="page === 1 ? '' : 'hidden'">
                            <div class="my-4">
                                <Label class="text-sm" for="company_name">Company Name</Label>
                                <Input id="company_name" v-model="form.company_name" class="w-full text-sm"
                                       placeholder="Sanders" type="text" />
                                <InputError v-if="form.errors.company_name" :message="form.errors.company_name" />
                            </div>

                            <div class="mb-4">
                                <Label class="text-sm" for="address_1">Address 1</Label>
                                <Input id="address_1" v-model="form.address_1" class="w-full text-sm"
                                       placeholder="Sanders" type="text" />
                                <InputError v-if="form.errors.address_1" :message="form.errors.address_1" />
                            </div>

                            <div class="mb-4">
                                <Label class="text-sm" for="address_2">Address 2</Label>
                                <Input id="address_2" v-model="form.address_2" class="w-full text-sm"
                                       placeholder="Sanders" type="text" />
                                <InputError v-if="form.errors.address_2" :message="form.errors.address_2" />
                            </div>

                            <div class="mb-4">
                                <Label class="text-sm" for="mobile_no">Mobile No</Label>
                                <Input id="mobile_no" v-model="form.mobile_no" class="w-full text-sm"
                                       placeholder="Sanders" type="tel" />
                                <InputError v-if="form.errors.mobile_no" :message="form.errors.mobile_no" />
                            </div>

                            <div class="mb-4">
                                <Label class="text-sm" for="office_no">Office No</Label>
                                <Input id="office_no" v-model="form.office_no" class="w-full text-sm"
                                       placeholder="Sanders" type="tel" />
                                <InputError v-if="form.errors.office_no" :message="form.errors.office_no" />
                            </div>
                        </div>

                        <div :class="page === 2 ? '' : 'hidden'"
                             class="">
                            <div class="my-4">
                                <Label class="text-sm" for="bank_name">Bank Name</Label>
                                <Input id="bank_name" v-model="form.bank_name" class="w-full text-sm"
                                       placeholder="Sanders" type="text" />
                                <InputError v-if="form.errors.bank_name" :message="form.errors.bank_name" />
                            </div>

                            <div class="mb-4">
                                <Label class="text-sm" for="account_name">Account Name</Label>
                                <Input id="account_name" v-model="form.account_name" class="w-full text-sm"
                                       placeholder="Sanders" type="text" />
                                <InputError v-if="form.errors.account_name" :message="form.errors.account_name" />
                            </div>

                            <div class="mb-4">
                                <Label class="text-sm" for="account_number">Account Number</Label>
                                <Input id="account_number" v-model="form.account_number" class="w-full text-sm"
                                       placeholder="Sanders" type="number" />
                                <InputError v-if="form.errors.account_number" :message="form.errors.account_number" />
                            </div>
                        </div>


                        <div class="flex justify-end">
                            <Button v-show="page === 1" @click="page = 2">Next</Button>

                            <div v-show="page === 2" class="space-x-3">
                                <Button @click="page = 1">Previous</Button>
                                <Button :class="{ 'opacity-25': form.processing }" :disabled="form.processing"
                                        @click.prevent="updateCompanyInformation">
                                    Setup
                                </Button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Button from "@/Jetstream/Button.vue";
    import DangerButton from "@/Jetstream/DangerButton.vue";
    import Input from "@/Jetstream/Input.vue";
    import InputError from "@/Jetstream/InputError.vue";
    import Label from "@/Jetstream/Label.vue";
    import SecondaryButton from "@/Jetstream/SecondaryButton.vue";
    import { useForm } from "@inertiajs/inertia-vue3";

    export default {
        name: "AccountSetup",

        components: {
            InputError,
            DangerButton,
            SecondaryButton,
            Button,
            Label,
            Input
        },

        data() {
            return {
                page: 1
            }
        },

        setup() {
            const form = useForm({
                company_name: null,
                address_1: null,
                address_2: null,
                mobile_no: null,
                office_no: null,
                bank_name: null,
                account_name: null,
                account_number: null,
            });

            return { form }
        },

        methods: {
            updateCompanyInformation() {
                this.form.patch(route('settings.setup-wizard'));
            },
        }

    }
</script>

<style scoped>

</style>
