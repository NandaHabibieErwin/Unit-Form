<script setup>
import {defineProps, defineEmits } from 'vue'
const props = defineProps({
  FotoKiri: File,
  FotoKanan: File,
  Keterangan: String,
})
const emit = defineEmits(['update:FotoKiri', 'update:FotoKanan', 'update:Keterangan'])

</script>

<template>
    <FormKit
  type="file"
  label="Tampak Kiri"
  accept=".png,.jpg,.jpeg,"
  :model-value="props.FotoKiri"
    @input="emit('update:FotoKiri', $event)"
  help="Foto bagian kiri mobil."
  multiple="false"
  validation="required"
/>
    <FormKit
  type="file"
  label="Tampak Kanan"
  accept=".png,.jpg,.jpeg,"
  :model-value="props.FotoKanan"
    @input="emit('update:FotoKanan', $event)"
  help="Foto bagian kanan mobil."
  multiple="false"
  validation="required"
/>

<FormKit
      type="text"
      label="Keterangan"
      :model-value="props.Keterangan"
    @input="emit('update:Keterangan', $event)"
      prefix-icon="avatarMan"
      validation="required"
    />

</template>
