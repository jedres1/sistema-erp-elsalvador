<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;

    protected $table = 'proveedores';

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
        'dias_credito',
        'plantilla_contable_id',
        'estado'
    ];

    protected $casts = [
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
     * Scope para proveedores activos
     */
    public function scopeActivos($query)
    {
        return $query->where('estado', 'A');
    }

    /**
     * Obtener cuenta contable por pagar del proveedor
     */
    public function getCuentaPorPagar()
    {
        if ($this->plantillaContable) {
            return $this->plantillaContable->getCuenta('cuentas_por_pagar');
        }
        return null;
    }
}
