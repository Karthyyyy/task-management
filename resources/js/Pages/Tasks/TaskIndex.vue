<template>
    <AppLayout title="Tasks">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Tasks
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 flex flex-wrap gap-6 text-white p-6 overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="w-full flex justify-end items-center">
                        <Link class="dark:bg-gray-900 sm:rounded-lg px-4 py-2"
                            :href="route('tasks.create')"
                        >
                            Create New
                        </Link>
                    </div>
                    
                    <div v-for="(task) in tasks.value" class="dark:bg-gray-900 p-3 w-full sm:rounded-lg">
                        <div class="flex justify-between items-center">
                            <div class="text-2xl">{{ task.title }}</div>
                            <div class="flex gap-3">
                                <div class="sm:rounded-lg dark:bg-gray-800 px-4 py-2">
                                    {{ task.status }}
                                </div>
                                <div class="sm:rounded-lg dark:bg-gray-800 px-4 py-2">
                                    Due: {{ task.due_date }}
                                </div>
                                <Link :href="route('tasks.edit', { id: task.id })" class="sm:rounded-lg dark:bg-blue-900 px-4 py-2">
                                    Edit
                                </Link>
                                <button type="button"
                                    class="sm:rounded-lg dark:bg-red-900 px-4 py-2"
                                    @click="deleteTask(task.id)">
                                    Delete
                                </button>
                            </div>
                        </div>
                        <hr class="h-px bg-gray-200 border-0 dark:bg-gray-500 my-3">
                        <div>{{ task.description }}</div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { onMounted, reactive } from 'vue';
import { Link } from '@inertiajs/vue3';
import axios from 'axios';

const tasks = reactive({});

const getTasks = () => {
    axios.get('/api/v1/tasks')
        .then((response) => {
            console.log(response);
            tasks.value = response.data.data;
        }).catch(error => {
            console.error(error);
        })
}

const deleteTask = (taskId) => {
    axios.create({
        withCredentials: true
    }).delete('api/v1/tasks/' + taskId)
    .then(() => {
        getTasks();
    }).catch(error => {
        console.error(error);
    })
}

onMounted(() => {
    getTasks();
});
</script>


