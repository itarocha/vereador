<?php

// https://laravel.com/api/5.3/Illuminate/Database/Query/Builder.html
namespace App\Model;

use DB;
use Laravel\Database\Exception;

class BairrosDAO {

  public function getRules(){
    return array('nome' => 'required|min:3|max:64',
                  'id_cidade' => 'required',
    );
  }

  public function listagem(){
    $query = DB::table('bairros as tb')
              ->select( 'tb.id', 'tb.nome', 'tb.id_cidade', 'c.nome as cidade_nome', 'c.uf')
              ->join('cidades as c','c.id','=','tb.id_cidade')
              ->orderBy('tb.nome');
    $retorno = $query->paginate(20);
    return $retorno;
  }

  public function novo(){
    		//$retorno = new StdClass; //array('id'=>0,'descricao'=>'');
    		//$retorno->id = 0;
    		//$retorno->descricao = '';
    		$retorno = array('id'=>0, 'nome'=>'','id_cidade' => null);
    		return (object)$retorno; // Retorna um new StdClass;
  }

  public function getById($id){
    $query = DB::table('bairros as tb')
              ->select( 'tb.id', 'tb.nome', 'tb.id_cidade', 'c.nome as cidade_nome', 'c.uf')
              ->join('cidades as c','c.id','=','tb.id_cidade')
              ->where('tb.id','=',$id);
              // Retorna apenas um registro. Se não encontra, retorna null
    $retorno = $query->first();
    return $retorno;
  }

  public function insert($array){
    try {
      $id = DB::table('bairros')->insertGetId($array);
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

    if (!$model){
      return (object)array( 'status'=>404,
                            'mensagem'=>'Não encontrado');
    }
    try {
      $affected = DB::table('bairros')
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
    $affected = DB::table('bairros')
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
