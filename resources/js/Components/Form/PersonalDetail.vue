<script setup>
import {defineProps, defineEmits } from 'vue'
const props = defineProps({
  Nama: String,
  Tanggal: String,
  NoUnit: String,
  KM: String,
  KMService: String
})
const emit = defineEmits(['update:Nama', 'update:Tanggal', 'update:NoUnit', 'update:KM', 'update:KMService'])

</script>
<template>
    <FormKit
      type="text"
      label="Nama"
      :model-value="props.Nama"
    @input="emit('update:Nama', $event)"
      prefix-icon="avatarMan"
      validation="required"
    />
    <FormKit
      type="date"
      label="Tanggal"
      :model-value="props.Tanggal"
    @input="emit('update:Tanggal', $event)"
      prefix-icon="date"
      validation="required|date"
    />
    <FormKit
      type="text"
      name="Nomor Unit"
      :model-value="props.NoUnit"
    @input="emit('update:NoUnit', $event)"
      mask="F - 135"
      label="Nomor Unit"
      prefix-icon="da"
      validation="required"
    />
    <FormKit
    type="number"
    name="Kilometer"
    :model-value="props.KM"
    @input="emit('update:KM', $event)"
    mask="25 KM"
    label="Kilometer"
    prefix-icon="da"
    validation="required"
  />
  <FormKit
  type="number"
  name="Kilometer Service"
  :model-value="props.KMService"
    @input="emit('update:KMService', $event)"
  mask="25 KM"
  label="Kilometer Service"
  prefix-icon="da"
  help="Boleh dikosongkan"
/>
  </template>

  <style>
</style>
