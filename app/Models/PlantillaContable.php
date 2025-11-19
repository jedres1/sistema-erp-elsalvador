<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlantillaContable extends Model
{
    use HasFactory;

    protected $table = 'plantillas_contables';

    protected $fillable = [
        'nombre',
        'tipo',
        'descripcion',
        'activo'
    ];

    protected $casts = [
        'activo' => 'boolean',
    ];

    /**
     * Relación con las cuentas contables de la plantilla
     */
    public function cuentas()
    {
        return $this->hasMany(PlantillaContableCuenta::class, 'plantilla_contable_id');
    }

    /**
     * Obtener una cuenta específica por tipo
     */
    public function getCuenta($tipoCuenta)
    {
        return $this->cuentas()->where('tipo_cuenta', $tipoCuenta)->first();
    }

    /**
     * Scope para filtrar por tipo
     */
    public function scopeTipo($query, $tipo)
    {
        return $query->where('tipo', $tipo);
    }

    /**
     * Scope para plantillas activas
     */
    public function scopeActivas($query)
    {
        return $query->where('activo', true);
    }

    /**
     * Obtener el label del tipo
     */
    public function getTipoLabelAttribute()
    {
        $tipos = [
            'cliente' => 'Cliente',
            'articulo' => 'Artículo',
            'proveedor' => 'Proveedor'
        ];

        return $tipos[$this->tipo] ?? $this->tipo;
    }

    /**
     * Obtener los tipos de cuenta según el tipo de plantilla
     */
    public function getTiposCuentaDisponibles()
    {
        $tiposCuenta = [
            'cliente' => [
                'cuentas_por_cobrar' => 'Cuentas por Cobrar',
                'anticipos_cliente' => 'Anticipos de Cliente'
            ],
            'articulo' => [
                'ingresos_venta' => 'Ingresos por Venta',
                'inventario' => 'Inventario',
                'costo_venta' => 'Costo de Venta'
            ],
            'proveedor' => [
                'cuentas_por_pagar' => 'Cuentas por Pagar',
                'anticipos_proveedor' => 'Anticipos a Proveedor'
            ]
        ];

        return $tiposCuenta[$this->tipo] ?? [];
    }
}
