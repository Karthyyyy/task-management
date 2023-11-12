<template>
    <AppLayout title="Task Create">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Task Create
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 flex flex-wrap gap-6 text-white p-6 overflow-hidden shadow-xl sm:rounded-lg">
                    <TaskForm></TaskForm>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import TaskForm from '@/Components/TaskForm.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
</script>


