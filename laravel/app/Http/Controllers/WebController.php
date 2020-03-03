<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Validator;
use App\Rules\CadastralRule;
use App\ApiModels\ApiCadastralModel;
use App\Repositories\CadastralRepositoryInterface;

class WebController extends Controller
{
    private $cadRepo;

    public function __construct(Request $request, CadastralRepositoryInterface $cadRepo)
    {
        $this->request = $request;
        $this->cadRepo = $cadRepo;
    }
    
    /**
     * Возврат кадастровых записей по кадастровым номерам
     *
     * @return \Illuminate\Http\Response
     */
    public function getCadastrals() 
    {
        $coords = $this->request->get('coords');
        $this->request->validate([
            'coords' => ['required', 'string', new CadastralRule],
        ]);

        $cadastrals = $this->cadRepo->getCadastrals($coords);
        return response()->json(['cadastrals' => $cadastrals]);
    }
}