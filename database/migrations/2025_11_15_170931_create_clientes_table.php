<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('codigo', 20)->unique();
            $table->string('nombre', 200);
            $table->string('nombre_comercial', 200)->nullable();
            $table->string('tipo_documento', 20)->default('NIT')->comment('NIT, DUI, NRC, PASAPORTE');
            $table->string('numero_documento', 50)->unique();
            $table->string('nrc', 20)->nullable();
            $table->string('giro', 100)->nullable();
            $table->text('direccion')->nullable();
            $table->string('telefono', 20)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('contacto', 100)->nullable();
            $table->decimal('limite_credito', 12, 2)->default(0);
            $table->integer('dias_credito')->default(0);
            $table->foreignId('plantilla_contable_id')->nullable()->constrained('plantillas_contables')->onDelete('set null');
            $table->enum('estado', ['A', 'I'])->default('A')->comment('A=Activo, I=Inactivo');
            $table->timestamps();
            
            $table->index(['estado']);
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
        Schema::dropIfExists('clientes');
    }
}
