<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlantillaCuentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plantilla_cuentas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('plantilla_contable_id')->constrained('plantillas_contables')->onDelete('cascade');
            $table->foreignId('account_catalog_id')->constrained('account_catalogs')->onDelete('restrict');
            $table->enum('tipo_cuenta', [
                'cuenta_por_cobrar',
                'ingreso_venta',
                'inventario',
                'costo_venta',
                'cuenta_por_pagar',
                'anticipo_cliente',
                'anticipo_proveedor'
            ])->comment('Tipo de cuenta según el contexto de uso');
            $table->text('descripcion')->nullable();
            $table->timestamps();
            
            $table->unique(['plantilla_contable_id', 'tipo_cuenta'], 'plantilla_tipo_cuenta_unique');
            $table->index(['plantilla_contable_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plantilla_cuentas');
    }
}
