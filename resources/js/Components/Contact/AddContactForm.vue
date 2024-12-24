<script setup>
import { defineProps, ref, defineEmits } from 'vue';
import { UpdateContact, DeleteContact, UploadContact } from '@/api';
const isModalOpen = ref(false);
const isProcessing = ref(false);

const emit = defineEmits(['contactAdded']);

const name = ref('');
const no_telepon = ref('');

const SaveContact = async (FormData) => {
    if (!name.value || !no_telepon.value) {
        alert('Please fill in all fields.');
        return;
    }
    isProcessing.value = true;
    try {
        const response = await UploadContact({
            name: name.value,
            no_telepon: no_telepon.value,
        });
        if (response && response.success) {
            alert('Contact saved successfully!');
            isModalOpen.value = false;
            emit('contactAdded', response.data);
            name.value = '';
            no_telepon.value = '';
        } else {
            alert('Failed to save contact. Please try again.');
            console.error('Save Contact Error:', response);
        }
    } catch (error) {
        alert('An error occurred while saving the contact.');
        console.error('Error:', error);
    } finally {
        isProcessing.value = false;
    }
};

</script>


<template>
    <button @click="isModalOpen = true"
        class="fixed bottom-20 right-6 bg-yellow-600 text-white p-4 rounded-full shadow-lg hover:bg-yellow-700 transition"
        aria-label="Search">
        🔍
    </button>
    <div v-if="isModalOpen"
        class="fixed inset-0 bg-gray-900 bg-opacity-90 flex justify-center items-center z-50 transition-opacity duration-300">
        <div
            class="bg-gray-100 dark:bg-gray-900 text-white w-full max-w-lg rounded-2xl shadow-2xl p-8 transform scale-95 transition-transform duration-300">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-2xl font-bold flex items-center">
                    <span class="ml-4 dark:text-white text-black">Add New Contact</span>
                </h3>
                <button @click="isModalOpen = false" class="text-yellow-200 hover:text-white transition"
                    aria-label="Close">
                    <i class="fas fa-times text-2xl"></i>
                </button>
            </div>

            <!-- Input Fields -->
            <div class="space-y-6">
                <!-- Name Input -->
                <div class="relative group">
                    <input v-model="name" type="text" placeholder="Nama Kontak"
                        class="w-full px-4 py-3 bg-yellow-100 text-gray-800 rounded-lg shadow-sm focus:ring-4 focus:ring-yellow-300 focus:outline-none transition group-hover:shadow-md" />
                    <i
                        class="fas fa-user absolute right-4 top-1/2 transform -translate-y-1/2 text-yellow-700 group-hover:text-yellow-900"></i>
                </div>

                <!-- Nomor Telepon Input -->
                <div class="relative group">
                    <input v-model="no_telepon" type="text" placeholder="Nomor Telepon"
                        class="w-full px-4 py-3 bg-yellow-100 text-gray-800 rounded-lg shadow-sm focus:ring-4 focus:ring-yellow-300 focus:outline-none transition group-hover:shadow-md" />
                    <i
                        class="fas fa-hashtag absolute right-4 top-1/2 transform -translate-y-1/2 text-yellow-700 group-hover:text-yellow-900"></i>
                </div>
            </div>

            <!-- Footer Buttons -->
            <div class="mt-6 flex justify-end space-x-4">
                <button @click="SaveContact"
                    class="px-6 w-full py-3 bg-gradient-to-r from-yellow-600 to-yellow-800 text-white font-semibold rounded-lg hover:from-yellow-700 hover:to-yellow-900 transition duration-300 shadow-lg">
                    Save
                </button>
                <button @click="isModalOpen = false"
                    class="px-6 w-full py-3 bg-gradient-to-r from-yellow-600 to-yellow-800 text-white font-semibold rounded-lg hover:from-yellow-700 hover:to-yellow-900 transition duration-300 shadow-lg">
                    Close
                </button>
            </div>
        </div>
    </div>

</template>
