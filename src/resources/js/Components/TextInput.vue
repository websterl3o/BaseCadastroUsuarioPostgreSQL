<script setup lang="ts">
import { onMounted, ref, watch, defineProps } from 'vue';

const props = defineProps({
    modelValue: String,
    minlength: Number,
    maxlength: Number,
});

const emit = defineEmits(['update:modelValue', 'update:errors']);

const model = ref(props.modelValue);

const input = ref<HTMLInputElement | null>(null);
const errors = ref<{ [key: string]: string }>({});

onMounted(() => {
    if (input.value?.hasAttribute('autofocus')) {
        input.value?.focus();
    }
});

watch(model, (newValue) => {
    if (props.minlength !== undefined && newValue.length < props.minlength) {
        errors.value.name = `O campo deve ter no mínimo ${props.minlength} caracteres.`;
    } else if (props.maxlength !== undefined && newValue.length > props.maxlength) {
        errors.value.name = `O campo deve ter no máximo ${props.maxlength} caracteres.`;
    } else {
        delete errors.value.name;
    }
    emit('update:errors', errors.value);
});

defineExpose({ focus: () => input.value?.focus(), errors });

watch(() => props.modelValue, (newValue) => {
    model.value = newValue;
});

watch(model, (newValue) => {
    emit('update:modelValue', newValue);
});
</script>

<template>
    <input
        class="border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-indigo-600 dark:focus:ring-indigo-600"
        v-model="model"
        ref="input"
        :minlength="props.minlength"
        :maxlength="props.maxlength"
    />
</template>
