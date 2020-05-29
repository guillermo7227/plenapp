<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeguimientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seguimientos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cliente_id')->unique();
            $table->date('fecha_compra')->default(now()->format('Y-m-d'));
            $table->date('fecha_seguimiento')->default(now()->format('Y-m-d'));
            $table->date('fecha_proximo_seguimiento')->default(now()->addDays(3)->format('Y-m-d'));
            $table->text('observaciones')->nullable();
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
        Schema::dropIfExists('seguimientos');
    }
}
