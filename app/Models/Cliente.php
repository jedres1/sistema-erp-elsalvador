<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $table = 'clientes';

    protected $fillable = [
        'codigo',
        'nombre',
        'nombre_comercial',
        'tipo_documento',
        'numero_documento',
        'nrc',
        'giro',
        'direccion',
        'telefono',
        'email',
        'contacto',
        'limite_credito',
        'dias_credito',
        'plantilla_contable_id',
        'estado'
    ];

    protected $casts = [
        'limite_credito' => 'decimal:2',
        'dias_credito' => 'integer',
    ];

    /**
     * Relación con la plantilla contable
     */
    public function plantillaContable()
    {
        return $this->belongsTo(PlantillaContable::class, 'plantilla_contable_id');
    }

    /**
     * Scope para clientes activos
     */
    public function scopeActivos($query)
    {
        return $query->where('estado', 'A');
    }

    /**
     * Obtener cuenta contable por cobrar del cliente
     */
    public function getCuentaPorCobrar()
    {
        if ($this->plantillaContable) {
            return $this->plantillaContable->getCuenta('cuentas_por_cobrar');
        }
        return null;
    }
}
