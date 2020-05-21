<?php

use Illuminate\Database\Seeder;

class LlaveValorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\LlaveValor::create(['llave' => 'descuento', 'valor' => '25']);
        \App\LlaveValor::create(['llave' => 'iva', 'valor' => '19']);
        \App\LlaveValor::create(['llave' => 'manejo', 'valor' => '11']);
    }
}
