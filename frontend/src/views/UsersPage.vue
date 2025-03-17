<template>
  <div>
    <h1>Lista de Usuários</h1>
    <table>
      <thead>
        <tr>
          <th>Nome</th>
          <th>CPF</th>
          <th>Email</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="user in users" :key="user.google_id">
          <td>{{ user.name }}</td>
          <td>{{ user.cpf }}</td>
          <td>{{ user.email }}</td>
          <td>
            <button @click="editUser(user.google_id)">✏️ Editar</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script lang="ts">
import { defineComponent, onMounted, ref } from 'vue';
import axios from 'axios';

interface User {
  google_id: string;
  name: string;
  cpf: string;
  email: string;
}

export default defineComponent({
  name: 'Users',
  setup() {
    const users = ref<User[]>([]);

    const fetchUsers = async () => {
      try {
        const response = await axios.get('http://localhost:8000/api/users');
        users.value = response.data.users.data;
      } catch (error) {
        console.error('Erro ao carregar usuários:', error);
      }
    };

    const editUser = (googleId: string) => {
      window.location.href = `http://localhost:8000/api/user/update/${googleId}`;
    };

    onMounted(fetchUsers);

    return { users, editUser };
  },
});
</script>
