<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    protected $responses;
    protected function __construct()
    {
        $this->responses = [
            'store' => ':word creado satisfactoriamente',
            'updated' => ':word actualizado satisfactoriamente',
            'destroy' => ':word eliminado satisfactoriamente'
        ];
    }
    use AuthorizesRequests, ValidatesRequests;

    public function crudResponses(string $word):void{
        foreach ($this->responses as $key=>$response){
            $this->responses[$key] = str_replace(':word',$word,$response);
        } 
    }
}
