<template>
    <div class="sidebar">
      <ul>
        <li><a href="/">Inicio</a></li>
        <li><a href="/">Catalogo de Cuentas</a></li>
        <li><a href="/daily-register">Libro Diario</a></li>
        <li><a href="/ledger">Libro Mayor</a></li>
        
        <!-- Estados Financieros con submenú -->
        <li @click="toggleFinancials" class="submenu-title">
          <a href="javascript:void(0)">Estados Financieros</a>
          <ul v-if="showFinancials" class="submenu">
            <li><a href="/balance_comprobation-sheet">Balanza de Comprobacion</a></li>
            <li><a href="/income-statement">Estado de Resultados</a></li>
            <li><a href="/balance-sheet">Balance General</a></li>
          </ul>
        </li>
  
      </ul>
    </div>
  </template>
  
  <script>
  export default {
    name: "Sidebar",
    data() {
      return {
        showFinancials: false, // Controla la visibilidad del submenú
      };
    },
    methods: {
      toggleFinancials() {
        this.showFinancials = !this.showFinancials; // Cambia el estado del submenú
      },
    },
  };
  </script>
  
  <style scoped>
  .sidebar {
    width: 250px;
    height: 100vh;
    background-color: #343a40;
    position: fixed;
    left: 0;
    top: 0;
    color: white;
    padding: 20px;
  }
  
  .sidebar ul {
    list-style-type: none;
    padding: 0;
  }
  
  .sidebar ul li {
    margin: 20px 0;
  }
  
  .sidebar ul li a {
    color: white;
    text-decoration: none;
  }
  
  .sidebar ul li a:hover {
    text-decoration: underline;
  }
  
  /* Submenú estilos */
  .submenu {
    margin-left: 20px;
  }
  
  .submenu li {
    margin: 10px 0;
  }
  
  /* Estilo opcional para el título del submenú */
  .submenu-title {
    cursor: pointer;
  }
  </style>
  