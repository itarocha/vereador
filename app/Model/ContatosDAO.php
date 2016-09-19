<?php

// https://laravel.com/api/5.3/Illuminate/Database/Query/Builder.html
namespace App\Model;

use DB;
use Laravel\Database\Exception;
use App\Model\PetraOpcaoFiltro;
use Auth;
use Carbon;

class ContatosDAO {

  protected $_estados;

  public function __construct(){
      //$this->buildEstados();
  }

  public function getRules(){

    // $rules = [
    //     'start_date'        => 'date_format:d/m/Y|after:tomorrow',
    //     'end_date'          => 'date_format:d/m/Y|after:start_date',
    // ];

    return array( 'nome' => 'required|min:3|max:64',
                  'data_nascimento' => 'required|date_format:d/m/Y',
                  'cpf' => 'required|size:11',
                  'titulo' => 'max:32',
                  'secao' => 'max:8',
                  'zona' => 'max:8',
                  'endereco' => 'required|max:64',
                  'numero'  => 'max:8',
                  'complemento' => 'max:32',
                  'id_bairro' => 'required',
                  'cep' => 'size:8',
                  'telefone1' => 'max:16',
                  'telefone2' => 'max:16',
                  'telefone3' => 'max:16',
                  'telefone4' => 'max:16',
                  'telefone5' => 'max:16',
                  //'id_usuario_cadastro' => 'required',
                  //'data_hora_cadastro' timestamp NULL DEFAULT NULL,
                  //'ligou' varchar(1) NOT NULL,
                  //'id_usuario_ligou' int(11) DEFAULT NULL,
                  //'data_hora_ligou' timestamp NULL DEFAULT NULL,
                );
  }

  public function getCamposPesquisa(){
    return array(
      (object)array('name' => 'tb.nome', 'type' => 'text', 'display' => 'Nome'),
      (object)array('name' => 'tb.cpf', 'type' => 'text', 'display' => 'CPF'),
      (object)array('name' => 'tb.data_nascimento', 'type' => 'date', 'display' => 'Nascimento'),
      (object)array('name' => 'b.nome', 'type' => 'text', 'display' => 'Bairro'),
      (object)array('name' => 'c.nome', 'type' => 'text', 'display' => 'Cidade' ),
      (object)array('name' => 'c.uf', 'type' => 'text', 'display' => 'UF' ),
      (object)array('name' => 'tb.titulo', 'type' => 'text', 'display' => 'Título' ),
      (object)array('name' => 'tb.secao', 'type' => 'text', 'display' => 'Seção' ),
      (object)array('name' => 'tb.zona', 'type' => 'text', 'display' => 'Zona' ),
      (object)array('name' => 'tb.ligou', 'type' => 'text', 'display' => 'Ligou (S/N)' ),
      (object)array('name' => 'u.name', 'type' => 'text', 'display' => 'Usuário que ligou ' ),
        );
  }

  public function all($porPagina = 10)
  {
    $q = new PetraOpcaoFiltro();
    return $this->getListagem($q, $porPagina);
  }

  public function listagemComFiltro(PetraOpcaoFiltro $q, $porPagina = 10)
  {
      return $this->getListagem($q, $porPagina);
  }

