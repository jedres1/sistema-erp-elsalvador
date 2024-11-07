import { createApp } from 'vue';
import ExampleComponent from './components/ExampleComponent.vue';
import Sidebar from './components/Sidebar.vue';

const app = createApp({});

// Registrar el componente
app.component('example-component', ExampleComponent);
app.component('sidebar-component', Sidebar);
// Montar la aplicación en el elemento con id 'app'
app.mount('#app');

