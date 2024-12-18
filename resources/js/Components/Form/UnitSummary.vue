<script setup>
import {defineProps, defineEmits } from 'vue'
const props = defineProps({
  Head: String,
})
const emit = defineEmits(['update:Nama', 'update:Tanggal', 'update:NoUnit', 'update:KM', 'update:KMService'])

</script>
<template>
    <FormKit
    type="select"
    :model-value="props.Head"
    @input="emit('update:Head', $event)"
    label="SPV/Dept Head/Leader"
    placeholder="Pilih"
    validation="required"
    :options="['Irlang Haristo', 'Sugeng Wahyudi']"
  />
  </template>
