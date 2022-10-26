<template>
    <div>
        <div
            class="flex justify-between border-2 rounded-t-lg p-6 bg-white border-b border-gray-200 sm:px-20">
            <h1 class="text-4xl font-bold text-black">Preview</h1>
        </div>

        <div class="p-6 w-full border-x-2 border-b-2 rounded-b-lg bg-white sm:px-20">
            <fieldset
                class="grid grid-cols-1 gap-x-4 px-4 pb-4 space-y-4 rounded-lg border-2 border-gray-300 md:grid-cols-2">
                <legend class="text-lg font-semibold">Customer Details</legend>

                <div>
                    <Label>Full Name</Label>
                    <h3 class="font-bold text-lg">{{ preview.fullname }}</h3>
                </div>

                <div>
                    <Label>Mobile Number</Label>
                    <h3 class="font-bold text-lg">{{ preview.number }}</h3>
                </div>

                <div>
                    <Label>Email</Label>
                    <h3 class="font-bold text-lg">{{ preview.email }}</h3>
                </div>

                <div>
                    <Label>Address 1</Label>
                    <h3 class="font-bold text-lg">{{ preview.address_1 }}</h3>
                </div>

                <div>
                    <Label for="address_2">Address 2</Label>
                    <h3 class="font-bold text-lg">{{ preview.address_2 }}</h3>
                </div>
            </fieldset>

            <fieldset
                class="grid grid-cols-1 gap-x-4 px-4 pb-4 mt-4 space-y-4 rounded-lg border-2 border-gray-300 md:grid-cols-3">
                <legend class="text-lg font-semibold">Invoice Details</legend>

                <div>
                    <Label>Serial No</Label>
                    <h3 class="font-bold text-lg">{{ preview.serial_no }}</h3>
                </div>

                <div>
                    <Label>Issue Date</Label>
                    <h3 class="font-bold text-lg">{{ preview.issue_date }}</h3>
                </div>

                <div>
                    <Label>Due Date</Label>
                    <h3 class="font-bold text-lg">{{ preview.due_date }}</h3>
                </div>
            </fieldset>

            <div v-for="(desc, index) in preview.info" :key="index">
                <fieldset
                    class="grid grid-cols-1 gap-x-4 px-4 pb-4 mt-4 space-y-4 rounded-lg border-2 border-gray-300 md:grid-cols-2">
                    <legend class="text-lg font-semibold">Item Description {{ index + 1 }}
                    </legend>

                    <div>
                        <Label>Description</Label>
                        <h3 class="font-bold text-lg">{{ desc.description }}</h3>
                    </div>

                    <div>
                        <Label>Unit Price</Label>
                        <h3 class="font-bold text-lg">{{ desc.unit_price }}</h3>
                    </div>

                    <div>
                        <Label>Quantity</Label>
                        <h3 class="font-bold text-lg">{{ desc.quantity }}</h3>
                    </div>

                    <div>
                        <Label>Total</Label>
                        <h3 class="font-bold text-lg">{{ desc.total }}</h3>
                    </div>
                </fieldset>
            </div>

            <fieldset
                class="grid grid-cols-1 gap-x-4 px-4 pb-4 mt-4 space-y-4 rounded-lg border-2 border-gray-300 md:grid-cols-3">
                <legend class="text-lg font-semibold">Summary</legend>

                <div>
                    <Label>Sum Total</Label>
                    <h3 class="font-bold text-lg">{{ preview.sum_total }}</h3>
                </div>

                <div>
                    <Label>Discount (%)</Label>
                    <h3 class="font-bold text-lg">{{ preview.discount }}</h3>
                </div>

                <div>
                    <Label class="">Sub Total</Label>
                    <h3 class="font-bold text-lg">{{ preview.sub_total }}</h3>
                </div>
            </fieldset>
        </div>
    </div>
</template>


<script>
import CardLayout from "@/Jetstream/CardLayout.vue";
import Label from "@/Jetstream/Label.vue";
import { defineComponent } from 'vue'

export default defineComponent({
    name: "Create.vue",

    components: {
        Label,
        CardLayout,
    },

    props: ['preview'],
})
</script>