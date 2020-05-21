<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ImportarListadoProductos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'plenapp:importar-productos {file : Archivos CSV con la lista de productos}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Pobla la tabla productos con el listado proveniente de un archivo .csv.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $filePath = $this->argument('file');

        try {
            $file = fopen($filePath, "r");
        } catch (\Exception $ex) {
            return $this->error('ERROR: ' . $ex->getMessage());
        }

        $recordsToImport = [];
        $count = 0;

        fgetcsv($file); // skips first line
        while (($line = fgetcsv($file)) !== false) {

            try {
                // checks if empty line
                if (is_null($line[0])) continue;

                $record = [
                    'descripcion' => $line[1],
                    'codigo' => $line[0],
                    'puntos' => (integer)$line[2],
                    'precio_base' => (integer)$line[3],
                    'sin_iva' => $line[4] == '1',
                    'sin_descuento' => $line[5] == '1',
                    'created_at' => now(),
                    'updated_at' => now(),
                ];

                $this->line("Procesando registro " . ++$count . " => '" . $record['descripcion'] . "'");

                array_push($recordsToImport, $record);

            } catch (\Exception $ex) {

                return $this->error('ERROR: ' . $ex->getMessage());
            }

        }

        fclose($file);

        $this->line('Guardando registros...');

        \App\Producto::insert($recordsToImport);

        $this->line(count($recordsToImport) . ' registros importados satisfactoriamente.');
    }
}
