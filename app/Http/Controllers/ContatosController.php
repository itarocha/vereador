<?php

namespace App\Http\Controllers;

use App\Model\ContatosDAO;

use Illuminate\Http\Request;
use App\Http\Requests;
use Validator;
use Session;
//use Illuminate\Support\Facades\Auth;
use Auth;
use Carbon;

class ContatosController extends Controller
{
    protected $dao;

    // Injeta o DAO no construtor
    public function __construct(ContatosDAO $dao)
    {
      $this->middleware('auth');
      $this->dao = $dao;
    }

    private function montaQuery(Request $request)
    {
      $retorno = array();

      if ($request->input('q_campo') && $request->input('q_opcao') && $request->input('q_valor')) {

        $opcao = $request->input('q_opcao');
        switch ($opcao) {
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
            $opcao = null;
            break;
        }
        if ($opcao){
          $retorno[] = $request->input('q_campo');
          $retorno[] = $request->input('q_opcao');
          $retorno[] = $request->input('q_valor');
        }
      }
      return $retorno;
    }

    // GET /cidades
    public function index(Request $request)
    {
        $q = $this->montaQuery($request);
        $model = $this->dao->listagem($q);

        // Método para setar os parâmetros
        foreach ($request->query as $key => $value){
          $model->appends([$key => $value]);
        }

        //$model->setPath('custom/url');
        return view("contatos.index")
          ->with('model',$model)
          ->with('q',$q)
          ->with('titulo','Listagem de Contatos');
    }

    // GET /cidades/create
    // Chama form de inclusão
    public function create(Request $request)
    {
      //dd(Auth::user());

       //dd($request->session());

        // Controle de postback
        $titulo = Session::get('titulo', null);
        $model = Session::get('model', null);

    		$titulo = $titulo ?  $titulo : 'Novo Contato';
        $model = $model ? $model : $this->dao->novo();

        // o form de inclusão e edição são os mesmos
    		return view('contatos.edit')
          			->with('model',$model)
                //->with('estados',$this->dao->getEstados())
          			->with('titulo',$titulo);
    }

    // GET /cidades/{id}/edit
    // Chama form de exclusão
    public function edit($id)
    {
      // Controle de postback
      $titulo = Session::get('titulo', null);
      $model = Session::get('model', null);

      $titulo = $titulo ?  $titulo : 'Editar Contato';
  		$model = $model ? $model : $this->dao->getById($id);

      if (is_null($model)){
        //return Response::json('Não encontrado...', 404);
        throw new NotFoundHttpException;
      }

      // mudar display da data de nascimento
      $model->data_nascimento = $model->data_nascimento ? date('d/m/Y', strtotime($model->data_nascimento)) : '';

      // o form de inclusão e edição são os mesmos
      return view('contatos.edit')
              ->with('model',$model)
              //->with('estados',$this->dao->getEstados())
              ->with('titulo',$titulo);
    }

    // POST /cidades
    // Inclusão e Edição utilizam POST, portanto vem para esse método
    // Descobre se é inclusão pela presença do "id"
    public function store(Request $request)
    {
        $editando = false;
        $id = $request->input('id');
        $editando = $id;
        $all = $request->all();
        // Valida campos apartir das regras estabelecidas no DAO injetado
        $validator = Validator::make($all, $this->dao->getRules());
        if ($validator->fails()){
          $model = (object)$all;
          if ($editando) {
            return redirect()
                    ->route('contatos.edit', [$id])
                    ->with('model',$model)
                    ->with('titulo','Editar Contato')
                    ->withErrors($validator);
          } else {
            return redirect()
                    ->route('contatos.create')
                    ->with('model',$model)
                    ->withErrors($validator)
                    ->with('titulo','Novo Contato');
          }
        } // end validator.fails

        // Aproveita somente os campos para gravação
        $all = $request->only([
          'nome',
          'data_nascimento',
          'cpf',
          'titulo',
          'secao',
          'zona',
          'endereco',
          'numero',
          'complemento',
          'id_bairro',
          'cep',
          'telefone1',
          'telefone2',
          'telefone3',
          'telefone4',
          'telefone5',
          'id_usuario_cadastro',
          'data_hora_cadastro',
          'ligou',
          'id_usuario_ligou',
          'data_hora_ligou'
        ]);
        if ($editando){
          $data_nascimento = Carbon\Carbon::createFromFormat('d/m/Y', $all['data_nascimento'])->toDateString();
          $all['data_nascimento'] = $data_nascimento;
          $retorno = $this->dao->update($id,$all);
        } else {
          $all['id_usuario_cadastro'] = Auth::user()->id;
          $all['data_hora_cadastro'] = Carbon\Carbon::now();

          $data_nascimento = Carbon\Carbon::createFromFormat('d/m/Y', $all['data_nascimento']);
          $all['data_nascimento'] = $data_nascimento;
          //Remover `id_usuario_ligou`, `data_hora_ligou`
          $retorno = $this->dao->insert($all);
        }
        return redirect('contatos');
    }

    // GET /cidades/{id}/delete
    // Chamará o formulário para confirmação de deleção
    public function delete($id)
    {
        $titulo = 'Confirma Exclusão de Contato?';
        $model = $this->dao->getById($id);
        return view('contatos.delete')
                ->with('model',$model)
                ->with('titulo',$titulo);
    }

    // DELETE/POST /cidades/{id}
    // Exclusão propriamente dita.
    public function destroy($id)
    {
        $retorno = $this->dao->delete($id);
        return redirect('contatos');
    }

    // Não serve para nada. Veja store
    public function update(Request $request, $id){}

    // Não está sendo utilizado
    public function show($id){}
}
// 'end_date' => Carbon::now()->addDays(10)
