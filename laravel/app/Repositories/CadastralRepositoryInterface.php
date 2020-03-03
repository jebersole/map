<?php

namespace App\Repositories;

interface CadastralRepositoryInterface
{
    /**
     * Найти кадастровые записи по кадастровому номеру
     *
     * @param string Кадастровые номера разделенных запятыми
     * @return \Illuminate\Database\Eloquent\Collection|[]
     */
    public function getCadastrals($cadNums);
    
    /**
     * Создать новую кадастровую запись
     *
     * @param array поля для заполнения App\Cadastral
     * @return \App\Cadastral|null
     */
    public function saveNewCadastral($fields);

}