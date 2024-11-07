<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDailyRegistersLineTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daily_registers_line', function (Blueprint $table) {
            $table->id();
            
            // Relación con daily_registers (asegurando la eliminación en cascada)
            $table->foreignId('daily_register_id')
                  ->constrained('daily_registers')
                  ->onDelete('cascade');

            // Campo de número de línea
            $table->integer('line');

            // Relación con account_cataloges (relacionando con 'id', pero si es 'code', asegúrate que 'code' sea único)
            $table->foreignId('account_catalog_id')
                  ->constrained('account_catalogs')
                  ->onDelete('restrict');

            // Montos de débito y crédito
            $table->decimal('debit_amount', 8, 4);
            $table->decimal('credit_amount', 8, 4);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('daily_registers_line');
    }
}
