# 🏢 Sistema ERP Empresarial - El Salvador

Sistema integral de **Planificación de Recursos Empresariales (ERP)** desarrollado en Laravel para empresas comerciales en El Salvador. Incluye módulos completos de contabilidad, facturación, inventario y gestión financiera.

## 🚀 Características Principales

### 📊 **Módulo Contable**
- **Balance General** automatizado con clasificación de activos/pasivos
- **Estado de Resultados** con cálculo automático de utilidades
- **Libro Diario** para registro de asientos contables
- **Catálogo de Cuentas** simplificado (107 cuentas estándar)
- **Mayor de Cuentas** con saldos actualizados

### 🧾 **Facturación Electrónica**
- Facturación con cálculo automático de **IVA 13%**
- Gestión completa de clientes y productos
- Descuentos y totales en tiempo real
- Generación de PDF para facturas
- Integración con inventario

### 📦 **Gestión de Inventario**
- Control de stock en tiempo real
- **Kardex** de productos con movimientos
- Gestión de categorías y proveedores
- Reportes de inventario valorizado
- Alertas de stock mínimo

### 🏦 **Módulos Financieros**
- Gestión bancaria y conciliaciones
- Control de compras y cuentas por pagar
- Documentos electrónicos
- Parámetros contables configurables

### 🌎 **Base Geográfica El Salvador**
- **14 Departamentos** oficiales
- **44 Municipios** completos
- **262 Distritos** actualizados
- Integración automática en formularios

## 🛠️ Tecnologías

- **Backend**: Laravel 8.83.27
- **Frontend**: Bootstrap 5.1.3
- **Base de Datos**: SQLite/MySQL
- **JavaScript**: Vanilla JS con funciones avanzadas
- **PDF**: Laravel PDF Generator
- **Autenticación**: Laravel Auth

## ⚡ Instalación Rápida

```bash
# Clonar repositorio
git clone https://github.com/jedres1/accounts_catalog.git
cd accounts_catalog

# Instalar dependencias
composer install
npm install

# Configurar entorno
cp .env.example .env
php artisan key:generate

# Migrar y sembrar base de datos
php artisan migrate
php artisan db:seed --class=AccountCatalogSeeder

# Iniciar servidor
php artisan serve --port=8002
```

## 📋 Estructura del Catálogo de Cuentas

### 1️⃣ **ACTIVOS** (1.x.xx.xx.xx.xx.xx)
- **1.1** Activos Corrientes
  - Efectivo y equivalentes (Caja, Bancos)
  - Cuentas por cobrar (Clientes, IVA Crédito)
  - Inventarios (Mercadería, Materiales)
  - Gastos pagados por adelantado
- **1.2** Activos No Corrientes
  - Propiedad, planta y equipo
  - Depreciación acumulada

### 2️⃣ **PASIVOS** (2.x.xx.xx.xx.xx.xx)
- **2.1** Pasivos Corrientes
  - Proveedores e IVA Débito Fiscal
  - Obligaciones laborales (ISSS, AFP)
  - Préstamos a corto plazo
- **2.2** Pasivos No Corrientes

### 3️⃣ **PATRIMONIO** (3.x.xx.xx.xx.xx.xx)
- Capital social y reservas
- Utilidades retenidas y del ejercicio

### 4️⃣ **INGRESOS** (4.x.xx.xx.xx.xx.xx)
- **4.1** Operacionales (Ventas, Servicios)
- **4.2** No Operacionales (Financieros)

### 5️⃣ **COSTOS** (5.x.xx.xx.xx.xx.xx)
- Costo de mercadería vendida
- Compras y fletes

### 6️⃣ **GASTOS** (6.x.xx.xx.xx.xx.xx)
- **6.1** Administración
- **6.2** Ventas
- **6.3** Financieros
- **6.4** Otros gastos

## 🎯 Casos de Uso

✅ **Empresas Comerciales** - Compra y venta de productos  
✅ **Empresas de Servicios** - Prestación de servicios profesionales  
✅ **PYMES Salvadoreñas** - Cumplimiento fiscal local  
✅ **Contadores** - Herramienta integral de trabajo  
✅ **Estudiantes** - Aprendizaje de sistemas contables  

## 📊 Reportes Incluidos

- 📈 **Balance General** clasificado
- 📊 **Estado de Resultados** por períodos
- 📋 **Libro Diario** cronológico
- 💰 **Mayor de Cuentas** individual
- 📦 **Inventario Valorizado**
- 🧾 **Reporte de Ventas**

## 🔧 Configuración Avanzada

### Variables de Entorno Importantes
```env
APP_NAME="Sistema ERP"
DB_CONNECTION=sqlite
IVA_RATE=0.13
CURRENCY=USD
TIMEZONE=America/El_Salvador
```

### Parámetros Contables
- **IVA**: 13% (configurable)
- **Moneda**: USD (configurable)
- **Período Fiscal**: Enero-Diciembre
- **Método Inventario**: FIFO/Promedio

## 🤝 Contribuciones

¡Las contribuciones son bienvenidas! Por favor:

1. Fork el proyecto
2. Crea una rama feature (`git checkout -b feature/AmazingFeature`)
3. Commit tus cambios (`git commit -m 'Add some AmazingFeature'`)
4. Push a la rama (`git push origin feature/AmazingFeature`)
5. Abre un Pull Request

## 📝 Licencia

Este proyecto está bajo la Licencia MIT - ver el archivo [LICENSE.md](LICENSE.md) para detalles.

## 📞 Soporte

- 📧 Email: jedres1@github.com
- 🐛 Issues: [GitHub Issues](https://github.com/jedres1/accounts_catalog/issues)
- 📖 Wiki: [Documentación completa](https://github.com/jedres1/accounts_catalog/wiki)

---

**Desarrollado con ❤️ para empresas salvadoreñas**

> Sistema robusto, escalable y fácil de usar para la gestión integral de tu empresa.
