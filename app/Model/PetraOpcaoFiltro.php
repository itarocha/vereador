<?php

namespace App\Model;

use Illuminate\Http\Request;
//use Illuminate\Queue\SerializesModels;

class PetraOpcaoFiltro
{
    //use SerializesModels;

    public $campo;

    public $operador;

    public $op;

    public $valor_principal;

    public $valor_complemento;

    public $valido = false;

    public function __construct()
    {

    }

}
