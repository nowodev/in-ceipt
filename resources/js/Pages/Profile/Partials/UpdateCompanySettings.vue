<template>
    <jet-form-section @submitted="updateCompanyInformation">
        <template #title>
            Company Information
        </template>

        <template #description>
            Update your company's profile.
        </template>

        <template #form>
            <!-- Logo -->
            <div class="col-span-6 sm:col-span-4">
                <!-- Logo File Input -->
                <input ref="logo" class="hidden"
                       type="file"
                       @change="updateLogoPreview">

                <jet-label for="logo" value="Logo" />

                <!-- Current Logo -->
                <div v-show="! logoPreview" class="mt-2">
                    <img :alt="setting.name" :src="setting.logo" class="rounded-full h-20 w-20 object-cover">
                </div>

                <!-- New Logo Preview -->
                <div v-show="logoPreview" class="mt-2">
                    <span :style="'background-image: url(\'' + logoPreview + '\');'"
                          class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center">
                    </span>
                </div>

                <jet-secondary-button class="mt-2 mr-2" type="button" @click.prevent="selectNewLogo">
                    Select A New Logo
                </jet-secondary-button>

<!--                <jet-secondary-button v-if="setting.profile_photo_path" class="mt-2" type="button"-->
<!--                                      @click.prevent="deleteLogo">-->
<!--                    Remove Logo-->
<!--                </jet-secondary-button>-->

                <jet-input-error :message="form.errors.logo" class="mt-2" />
            </div>

            <!-- Name -->
            <div class="col-span-6 sm:col-span-4">
                <jet-label for="company_name" value="Company Name" />
                <jet-input id="company_name" v-model="form.company_name" class="mt-1 block w-full"
                           type="text" />
                <jet-input-error :message="form.errors.company_name" class="mt-2" />
            </div>

            <!-- Address 1 -->
            <div class="col-span-6 sm:col-span-4">
                <jet-label for="address_1" value="Address 1" />
                <jet-input id="address_1" v-model="form.address_1" autocomplete="address" class="mt-1 block w-full"
                           type="text" />
                <jet-input-error :message="form.errors.address_1" class="mt-2" />
            </div>

            <!-- Address 2 -->
            <div class="col-span-6 sm:col-span-4">
                <jet-label for="address_2" value="Address 2" />
                <jet-input id="address_2" v-model="form.address_2" autocomplete="address" class="mt-1 block w-full"
                           type="text" />
                <jet-input-error :message="form.errors.address_2" class="mt-2" />
            </div>

            <!-- Mobile No -->
            <div class="col-span-6 sm:col-span-4">
                <jet-label for="mobile_no" value="Mobile No." />
                <jet-input id="mobile_no" v-model="form.mobile_no" autocomplete="Number" class="mt-1 block w-full"
                           type="tel" />
                <jet-input-error :message="form.errors.mobile_no" class="mt-2" />
            </div>

            <!-- Office No -->
            <div class="col-span-6 sm:col-span-4">
                <jet-label for="office_no" value="Office No." />
                <jet-input id="office_no" v-model="form.office_no" autocomplete="Number" class="mt-1 block w-full"
                           type="text" />
                <jet-input-error :message="form.errors.office_no" class="mt-2" />
            </div>

            <!-- Bank Name -->
            <div class="col-span-6 sm:col-span-4">
                <jet-label for="bank_name" value="Bank" />
                <jet-input id="bank_name" v-model="form.bank_name" class="mt-1 block w-full"
                           type="text" />
                <jet-input-error :message="form.errors.bank_name" class="mt-2" />
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
        name: "UpdateCompanySettings",

        components: {
            JetActionMessage,
            JetButton,
            JetFormSection,
            JetInput,
            JetInputError,
            JetLabel,
            JetSecondaryButton,
        },

        props: ['user'],

        data() {
            return {
                logoPreview: null,
            }
        },

        setup(props) {
            const form = useForm({
                company_name: props.user.company_name,
                address_1: props.user.address_1,
                address_2: props.user.address_2,
                mobile_no: props.user.mobile_no,
                office_no: props.user.office_no,
                bank_name: props.user.bank_name,
                account_name: props.user.account_name,
                account_number: props.user.account_number,
                address: props.user.address,
                logo: null,
            })

            return { form }
        },

        methods: {
            updateCompanyInformation() {
                if (this.$refs.logo) {
                    this.form.logo = this.$refs.logo.files[0]
                }

                this.form.post(route('settings.update-company'), {
                    preserveScroll: true,
                    onSuccess: () => (this.clearLogoFileInput()),
                });
            },

            selectNewLogo() {
                this.$refs.logo.click();
            },

            updateLogoPreview() {
                const logo = this.$refs.logo.files[0];

                if (!logo) return;

                const reader = new FileReader();

                reader.onload = (e) => {
                    this.logoPreview = e.target.result;
                };

                reader.readAsDataURL(logo);
            },

            // deleteLogo() {
            //     this.$inertia.delete(route('current-user-photo.destroy'), {
            //         preserveScroll: true,
            //         onSuccess: () => {
            //             this.logoPreview = null;
            //             this.clearLogoFileInput();
            //         },
            //     });
            // },

            clearLogoFileInput() {
                if (this.$refs.logo?.value) {
                    this.$refs.logo.value = null;
                }
            },
        },

    })
</script>
