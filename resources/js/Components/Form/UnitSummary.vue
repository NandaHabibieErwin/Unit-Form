<script setup>
import { defineProps, defineEmits, ref, onMounted } from 'vue'
import { FetchContact } from '@/api.js';

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
    Keterangan: String,
})

const fetchContacts = async () => {
    try {
        Contact.value = await FetchContact();
    } catch (error) {
        console.error('Error fetching contacts:', error);
    }
};

const ConvertTtdToImage = async (ttd) => {

    const { isEmpty, data } = ttd;
    const binaryData = atob(data.split(',')[1]); // Decode the base64 string (remove the prefix "data:image/png;base64,")
    const arrayBuffer = new ArrayBuffer(binaryData.length);
    const uint8Array = new Uint8Array(arrayBuffer);

    for (let i = 0; i < binaryData.length; i++) {
        uint8Array[i] = binaryData.charCodeAt(i);
    }

    const TtdImg = new File([uint8Array], `signature_${Date.now()}.png`, { type: 'image/png' });
    emit('update:Ttd', TtdImg);

    /*
    console.log("TTD RUN",ttd);
    const { isEmpty, data } = ttd;
    console.log("Data",data);
    const TtdImg = new File(
        [Uint8Array.from(btoa(data), (m) => m.codePointAt(0))],
        `signature_${Date.now()}.png`,
        { type: 'image/png' }
    );
    console.log("TTDIMG",TtdImg);
    emit('update:Ttd', TtdImg);
    */
};

onMounted(fetchContacts());


const emit = defineEmits(['update:Nama', 'update:Tanggal', 'update:NoUnit', 'update:KM', 'update:KMService', 'update:Head', 'update:NamaSPV', 'update:NoSPV', 'update:Ttd', 'update:Keterangan'])

