<template>
    <Button @mousedown="downloadFile">Download</Button>
</template>

<script>
    import html2pdf from "html2pdf.js";
    import Button from "@/Jetstream/Button.vue";

    export default {
        name: "Download",

        components: { Button },

        props: ["dom", "name"],

        methods: {
            downloadFile() {
                const download = this;

                const inceipt = document.querySelector(download.dom);
                let opt = {
                    margin: 1,
                    filename: download.name,
                    image: { type: 'jpeg', quality: 0.98 },
                    html2canvas: { scale: 2 },
                    jsPDF: { format: 'A4', orientation: 'portrait' }
                };
                html2pdf().from(inceipt).set(opt).save();
            },
        },
    }
</script>