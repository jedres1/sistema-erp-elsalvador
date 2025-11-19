<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'productos';

    protected $fillable = [
        'codigo',
        'nombre',
        'descripcion',
        'tipo',
        'unidad_medida',
        'precio_venta',
        'precio_compra',
        'existencia',
        'existencia_minima',
        'maneja_inventario',
        'plantilla_contable_id',
        'estado'
    ];

    protected $casts = [
        'precio_venta' => 'decimal:2',
        'precio_compra' => 'decimal:2',
        'existencia' => 'decimal:2',
        'existencia_minima' => 'decimal:2',
        'maneja_inventario' => 'boolean',
    ];

    /**
     * Relación con la plantilla contable
     */
    public function plantillaContable()
    {
        return $this->belongsTo(PlantillaContable::class, 'plantilla_contable_id');
    }

    /**
     * Scope para productos activos
     */
    public function scopeActivos($query)
    {
        return $query->where('estado', 'A');
    }

    /**
     * Obtener cuenta de ingresos por venta
     */
    public function getCuentaIngreso()
    {
        if ($this->plantillaContable) {
            return $this->plantillaContable->getCuenta('ingresos_venta');
        }
        return null;
    }

    /**
     * Obtener cuenta de inventario
     */
    public function getCuentaInventario()
    {
        if ($this->plantillaContable) {
            return $this->plantillaContable->getCuenta('inventario');
        }
        return null;
    }

    /**
     * Obtener cuenta de costo de venta
     */
    public function getCuentaCostoVenta()
    {
        if ($this->plantillaContable) {
            return $this->plantillaContable->getCuenta('costo_venta');
        }
        return null;
    }
}
