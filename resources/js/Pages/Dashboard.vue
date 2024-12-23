<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import FormMain from '@/Components/Form/Main.vue';
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>


        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800"
                >
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class=" flex items-center justify-center">
                    <FormMain></FormMain></div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
