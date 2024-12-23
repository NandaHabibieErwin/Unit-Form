<script setup>
import { defineProps, ref, watch } from 'vue';
import { Link } from '@inertiajs/vue3';
const props = defineProps({
    item: Object,
});
</script>

<template>
    <div class="w-full max-w-5xl mx-auto p-4">
        <!-- Card Container -->
        <div
            class="bg-white shadow-lg rounded-lg overflow-hidden border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
            <!-- Header -->
            <div class="bg-gradient-to-r from-yellow-600 to-yellow-400 p-6 text-white text-center">
                <h3 class="text-2xl font-semibold uppercase tracking-wide">
                    {{ item.Nama }}
                </h3>
            </div>

            <!-- Body -->
            <div class="p-6 grid grid-cols-2 gap-6 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6">
                <!-- Nomor Unit -->
                <div class="flex flex-col">
                    <span class="text-gray-500 text-sm font-medium dark:text-gray-400">
                        Nomor Unit
                    </span>
                    <span class="text-gray-900 font-semibold dark:text-gray-100">
                        {{ item.Nomor_Unit }}
                    </span>
                </div>

                <!-- Tanggal Data -->
                <div class="flex flex-col">
                    <span class="text-gray-500 text-sm font-medium dark:text-gray-400">
                        Tanggal
                    </span>
                    <span class="text-gray-900 font-semibold dark:text-gray-100">
                        {{ item.Tanggal_Data }}
                    </span>
                </div>

                <!-- Kilometer -->
                <div class="flex flex-col">
                    <span class="text-gray-500 text-sm font-medium dark:text-gray-400">
                        Kilometer
                    </span>
                    <span class="text-gray-900 font-semibold dark:text-gray-100">
                        {{ item.Kilo_Meter }}
                    </span>
                </div>

                <!-- Kilometer Service -->
                <div class="flex flex-col">
                    <span class="text-gray-500 text-sm font-medium dark:text-gray-400">
                        KM Service
                    </span>
                    <span class="text-gray-900 font-semibold dark:text-gray-100">
                        {{ item.KiloMeter_Service }}
                    </span>
                </div>

                <!-- Kelayakan -->
                <div class="flex flex-col">
                    <span class="text-gray-500 text-sm font-medium dark:text-gray-400">
                        Kelayakan
                    </span>
                    <span class="text-sm font-semibold px-2 py-1 rounded-sm" :class="{
                        'bg-green-200 text-green-800 dark:bg-green-900 dark:text-green-200':
                            item.layak === 'Layak',
                        'bg-red-200 text-red-800 dark:bg-red-900 dark:text-red-200':
                            item.layak === 'Tidak Layak',
                        'bg-yellow-200 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200':
                            item.layak === 'Layak dengan catatan',
                    }">
                        {{ item.layak }}
                    </span>
                </div>

                <!-- Status -->
                <div class="flex flex-col">
                    <span class="text-gray-500 text-sm font-medium dark:text-gray-400">
                        Status
                    </span>
                    <span class="text-sm font-semibold px-2 py-1 rounded-full" :class="{
                        'bg-green-200 text-green-800 dark:bg-green-900 dark:text-green-200':
                            item.status === 'Approved',
                        'bg-red-200 text-red-800 dark:bg-red-900 dark:text-red-200':
                            item.status === 'Rejected',
                        'bg-yellow-200 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200':
                            item.status === 'Pending',
                    }">
                        {{ item.status }}
                    </span>
                </div>
            </div>

            <!-- Footer with Button -->
            <div class="p-4 bg-gray-100 dark:bg-gray-700 text-center">
                <Link :href="`/report/view/${item.id}`"
                    class="w-full inline-block px-4 py-2 bg-yellow-600 text-white font-semibold rounded-lg hover:bg-yellow-700 dark:bg-yellow-700 dark:hover:bg-yellow-800 transition">
                View Report
                </Link>
            </div>
        </div>
    </div>
</template>
