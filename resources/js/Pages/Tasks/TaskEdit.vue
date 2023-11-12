<template>
    <AppLayout title="Task Edit">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Task Edit
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 flex flex-wrap gap-6 text-white p-6 overflow-hidden shadow-xl sm:rounded-lg">
                    <TaskForm v-if="tasks.value" :task="tasks.value"></TaskForm>
                    <div v-else class="text-center w-full p-10">Loading...</div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import TaskForm from '@/Components/TaskForm.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import axios from 'axios';
import { onMounted, reactive } from 'vue';

const props = defineProps({
    id: String
});

const tasks = reactive({
    title: null,
    description: null,
    due_date: null,
    status: null,
    files: null
});

const getTask = () => {
    axios.create({
        withCredentials: true
    }).get('/api/v1/tasks/' + props.id)
    .then((response) => {
        tasks.value = response.data.data;
    }).catch(error => {
        console.error(error);
    })
}

onMounted(() => {
    getTask();
})
</script>


