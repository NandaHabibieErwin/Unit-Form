<script setup>
import { defineProps, defineEmits } from 'vue';

// Define props for individual data fields
const props = defineProps({
    istirahat: String,
    obat: String,
    masalah: String,
    kondisi: String,
});

// Define emits for updates
const emit = defineEmits([
    'update:istirahat',
    'update:obat',
    'update:masalah',
    'update:kondisi',
]);
</script>

<template>
    <FormKit type="radio" label="Telah beristirahat sebelum awal shift selama" validation="required"
        :options="['Lebih dari 6 jam (Standar bugar selamat)', '4-6 jam (Wajib konseling dengan pengawas/user)', 'Kurang dari 6 jam (Tidak diperbolehkan mengemudi)']"
        name="istirahat" :model-value="props.istirahat" @input="emit('update:istirahat', $event)" />
    <FormKit type="radio"
        label="Tidak mengonsumsi obat-obatan yang dapat menyebabkan ngantuk dalam periode 8 jam sebelum mengemudi"
        validation="required" :options="['Tidak', 'Iya']" name="obat" :model-value="props.obat"
        @input="emit('update:obat', $event)" />
    <FormKit type="radio"
        label="Tidak memiliki masalah pribadi atau keluarga yang dapat memengaruhi konsentrasi saya dalam mengemudi"
        validation="required" :options="['Tidak', 'Iya']" name="masalah" :model-value="props.masalah"
        @input="emit('update:masalah', $event)" />
    <FormKit type="radio" label="Dalam Kondisi sehat dan fit untuk mengemudi" validation="required" :options="['Iya', 'Tidak']"
        name="kondisi" :model-value="props.kondisi" @input="emit('update:kondisi', $event)" />
</template>
