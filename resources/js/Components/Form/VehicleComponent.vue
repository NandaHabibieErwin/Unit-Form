<script setup>
import { defineProps, defineEmits } from 'vue';

const props = defineProps({
  Ban_Velg_Baut: String,
  Oli_Mesin: String,
  Air_Radiator: String,
  APAR: String,
  Sabuk_Pengaman: String,
  Spion: String,
  Klakson_Alarm: String,
  Kontrol_Panel: String,
  Brake_System: String,
  Steering_System: String,
  Lampu: String,
  Battery: String,
  Air_Conditioner: String,
  Wiper: String,
  V_Belt: String,
  Kaca: String,
Buggy_Whip: String,
Radio_Komunikasi: String,
Sistem_4wd: String,
});


const emit = defineEmits([
  'update:Ban_Velg_Baut',
  'update:Oli_Mesin',
  'update:Air_Radiator',
  'update:APAR',
  'update:Sabuk_Pengaman',
  'update:Spion',
  'update:Klakson_Alarm',
  'update:Kontrol_Panel',
  'update:Brake_System',
  'update:Steering_System',
  'update:Lampu',
  'update:Battery',
  'update:Air_Conditioner',
  'update:Wiper',
  'update:V_Belt',
  'update:Kaca',
  'update:Buggy_Whip',
  'update:Radio_Komunikasi',
  'update:Sistem_4wd',
]);
</script>

