<template>
    <div class="form-group">
        <label :for="id">{{ label }}:</label>
        <input
            :id="id"
            :type="type"
            :value="modelValue"
            @input="$emit('update:modelValue', ($event.target as HTMLInputElement).value)"
            class="form-control"
            v-bind="$attrs"
        />
    </div>
</template>

<script setup lang="ts">
defineProps<{
    label: string;
    modelValue: string;
    type?: string;
    id?: string;
}>();
</script>
