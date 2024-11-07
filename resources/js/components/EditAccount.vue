<template>
    <div>
      <h2>Editar Cuenta</h2>
      <form @submit.prevent="submitEditAccount">
        <input type="hidden" v-model="account.id">
        <div>
          <label for="account-description">Descripción:</label>
          <input type="text" v-model="account.description">
        </div>
        <div>
          <label for="account-type">Tipo de Cuenta:</label>
          <select v-model="account.type_account">
            <option value="A">Activo</option>
            <option value="P">Pasivo</option>
            <option value="K">Capital</option>
            <option value="I">Ingreso</option>
            <option value="G">Gasto</option>
          </select>
        </div>
        <!-- Agrega otros campos aquí -->
        <button type="submit">Guardar</button>
      </form>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        account: {}
      };
    },
    methods: {
      async submitEditAccount() {
        try {
          const response = await fetch(`/api/accounts/${this.account.id}`, {
            method: 'PUT',
            headers: {
              'Content-Type': 'application/json',
            },
            body: JSON.stringify(this.account),
          });
          if (response.ok) {
            this.$router.push({ name: 'accounts.index' });
          } else {
            alert('Error al actualizar la cuenta');
          }
        } catch (error) {
          console.error('Error al actualizar la cuenta:', error);
        }
      },
      async loadAccount() {
        const response = await fetch(`/api/accounts/${this.$route.params.id}`);
        this.account = await response.json();
      }
    },
    mounted() {
      this.loadAccount();
    }
  };
  </script>
  