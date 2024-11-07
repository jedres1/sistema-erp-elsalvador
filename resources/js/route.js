import { createRouter, createWebHistory } from 'vue-router';

// Importa los componentes que vas a usar en las rutas
import HomeComponent from './components/HomeComponent.vue'; // Cambia este nombre según tu componente
import ExampleComponent from './components/ExampleComponent.vue';

// Define las rutas
const routes = [
  {
    path: '/',
    name: 'home',
    component: HomeComponent, // Componente que se mostrará en la ruta "/"
  },
  {
    path: '/example',
    name: 'example',
    component: ExampleComponent,
  },
  // Puedes agregar más rutas aquí
];

// Crea el enrutador usando el historial de la web
const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
