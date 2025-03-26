<template>
    <div class="card-box">
        <div class="card-box-content">
            <h1>{{ title }}</h1>
            <slot></slot>
        </div>
    </div>
</template>

<script lang="ts">
    import { defineComponent } from 'vue';

    export default defineComponent({
        name: "CardBox",
        props: {
            title: {
                type: String,
                required: true
            }
        }
    });
</script>
