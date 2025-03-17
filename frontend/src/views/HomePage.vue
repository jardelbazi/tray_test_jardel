<template>
  <div>
    <h1>Bem-vindo ao Aplicativo</h1>
    <button @click="loginWithGoogle">Login com Google</button>
  </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue';
import axios from 'axios';

export default defineComponent({
  name: 'HomePage',
  methods: {
    async loginWithGoogle() {
      try {
        const response = await axios.get('http://localhost:8000/api/auth/google');
        
        if (response.data.auth_url) {
          window.location.href = response.data.auth_url;
        } else {
          console.error('Resposta inválida da API:', response.data);
        }
      } catch (error) {
        console.error('Erro ao fazer login com Google:', error);
      }
    },
  },
});
</script>
