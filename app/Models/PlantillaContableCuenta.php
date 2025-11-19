<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlantillaContableCuenta extends Model
{
    use HasFactory;

    protected $table = 'plantillas_contables_cuentas';

    protected $fillable = [
        'plantilla_contable_id',
        'account_catalog_id',
        'tipo_cuenta'
    ];

    /**
     * Relación con la plantilla contable
     */
    public function plantilla()
    {
        return $this->belongsTo(PlantillaContable::class, 'plantilla_contable_id');
    }

    /**
     * Relación con el catálogo de cuentas
     */
    public function cuenta()
    {
        return $this->belongsTo(AccountCatalog::class, 'account_catalog_id');
    }

    /**
     * Obtener el label del tipo de cuenta
     */
    public function getTipoCuentaLabelAttribute()
    {
        $tipos = [
            'cuentas_por_cobrar' => 'Cuentas por Cobrar',
            'ingresos_venta' => 'Ingresos por Venta',
            'inventario' => 'Inventario',
            'costo_venta' => 'Costo de Venta',
            'cuentas_por_pagar' => 'Cuentas por Pagar',
            'anticipos_cliente' => 'Anticipos de Cliente',
            'anticipos_proveedor' => 'Anticipos a Proveedor'
        ];

        return $tipos[$this->tipo_cuenta] ?? $this->tipo_cuenta;
    }
}