<template>
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 p-4">
    <!-- Ban, Velg, Baut -->
    <div class="border p-4 rounded shadow">
        <span class="badge text-xs bg-yellow-400 text-black font-semibold py-1 px-2 rounded">A</span>
      <FormKit
        type="radio"
        label="Ban, Velg, Baut"
        validation="required"
        :options="['Baik', 'Buruk', 'NA']"
        name="Ban_Velg_Baut"
        :model-value="props.Ban_Velg_Baut"
        @input="emit('update:Ban_Velg_Baut', $event)"
      />
    </div>
    <!-- Oli Mesin -->
    <div class="border p-4 rounded shadow">
        <span class="badge text-xs bg-yellow-400 text-black font-semibold py-1 px-2 rounded">AA</span>
      <FormKit
        type="radio"
        label="Oli Mesin"
        validation="required"
        :options="['Baik', 'Buruk', 'NA']"
        name="Oli_Mesin"
        :model-value="props.Oli_Mesin"
        @input="emit('update:Oli_Mesin', $event)"
      />
    </div>
    <!-- Air Radiator -->
    <div class="border p-4 rounded shadow">
        <span class="badge text-xs bg-yellow-400 text-black font-semibold py-1 px-2 rounded">A</span>
      <FormKit
        type="radio"
        label="Air Radiator"
        validation="required"
        :options="['Baik', 'Buruk', 'NA']"
        name="Air_Radiator"
        :model-value="props.Air_Radiator"
        @input="emit('update:Air_Radiator', $event)"
      />
    </div>
    <!-- APAR -->
    <div class="border p-4 rounded shadow">
        <span class="badge text-xs bg-yellow-400 text-black font-semibold py-1 px-2 rounded">A</span>
      <FormKit
        type="radio"
        label="APAR"
        validation="required"
        :options="['Baik', 'Buruk', 'NA']"
        name="APAR"
        :model-value="props.APAR"
        @input="emit('update:APAR', $event)"
      />
    </div>
    <!-- Sabuk Pengaman -->
    <div class="border p-4 rounded shadow">
        <span class="badge text-xs bg-yellow-400 text-black font-semibold py-1 px-2 rounded">A</span>
      <FormKit
        type="radio"
        label="Sabuk Pengaman"
        validation="required"
        :options="['Baik', 'Buruk', 'NA']"
        name="Sabuk_Pengaman"
        :model-value="props.Sabuk_Pengaman"
        @input="emit('update:Sabuk_Pengaman', $event)"
      />
    </div>
    <!-- Spion -->
    <div class="border p-4 rounded shadow">
        <span class="badge text-xs bg-yellow-400 text-black font-semibold py-1 px-2 rounded">A</span>
      <FormKit
        type="radio"
        label="Spion"
        validation="required"
        :options="['Baik', 'Buruk', 'NA']"
        name="Spion"
        :model-value="props.Spion"
        @input="emit('update:Spion', $event)"
      />
    </div>
    <!-- Klakson & Alarm -->
    <div class="border p-4 rounded shadow">
        <span class="badge text-xs bg-yellow-400 text-black font-semibold py-1 px-2 rounded">A</span>
      <FormKit
        type="radio"
        label="Klakson & Alarm"
        validation="required"
        :options="['Baik', 'Buruk', 'NA']"
        name="Klakson_Alarm"
        :model-value="props.Klakson_Alarm"
        @input="emit('update:Klakson_Alarm', $event)"
      />
    </div>
    <!-- Kontrol & Panel -->
    <div class="border p-4 rounded shadow">
        <span class="badge text-xs bg-yellow-400 text-black font-semibold py-1 px-2 rounded">AA</span>
      <FormKit
        type="radio"
        label="Kontrol & Panel"
        validation="required"
        :options="['Baik', 'Buruk', 'NA']"
        name="Kontrol_Panel"
        :model-value="props.Kontrol_Panel"
        @input="emit('update:Kontrol_Panel', $event)"
      />
    </div>
    <!-- Brake System -->
    <div class="border p-4 rounded shadow">
        <span class="badge text-xs bg-yellow-400 text-black font-semibold py-1 px-2 rounded">AA</span>
      <FormKit
        type="radio"
        label="Brake System"
        validation="required"
        :options="['Baik', 'Buruk', 'NA']"
        name="Brake_System"
        :model-value="props.Brake_System"
        @input="emit('update:Brake_System', $event)"
      />
    </div>
    <!-- Steering System -->
    <div class="border p-4 rounded shadow">
        <span class="badge text-xs bg-yellow-400 text-black font-semibold py-1 px-2 rounded">AA</span>
      <FormKit
        type="radio"
        label="Steering System"
        validation="required"
        :options="['Baik', 'Buruk', 'NA']"
        name="Steering_System"
        :model-value="props.Steering_System"
        @input="emit('update:Steering_System', $event)"
      />
    </div>
    <!-- Lampu -->
    <div class="border p-4 rounded shadow">
        <span class="badge text-xs bg-yellow-400 text-black font-semibold py-1 px-2 rounded">A</span>
      <FormKit
        type="radio"
        label="Lampu"
        validation="required"
        :options="['Baik', 'Buruk', 'NA']"
        name="Lampu"
        :model-value="props.Lampu"
        @input="emit('update:Lampu', $event)"
      />
    </div>
    <!-- Battery -->
    <div class="border p-4 rounded shadow">
        <span class="badge text-xs bg-yellow-400 text-black font-semibold py-1 px-2 rounded">A</span>
      <FormKit
        type="radio"
        label="Battery"
        validation="required"
        :options="['Baik', 'Buruk', 'NA']"
        name="Battery"
        :model-value="props.Battery"
        @input="emit('update:Battery', $event)"
      />
    </div>

    <!-- MORE FUCKING SHIT HOLY FUCKING FUCK, YES I COULD SIMPLIFY THIS WITH LOOPING AND COMPONENT BUT I DONT GIVE A SHIT AT THIS POINT FUCK YOU -->
    <div class="border p-4 rounded shadow">
        <span class="badge text-xs bg-yellow-400 text-black font-semibold py-1 px-2 rounded">A</span>
      <FormKit
        type="radio"
        label="Air Conditioner (AC)"
        validation="required"
        :options="['Baik', 'Buruk', 'NA']"
        name="Air_Conditioner"
        :model-value="props.Air_Conditioner"
        @input="emit('update:Air_Conditioner', $event)"
      />
    </div>
    <div class="border p-4 rounded shadow">
        <span class="badge text-xs bg-yellow-400 text-black font-semibold py-1 px-2 rounded">A</span>
      <FormKit
        type="radio"
        label="Wiper"
        validation="required"
        :options="['Baik', 'Buruk', 'NA']"
        name="Wiper"
        :model-value="props.Wiper"
        @input="emit('update:Wiper', $event)"
      />
    </div>
    <div class="border p-4 rounded shadow">
        <span class="badge text-xs bg-yellow-400 text-black font-semibold py-1 px-2 rounded">A</span>
      <FormKit
        type="radio"
        label="V-Belt"
        validation="required"
        :options="['Baik', 'Buruk', 'NA']"
        name="V_Belt"
        :model-value="props.V_Belt"
        @input="emit('update:V_Belt', $event)"
      />
    </div>
    <div class="border p-4 rounded shadow">
        <span class="badge text-xs bg-yellow-400 text-black font-semibold py-1 px-2 rounded">A</span>
      <FormKit
        type="radio"
        label="Kaca Depan, Samping & Belakang"
        validation="required"
        :options="['Baik', 'Buruk', 'NA']"
        name="Kaca"
        :model-value="props.Kaca"
        @input="emit('update:Kaca', $event)"
      />
    </div>
    <div class="border p-4 rounded shadow">
        <span class="badge text-xs bg-yellow-400 text-black font-semibold py-1 px-2 rounded">A</span>
      <FormKit
        type="radio"
        label="Buggy Whip 4M"
        validation="required"
        :options="['Baik', 'Buruk', 'NA']"
        name="Buggy_Whip"
        :model-value="props.Buggy_Whip"
        @input="emit('update:Buggy_Whip', $event)"
      />
    </div>
    <div class="border p-4 rounded shadow">
        <span class="badge text-xs bg-yellow-400 text-black font-semibold py-1 px-2 rounded">A</span>
      <FormKit
        type="radio"
        label="Radio Komunikasi"
        validation="required"
        :options="['Baik', 'Buruk', 'NA']"
        name="Radio_Komunikasi"
        :model-value="props.Radio_Komunikasi"
        @input="emit('update:Radio_Komunikasi', $event)"
      />
    </div>
    <div class="border p-4 rounded shadow">
        <span class="badge text-xs bg-yellow-400 text-black font-semibold py-1 px-2 rounded">A</span>
      <FormKit
        type="radio"
        label="Sistem 4WD"
        validation="required"
        :options="['Baik', 'Buruk', 'NA']"
        name="Sistem_4wd"
        :model-value="props.Sistem_4wd"
        @input="emit('update:Sistem_4wd', $event)"
      />
    </div>

  </div>
</template>
