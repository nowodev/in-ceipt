<template>
    <Button @mousedown="downloadFile">Download</Button>
</template>

<script>
    import html2pdf from "html2pdf.js";
    import Button from "@/Jetstream/Button";

    export default {
        name: "Download",

        components: { Button },

        props: ["dom", "name"],

        methods: {
            downloadFile() {
                const me = this;

                const invoice = document.querySelector(me.dom);
                let opt = {
                    margin: 1,
                    filename: me.name,
                    image: { type: 'jpeg', quality: 0.98 },
                    html2canvas: { scale: 2 },
                    jsPDF: { format: 'A4', orientation: 'portrait' }
                };
                html2pdf().from(invoice).set(opt).save();
            },
        },
    }
</script>

<style scoped>

</style>
