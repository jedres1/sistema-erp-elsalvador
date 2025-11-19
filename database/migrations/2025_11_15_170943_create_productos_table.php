<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo', 50)->unique();
            $table->string('nombre', 200);
            $table->text('descripcion')->nullable();
            $table->enum('tipo', ['producto', 'servicio'])->default('producto');
            $table->string('unidad_medida', 20)->default('UND')->comment('UND, KG, LT, MT, etc');
            $table->decimal('precio_venta', 12, 2)->default(0);
            $table->decimal('precio_compra', 12, 2)->default(0);
            $table->decimal('existencia', 12, 2)->default(0);
            $table->decimal('existencia_minima', 12, 2)->default(0);
            $table->boolean('maneja_inventario')->default(true);
            $table->foreignId('plantilla_contable_id')->nullable()->constrained('plantillas_contables')->onDelete('set null');
            $table->enum('estado', ['A', 'I'])->default('A')->comment('A=Activo, I=Inactivo');
            $table->timestamps();
            
            $table->index(['tipo', 'estado']);
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
        Schema::dropIfExists('productos');
    }
}
