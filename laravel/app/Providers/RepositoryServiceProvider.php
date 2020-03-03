<?php 

namespace App\Providers; 

use App\Repositories\CadastralRepository; 
use App\Repositories\CadastralRepositoryInterface; 
use Illuminate\Support\ServiceProvider; 

/** 
* Class RepositoryServiceProvider 
* @package App\Providers 
*/ 
class RepositoryServiceProvider extends ServiceProvider 
{ 
   /** 
    * Register services. 
    * 
    * @return void  
    */ 
   public function register() 
   { 
       $this->app->bind(CadastralRepositoryInterface::class, CadastralRepository::class);
      // $this->app->bind('App\Repositories\PostRepositoryInterface', 'App\Repositories\PostRepository');
   }
}