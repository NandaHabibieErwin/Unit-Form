<script setup>
import { ManageReport } from '@/api';
import Vue3Html2pdf from 'vue3-html2pdf'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { defineProps, ref, computed } from 'vue';
import html2pdf from 'html2pdf.js';
import jsPDF from 'jspdf';
import UTLogo from '@/Components/UTLogo.vue';
import { usePage } from '@inertiajs/vue3';
const page = usePage();
const IsAdmin = computed(() => page.props.auth.user.name === 'admin');

const props = defineProps({
    report: Object,
});
const report = ref({ ...props.report });
const isProcessing = ref(false);

console.log(props.report);

const ShowPDF= ref(false);
const pdfRef = ref(null);
console.log(props.report.status);

const handleReport = async (status) => {
    isProcessing.value = true;
    try {
        const response = await ManageReport(props.report.id, status);
    if (response && response.success) {
            report.value.status = status;
            DownloadPDF();
            console.log("Updated:", report.value);
        } else {
            console.error("Failed to update status:", response);
        }
    } catch (error) {
        console.error("Error updating status:", error);
    } finally {
        isProcessing.value = false;
    }
    console.log("Updated:", response);
};

const DownloadPDF = () => {
    const element = document.getElementById('pdf-content');
    html2pdf().from(element).set({
        filename: 'report.pdf',
        html2canvas: { scale: 2 },
        jsPDF: { orientation: 'portrait', format: 'a4' },
    }).save();
};
/*
const downloadPDF = () => {
    ShowPDF.value = true;
    setTimeout(() => {
        pdfRef.value.generatePdf();
        ShowPDF.value = false;
    }, 500);
};
*/
</script>

