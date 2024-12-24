<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import {FetchContact, UpdateContact,DeleteContact} from '@/api.js';

const Contact = ref([]);
const isEditing = ref(false);
const currentContact = ref({});

const props = defineProps({
    Contact: {
        type: Object,
        required: true,
    },
});

console.log("Prop", props.Contact)

const fetchContacts = async () => {
    try {
        Contact.value = await FetchContact();
    } catch (error) {
        console.error('Error fetching contacts:', error);
    }
};

const editContact = (contact) => {
    isEditing.value = true;
    currentContact.value = { ...contact };
};

const saveContact = async () => {
    try {
        const response = await UpdateContact(currentContact.value.id, currentContact.value);
        const index = Contact.value.findIndex((c) => c.id === currentContact.value.id);
        Contact.value[index] = response;
        isEditing.value = false;
    } catch (error) {
        console.error('Error saving contact:', error);
    }
};

const deleteContact = async (id) => {
    if (confirm('Are you sure you want to delete this contact?')) {
        try {
            await DeleteContact(id);
            Contact.value = Contact.value.filter((contact) => contact.id !== id);
        } catch (error) {
            console.error('Error deleting contact:', error);
        }
    }
};

const handleContactAdded = (newContact) => {
    Contact.value.push(newContact);
};

onMounted(fetchContacts);
</script>

<template>

        <div class="container mx-auto p-6 dark:bg-gray-900 dark:text-white">
            <table class="min-w-full table-auto border-collapse border border-gray-300 dark:border-gray-700">
                <thead class="bg-gray-100 dark:bg-gray-800">
                    <tr>
                        <th class="border border-gray-300 dark:border-gray-700 px-4 py-2 text-left">Nama Kontak</th>
                        <th class="border border-gray-300 dark:border-gray-700 px-4 py-2 text-left">Nomor Telepon</th>
                        <th class="border border-gray-300 dark:border-gray-700 px-4 py-2 text-left">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        v-for="contact in props.Contact"
                        :key="contact.id"
                        class="hover:bg-gray-50 dark:hover:bg-gray-800"
                    >
                        <td class="border border-gray-300 dark:border-gray-700 px-4 py-2">{{ contact.name }}</td>
                        <td class="border border-gray-300 dark:border-gray-700 px-4 py-2">{{ contact.no_telepon }}</td>
                        <td class="border border-gray-300 dark:border-gray-700 px-4 py-2">
                            <button
                                @click="editContact(contact)"
                                class="bg-blue-500 text-white px-3 py-1 rounded-md hover:bg-blue-600 dark:bg-blue-600 dark:hover:bg-blue-700"
                            >
                                Edit
                            </button>
                            <button
                                @click="deleteContact(contact.id)"
                                class="bg-red-500 text-white px-3 py-1 rounded-md hover:bg-red-600 ml-2 dark:bg-red-600 dark:hover:bg-red-700"
                            >
                                Delete
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>

            <!-- Edit Modal -->
            <div
                v-if="isEditing"
                class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center"
            >
                <div class="bg-white dark:bg-gray-900 dark:text-white p-6 rounded-md shadow-md w-96">
                    <h2 class="text-lg font-semibold mb-4">Edit Contact</h2>
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Name</label>
                        <input
                            id="name"
                            type="text"
                            v-model="currentContact.name"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2 focus:ring-blue-500 focus:border-blue-500 dark:border-gray-700 dark:bg-gray-800 dark:focus:ring-blue-400 dark:focus:border-blue-400"
                        />
                    </div>
                    <div class="mb-4">
                        <label for="no_telepon" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Phone Number</label>
                        <input
                            id="no_telepon"
                            type="text"
                            v-model="currentContact.no_telepon"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2 focus:ring-blue-500 focus:border-blue-500 dark:border-gray-700 dark:bg-gray-800 dark:focus:ring-blue-400 dark:focus:border-blue-400"
                        />
                    </div>
                    <div class="flex justify-end">
                        <button
                            @click="saveContact"
                            class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600 dark:bg-green-600 dark:hover:bg-green-700"
                        >
                            Save
                        </button>
                        <button
                            @click="isEditing = false"
                            class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 ml-2 dark:bg-gray-600 dark:hover:bg-gray-700"
                        >
                            Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>

</template>

<style>
/* Custom styles if needed */
</style>