  private function getListagem(PetraOpcaoFiltro $q, $porPagina = 10)
  {
      $query = DB::table('contatos as tb')
              ->select( 'tb.id',
                        'tb.nome',
                        'tb.data_nascimento',
                        'tb.cpf',
                        'tb.titulo',
                        'tb.secao',
                        'tb.zona',
                        'tb.endereco',
                        'tb.numero',
                        'tb.complemento',
                        'tb.id_bairro',
                        'b.nome as nome_bairro',
                        'c.id as id_cidade',
                        'c.nome as nome_cidade',
                        'c.uf',
                        'tb.cep',
                        'tb.telefone1',
                        'tb.telefone2',
                        'tb.telefone3',
                        'tb.telefone4',
                        'tb.telefone5',
                        'tb.id_usuario_cadastro',
                        'tb.data_hora_cadastro',
                        'tb.ligou',
                        'tb.id_usuario_ligou',
                        'u.name as nome_usuario_ligou',
                        'tb.data_hora_ligou'
                        )
                        ->join('bairros as b','b.id','=','tb.id_bairro')
                        ->join('cidades as c','c.id','=','b.id_cidade')
                        ->leftJoin('users as u', 'u.id', '=', 'tb.id_usuario_ligou')
              ->orderBy('tb.nome');

      // montagem de pesquisa
      if (($q != null) && ($q->valido))
      {
        if ($q->op == "like")
        {
          $query->where($q->campo,"like","%".$q->getValorPrincipalFormatado()."%");
        } else
        if ($q->op == "between")
        {
           $query->whereBetween($q->campo,[$q->getValorPrincipalFormatado(), $q->getValorComplementoFormatado()]);
        } else {
          $query->where($q->campo,$q->op,$q->getValorPrincipalFormatado());
        }
      }

      if ( isset($porPagina) && ($porPagina > 0)){
          $retorno = $query->paginate($porPagina);
      } else {
        $retorno = $query->get();
      }

      return $retorno;
  }

  public function ___listagem($q = array(), $porPagina = 10){
    $query = DB::table('contatos as tb')
              ->select( 'tb.id',
                        'tb.nome',
                        'tb.data_nascimento',
                        'tb.cpf',
                        'tb.titulo',
                        'tb.secao',
                        'tb.zona',
                        'tb.endereco',
                        'tb.numero',
                        'tb.complemento',
                        'tb.id_bairro',
                        'b.nome as nome_bairro',
                        'c.id as id_cidade',
                        'c.nome as nome_cidade',
                        'c.uf',
                        'tb.cep',
                        'tb.telefone1',
                        'tb.telefone2',
                        'tb.telefone3',
                        'tb.telefone4',
                        'tb.telefone5',
                        'tb.id_usuario_cadastro',
                        'tb.data_hora_cadastro',
                        'tb.ligou',
                        'tb.id_usuario_ligou',
                        'u.name as nome_usuario_ligou',
                        'tb.data_hora_ligou'
                        )
                        ->join('bairros as b','b.id','=','tb.id_bairro')
                        ->join('cidades as c','c.id','=','b.id_cidade')
                        ->leftJoin('users as u', 'u.id', '=', 'tb.id_usuario_ligou')

              ->orderBy('tb.nome');


    if ($q && count($q) == 3){
      switch ($q[1]) {
        case 'igual':
          $opcao = "=";
          break;
        case 'diferente':
          $opcao = "<>";
          break;
        case 'like':
          $opcao = "like";
          break;
        default:
          $opcao = "=";
          break;
      }

      if ($q[1] == "like"){
        $query->where('tb.'.$q[0],$opcao,"%".$q[2]."%");
      } else {
        $query->where('tb.'.$q[0],$opcao,$q[2]);
      }
    }

    if ( isset($porPagina) && ($porPagina > 0)){
        $retorno = $query->paginate($porPagina);
    } else {
      $retorno = $query->get();
    }

    return $retorno;
  }

  public function novo(){
  		//$retorno = new StdClass; //array('id'=>0,'descricao'=>'');
  		//$retorno->id = 0;
  		//$retorno->descricao = '';
  		$retorno = array('id'=>0,
                'nome'=>'',
                'data_nascimento'=>'',
                'cpf'=>'',
                'titulo'=>'',
                'secao'=>'',
                'zona'=>'',
                'endereco'=>'',
                'numero'=>'',
                'complemento'=>'',
                'id_cidade'=>'',
                'id_bairro'=>'',
                'cep'=>'',
                'telefone1'=>'',
                'telefone2'=>'',
                'telefone3'=>'',
                'telefone4'=>'',
                'telefone5'=>'',
                'id_usuario_cadastro'=>'',
                'data_hora_cadastro'=>'',
                'ligou'=>'N',
                'id_usuario_ligou'=>'',
                'data_hora_ligou'=>'');
  		return (object)$retorno; // Retorna um new StdClass;
  }

