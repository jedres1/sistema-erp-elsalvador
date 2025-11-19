<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlantillasContablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plantillas_contables', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
            $table->enum('tipo', ['cliente', 'articulo', 'proveedor']);
            $table->text('descripcion')->nullable();
            $table->boolean('activo')->default(true);
            $table->timestamps();
        });

        // Tabla para definir las cuentas contables de cada plantilla
        Schema::create('plantillas_contables_cuentas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('plantilla_contable_id')->constrained('plantillas_contables')->onDelete('cascade');
            $table->foreignId('account_catalog_id')->constrained('account_catalogs')->onDelete('cascade');
            $table->enum('tipo_cuenta', [
                'cuentas_por_cobrar',      // Para tipo cliente
                'ingresos_venta',          // Para tipo artículo
                'inventario',              // Para tipo artículo
                'costo_venta',             // Para tipo artículo
                'cuentas_por_pagar',       // Para tipo proveedor
                'anticipos_cliente',       // Para tipo cliente
                'anticipos_proveedor'      // Para tipo proveedor
            ]);
            $table->timestamps();
            
            $table->unique(['plantilla_contable_id', 'tipo_cuenta'], 'plantilla_tipo_cuenta_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plantillas_contables_cuentas');
        Schema::dropIfExists('plantillas_contables');
    }
}
