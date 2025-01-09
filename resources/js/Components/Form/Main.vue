    <template>

        <div class="">
            <FormKit type="form" :actions="false" @submit="handleSubmit">
                <FormKit type="multi-step" tab-style="tab">
                    <FormKit type="step" name="Personal Detail">
                        <!-- component for example brevity. -->
                        <PersonalDetail v-model:Nama="Nama" v-model:Tanggal="Tanggal" v-model:NoUnit="NoUnit"
                            v-model:KM="KM" v-model:KMService="KMService" />

                    </FormKit>

                    <FormKit type="step" name="Vehicle">
                        <!-- component for example brevity. -->
                        <VehicleComponent v-model:Ban_Velg_Baut="Vehicle.Ban_Velg_Baut"
                            v-model:Oli_Mesin="Vehicle.Oli_Mesin" v-model:Air_Radiator="Vehicle.Air_Radiator"
                            v-model:APAR="Vehicle.APAR" v-model:Sabuk_Pengaman="Vehicle.Sabuk_Pengaman"
                            v-model:Spion="Vehicle.Spion" v-model:Klakson_Alarm="Vehicle.Klakson_Alarm"
                            v-model:Kontrol_Panel="Vehicle.Kontrol_Panel" v-model:Brake_System="Vehicle.Brake_System"
                            v-model:Steering_System="Vehicle.Steering_System" v-model:Lampu="Vehicle.Lampu"
                            v-model:Battery="Vehicle.Battery" v-model:Air_Conditioner="Vehicle.Air_Conditioner"
                            v-model:Wiper="Vehicle.Wiper" v-model:V_Belt="Vehicle.V_Belt" v-model:Buggy_Whip="Vehicle.Buggy_Whip" v-model:Kaca="Vehicle.Kaca"
                            v-model:Radio_Komunikasi="Vehicle.Radio_Komunikasi"
                            v-model:Sistem_4wd="Vehicle.Sistem_4wd" />
                    </FormKit>

                    <FormKit type="step" name="Health Check">
                        <!-- component for example brevity. -->
                        <DriverHealth v-model:istirahat="Health.istirahat" v-model:obat="Health.obat"
                            v-model:masalah="Health.masalah" v-model:kondisi="Health.kondisi" />
                    </FormKit>


                    <FormKit type="step" name="Photo of Vehicle & Information">
                        <!-- component for example brevity. -->
                        <Photo v-model:FotoKiri="FotoKiri" v-model:FotoKanan="FotoKanan"
                            v-model:Keterangan="Keterangan" />
                    </FormKit>

                    <FormKit type="step" name="Summary">
                        <!-- component for example brevity. -->
                        <UnitSummary v-model:Head="Head" v-model:Ttd="Ttd" :Nama="Nama" :Tanggal="Tanggal"
                            :NoUnit="NoUnit" :KM="KM" :KMService="KMService" :Head="Head" :Vehicle="Vehicle"
                            :Health="Health" :Kelayakan="kelayakan" :Keterangan="Keterangan" />



                        <template #stepNext>

                            <FormKit type="submit" :disabled="isLoading" />
                        </template>
                    </FormKit>
                </FormKit>
            </FormKit>
        </div>
        <div v-if="OpenModal" id="static-modal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
            class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
            <div class="relative p-4 w-full max-w-2xl max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Pastikan data yg dikirim sudah
                            benar
                        </h3>
                        <button v-on:click="OpenModal = false" type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-hide="static-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="ml-4" v-if="Custom">
                        <FormKit type="text" label="Nama" v-model="NamaSPV" placeholder="Masukkan Nama SPV" />
                        <FormKit type="text" label="Nomor Telepon" v-model="NoSPV"
                            placeholder="Masukkan Nomor Telepon" />
                    </div>
                    <div>
                    </div>
                    <!-- Modal footer -->
                    <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                        <button :disabled="isLoading" v-on:click="SubmitData" data-modal-hide="static-modal"
                            type="button"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            <span v-if="isLoading">Uploading...</span>
                            <span v-else>Send</span></button>
                        <button v-on:click="OpenModal = false" data-modal-hide="static-modal" type="button"
                            class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Cancel</button>
                    </div>
                </div>
            </div>
        </div>

    </template>

