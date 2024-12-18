<script setup>
import { ApproveReport } from '@/api';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { defineProps } from 'vue';
import UTLogo from '@/Components/UTLogo.vue';

const props = defineProps({
    report: Object,
});

const handleApprove = async () => {
    const response = await ApproveReport($id);

};

const handleReject = () => {
    console.log('Rejected:', props.report.id);
};
</script>

<template>
    <Head title="Detailed Report" />

    <AuthenticatedLayout>

        <div class="pb-20"> <!-- Add bottom padding to prevent overlap with the sticky bottom bar -->
            <div class="mx-auto max-w-5xl sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden">
                    <!-- Header Section with Logo -->
                    <div class="bg-gradient-to-r from-yellow-300 to-yellow-400 text-white rounded-lg shadow-lg p-6 flex flex-wrap justify-between items-center">
                        <div class="space-y-2">
                            <h1 class="text-3xl font-bold">{{ report.Nama }}</h1>
                            <p class="text-lg font-medium">Report for Unit {{ report.Nomor_Unit }}</p>
                        </div>
                        <UTLogo class="h-16 w-auto" />
                        <div class="mt-4 sm:mt-0 space-y-1 text-right">
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
                        <!-- Report Information -->
                        <div class="grid grid-cols-2 gap-6">
                            <div>
                                <p class="text-gray-500 dark:text-gray-400 text-sm">Nama</p>
                                <p class="text-gray-900 dark:text-gray-100 font-semibold">{{ report.Nama }}</p>
                            </div>
                            <div>
                                <p class="text-gray-500 dark:text-gray-400 text-sm">Tanggal Data</p>
                                <p class="text-gray-900 dark:text-gray-100 font-semibold">{{ report.Tanggal_Data }}</p>
                            </div>
                            <div>
                                <p class="text-gray-500 dark:text-gray-400 text-sm">Nomor Unit</p>
                                <p class="text-gray-900 dark:text-gray-100 font-semibold">{{ report.Nomor_Unit }}</p>
                            </div>
                            <div>
                                <p class="text-gray-500 dark:text-gray-400 text-sm">Kilometer</p>
                                <p class="text-gray-900 dark:text-gray-100 font-semibold">{{ report.Kilo_Meter }}</p>
                            </div>
                            <div>
                                <p class="text-gray-500 dark:text-gray-400 text-sm">KM Service</p>
                                <p class="text-gray-900 dark:text-gray-100 font-semibold">{{ report.KiloMeter_Service }}</p>
                            </div>
                        </div>

                        <!-- Vehicle Inspection -->
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Vehicle Inspection</h3>
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
                                    <p class="text-gray-500 dark:text-gray-400 text-sm font-medium">{{ key }}</p>
                                    <p class="text-gray-900 dark:text-gray-100 font-semibold">{{ value }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Driver Health -->
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Driver Health</h3>
                            <div class="grid grid-cols-2 md:grid-cols-2 gap-6">
                                <div>
                                    <p class="text-gray-500 dark:text-gray-400 text-sm">Istirahat</p>
                                    <p class="text-gray-900 dark:text-gray-100 font-semibold">{{ report.istirahat }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-500 dark:text-gray-400 text-sm">Obat</p>
                                    <p class="text-gray-900 dark:text-gray-100 font-semibold">{{ report.obat }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-500 dark:text-gray-400 text-sm">Masalah</p>
                                    <p class="text-gray-900 dark:text-gray-100 font-semibold">{{ report.masalah }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-500 dark:text-gray-400 text-sm">Kondisi</p>
                                    <p class="text-gray-900 dark:text-gray-100 font-semibold">{{ report.kondisi }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Kelayakan -->
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Kelayakan</h3>
                            <p
                                class="text-lg font-bold px-4 py-2 inline-block rounded-md"
                                :class="{
                                    'bg-green-100 text-green-800': report.layak === 'Layak',
                                    'bg-red-100 text-red-800': report.layak === 'Tidak Layak'
                                }"
                            >
                                {{ report.layak }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sticky Bottom Bar -->
        <div class="fixed bottom-0 left-0 right-0 bg-white dark:bg-gray-800 shadow-md p-4 grid grid-cols-2 gap-4">
            <button
                @click="handleReject"
                class="w-full px-4 py-2 bg-red-600 text-white font-semibold rounded-lg hover:bg-red-700 transition"
            >
                Reject
            </button>
            <button
                @click="handleApprove"
                class="w-full px-4 py-2 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition"
            >
                Approve
            </button>
        </div>
    </AuthenticatedLayout>
</template>
