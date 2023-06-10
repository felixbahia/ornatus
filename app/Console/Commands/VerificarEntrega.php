<?php

namespace App\Console\Commands;

use App\Http\Controllers\HomeController;
use Illuminate\Console\Command;

class VerificarEntrega extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'verificar:entrega';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Verifica seu o pedido foi entregue junto a transportadora';

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
        $pedidos = new HomeController;

        try{
            $pedidos->verificarEntrega();
            echo 'Dados inseridos com sucesso!'.PHP_EOL;
        }catch (\Exception $e) {
            echo $e->getMessage().PHP_EOL;
        }
    }
}
