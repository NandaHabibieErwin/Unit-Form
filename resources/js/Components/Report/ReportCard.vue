<script setup>
import { defineProps } from 'vue';

const props = defineProps({
    item: Object,
});
</script>

<template>
    <div class="w-full max-w-5xl mx-auto p-4">
        <!-- Card Container -->
        <div class="bg-white shadow-lg rounded-lg overflow-hidden border border-gray-200">
            <!-- Header -->
            <div class="bg-gradient-to-r from-blue-600 to-blue-400 p-6 text-white text-center">
                <h3 class="text-2xl font-semibold uppercase tracking-wide">{{ item.Nama }}</h3>
            </div>

            <!-- Body -->
            <div class="p-6 grid grid-cols-2 gap-6 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6">
                <!-- Nomor Unit -->
                <div class="flex flex-col">
                    <span class="text-gray-500 text-sm font-medium">Nomor Unit</span>
                    <span class="text-gray-900 font-semibold">{{ item.Nomor_Unit }}</span>
                </div>

                <!-- Tanggal Data -->
                <div class="flex flex-col">
                    <span class="text-gray-500 text-sm font-medium">Tanggal</span>
                    <span class="text-gray-900 font-semibold">{{ item.Tanggal_Data }}</span>
                </div>

                <!-- Kilometer -->
                <div class="flex flex-col">
                    <span class="text-gray-500 text-sm font-medium">Kilometer</span>
                    <span class="text-gray-900 font-semibold">{{ item.Kilo_Meter }}</span>
                </div>

                <!-- Kilometer Service -->
                <div class="flex flex-col">
                    <span class="text-gray-500 text-sm font-medium">KM Service</span>
                    <span class="text-gray-900 font-semibold">{{ item.KiloMeter_Service }}</span>
                </div>

                <!-- Kelayakan -->
                <div class="flex flex-col">
                    <span class="text-gray-500 text-sm font-medium">Kelayakan</span>
                    <span
                        class="text-sm font-semibold px-2 py-1 rounded-full"
                        :class="{
                            'bg-green-200 text-green-800': item.layak === 'Layak',
                            'bg-red-200 text-red-800': item.layak === 'Tidak Layak'
                        }"
                    >
                        {{ item.layak }}
                    </span>
                </div>
            </div>

            <!-- Footer with Button -->
            <div class="p-4 bg-gray-100 text-center">
                <a
                    :href="`/report/view/${item.id}`"
                    class="w-full inline-block px-4 py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition"
                >
                    View Full Report
                </a>
            </div>
        </div>
    </div>
</template>
