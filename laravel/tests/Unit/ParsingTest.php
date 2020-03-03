<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Repositories\CadastralRepository; 
use App\Cadastral;

class ParsingTest extends TestCase
{
    
    private $cadRepo;
    
    public function setUp()
    {
        parent::setUp();
        $this->cadRepo = new CadastralRepository();
    }
   
    /**
     * тест для проверки работы парсера
     *
     * @return void
     */
    public function testParsing()
    {
        $testNums = ['69:27:0000022:1306', '69:27:0000022:1307'];
        Cadastral::whereIn('cadastral_number', $testNums)->delete();
        $cadastrals = $this->cadRepo->getCadastrals(implode($testNums, ','));
        
        $this->assertTrue($cadastrals[0]->price == 36126.00);
        $this->assertTrue($cadastrals[1]->price == 36633.60);
    }
}
