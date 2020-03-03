<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCadastralTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cadastrals', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cadastral_number')->default('')->comment('Кадастровый номер');
            $table->string('address')->default('')->comment('Адрес');
            $table->decimal('price', 14, 2)->default(0)->comment('Кадастровая цена (рубли)');
            $table->bigInteger('area')->default(0)->comment('Площадь (квадратные метры)');
            $table->timestamps();
        });
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cadastral');
    }
}
