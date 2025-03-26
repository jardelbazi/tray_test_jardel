import { ref, onMounted } from "vue";
import axios from "axios";
import { config } from "@/config";
import type { User } from "@/types/User";

export function useUser(googleId: string) {
    const form = ref<User>({
        name: "",
        email: "",
        birthDate: "",
        cpf: "",
    });

    const fetchUserData = async () => {
        try {
            const { data } = await axios.get<User>(`${config.apiUrl}/user/${googleId}`);
            form.value = data;
        } catch (error) {
            console.error("Erro ao buscar usuário:", error);
        }
    };

    const saveUser = async () => {
        try {
            const userData = { ...form.value };

            console.log("Enviando para API:", JSON.stringify(userData));

            await axios.put(`${config.apiUrl}/user/update/${googleId}`, userData);
            alert("Dados salvos com sucesso!");
        } catch (error) {
            console.error("Erro ao salvar:", error);
        }
    };

    onMounted(fetchUserData);

    return { form, saveUser };
}
