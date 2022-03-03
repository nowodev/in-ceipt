<template>
    <jet-form-section @submitted="updateBankInformation">
        <template #title>
            Bank Information
        </template>

        <template #description>
            Update your bank profile.
        </template>

        <template #form>
            <!-- Name -->
            <div class="col-span-6 sm:col-span-4">
                <jet-label for="name" value="Bank" />
                <jet-input id="name" v-model="form.name" autocomplete="name" class="mt-1 block w-full"
                           type="text" />
                <jet-input-error :message="form.errors.name" class="mt-2" />
            </div>

            <!-- Account Number -->
            <div class="col-span-6 sm:col-span-4">
                <jet-label for="account_name" value="Account Name" />
                <jet-input id="account_name" v-model="form.account_name" class="mt-1 block w-full"
                           type="text" />
                <jet-input-error :message="form.errors.account_name" class="mt-2" />
            </div>

            <!-- Account Number -->
            <div class="col-span-6 sm:col-span-4">
                <jet-label for="account_number" value="Account Number" />
                <jet-input id="account_number" v-model="form.account_number" class="mt-1 block w-full" type="text" />
                <jet-input-error :message="form.errors.account_number" class="mt-2" />
            </div>
        </template>

        <template #actions>
            <jet-action-message :on="form.recentlySuccessful" class="mr-3">
                Saved.
            </jet-action-message>

            <jet-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Save
            </jet-button>
        </template>
    </jet-form-section>
</template>

<script>
    import JetActionMessage from '@/Jetstream/ActionMessage.vue'
    import JetButton from '@/Jetstream/Button.vue'
    import JetFormSection from '@/Jetstream/FormSection.vue'
    import JetInput from '@/Jetstream/Input.vue'
    import JetInputError from '@/Jetstream/InputError.vue'
    import JetLabel from '@/Jetstream/Label.vue'
    import JetSecondaryButton from '@/Jetstream/SecondaryButton.vue'
    import { useForm } from "@inertiajs/inertia-vue3";
    import { defineComponent } from "vue";

    export default defineComponent({
        name: "UpdateBankDetails",

        components: {
            JetActionMessage,
            JetButton,
            JetFormSection,
            JetInput,
            JetInputError,
            JetLabel,
            JetSecondaryButton,
        },

        props: ['bank_details'],

        setup(props) {
            if (props.bank_details == null) {
                const form = useForm({
                    name: null,
                    account_name: null,
                    account_number: null
                })

                return { form }
            } else {
                const form = useForm({
                    name: props.bank_details.name,
                    account_name: props.bank_details.account_name,
                    account_number: props.bank_details.account_number
                })

                return { form }
            }
        },

        methods: {
            updateBankInformation() {
                this.form.post(route('settings.update-bank'), {
                    preserveScroll: true,
                });
            },
        },

    })
</script>
