<template>
    <FormKit type="form" :actions="false" @submit="handleSubmit">
        <FormKit type="multi-step" tab-style="tab">
            <FormKit type="step" name="Personal Detail & Date">
                <!-- component for example brevity. -->
                <PersonalDetail v-model:Nama="Nama" v-model:Tanggal="Tanggal" v-model:NoUnit="NoUnit" v-model:KM="KM"
                    v-model:KMService="KMService" />
            </FormKit>

            <FormKit type="step" name="Vehicle Components">
                <!-- component for example brevity. -->
                <VehicleComponent  v-model:Ban_Velg_Baut="Vehicle.Ban_Velg_Baut"
          v-model:Oli_Mesin="Vehicle.Oli_Mesin"
          v-model:Air_Radiator="Vehicle.Air_Radiator"
          v-model:APAR="Vehicle.APAR"
          v-model:Sabuk_Pengaman="Vehicle.Sabuk_Pengaman"
          v-model:Spion="Vehicle.Spion"
          v-model:Klakson_Alarm="Vehicle.Klakson_Alarm"
          v-model:Kontrol_Panel="Vehicle.Kontrol_Panel"
          v-model:Brake_System="Vehicle.Brake_System"
          v-model:Steering_System="Vehicle.Steering_System"
          v-model:Lampu="Vehicle.Lampu"
          v-model:Battery="Vehicle.Battery" />
            </FormKit>

            <FormKit type="step" name="Driver Health Check">
                <!-- component for example brevity. -->
                <DriverHealth
                v-model:istirahat="Health.istirahat"
                v-model:obat="Health.obat"
                v-model:masalah="Health.masalah"
                v-model:kondisi="Health.kondisi"/>
            </FormKit>

            <FormKit type="step" name="Unit Summary Form">
                <!-- component for example brevity. -->
                <UnitSummary v-model:Head="Head" />


                <FormKit type="submit" />

            </FormKit>
        </FormKit>
    </FormKit>

    <div v-if="OpenModal" id="static-modal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
        class="overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Result
                    </h3>
                    <button v-on:click="OpenModal = false" type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="static-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4 md:p-5 space-y-4">
                    <FormKit type="text" label="Nomor_Telepon" v-model="Nomor_Telepon"
                        prefix-icon="avatarMan" validation="required" />
                </div>
                <!-- Modal footer -->
                <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <button v-on:click="SubmitData" data-modal-hide="static-modal" type="button"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">I
                        accept</button>
                    <button v-on:click="OpenModal = false" data-modal-hide="static-modal" type="button"
                        class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Decline</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue'
import PersonalDetail from '@/Components/Form/PersonalDetail.vue'
import DriverHealth from '@/Components/Form/DriverHealth.vue'
import UnitSummary from '@/Components/Form/UnitSummary.vue'
import VehicleComponent from '@/Components/Form/VehicleComponent.vue'
import { UploadForm } from '@/api.js';
import { defineProps, defineEmits } from 'vue'


const Nama = ref('')
const Tanggal = ref('')
const NoUnit = ref('')
const KM = ref('')
const KMService = ref('')
const Head = ref('')
const OpenModal = ref(false)
const Nomor_Telepon = ref('')
const Vehicle = ref({
    Ban_Velg_Baut: '',
  Oli_Mesin: '',
  Air_Radiator: '',
  APAR: '',
  Sabuk_Pengaman: '',
  Spion: '',
  Klakson_Alarm: '',
  Kontrol_Panel: '',
  Brake_System: '',
  Steering_System: '',
  Lampu: '',
  Battery: '',
});
const Health = ref({
    istirahat: '',
    obat: '',
    masalah: '',
    kondisi:'',
});

const isSubmitted = ref(false)

/*
When handling submit, it should open modal to provide link and input phone number. only then does it store into database.
*/
const handleSubmit = async () => {
    try {
        console.log("Vehicle: " + JSON.stringify(Vehicle.value, null, 2));
        console.log("Health: " + JSON.stringify(Health.value, null, 2));
        OpenModal.value = true;
    } catch (error) {
        console.error('Error uploading form:', error);
    }
};

const SubmitData = async () => {
    try {
        const CheckKelayakan = () => {
            const { Oli_Mesin, Brake_System, Steering_System } = Vehicle.value;
            return Oli_Mesin === 'Buruk' || Brake_System === 'Buruk' || Steering_System === 'Buruk'
                ? 'Tidak Layak'
                : 'Layak';
        };
        const formData = {
            Nama: Nama.value,
            Tanggal_Data: Tanggal.value,
            Nomor_Unit: NoUnit.value,
            Kilo_Meter: KM.value,
            KiloMeter_Service: KMService.value,
            Head: Head.value,
            Vehicle: Vehicle.value,
            Health: Health.value,
            layak: CheckKelayakan(),
        };

        const response = await UploadForm(formData);
        console.log('Form uploaded successfully:', response);
        OpenModal.value = false;
        isSubmitted.value = true;

        const ChangeFormat = (number) =>
        {
            number = String(number);
            if (number.startsWith('0')){
                return '62' + number.slice(1);
            }
            return number;
        }

        const Response = "Saya sudah mengisi form"
        const link = `https://api.whatsapp.com/send?phone=${ChangeFormat(Nomor_Telepon.value)}&text=${Response}`;
        /*Disable during debug*/
        // window.open(link) ,
    } catch (error) {
        console.error('Error uploading form:', error);
    }
}

</script>
