<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Cadastral
 *
 * @property int $id
 * @property string $cadastral_number Кадастровый номер
 * @property string $address Кадастровый Адрес
 * @property float $cost стоимость договора
 * @property int $area Площадь (квадратные метры)
 * @mixin \Eloquent
 */
class Cadastral extends Model
{
    protected $fillable = [
        'cadastral_number',
        'address',
        'price',
        'area',
    ];
}
