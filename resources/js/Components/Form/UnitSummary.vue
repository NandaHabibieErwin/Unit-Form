<script setup>
import {defineProps, defineEmits, ref, onMounted } from 'vue'
import {FetchContact, UpdateContact,DeleteContact} from '@/api.js';

const Contact = ref([]);

const props = defineProps({
    Nama: String,
  Tanggal: String,
  NoUnit: String,
  KM: String,
  KMService: String,
  Vehicle: Object,
  Health: Object,
  Head: String,
  Kelayakan: String,
})

const fetchContacts = async () => {
    try {
        Contact.value = await FetchContact();
    } catch (error) {
        console.error('Error fetching contacts:', error);
    }
};

onMounted(fetchContacts());


const emit = defineEmits(['update:Nama', 'update:Tanggal', 'update:NoUnit', 'update:KM', 'update:KMService','update:Head'])

</script>
<template>
    <div class="summary-container bg-white shadow-lg rounded-lg p-6 mx-auto max-w-3xl lg:max-w-4xl dark:bg-gray-800 dark:text-gray-200">
        <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center border-b pb-3 dark:text-gray-100 dark:border-gray-600">
          Summary Report
        </h2>

        <!-- Personal Information Section -->
        <div class="mb-6">
          <h3 class="text-xl font-semibold text-gray-700 mb-4 dark:text-gray-300">Personal Information</h3>
          <ul class="grid grid-cols-1 sm:grid-cols-2 gap-y-2 text-gray-600 dark:text-gray-400">
            <li><strong>Nama:</strong> <span class="font-medium text-gray-800 dark:text-gray-200">{{ Nama }}</span></li>
            <li><strong>Tanggal:</strong> <span class="font-medium text-gray-800 dark:text-gray-200">{{ Tanggal }}</span></li>
            <li><strong>Nomor Unit:</strong> <span class="font-medium text-gray-800 dark:text-gray-200">{{ NoUnit }}</span></li>
            <li><strong>Kilometer:</strong> <span class="font-medium text-gray-800 dark:text-gray-200">{{ KM }}</span></li>
            <li><strong>Kilometer Service:</strong> <span class="font-medium text-gray-800 dark:text-gray-200">{{ KMService }}</span></li>
            <li><strong>SPV/Dept Head/Leader:</strong> <span class="font-medium text-gray-800 dark:text-gray-200">{{ Head }}</span></li>
            <li class="col-span-full">
              <strong>Kelayakan Unit:</strong>
              <span
                class="font-medium text-green-600 dark:text-green-400"
                v-if="Kelayakan === 'Layak'"
              >
                Layak
              </span>
              <span
                class="font-medium text-yellow-600  dark:text-yellow-400"
                v-else-if="Kelayakan === 'Layak dengan catatan'"
              >Layak dengan catatan</span>
              <span class="font-medium text-red-600 dark:text-red-400" v-else>{{ Kelayakan }}</span>
            </li>
          </ul>
        </div>

        <!-- Vehicle Components Section -->
        <div class="mb-6">
          <h3 class="text-xl font-semibold text-gray-700 mb-4 dark:text-gray-300">Vehicle Components</h3>
          <ul class="grid grid-cols-1 sm:grid-cols-2 gap-y-2 text-gray-600 dark:text-gray-400">
            <li><strong>Ban, Velg, Baut:</strong> <span class="font-medium text-gray-800 dark:text-gray-200">{{ Vehicle.Ban_Velg_Baut }}</span></li>
            <li><strong>Oli Mesin:</strong> <span class="font-medium text-gray-800 dark:text-gray-200">{{ Vehicle.Oli_Mesin }}</span></li>
            <li><strong>Air Radiator:</strong> <span class="font-medium text-gray-800 dark:text-gray-200">{{ Vehicle.Air_Radiator }}</span></li>
            <li><strong>APAR:</strong> <span class="font-medium text-gray-800 dark:text-gray-200">{{ Vehicle.APAR }}</span></li>
            <li><strong>Sabuk Pengaman:</strong> <span class="font-medium text-gray-800 dark:text-gray-200">{{ Vehicle.Sabuk_Pengaman }}</span></li>
            <li><strong>Spion:</strong> <span class="font-medium text-gray-800 dark:text-gray-200">{{ Vehicle.Spion }}</span></li>
            <li><strong>Klakson dan Alarm:</strong> <span class="font-medium text-gray-800 dark:text-gray-200">{{ Vehicle.Klakson_Alarm }}</span></li>
            <li><strong>Kontrol Panel:</strong> <span class="font-medium text-gray-800 dark:text-gray-200">{{ Vehicle.Kontrol_Panel }}</span></li>
            <li><strong>Brake System:</strong> <span class="font-medium text-gray-800 dark:text-gray-200">{{ Vehicle.Brake_System }}</span></li>
            <li><strong>Steering System:</strong> <span class="font-medium text-gray-800 dark:text-gray-200">{{ Vehicle.Steering_System }}</span></li>
            <li><strong>Lampu:</strong> <span class="font-medium text-gray-800 dark:text-gray-200">{{ Vehicle.Lampu }}</span></li>
            <li><strong>Battery:</strong> <span class="font-medium text-gray-800 dark:text-gray-200">{{ Vehicle.Battery }}</span></li>
          </ul>
        </div>

        <!-- Driver Health Section -->
        <div>
          <h3 class="text-xl font-semibold text-gray-700 mb-4 dark:text-gray-300">Driver Health</h3>
          <ul class="grid grid-cols-1 sm:grid-cols-2 gap-y-2 text-gray-600 dark:text-gray-400">
            <li><strong>Telah beristirahat selama:</strong> <span class="font-medium text-gray-800 dark:text-gray-200">{{ Health.istirahat }}</span></li>
            <li><strong>Tidak mengonsumsi obat-obatan yang dapat menyebabkan ngantuk:</strong> <span class="font-medium text-gray-800 dark:text-gray-200">{{ Health.obat }}</span></li>
            <li><strong>Tidak memiliki masalah:</strong> <span class="font-medium text-gray-800 dark:text-gray-200">{{ Health.masalah }}</span></li>
            <li><strong>Dalam kondisi sehat:</strong> <span class="font-medium text-gray-800 dark:text-gray-200">{{ Health.kondisi }}</span></li>
          </ul>
        </div>
      </div>


    <FormKit
    type="select"
    :model-value="props.Head"
    @input="emit('update:Head', $event)"
    label="SPV/Dept Head/Leader"
    placeholder="Pilih"
    validation="required"
    :options="['Irlang Haristo', 'Sariyanto', 'Edy Saputra', 'Efrem Togu Adi Suryo','Stephen Boenardi','Aprio Nugroho','Waston','Dani Rogusty']"
  />
  </template>
