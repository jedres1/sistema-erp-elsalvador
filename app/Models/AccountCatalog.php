<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccountCatalog extends Model
{
    protected $fillable = [
        'code', 'description', 'type_account', 'type_naturaled', 'group', 'accept_transaction'
    ];

    /**
     * Obtener la cuenta padre de la cuenta actual.
     */
    public function parent()
    {
        // Buscar el padre comparando el prefijo del código
        return $this->where('code', 'like', substr($this->code, 0, strrpos($this->code, '.')) . '%')
                    ->where('code', '<>', $this->code)
                    ->first();
    }

    /**
     * Obtener las cuentas hijas de la cuenta actual.
     */
    public function children()
    {
        return $this->where('code', 'like', $this->code . '.%')->get();
    }

    /**
     * Verificar si la cuenta puede aceptar transacciones.
     */
    public function isAcceptingTransactions()
    {
        return $this->children()->count() === 0; // Solo las cuentas sin hijos pueden aceptar transacciones
    }
}
