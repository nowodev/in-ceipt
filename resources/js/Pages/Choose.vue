<template>
    <div>
        <div class="p-6 bg-white border-b border-gray-200 sm:px-20">
            <h1 class="text-4xl font-bold text-black">Choose an <span
                class="underline decoration-double decoration decoration-cyan-500">Option</span></h1>
        </div>

        <div
            class="flex grid grid-cols-1 gap-x-4 gap-y-6 justify-center p-6 text-center bg-gray-200 bg-opacity-25 md:grid-cols-2 lg:grid-cols-3 sm:px-20">
            <Link :href="card.href" v-for="card in cards"
                  class="flex items-center p-6 h-64 bg-cyan-300 rounded-lg outline-black outline">
                <h1 class="w-full font-mono text-4xl font-bold uppercase">{{ card.name }}</h1>
            </Link>
        </div>
    </div>
</template>

<script>
    import { Link } from '@inertiajs/inertia-vue3';

    const cards = [
        { name: 'Invoice', href: route('invoice.index') },
        { name: 'Receipt', href: 'something' },
        { name: 'History', href: 'something' },
    ]

    export default {
        name: "Choose.vue",
        components: {
            Link
        },
        setup() {
            return { cards }
        }
    }

</script>
