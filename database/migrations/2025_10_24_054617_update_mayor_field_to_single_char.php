<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class UpdateMayorFieldToSingleChar extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Paso 1: Cambiar temporalmente a VARCHAR(3) para poder manejar tanto YES/NO como Y/N
        Schema::table('daily_registers', function (Blueprint $table) {
            $table->string('mayor', 3)->default('NO')->change();
        });
        
        // Paso 2: Actualizar los datos existentes YES -> Y, NO -> N
        DB::statement("UPDATE daily_registers SET mayor = 'Y' WHERE mayor = 'YES'");
        DB::statement("UPDATE daily_registers SET mayor = 'N' WHERE mayor = 'NO'");
        
        // Paso 3: Cambiar la columna a VARCHAR(1) con default 'N'
        Schema::table('daily_registers', function (Blueprint $table) {
            $table->string('mayor', 1)->default('N')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Paso 1: Cambiar temporalmente a VARCHAR(3)
        Schema::table('daily_registers', function (Blueprint $table) {
            $table->string('mayor', 3)->default('NO')->change();
        });
        
        // Paso 2: Revertir los datos Y -> YES, N -> NO
        DB::statement("UPDATE daily_registers SET mayor = 'YES' WHERE mayor = 'Y'");
        DB::statement("UPDATE daily_registers SET mayor = 'NO' WHERE mayor = 'N'");
        
        // Paso 3: Cambiar de vuelta a SET
        Schema::table('daily_registers', function (Blueprint $table) {
            $table->set('mayor', ['YES', 'NO'])->default('NO')->change();
        });
    }
}
