<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGeographicFieldsToClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clientes', function (Blueprint $table) {
            $table->string('departamento', 50)->nullable()->after('direccion');
            $table->string('municipio', 50)->nullable()->after('departamento');
            $table->string('distrito', 50)->nullable()->after('municipio');
            $table->string('dui', 15)->nullable()->after('numero_documento');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('clientes', function (Blueprint $table) {
            $table->dropColumn(['departamento', 'municipio', 'distrito', 'dui']);
        });
    }
}
