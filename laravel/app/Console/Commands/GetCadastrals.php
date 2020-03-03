<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;
use App\Rules\CadastralRule;
use App\Repositories\CadastralRepositoryInterface; 

class GetCadastrals extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'getcadastrals {coords}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Возврат кадастровых записей по кадастровым номерам';

    private $cadRepo;
    
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(CadastralRepositoryInterface $cadRepo)
    {
        parent::__construct();
        $this->cadRepo = $cadRepo;
    }

    /**
     * Возврат кадастровых записей по кадастровым номерам
     *
     * @return mixed
     */
    public function handle()
    {
        $coords = $this->argument('coords');
        $validator = Validator::make([
            'coords' => $coords
        ], [
            'coords' => new CadastralRule
        ]);
        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                $this->error($error);
            }
        }

        $cadastrals = array_map(function($cad) {
            return [$cad->cadastral_number, $cad->address, $cad->price, $cad->area]; 
        }, $this->cadRepo->getCadastrals($coords));

        $headers = ['Кадастровый номер', 'Адрес', 'Стоимость', 'Площадь'];
        $this->table($headers, $cadastrals);
    }
}
