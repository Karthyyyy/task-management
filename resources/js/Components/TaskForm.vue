<template>
    <form class="w-full flex flex-col gap-4">
        <div class="col-span-6 sm:col-span-4">
            <InputLabel for="title" value="Title" />
            <TextInput
                id="title"
                v-model="form.title"
                type="text"
                class="mt-1 block w-full"
                required
            />
            <InputError :message="form.errors.title" class="mt-2" />
        </div>
        <div class="col-span-6 sm:col-span-4">
            <InputLabel for="description" value="Description" />
            <TextInput
                id="description"
                v-model="form.description"
                type="text"
                class="mt-1 block w-full"
                required
            />
            <InputError :message="form.errors.description" class="mt-2" />
        </div>
        <div class="col-span-6 sm:col-span-4">
            <InputLabel for="due_date" value="Due Date" />
            <TextInput
                id="due_date"
                v-model="form.due_date"
                type="date"
                class="mt-1 block w-full"
                required
            />
            <InputError :message="form.errors.due_date" class="mt-2" />
        </div>
        <div class="col-span-6 sm:col-span-4">
            <InputLabel for="status" value="Status" />
            <InputSelect
                id="status"
                v-model="form.status"
                :options="['pending', 'completed']"
                class="mt-1 block w-full"
                required
            />
            <InputError :message="form.errors.status" class="mt-2" />
        </div>

        <div class="flex items-center justify-end">
            <ActionMessage :on="form.recentlySuccessful" class="me-3">
                Saved.
            </ActionMessage>

            <PrimaryButton @click="submitForm" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Save
            </PrimaryButton>
        </div>
    </form>
</template>

<script setup>
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import TextInput from '@/Components/TextInput.vue';
import ActionMessage from './ActionMessage.vue';
import PrimaryButton from './PrimaryButton.vue';
import { onMounted, reactive } from 'vue';
import { useForm } from '@inertiajs/vue3';
import InputSelect from './InputSelect.vue';

const props = defineProps({
    task: Object
});

const form = useForm({
    _method: 'POST',
    id: props.task?.id ?? null,
    user_id: props.task?.id ?? null,
    title: props.task?.title ?? null,
    description: props.task?.description ?? null,
    due_date: props.task?.due_date ?? null,
    status: props.task?.status ?? null,
    files: ''
})

const submitForm = () => {
    form.post('/api/v1/tasks');
}
</script>


