<?php

// https://laravel.com/api/5.3/Illuminate/Database/Query/Builder.html
namespace App\Model;

use DB;
use Laravel\Database\Exception;

class CidadesDAO {

  protected $_estados;

  public function __construct(){
      $this->buildEstados();
  }

  // Essa função vai sair daqui
  private function buildEstados(){
    $this->_estados = array(
        (object)array('id' => 'AC', 'nome' => 'Acre'),
        (object)array('id' => 'AL', 'nome' => 'Alagoas'),
        (object)array('id' => 'AP', 'nome' => 'Amapá'),
        (object)array('id' => 'AM', 'nome' => 'Amazonas'),
        (object)array('id' => 'BA', 'nome' => 'Bahia'),
        (object)array('id' => 'CE', 'nome' => 'Ceará'),
        (object)array('id' => 'DF', 'nome' => 'Distrito Federal'),
        (object)array('id' => 'ES', 'nome' => 'Espírito Santo'),
        (object)array('id' => 'GO', 'nome' => 'Goiás'),
        (object)array('id' => 'MA', 'nome' => 'Maranhão'),
        (object)array('id' => 'MT', 'nome' => 'Mato Grosso'),
        (object)array('id' => 'MS', 'nome' => 'Mato Grosso do Sul'),
        (object)array('id' => 'MG', 'nome' => 'Minas Gerais'),
        (object)array('id' => 'PA', 'nome' => 'Pará'),
        (object)array('id' => 'PB', 'nome' => 'Paraíba'),
        (object)array('id' => 'PR', 'nome' => 'Paraná'),
        (object)array('id' => 'PE', 'nome' => 'Pernambuco'),
        (object)array('id' => 'PI', 'nome' => 'Piauí'),
        (object)array('id' => 'RJ', 'nome' => 'Rio de Janeiro'),
        (object)array('id' => 'RN', 'nome' => 'Rio Grande do Norte'),
        (object)array('id' => 'RS', 'nome' => 'Rio Grande do Sul'),
        (object)array('id' => 'RO', 'nome' => 'Rondônia'),
        (object)array('id' => 'RR', 'nome' => 'Roraima'),
        (object)array('id' => 'SC', 'nome' => 'Santa Catarina'),
        (object)array('id' => 'SP', 'nome' => 'São Paulo'),
        (object)array('id' => 'SE', 'nome' => 'Sergipe'),
        (object)array('id' => 'TO', 'nome' => 'Tocantins'),
        );
  }

  public function getEstados(){
    return $this->_estados;
  }

  public function getRules(){
    return array( 'nome' => 'required|min:3|max:64',
                  'uf' => 'required|min:2|max:2');
  }

  public function listagem(){
    $query = DB::table('cidades as tb')
              ->select( 'tb.id', 'tb.nome', 'tb.uf')
              ->orderBy('tb.nome');
    $retorno = $query->paginate(20);
    return $retorno;
  }

  public function novo(){
  		//$retorno = new StdClass; //array('id'=>0,'descricao'=>'');
  		//$retorno->id = 0;
  		//$retorno->descricao = '';
  		$retorno = array('id'=>0,'nome'=>'','uf' => 'MG');
  		return (object)$retorno; // Retorna um new StdClass;
  }

  public function getById($id){
    $query = DB::table('cidades as tb')
              ->select('tb.id', 'tb.nome', 'tb.uf')
              ->where('tb.id','=',$id);
    // Retorna apenas um registro. Se não encontra, retorna null
    $retorno = $query->first();
    return $retorno;
  }

  public function insert($array){
    try {
      $id = DB::table('cidades')->insertGetId($array);
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
      $affected = DB::table('cidades')
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
    $affected = DB::table('cidades')
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
