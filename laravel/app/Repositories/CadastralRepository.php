<?php   

namespace App\Repositories;   

use App\Helpers\GuzzleHelper;
use App\Repositories\CadastralRepositoryInterface; 
use App\Cadastral;   

class CadastralRepository implements CadastralRepositoryInterface 
{     
    public function getCadastrals($cadNums)
    {
        $cadArr = array_filter(preg_split('/,\s*/', $cadNums));
        $cadastrals = Cadastral::whereIn('cadastral_number', $cadArr)->get()->all();
        if (!$cadastrals) {
            $responseItems = GuzzleHelper::getData($cadArr);
            foreach ($responseItems as $item) {
                $fields = [];
                if (empty($item['number']) || empty($item['data'])) {
                    \Log::error('Получена неверная кадастровая запись: ', $item);
                    continue;
                }
                $fields['cadastral_number'] = $item['number'];
                $fields['address'] = $item['data']['attrs']['address'];
                $fields['price'] = floatval($item['data']['attrs']['cad_cost']);
                $fields['area'] = intval($item['data']['attrs']['area_value']);
                $newCadastral = $this->saveNewCadastral($fields);
                if ($newCadastral) $cadastrals[] = $newCadastral;
            }
        }
        return $cadastrals;
    }
    
    public function saveNewCadastral($fields)
    {
        $cadastral = new Cadastral();
        $cadastral->fill($fields);
        if (!$cadastral->save()) {
            \Log::error('Ошибка при сохранении Cadastral: ', $fields);
            return null;
        }
        return $cadastral;
    }
}