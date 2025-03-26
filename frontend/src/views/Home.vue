<template>
    <CardBox title="Bem-vindo">
        <div class="welcome-content">
            <button class="button" @click="loginWithGoogle">
                <img src="@/assets/google-icon.svg" alt="Google Icon" />
                Login com Google
            </button>
        </div>

        <p v-if="errorMessage" class="error-message">{{ errorMessage }}</p>
    </CardBox>
</template>

<script setup lang="ts">
import { ref } from 'vue';
import CardBox from "@/components/CardBox.vue"; // Importe o componente CenteredBox
import { config } from '@/config';

const errorMessage = ref<string | null>(null);

const loginWithGoogle = async () => {
    errorMessage.value = null;

    try {
        const response = await fetch(`${config.apiUrl}/auth/google`);
        const data = await response.json();

        if (data.auth_url) {
            window.location.href = data.auth_url;
        } else {
            errorMessage.value = 'Erro ao obter a URL de autenticação.';
        }
    } catch (error) {
        errorMessage.value = 'Erro ao conectar com a API.';
        console.error('Erro ao conectar com a API:', error);
    }
};
</script>
