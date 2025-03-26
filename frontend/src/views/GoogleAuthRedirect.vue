<template>
    <CardBox title="Autenticando">
        <div class="auth-content">
            <div class="loading-spinner"></div>
        </div>
    </CardBox>
</template>

<script setup lang="ts">
    import { useRoute, useRouter } from 'vue-router';
    import { onMounted } from 'vue';
    import { config } from "@/config";
    import CardBox from "@/components/CardBox.vue";

    const route = useRoute();
    const router = useRouter();

    const fetchUserData = async (code: string) => {
        try {
            const response = await fetch(`${config.apiUrl}/auth/callback?code=${code}`);
            const data = await response.json();

            if (data.user.googleToken) {
                const googleId = data.user.googleId
                localStorage.setItem('token', data.token);
                router.push(`/user/${googleId}`);
            } else {
                localStorage.setItem('errorMessage', 'Erro ao autenticar.');
                router.push('/');
            }
        } catch (error) {
            localStorage.setItem('errorMessage', 'Erro ao conectar com a API');
            router.push('/');
        }
    };

    onMounted(() => {
        const code = route.query.code as string | undefined;
        if (code) {
            fetchUserData(code);
        } else {
            localStorage.setItem('errorMessage', 'Código de autenticação não encontrado.');
            router.push('/');
        }
    });
</script>
