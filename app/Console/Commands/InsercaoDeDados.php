<?php

namespace App\Console\Commands;

use App\Http\Controllers\HomeController;
use Illuminate\Console\Command;

class InsercaoDeDados extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'inserir:dados';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Alimentando os dados na base';

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
        $produto = new HomeController;

        try{
            $produto->inserirDados();
            echo 'Dados inseridos com sucesso!'.PHP_EOL;
        }catch (\Exception $e) {
            echo $e->getMessage().PHP_EOL;
        }
    }
}