<template>

    <Head title="Full Report" />

    <AuthenticatedLayout>
        <div class="flex mt-5 justify-center items-center min-h-screen bg-gray-100 dark:bg-gray-900">
        <div id="pdf-content" class="pb-20">

            <div  class="mx-4 max-w-5xl sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden">
                    <!-- Header Section with Logo -->
                    <div class="bg-gradient-to-r from-yellow-300 to-yellow-400 text-white rounded-lg shadow-lg p-6 grid grid-cols-3 items-center">
                        <!-- Left Section -->
                        <div class="text-left space-y-1">
                            <h1 class="text-2xl font-bold">{{ report.Nama }}</h1>
                            <p class="text-lg font-medium">Nomor Unit: {{ report.Nomor_Unit }}</p>
                        </div>

                        <!-- Center Section -->
                        <div class="text-center">
                            <p class="text-2xl font-bold">REPORT</p>
                        </div>

                        <!-- Right Section -->
                        <div class="text-right space-y-1">
                            <p>
                                <span class="font-semibold">Tanggal:</span> {{ report.Tanggal_Data }}
                            </p>
                            <p>
                                <span class="font-semibold">Kilometer:</span> {{ report.Kilo_Meter }} KM
                            </p>
                            <p>
                                <span class="font-semibold">KM Service:</span> {{ report.KiloMeter_Service }} KM
                            </p>
                        </div>
                    </div>




                    <!-- Report Details -->
                    <div class="p-6 space-y-8">
                        <!-- Vehicle Inspection -->
                        <div>
                            <h2 class="text-lg font-semibold text-gray-800 mb-4 dark:text-gray-200">Vehicle Inspection
                            </h2>
                            <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                <div v-for="(value, key) in {
                                    'Ban Velg Baut': report.Ban_Velg_Baut,
                                    'Oli Mesin': report.Oli_Mesin,
                                    'Air Radiator': report.Air_Radiator,
                                    'APAR': report.APAR,
                                    'Sabuk Pengaman': report.Sabuk_Pengaman,
                                    'Spion': report.Spion,
                                    'Klakson Alarm': report.Klakson_Alarm,
                                    'Kontrol Panel': report.Kontrol_Panel,
                                    'Brake System': report.Brake_System,
                                    'Steering System': report.Steering_System,
                                    'Battery': report.Battery
                                }" :key="key" class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg shadow-sm">

                                    <p class="text-gray-500 dark:text-gray-400 text-sm font-medium">
                                        <span
                                            v-if="key === 'Oli Mesin' || key === 'Brake System' || key === 'Steering System'"
                                            class="badge text-xs bg-yellow-400 text-black font-semibold py-1 mr-3 mb-5 px-2 rounded">AA</span>
                                        <span v-else
                                            class="badge text-xs bg-yellow-400 text-black font-semibold py-1 mr-3 mb-5 px-2 rounded">A</span>
                                        {{ key }}
                                    </p>
                                    <p class="text-gray-900 dark:text-gray-100 mt-2 font-semibold">{{ value }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Driver Health -->
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800 mb-4 dark:text-gray-200">Driver Health</h3>
                            <div class="grid grid-cols-2 md:grid-cols-2 gap-6">
                                <div>
                                    <p class="text-gray-500 dark:text-gray-400 text-sm">Telah beristirahat sebelum awal
                                        shift selama</p>
                                    <p class="text-gray-900 dark:text-gray-100 font-semibold">{{ report.istirahat }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-500 dark:text-gray-400 text-sm">Tidak mengonsumsi obat-obatan
                                        yang dapat menyebabkan ngantuk dalam periode 8 jam sebelum mengemudi</p>
                                    <p class="text-gray-900 dark:text-gray-100 font-semibold">{{ report.obat }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-500 dark:text-gray-400 text-sm">Tidak memiliki masalah pribadi
                                        atau keluarga yang dapat memengaruhi konsentrasi saya dalam mengemudi</p>
                                    <p class="text-gray-900 dark:text-gray-100 font-semibold">{{ report.masalah }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-500 dark:text-gray-400 text-sm">Dalam Kondisi sehat dan fit
                                        untuk mengemudi</p>
                                    <p class="text-gray-900 dark:text-gray-100 font-semibold">{{ report.kondisi }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Photo -->
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800 mb-4 dark:text-gray-200">Photo</h3>
                            <div class="grid grid-cols-2 md:grid-cols-2 gap-6">
                                 <!-- Photo Kanan -->
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800 mb-4 dark:text-gray-200">Foto Kanan</h3>
                            <ul class="grid grid-cols-2 md:grid-cols-3 gap-6">
                                    <img :src="`/storage/${report.FotoKanan}`" alt="Foto Kanan" class="w-full rounded-lg h-32 shadow-sm mb-4" />
                            </ul>
                        </div>

                        <!-- Foto Kiri -->
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800 mb-4 dark:text-gray-200">Foto Kiri</h3>
                            <ul class="grid grid-cols-2 md:grid-cols-3 gap-6">
                                    <img :src="`/storage/${report.FotoKiri}`" alt="Foto Kiri" class="w-full rounded-lg h-32 shadow-sm mb-4" />
                            </ul>
                        </div>
                            </div>
                        </div>

                        <!-- Kelayakan -->
                        <div class="grid grid-cols-2 md:grid-cols-2 gap-6">
                            <!-- Kelayakan -->
                            <div>
                                <h3 class="text-lg font-semibold mb-5 text-gray-800 dark:text-gray-200">Kelayakan</h3>
                                <p class="text-lg font-bold px-4 py-2 inline-block rounded-md" :class="{
                                    'bg-green-100 text-green-800': report.layak === 'Layak',
                                    'bg-yellow-100 text-yellow-800': report.layak === 'Layak dengan catatan',
                                    'bg-red-100 text-red-800': report.layak === 'Tidak Layak'
                                }">
                                    {{ report.layak }}
                                </p>
                            </div>
                            <!-- Head -->
                            <div>
                                <h3 class="text-lg font-semibold mb-5 text-gray-800 dark:text-gray-200">
                                    SPV/Dept Head/Leader:</h3>
                                <p class="text-lg font-bold px-4 py-2 inline-block rounded-md bg-gray-100 text-gray-800">
                                    {{ report.Head }}
                                </p>
                            </div>
                        </div>


                    </div>
                </div>
            </div>

        </div>
    </div>
        <!-- Sticky Bottom Bar -->
        <div class="fixed bottom-0 left-0 right-0 bg-white dark:bg-gray-800 shadow-md p-4 flex items-center justify-center">
            <div v-if="report.status === 'Pending' && IsAdmin" class="w-full flex justify-between gap-4">
                <!-- Buttons for "Reject" and "Approve" -->
                <button
                    v-if="!isProcessing"
                    @click="handleReport('Rejected')"
                    class="flex-grow px-4 py-2 bg-red-600 text-white font-semibold rounded-lg hover:bg-red-700 transition">
                    Reject
                </button>
                <button
                    v-if="!isProcessing"
                    @click="handleReport('Approved')"
                    class="flex-grow px-4 py-2 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition">
                    Approve
                </button>

                <!-- Loading Spinner -->
                <div
                    v-else
                    class="flex-grow flex items-center justify-center">
                    <div class="flex items-center gap-2">
                        <svg class="animate-spin h-8 w-8 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                        </svg>
                        <span class="text-blue-500 font-semibold text-lg">Processing...</span>
                    </div>
                </div>
            </div>

            <!-- Status and "Download as PDF" Button -->
            <div v-else class="w-full text-center">
                <p
                    class="text-lg font-bold px-4 flex-grow mx-4 py-2 rounded-lg inline-block"
                    :class="{
                        'bg-green-100 text-green-800': report.status === 'Approved',
                        'bg-red-100 text-red-800': report.status === 'Rejected',
                        'bg-yellow-100 text-yellow-800': report.status === 'Pending'
                    }">
                    {{ report.status }}
                </p>
                <button
                    @click="DownloadPDF"
                    class="flex-grow px-4 py-2 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition">
                    Download as PDF
                </button>
            </div>
        </div>


    </AuthenticatedLayout>
</template>
