<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDailyRegistersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daily_registers', function (Blueprint $table) {
            $table->id();
            $table->date('date_register');
            $table->string('description',200);
            $table->decimal('mount_debit', 8,4);
            $table->decimal('mount_credit',8,4);
            $table->decimal('balance',8,4);
            $table->set('mayor',['YES','NO']);
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
        Schema::dropIfExists('daily_registers');
    }
}
