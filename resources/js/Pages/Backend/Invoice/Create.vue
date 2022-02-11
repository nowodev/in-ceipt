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
                        <Input type="text" placeholder="John Doe" class="w-full" />
                    </div>

                    <div>
                        <Label class="">Mobile Number</Label>
                        <Input type="number" placeholder="John Doe" class="w-full" />
                    </div>

                    <div>
                        <Label class="">Email</Label>
                        <Input type="email" placeholder="johndoe@email.com" class="w-full" />
                    </div>

                    <div>
                        <Label class="">Address 1</Label>
                        <Input type="text" placeholder="No. X, Somewhere in China town" class="w-full" />
                    </div>

                    <div>
                        <Label class="">Address 2</Label>
                        <Input type="text" placeholder="No. X, Somewhere in China town" class="w-full" />
                    </div>
                </fieldset>

                <fieldset
                    class="grid grid-cols-1 gap-x-4 px-4 pb-4 mt-4 space-y-4 rounded-lg border-2 border border-gray-300 md:grid-cols-3">
                    <legend class="text-lg font-semibold">Invoice Details</legend>
                    <div>
                        <Label class="">Serial No</Label>
                        <Input type="number" placeholder="XXXXXXXXXXXX" class="w-full" />
                    </div>

                    <div>
                        <Label class="">Issue Date</Label>
                        <Input type="date" class="w-full" />
                    </div>

                    <div>
                        <Label class="">Due Date</Label>
                        <Input type="date" class="w-full" />
                    </div>
                </fieldset>

                <fieldset
                    class="grid grid-cols-1 gap-x-4 px-4 pb-4 mt-4 space-y-4 rounded-lg border-2 border border-gray-300 md:grid-cols-3">
                    <legend class="text-lg font-semibold">Description</legend>

                    <div>
                        <Label class="">Description</Label>
                        <Input type="text" placeholder="XXXXXXXXXXXX" class="w-full" />
                    </div>

                    <div>
                        <Label class="">Unit Price</Label>
                        <Input type="number" placeholder="0000.00" class="w-full" />
                    </div>

                    <div>
                        <Label class="">Quantity</Label>
                        <Input type="number" placeholder="0000.00" class="w-full" />
                    </div>

                    <div>
                        <Label class="">Sub Total</Label>
                        <Input type="number" placeholder="0000.00" class="w-full" />
                    </div>

                    <div>
                        <Label class="">Discount (%)</Label>
                        <Input type="number" placeholder="2%" class="w-full" />
                    </div>

                    <div>
                        <Label class="">Total</Label>
                        <Input type="number" placeholder="0000.00" class="w-full" />
                    </div>
                </fieldset>

                <ButtonLink class="mt-4">Submit</ButtonLink>
            </div>
        </CardLayout>
    </app-layout>
</template>

<script>

    import { defineComponent } from 'vue'
    import AppLayout from '@/Layouts/AppLayout.vue'
    import CardLayout from "@/Jetstream/CardLayout";
    import Input from "@/Jetstream/Input";
    import Label from "@/Jetstream/Label";
    import ButtonLink from "@/Jetstream/ButtonLink";

    export default defineComponent({

        name: "Create.vue",
        components: {
            Label,
            CardLayout,
            AppLayout,
            Input,
            ButtonLink
        }
    })
</script>