<script setup>
import { ref } from 'vue'
import PersonalDetail from '@/Components/Form/PersonalDetail.vue'
import DriverHealth from '@/Components/Form/DriverHealth.vue'
import Photo from '@/Components/Form/Photo.vue'
import UnitSummary from '@/Components/Form/UnitSummary.vue'
import VehicleComponent from '@/Components/Form/VehicleComponent.vue'
import { UploadForm } from '@/api.js';
import { computed } from 'vue'

const Custom = ref(false)
const isLoading = ref(false);
const Nama = ref('')
const Ttd = ref('');
const Tanggal = ref('')
const NoUnit = ref('')
const KM = ref('')
const KMService = ref('')
const FotoKiri = ref(null);
const FotoKanan = ref(null);
const Head = ref('')
const Keterangan = ref('');
const NamaSPV = ref('')
const NoSPV = ref('')
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
    Air_Conditioner: '',
    Wiper: '',
    V_Belt: '',
    Kaca: '',
    Buggy_Whip: '',
    Radio_Komunikasi: '',
    Sistem_4wd: '',
});
const Health = ref({
    istirahat: '',
    obat: '',
    masalah: '',
    kondisi: '',
});


const CheckKelayakan = () => {
    const { Oli_Mesin, Brake_System, Steering_System,
        Kontrol_Panel, Ban_Velg_Baut, Air_Radiator, APAR, Sabuk_Pengaman, Spion, Klakson_Alarm,
        Lampu, Battery,
        Air_Conditioner,
        Wiper,
        V_Belt,
        Kaca,
        Buggy_Whip,
        Radio_Komunikasi,
        Sistem_4wd, } = Vehicle.value;

    const { istirahat, obat, masalah, kondisi } = Health.value;
    if (Oli_Mesin === 'Buruk' || Brake_System === 'Buruk' || Steering_System === 'Buruk' || istirahat === 'Kurang dari 6 jam (Tidak diperbolehkan mengemudi)') {
        return 'Tidak Layak';
    }

    if (Ban_Velg_Baut === 'Buruk' ||
        Air_Conditioner === 'Buruk' ||
        Wiper === 'Buruk' ||
        V_Belt === 'Buruk' ||
        Kaca === 'Buruk' ||
        Buggy_Whip === 'Buruk' ||
        Radio_Komunikasi === 'Buruk' ||
        Sistem_4wd === 'Buruk' ||
        Air_Radiator === 'Buruk' || APAR === 'Buruk' || Sabuk_Pengaman === 'Buruk' || Spion === 'Buruk' ||
        Klakson_Alarm === 'Buruk' || Lampu === 'Buruk' || istirahat === '4-6 jam (Wajib konseling dengan pengawas/user)' || Battery === 'Buruk' || obat === 'Iya' || masalah === 'Iya' || kondisi === 'Tidak') {
        return 'Layak dengan catatan'
    }

    return 'Layak'
};
const kelayakan = computed(() => CheckKelayakan());

const isSubmitted = ref(false)

