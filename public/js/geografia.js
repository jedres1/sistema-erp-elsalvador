/**
 * Módulo de Geografía de El Salvador
 * Maneja la carga y gestión de datos geográficos (departamentos, municipios, distritos)
 * @version 1.0.0
 * @date 2025-11-22
 */

let geografiaData = null;

/**
 * Carga los datos geográficos desde el archivo JSON
 * @returns {Promise<Object>} Datos geográficos cargados
 */
async function cargarDatosGeograficos() {
    if (geografiaData) {
        return geografiaData;
    }
    
    try {
        const response = await fetch('/js/geografia-el-salvador.json');
        if (!response.ok) {
            throw new Error('Error al cargar datos geográficos');
        }
        geografiaData = await response.json();
        return geografiaData;
    } catch (error) {
        console.error('Error cargando datos geográficos:', error);
        throw error;
    }
}

/**
 * Inicializa los selectores de geografía en un formulario
 * @param {Object} config - Configuración de selectores
 * @param {string} config.departamentoId - ID del select de departamento
 * @param {string} config.municipioId - ID del select de municipio
 * @param {string} config.distritoId - ID del select de distrito
 * @param {Object} config.valoresActuales - Valores actuales para preselección (opcional)
 */
async function inicializarSelectoresGeografia(config) {
    const {
        departamentoId = 'departamento',
        municipioId = 'municipio',
        distritoId = 'distrito',
        valoresActuales = {}
    } = config;

    try {
        const data = await cargarDatosGeograficos();
        
        // Configurar eventos
        const deptoSelect = document.getElementById(departamentoId);
        const muniSelect = document.getElementById(municipioId);
        const distSelect = document.getElementById(distritoId);

        if (!deptoSelect || !muniSelect || !distSelect) {
            console.error('No se encontraron todos los selectores necesarios');
            return;
        }

        // Cargar departamentos
        cargarDepartamentos(deptoSelect, data.departamentos, valoresActuales.departamento);

        // Eventos de cascada
        deptoSelect.addEventListener('change', function() {
            cargarMunicipiosDesdeEvento(this.value, muniSelect, distSelect, data, valoresActuales);
        });

        muniSelect.addEventListener('change', function() {
            cargarDistritosDesdeEvento(this.value, distSelect, data, valoresActuales);
        });

        // Cargar datos iniciales si hay valores actuales
        if (valoresActuales.departamento) {
            cargarMunicipiosDesdeEvento(
                valoresActuales.departamento, 
                muniSelect, 
                distSelect, 
                data, 
                valoresActuales
            );
        }

    } catch (error) {
        console.error('Error inicializando selectores de geografía:', error);
    }
}

/**
 * Carga departamentos en el select
 */
function cargarDepartamentos(select, departamentos, valorActual) {
    select.innerHTML = '<option value="">Seleccione...</option>';
    
    departamentos.forEach(depto => {
        const option = document.createElement('option');
        option.value = depto.codigo;
        option.textContent = `${depto.codigo} - ${depto.nombre}`;
        if (depto.codigo === valorActual) {
            option.selected = true;
        }
        select.appendChild(option);
    });
}

/**
 * Carga municipios desde evento
 */
function cargarMunicipiosDesdeEvento(codigoDepto, muniSelect, distSelect, data, valoresActuales) {
    muniSelect.innerHTML = '<option value="">Seleccionar municipio...</option>';
    distSelect.innerHTML = '<option value="">Seleccionar distrito...</option>';
    
    if (codigoDepto && data.municipios[codigoDepto]) {
        data.municipios[codigoDepto].forEach(muni => {
            const option = document.createElement('option');
            option.value = muni.codigo;
            option.textContent = `${muni.codigo} - ${muni.nombre}`;
            if (muni.codigo === valoresActuales.municipio && codigoDepto === valoresActuales.departamento) {
                option.selected = true;
            }
            muniSelect.appendChild(option);
        });

        // Si hay municipio preseleccionado, cargar sus distritos
        if (valoresActuales.municipio && codigoDepto === valoresActuales.departamento) {
            cargarDistritosDesdeEvento(valoresActuales.municipio, distSelect, data, valoresActuales);
        }
    }
}

/**
 * Carga distritos desde evento
 */
function cargarDistritosDesdeEvento(codigoMuni, distSelect, data, valoresActuales) {
    distSelect.innerHTML = '<option value="">Seleccionar distrito...</option>';
    
    if (codigoMuni && data.distritos[codigoMuni]) {
        data.distritos[codigoMuni].forEach(dist => {
            const option = document.createElement('option');
            option.value = dist.codigo;
            option.textContent = `${dist.codigo} - ${dist.nombre}`;
            if (dist.codigo === valoresActuales.distrito) {
                option.selected = true;
            }
            distSelect.appendChild(option);
        });
    }
}

/**
 * Obtiene el nombre de un departamento por su código
 */
async function obtenerNombreDepartamento(codigo) {
    const data = await cargarDatosGeograficos();
    const depto = data.departamentos.find(d => d.codigo === codigo);
    return depto ? depto.nombre : null;
}

/**
 * Obtiene el nombre de un municipio por su código
 */
async function obtenerNombreMunicipio(codigo) {
    const data = await cargarDatosGeograficos();
    const codigoDepto = codigo.substring(0, 2);
    const municipios = data.municipios[codigoDepto] || [];
    const muni = municipios.find(m => m.codigo === codigo);
    return muni ? muni.nombre : null;
}

/**
 * Obtiene el nombre de un distrito por su código
 */
async function obtenerNombreDistrito(codigo) {
    const data = await cargarDatosGeograficos();
    const codigoMuni = codigo.substring(0, 4);
    const distritos = data.distritos[codigoMuni] || [];
    const dist = distritos.find(d => d.codigo === codigo);
    return dist ? dist.nombre : null;
}

// Exportar funciones para uso global
if (typeof window !== 'undefined') {
    window.Geografia = {
        inicializar: inicializarSelectoresGeografia,
        cargarDatos: cargarDatosGeograficos,
        obtenerNombreDepartamento,
        obtenerNombreMunicipio,
        obtenerNombreDistrito
    };
}
