<template>
    <div class="profile-content">
        <CardBox title="Editar Perfil">
        <form @submit.prevent="saveUser">
            <BaseInput v-model="form.name" label="Nome" type="text" id="name" />
            <BaseInput v-model="form.email" label="E-mail" type="email" id="email" />
            <BaseInput v-model="form.birthDate" label="Data de Nascimento" type="date" id="birth_date" />
            <BaseInput 
                v-model="form.cpf" 
                label="CPF" 
                type="text" 
                id="cpf" 
                @input="form.cpf = formatCPF(form.cpf)"
            />

            <button type="submit" class="btn">Salvar</button>
        </form>
    </CardBox>
    </div>
</template>

<script setup lang="ts">
import { useRoute } from "vue-router";
import { useUser } from "@/composables/useUser";
import { formatCPF } from "@/utils/formatCPF";
import BaseInput from "@/components/FormInput.vue";
import CardBox from "@/components/CardBox.vue";

const route = useRoute();
const googleId = route.params.googleId as string;
const { form, saveUser } = useUser(googleId);
</script>