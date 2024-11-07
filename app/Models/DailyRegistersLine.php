<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyRegistersLine extends Model
{
    use HasFactory;

    protected $fillable = [
        'daily_register_id',
        'line',
        'account_cataloge_id',
        'debit_amount',
        'credit_amount',
    ];

    /**
     * Relación inversa con DailyRegister
     * Cada línea pertenece a un DailyRegister.
     */
    public function dailyRegister()
    {
        return $this->belongsTo(DailyRegister::class);
    }

    /**
     * Relación con AccountCataloge (si tienes un modelo para eso)
     */
    public function accountCataloge()
    {
        return $this->belongsTo(AccountCatalog::class);
    }
}
