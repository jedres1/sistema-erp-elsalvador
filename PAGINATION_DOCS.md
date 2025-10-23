# Documentación de Paginación - Catálogo de Cuentas

## 📚 Funcionalidades Implementadas

### 🌐 **Paginación Web (Navegador)**

#### Características:
- ✅ **Navegación por páginas:** Anterior/Siguiente + números de página
- ✅ **Control de elementos por página:** 10, 15, 25, 50, 100
- ✅ **Buscador integrado:** Por código o descripción
- ✅ **Información de resultados:** "Mostrando X a Y de Z cuentas"
- ✅ **Diseño responsive:** Optimizado para móviles
- ✅ **Atajos de teclado:** Ctrl+F para buscar, Escape para limpiar

#### URLs de ejemplo:
```
http://localhost:8000/accounts
http://localhost:8000/accounts?page=2
http://localhost:8000/accounts?per_page=25
http://localhost:8000/accounts?search=ACTIVO
http://localhost:8000/accounts?search=ACTIVO&per_page=10&page=1
```

### 🔧 **Paginación API (JSON)**

#### Características:
- ✅ **Respuesta JSON estructurada:** Con metadatos de paginación
- ✅ **Mismos parámetros:** `page`, `per_page`, `search`
- ✅ **Enlaces de navegación:** URLs para páginas anterior/siguiente
- ✅ **Información completa:** Total de elementos, páginas, etc.

#### URLs de ejemplo:
```
http://localhost:8000/api/accounts
http://localhost:8000/api/accounts?page=2
http://localhost:8000/api/accounts?per_page=5
http://localhost:8000/api/accounts?search=BANCO
```

#### Estructura de respuesta JSON:
```json
{
  "current_page": 1,
  "data": [...],
  "first_page_url": "http://localhost:8000/api/accounts?page=1",
  "from": 1,
  "last_page": 5,
  "last_page_url": "http://localhost:8000/api/accounts?page=5",
  "links": [...],
  "next_page_url": "http://localhost:8000/api/accounts?page=2",
  "path": "http://localhost:8000/api/accounts",
  "per_page": 15,
  "prev_page_url": null,
  "to": 15,
  "total": 75
}
```

## 🎛️ **Parámetros Disponibles**

| Parámetro | Tipo | Descripción | Valores | Ejemplo |
|-----------|------|-------------|---------|---------|
| `page` | integer | Número de página | 1, 2, 3... | `?page=2` |
| `per_page` | integer | Elementos por página | 10, 15, 25, 50, 100 | `?per_page=25` |
| `search` | string | Término de búsqueda | Cualquier texto | `?search=ACTIVO` |

## 🎨 **Características de UI/UX**

### ✨ **Diseño Mejorado:**
- Paginación con iconos Font Awesome
- Estados hover y activo
- Diseño responsive
- Colores consistentes con Bootstrap

### 🔍 **Buscador Inteligente:**
- Busca en código y descripción
- Botón de limpiar búsqueda
- Información de resultados
- Preserva parámetros de paginación

### 📱 **Responsive Design:**
- Botones más pequeños en móviles
- Texto adaptativo ("Anterior" → icono solo)
- Navegación centrada en pantallas pequeñas

## 🚀 **Uso en Código**

### Controlador:
```php
// Con paginación
$accounts = AccountCatalog::orderBy('code')->paginate(15);

// Con búsqueda y paginación
$accounts = AccountCatalog::where('description', 'like', "%{$search}%")
                         ->orderBy('code')
                         ->paginate($perPage);
```

### Vista Blade:
```php
{{-- Mostrar paginación --}}
{{ $accounts->links() }}

{{-- Con parámetros adicionales --}}
{{ $accounts->appends(request()->query())->links() }}

{{-- Vista personalizada --}}
{{ $accounts->links('pagination.custom') }}
```

### JavaScript:
```javascript
// Ir a página específica
function goToPage(page) {
    const url = new URL(window.location);
    url.searchParams.set('page', page);
    window.location.href = url.toString();
}
```

## 🔧 **Configuración**

### AppServiceProvider.php:
```php
public function boot()
{
    Paginator::defaultView('pagination.custom');
    Paginator::defaultSimpleView('pagination.simple-custom');
}
```

### Rutas configuradas:
- Web: `GET /accounts` (con paginación HTML)
- API: `GET /api/accounts` (con paginación JSON)

---

**¡La paginación está completamente implementada y lista para usar!** 🎉