  public function getById($id){
    $query = DB::table('contatos as tb')
              ->select( 'tb.id',
                        'tb.nome',
                        'tb.data_nascimento',
                        'tb.cpf',
                        'tb.titulo',
                        'tb.secao',
                        'tb.zona',
                        'tb.endereco',
                        'tb.numero',
                        'tb.complemento',
                        'tb.id_bairro',

                        'b.nome as nome_bairro',
                        'c.id as id_cidade',
                        'c.nome as nome_cidade',
                        'c.uf',

                        'tb.cep',
                        'tb.telefone1',
                        'tb.telefone2',
                        'tb.telefone3',
                        'tb.telefone4',
                        'tb.telefone5',
                        'tb.id_usuario_cadastro',
                        'tb.data_hora_cadastro',
                        'tb.ligou',
                        'tb.id_usuario_ligou',
                        'tb.data_hora_ligou'
                        )

              ->join('bairros as b','b.id','=','tb.id_bairro')
              ->join('cidades as c','c.id','=','b.id_cidade')


              ->where('tb.id','=',$id)
              ->orderBy('tb.nome');
    // Retorna apenas um registro. Se não encontra, retorna null
    $retorno = $query->first();
    return $retorno;
  }

  public function insert($array){
    try {
      $array['id_usuario_criou'] = Auth::user()->id;
      $array['id_usuario_alterou'] = Auth::user()->id;
      $id = DB::table('contatos')->insertGetId($array);
      return (object)array( 'id' => $id,
                            'status' => 200,
                            'mensagem' => 'Criado com sucesso');
    } catch (\Exception $e){
      return (object)array( 'id' => -1,
                            'status' => 500,
                            'mensagem' => $e->getMessage());
    }
  }

  public function update($id, $array){
    $model = $this->getById($id);
    $array['id_usuario_alterou'] = Auth::user()->id;

    if (!$model){
      return (object)array( 'status'=>404,
                            'mensagem'=>'Não encontrado');
    }
    try {
      $affected = DB::table('contatos')
                    ->where('id',$id)
                    ->update($array);
      $retorno = ($affected == 1) ? 200 : 204;
      if ($affected == 1) {
        return (object)array(   'status'=>200,
                                'mensagem'=>'Alterado com sucesso');
      } else {
          return (object)array( 'status'=>204,
                                'mensagem'=>'Registro não necessita ser modificado');
      }
    } catch (\Exception $e) {
        //Campo inválido, erro de sintaxe
        return (object)array('status'=>500,
            'mensagem'=>'Falha ao alterar registro. Erro de sintaxe ou violação de chave'
            .$e->getMessage());
    }
    return $retorno;
  }


  public function ligar($id){
    $model = $this->getById($id);
    $array = array();
    $array['id_usuario_alterou'] = Auth::user()->id;
    $array['id_usuario_ligou'] = Auth::user()->id;
    $array['data_hora_ligou'] = Carbon\Carbon::now();
    $array['ligou'] = 'S';

    if (!$model){
      return (object)array( 'status'=>404,
                            'mensagem'=>'Não encontrado');
    }
    try {
      $affected = DB::table('contatos')
                    ->where('id',$id)
                    ->update($array);
      $retorno = ($affected == 1) ? 200 : 204;
      if ($affected == 1) {
        return (object)array(   'status'=>200,
                                'mensagem'=>'Alterado com sucesso');
      } else {
          return (object)array( 'status'=>204,
                                'mensagem'=>'Registro não necessita ser modificado');
      }
    } catch (\Exception $e) {
        //Campo inválido, erro de sintaxe
        return (object)array('status'=>500,
            'mensagem'=>'Falha ao alterar registro. Erro de sintaxe ou violação de chave'
            .$e->getMessage());
    }
    return $retorno;
  }


  public function delete($id)
  {
    $affected = DB::table('contatos')
                ->where('id',$id)
                ->delete();
    if ($affected == 1) {
      return (object)array( 'status'=>200,
                            'mensagem'=>'Excluído com sucesso');
    } else {
      return (object)array( 'status'=>404,
                            'mensagem'=>'Não encontrado');
    }
  }
}
