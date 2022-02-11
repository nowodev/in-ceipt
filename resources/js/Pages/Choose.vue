<template>
    <div>
        <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
            <h1 class="text-black font-bold text-4xl">Choose an <span
                class="underline decoration-double decoration decoration-cyan-500">Option</span></h1>
        </div>

        <div
            class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 flex justify-center text-center gap-x-4 gap-y-6 p-6 sm:px-20">
            <a href="" v-for="card in cards"
               class="p-6 bg-cyan-300 rounded-lg h-64 flex items-center outline outline-black">
                <h2 class="text-2xl font-semibold uppercase w-full outline outline-red-600">{{ card.name }}</h2>
            </a>
        </div>
    </div>
</template>

<script>
    const cards = [
        { name: 'Invoice', href: 'something' },
        { name: 'Receipt', href: 'something' },
        { name: 'History', href: 'something' },
    ]

    export default {
        name: "Choose.vue",
        setup() {
            return { cards }
        }
    }

</script>
