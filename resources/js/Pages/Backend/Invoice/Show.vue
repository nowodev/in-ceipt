<template>
    <app-layout title="Invoice">
        <template #header>
            <h2 class="flex text-xl font-semibold leading-tight text-gray-800">
                <Link :href="route('invoice.index')">
                    <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-6 h-6" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 01-18 0z" />
                    </svg>
                </Link>
                View Invoice
            </h2>
        </template>

        <CardLayout>
            <div class="overflow-hidden shadow sm:rounded-lg">
                <div class="px-4 py-5 space-x-4 sm:px-6">
                    <Button @click="showModal(1, 'one')">
                        One
                    </Button>
                    <Button @click="showModal(2, 'two')">
                        Two
                    </Button>
                    <Button @click="showModal(3, 'three')">
                        Three
                    </Button>
                </div>
            </div>

            <DialogModal max-width="4xl" :show="showingModal" @close="closeModal">
                <template #content>
                    <One v-if="selected === 1" :invoice="invoice" id="one" />
                    <Two v-if="selected === 2" :invoice="invoice" id="two" />
                    <Three v-if="selected === 3" :invoice="invoice" id="three" />
                </template>

                <template #footer>
                    <SecondaryButton @click="closeModal">
                        Close
                    </SecondaryButton>

                    <Download class="ml-3" :dom="print_id" :name="name" />
                </template>
            </DialogModal>
        </CardLayout>
    </app-layout>
</template>

<script>
    import Button from "@/Jetstream/Button.vue";
    import CardLayout from "@/Jetstream/CardLayout.vue";
    import DialogModal from "@/Jetstream/DialogModal.vue";
    import Download from "@/Jetstream/Download.vue";
    import SecondaryButton from "@/Jetstream/SecondaryButton.vue";
    import AppLayout from '@/Layouts/AppLayout.vue';
    import One from "@/Pages/Backend/Invoice/Template/One.vue";
    import Three from "@/Pages/Backend/Invoice/Template/Three.vue";
    import Two from "@/Pages/Backend/Invoice/Template/Two.vue";
    import { Link } from "@inertiajs/inertia-vue3";
    import { defineComponent } from 'vue';

    export default defineComponent({
        name: "Show",
        components: {
            Download,
            Two,
            Three,
            SecondaryButton,
            DialogModal,
            Button,
            One,
            CardLayout,
            AppLayout,
            Link,
        },
        props: {
            invoice: Object,
        },
        data() {
            return {
                selected: false,
                showingModal: null,
                print_id: null,
                name: null,
            }
        },
        methods: {
            showModal(value, id) {
                this.showingModal = true
                this.selected = value
                this.print_id = '#' + id
                this.name = this.invoice.serial_no + '.pdf'
                console.log(this.name)
            },

            closeModal() {
                this.selected = !this.selected
                this.showingModal = null
                this.print_id = null;
            }
        },
    })
</script>
