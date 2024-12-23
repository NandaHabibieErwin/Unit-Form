<script setup>

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import ReportCard from '@/Components/Report/ReportCard.vue';
import { defineProps, ref, watch } from 'vue';
import { SearchReports } from '@/api.js';

const name = ref('');
const no_unit = ref('');
const tanggal_data = ref('');
const kelayakan = ref('');
const data = ref([]);
const CurrentPage = ref(1);
const TotalPages = ref(1);
const isModalOpen = ref(false);
const loading = ref(false);

watch([name, no_unit, tanggal_data, kelayakan, CurrentPage], async () => {
    loading.value = true;
    const allEmpty = !name.value && !no_unit.value && !tanggal_data.value && !kelayakan.value;
    try {
    const response = await SearchReports({
        name: name.value,
        no_unit: no_unit.value,
        tanggal_data: tanggal_data.value,
        kelayakan: kelayakan.value,
        page: CurrentPage.value,
    });
    data.value = response.data;
    TotalPages.value = response.last_page || 1;
}finally {
        loading.value = false;
    }
}, { immediate: true });


const props = defineProps({
    data: Array,
});

console.log(props.data);
</script>

<template>

    <Head title="Report" />

    <AuthenticatedLayout>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div v-if="loading" class="flex items-center justify-center min-h-[200px]">
                    <div class="flex items-center space-x-2">
                        <div class="w-5 h-5 border-4 border-yellow-500 border-t-transparent rounded-full animate-spin"></div>
                        <span class="text-yellow-600 font-medium">Loading...</span>
                    </div>
                </div>
                <div v-else>
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div v-for="(item, index) in data" :key="item.id" class="mb-4">
                            <ReportCard :item="item" />
                        </div>
                    </div>
                </div>
            </div>
                <nav class="fixed bottom-0 left-0 right-0 flex bg-gray-100 dark:bg-gray-900 shadow-md">
                    <button @click="CurrentPage > 1 && (CurrentPage--)" :disabled="CurrentPage === 1"
                        class="flex-1 py-4 text-center text-gray-800 bg-gray-200 dark:bg-gray-700 dark:text-gray-200 hover:bg-gray-300 dark:hover:bg-gray-600 disabled:opacity-50 transition">
                        Previous
                    </button>
                    <span class="flex-1 py-4 text-center text-gray-800 dark:text-gray-200">
                        Page {{ CurrentPage }} of {{ TotalPages }}
                    </span>
                    <button @click="CurrentPage < TotalPages && (CurrentPage++)" :disabled="CurrentPage === TotalPages"
                        class="flex-1 py-4 text-center text-gray-800 bg-gray-200 dark:bg-gray-700 dark:text-gray-200 hover:bg-gray-300 dark:hover:bg-gray-600 disabled:opacity-50 transition">
                        Next
                    </button>
                </nav>

                <button @click="isModalOpen = true"
                    class="fixed bottom-20 right-6 bg-yellow-600 text-white p-4 rounded-full shadow-lg hover:bg-yellow-700 transition"
                    aria-label="Search">
                    🔍
                </button>
                <div
                v-if="isModalOpen"
                class="fixed inset-0 bg-gray-900 bg-opacity-90 flex justify-center items-center z-50 transition-opacity duration-300"
            >
                <!-- Modal Container -->
                <div
                    class="bg-gray-100 dark:bg-gray-900 text-white w-full max-w-lg rounded-2xl shadow-2xl p-8 transform scale-95 transition-transform duration-300"
                >
                    <!-- Header with Icon -->
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-2xl font-bold flex items-center">
                            <span class="ml-4 dark:text-white text-black">Search Reports</span>
                        </h3>
                        <button
                            @click="isModalOpen = false"
                            class="text-yellow-200 hover:text-white transition"
                            aria-label="Close"
                        >
                            <i class="fas fa-times text-2xl"></i>
                        </button>
                    </div>

                    <!-- Input Fields -->
                    <div class="space-y-6">
                        <!-- Name Input -->
                        <div class="relative group">
                            <input
                                v-model="name"
                                type="text"
                                placeholder="Search by name"
                                class="w-full px-4 py-3 bg-yellow-100 text-gray-800 rounded-lg shadow-sm focus:ring-4 focus:ring-yellow-300 focus:outline-none transition group-hover:shadow-md"
                            />
                            <i class="fas fa-user absolute right-4 top-1/2 transform -translate-y-1/2 text-yellow-700 group-hover:text-yellow-900"></i>
                        </div>

                        <!-- Unit Number Input -->
                        <div class="relative group">
                            <input
                                v-model="no_unit"
                                type="text"
                                placeholder="Search by unit number"
                                class="w-full px-4 py-3 bg-yellow-100 text-gray-800 rounded-lg shadow-sm focus:ring-4 focus:ring-yellow-300 focus:outline-none transition group-hover:shadow-md"
                            />
                            <i class="fas fa-hashtag absolute right-4 top-1/2 transform -translate-y-1/2 text-yellow-700 group-hover:text-yellow-900"></i>
                        </div>

                        <!-- Date Input -->
                        <div class="relative group">
                            <input
                                v-model="tanggal_data"
                                type="date"
                                class="w-full px-4 py-3 bg-yellow-100 text-gray-800 rounded-lg shadow-sm focus:ring-4 focus:ring-yellow-300 focus:outline-none transition group-hover:shadow-md"
                            />
                            <i class="fas fa-calendar-alt absolute right-4 top-1/2 transform -translate-y-1/2 text-yellow-700 group-hover:text-yellow-900"></i>
                        </div>

                        <!-- Eligibility Dropdown -->
                        <div class="relative group">
                            <select
                                v-model="kelayakan"
                                class="w-full px-4 py-3 bg-yellow-100 text-gray-800 rounded-lg shadow-sm focus:ring-4 focus:ring-yellow-300 focus:outline-none transition group-hover:shadow-md"
                            >
                                <option value="" disabled selected>Kelayakan</option>
                                <option value="Layak">Layak</option>
                                <option value="Layak dengan catatan">
                                    Layak dengan catatan
                                </option>
                                <option value="Tidak Layak">Tidak Layak</option>

                            </select>
                            <i class="fas fa-check-circle absolute right-4 top-1/2 transform -translate-y-1/2 text-yellow-700 group-hover:text-yellow-900"></i>
                        </div>
                    </div>

                    <!-- Footer Buttons -->
                    <div class="mt-6 flex justify-end space-x-4">
                        <button
                            @click="isModalOpen = false"
                            class="px-6 w-full py-3 bg-gradient-to-r from-yellow-600 to-yellow-800 text-white font-semibold rounded-lg hover:from-yellow-700 hover:to-yellow-900 transition duration-300 shadow-lg"
                        >
                            Close
                        </button>
                    </div>
                </div>
            </div>


            </div>
        </div>
    </AuthenticatedLayout>
</template>
