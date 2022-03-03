<template>
    <app-layout title="Settings">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Settings
            </h2>
        </template>

        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <div>
                    <update-company-settings :setting="setting" />
                    <jet-section-border />
                </div>

                <div>
                    <update-bank-details :bank_details="bank_details" class="mt-10 sm:mt-0" />
                    <jet-section-border />
                </div>
            </div>
        </div>

    </app-layout>
</template>

<script>
    import JetSectionBorder from '@/Jetstream/SectionBorder.vue'
    import AppLayout from '@/Layouts/AppLayout.vue'
    import UpdateBankDetails from "@/Pages/Settings/Partials/UpdateBankDetails";
    import UpdateCompanySettings from "@/Pages/Settings/Partials/UpdateCompanySettings";
    import { defineComponent } from 'vue'

    export default defineComponent({
        name: "Show.vue",

        props: ['setting', 'bank_details'],

        components: {
            UpdateBankDetails,
            UpdateCompanySettings,
            AppLayout,
            JetSectionBorder,
        },
    })
</script>