/*
When handling submit, it should open modal to provide link and input phone number. only then does it store into database.
Changed, the modal should provide digital signature, THEN you can submit
*/
const handleSubmit = async () => {
    try {
        Custom.value = false;
        console.log("PANTEK ", NamaSPV.value)
        console.log("Vehicle: " + JSON.stringify(Vehicle.value, null, 2));
        console.log("Health: " + JSON.stringify(Health.value, null, 2));
        if (Head.value === "Irlang Haristo") {
            Nomor_Telepon.value = "6281382831692";
            console.log(Nomor_Telepon.value);
        }
        if (Head.value === "Sariyanto") {
            Nomor_Telepon.value = "6281275897313";
            console.log(Nomor_Telepon.value);
        }
        if (Head.value === "Edy Saputra") {
            Nomor_Telepon.value = "6281357201522";
            console.log(Nomor_Telepon.value);
        }
        if (Head.value === "Efrem Togu Adi Suryo") {
            Nomor_Telepon.value = "6281280968125";
            console.log(Nomor_Telepon.value);
        }
        if (Head.value === "Stephen Boenardi") {
            Nomor_Telepon.value = "62811882269";
            console.log(Nomor_Telepon.value);
        }
        if (Head.value === "Aprio Nugroho") {
            Nomor_Telepon.value = "628117122363";
            console.log(Nomor_Telepon.value);
        }
        if (Head.value === "Waston") {
            Nomor_Telepon.value = "6282122328985";
            console.log(Nomor_Telepon.value);
        }
        if (Head.value === "Dani Rogusty") {
            Nomor_Telepon.value = "62811783471";
            console.log(Nomor_Telepon.value);
        }
        if (Head.value === "Nanda") {
            Nomor_Telepon.value = "6282385417804";
            console.log(Nomor_Telepon.value);
        }
        if (Head.value === "Lainnya") {
            Custom.value = true;
        }

        OpenModal.value = true;
        // SubmitData();
    } catch (error) {
        console.error('Error uploading form:', error);
    }
};


const SubmitData = async () => {
    isLoading.value = true;
    try {

        const body = new FormData();

        body.append('Nama', Nama.value);
        body.append('Tanggal_Data', Tanggal.value);
        body.append('Nomor_Unit', NoUnit.value);
        body.append('Kilo_Meter', KM.value);
        body.append('KiloMeter_Service', KMService.value);
        if (Head.value === "Lainnya") {
            Head.value = NamaSPV.value;
            Nomor_Telepon.value = NoSPV.value;
            console.log("CustomSPVDATA: ", NamaSPV.value, NoSPV.value);
        }

        body.append('Head', Head.value);

        body.append('layak', kelayakan.value);

        body.append('Keterangan', Keterangan.value);

        body.append('Vehicle', JSON.stringify(Vehicle.value));
        body.append('Health', JSON.stringify(Health.value));

        FotoKiri.value.forEach((item, index) => {
            body.append(`FotoKiri[${index}][name]`, item.name);
            body.append(`FotoKiri[${index}][file]`, item.file);
        });

        FotoKanan.value.forEach((item, index) => {
            body.append(`FotoKanan[${index}][name]`, item.name);
            body.append(`FotoKanan[${index}][file]`, item.file);
        });
        console.log("IsiTTD: ", Ttd.value)
        body.append('Ttd', Ttd.value);

        /*
                const formData = {
                    Nama: Nama.value,
                    Tanggal_Data: Tanggal.value,
                    Nomor_Unit: NoUnit.value,
                    Kilo_Meter: KM.value,
                    KiloMeter_Service: KMService.value,
                    Head: Head.value,
                    Vehicle: Vehicle.value,
                    Health: Health.value,
                    layak: kelayakan.value,
                    FotoKiri: FotoKiri.value.map(item => ({
                        name: item.name,
                        file: item.file
                    })),
                    FotoKanan: FotoKanan.value.map(item => ({
                        name: item.name,
                        file: item.file
                    }))
                };*/
        console.log(body.FotoKiri);
        console.log(body.FotoKanan);
        const response = await UploadForm(body);
        console.log('Form uploaded successfully:', response);
        console.log('Form ID:', response.upload.id);
        OpenModal.value = false;
        isSubmitted.value = true;
        const id = response.upload.id;

        const ChangeFormat = (number) => {
            number = String(number);
            if (number.startsWith('0')) {
                return '62' + number.slice(1);
            }
            return number;
        }



        const Response = `Saya sudah mengisi form disini dengan
            \nNama:${Nama.value}
            \nTanggal:${Tanggal.value}
            \nNomor Unit:${NoUnit.value}
            \nKelayakan:${kelayakan.value}
            \nhttps://p2hpkb.site/report/view/` + id;
        const EncodedResponse = encodeURIComponent(Response);
        const link = `https://api.whatsapp.com/send?phone=${ChangeFormat(Nomor_Telepon.value)}&text=${EncodedResponse}`;
        /*Disable during debug*/
        window.open(link);
    } catch (error) {
        console.error('Error uploading form:', error);
    } finally {
        isLoading.value = false;
    }
}

</script>
