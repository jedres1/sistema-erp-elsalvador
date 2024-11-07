<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountCatalogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_catalogs', function (Blueprint $table) {
                $table->id();
                $table->string('code')->unique(); // Código de cuenta en formato 0.0.00.00.00.00.00
                $table->string('description'); // Descripción de la cuenta
                $table->string('type_account'); // Tipo de cuenta (A =Activo, P=Pasivo, k=Capita, I=Ingreso, G=Gasto.)
                $table->string('type_naturaled'); // Naturaleza de la cuenta (D=Deudor o A=Acreedor)
                $table->string('group'); // Grupo (B=Balance o R=Resultado)
                $table->string('accept_transaction', 1)->default('N'); // Si acepta transacciones ('Y' o 'N')
                $table->timestamps(); // Campos de creación y actualización
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('account_catalogs');
    }
}