</script>
<template>
    <div
        class="summary-container bg-white shadow-lg rounded-lg p-6 mx-auto max-w-3xl lg:max-w-4xl dark:bg-gray-800 dark:text-gray-200">
        <h2
            class="text-2xl font-bold text-gray-800 mb-6 text-center border-b pb-3 dark:text-gray-100 dark:border-gray-600">
            Summary
        </h2>

        <!-- Personal Information Section -->
        <div class="mb-6">
            <h3 class="text-xl font-semibold text-gray-700 mb-4 dark:text-gray-300">Personal Information</h3>
            <ul class="grid grid-cols-1 sm:grid-cols-2 gap-y-2 text-gray-600 dark:text-gray-400">
                <li><strong>Nama:</strong> <span class="font-medium text-gray-800 dark:text-gray-200">{{ Nama }}</span>
                </li>
                <li><strong>Tanggal:</strong> <span class="font-medium text-gray-800 dark:text-gray-200">{{ Tanggal
                        }}</span></li>
                <li><strong>Nomor Unit:</strong> <span class="font-medium text-gray-800 dark:text-gray-200">{{ NoUnit
                        }}</span></li>
                <li><strong>Kilometer:</strong> <span class="font-medium text-gray-800 dark:text-gray-200">{{ KM
                        }}</span></li>
                <li><strong>Kilometer Service:</strong> <span class="font-medium text-gray-800 dark:text-gray-200">{{
                    KMService }}</span></li>
                <li><strong>SPV/Dept Head/Leader:</strong> <span class="font-medium text-gray-800 dark:text-gray-200">{{
                    Head }}</span></li>
                <li class="col-span-full">
                    <strong>Kelayakan Unit:</strong>
                    <span class="font-medium text-green-600 dark:text-green-400" v-if="Kelayakan === 'Layak'">
                        Layak
                    </span>
                    <span class="font-medium text-yellow-600  dark:text-yellow-400"
                        v-else-if="Kelayakan === 'Layak dengan catatan'">Layak dengan catatan</span>
                    <span class="font-medium text-red-600 dark:text-red-400" v-else>{{ Kelayakan }}</span>
                </li>
            </ul>
        </div>

        <!-- Vehicle Components Section -->
        <div class="mb-6">
            <h3 class="text-xl font-semibold text-gray-700 mb-4 dark:text-gray-300">Vehicle Components</h3>
            <ul class="grid grid-cols-1 sm:grid-cols-2 gap-y-2 text-gray-600 dark:text-gray-400">
                <li><strong>Ban, Velg, Baut:</strong> <span class="font-medium text-gray-800 dark:text-gray-200">{{
                    Vehicle.Ban_Velg_Baut }}</span></li>
                <li><strong>Oli Mesin:</strong> <span class="font-medium text-gray-800 dark:text-gray-200">{{
                    Vehicle.Oli_Mesin }}</span></li>
                <li><strong>Air Radiator:</strong> <span class="font-medium text-gray-800 dark:text-gray-200">{{
                    Vehicle.Air_Radiator }}</span></li>
                <li><strong>APAR:</strong> <span class="font-medium text-gray-800 dark:text-gray-200">{{ Vehicle.APAR
                        }}</span></li>
                <li><strong>Sabuk Pengaman:</strong> <span class="font-medium text-gray-800 dark:text-gray-200">{{
                    Vehicle.Sabuk_Pengaman }}</span></li>
                <li><strong>Spion:</strong> <span class="font-medium text-gray-800 dark:text-gray-200">{{ Vehicle.Spion
                        }}</span></li>
                <li><strong>Klakson dan Alarm:</strong> <span class="font-medium text-gray-800 dark:text-gray-200">{{
                    Vehicle.Klakson_Alarm }}</span></li>
                <li><strong>Kontrol Panel:</strong> <span class="font-medium text-gray-800 dark:text-gray-200">{{
                    Vehicle.Kontrol_Panel }}</span></li>
                <li><strong>Brake System:</strong> <span class="font-medium text-gray-800 dark:text-gray-200">{{
                    Vehicle.Brake_System }}</span></li>
                <li><strong>Steering System:</strong> <span class="font-medium text-gray-800 dark:text-gray-200">{{
                    Vehicle.Steering_System }}</span></li>
                <li><strong>Lampu:</strong> <span class="font-medium text-gray-800 dark:text-gray-200">{{ Vehicle.Lampu
                        }}</span></li>
                <li><strong>Battery:</strong> <span class="font-medium text-gray-800 dark:text-gray-200">{{
                    Vehicle.Battery }}</span></li>

                <li><strong>Air Conditioner:</strong> <span class="font-medium text-gray-800 dark:text-gray-200">{{
                    Vehicle.Air_Conditioner }}</span></li>
                <li><strong>Wiper:</strong> <span class="font-medium text-gray-800 dark:text-gray-200">{{
                    Vehicle.Wiper }}</span></li>
                <li><strong>V-Belt:</strong> <span class="font-medium text-gray-800 dark:text-gray-200">{{
                    Vehicle.V_Belt }}</span></li>
                <li><strong>Kaca Depan, Samping dan Belakang:</strong> <span
                        class="font-medium text-gray-800 dark:text-gray-200">{{
                            Vehicle.Kaca }}</span></li>
                <li><strong>Buggy Whip 4M:</strong> <span class="font-medium text-gray-800 dark:text-gray-200">{{
                    Vehicle.Buggy_Whip
                        }}</span></li>
                <li><strong>Radio Komunikasi:</strong> <span class="font-medium text-gray-800 dark:text-gray-200">{{
                    Vehicle.Radio_Komunikasi }}</span></li>
                <li><strong>Sistem 4WD:</strong> <span class="font-medium text-gray-800 dark:text-gray-200">{{
                    Vehicle.Sistem_4wd
                        }}</span></li>
            </ul>
            <div>
                <h3 class="text-xl font-semibold mt-4 text-gray-700 mb-1 dark:text-gray-300">Keterangan</h3>
                <span class="font-medium text-gray-800 dark:text-gray-200">{{
                    Keterangan }}</span>
            </div>
        </div>

        <!-- Driver Health Section -->
        <div>
            <h3 class="text-xl font-semibold text-gray-700 mb-4 dark:text-gray-300">Driver Health</h3>
            <ul class="grid grid-cols-1 sm:grid-cols-2 gap-y-2 text-gray-600 dark:text-gray-400">
                <li><strong>Telah beristirahat selama:</strong> <span
                        class="font-medium text-gray-800 dark:text-gray-200">{{ Health.istirahat }}</span></li>
                <li><strong>Tidak mengonsumsi obat-obatan yang dapat menyebabkan ngantuk:</strong> <span
                        class="font-medium text-gray-800 dark:text-gray-200">{{ Health.obat }}</span></li>
                <li><strong>Tidak memiliki masalah:</strong> <span
                        class="font-medium text-gray-800 dark:text-gray-200">{{ Health.masalah }}</span></li>
                <li><strong>Dalam kondisi sehat:</strong> <span class="font-medium text-gray-800 dark:text-gray-200">{{
                    Health.kondisi }}</span></li>
            </ul>
        </div>
    </div>

    <FormKit type="select" :model-value="props.Head" @input="emit('update:Head', $event)" label="SPV/Dept Head/Leader"
        placeholder="Pilih" validation="required"
        :options="['Irlang Haristo', 'Sariyanto', 'Edy Saputra', 'Efrem Togu Adi Suryo', 'Stephen Boenardi', 'Aprio Nugroho', 'Waston', 'Dani Rogusty', 'Lainnya']" />

    <h3 class="text-xl font-semibold text-gray-700 mb-4 dark:text-gray-300">Tanda Tangan Driver</h3>
    <VueSignaturePad height="150px" :scaleToDevicePixelRatio="true" class="bg-white" ref="signaturePad" :options="{
        onBegin: () => { $refs.signaturePad.resizeCanvas() },
        onEnd: () => { const RawTTD = $refs.signaturePad.saveSignature(); ConvertTtdToImage(RawTTD) },
    }" />
    <button type="button"
        class="bg-transparent hover:bg-yellow-500 text-yellow-700 mr-3 font-semibold hover:text-white py-2 px-4 border border-yellow-500 hover:border-transparent rounded my-5"
        @click="$refs.signaturePad.undoSignature()">Undo</button>
    <button type="button"
        class="bg-transparent hover:bg-yellow-500 text-yellow-700 font-semibold hover:text-white py-2 px-4 border border-yellow-500 hover:border-transparent rounded my-5"
        @click="$refs.signaturePad.clearSignature()">Clear</button>

</template>
