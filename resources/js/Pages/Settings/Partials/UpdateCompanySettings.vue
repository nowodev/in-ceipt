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

                <jet-label for="photo" value="Logo" />

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
                <jet-label for="name" value="Company Name" />
                <jet-input id="name" v-model="form.company_name" autocomplete="name" class="mt-1 block w-full"
                           type="text" />
                <jet-input-error :message="form.errors.company_name" class="mt-2" />
            </div>

            <!-- Address -->
            <div class="col-span-6 sm:col-span-4">
                <jet-label for="address_1" value="Address" />
                <jet-input id="address_1" v-model="form.address" class="mt-1 block w-full" type="text" />
                <jet-input-error :message="form.errors.address" class="mt-2" />
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

        props: ['setting'],

        data() {
            return {
                logoPreview: null,
            }
        },

        setup(props) {
            const form = useForm({
                company_name: props.setting.company_name,
                address: props.setting.address,
                logo: null,
            })

            return { form }
        },

        methods: {
            updateCompanyInformation() {
                if (this.$refs.logo) {
                    this.form.logo = this.$refs.logo.files[0]
                }

                this.form.post(route('settings.store'), {
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
