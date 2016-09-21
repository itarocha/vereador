<?php

namespace App\Http\Controllers;

use App\Model\ContatosDAO;
use App\Model\CidadesDAO;
use App\Model\PetraOpcaoFiltro;
use App\Util\PetraInjetorFiltro;

use Illuminate\Http\Request;
use App\Http\Requests;
use Validator;
use Session;
//use Illuminate\Support\Facades\Auth;
use Auth;
use Carbon;
use PDF;
use App;
use View;

class ContatosController extends Controller
{
    protected $dao;

    // Injeta o DAO no construtor
    public function __construct(ContatosDAO $dao)
    {
      $this->middleware('auth');
      $this->dao = $dao;
    }

    // GET /cidades
    public function index(Request $request)
    {
        // Consulta
        $query = new PetraOpcaoFiltro();
        PetraInjetorFiltro::injeta($request, $query);

        //dd($query->getValorPrincipalFormatado());

        $model = $this->dao->listagemComFiltro($query);
        // Carrega parâmetros do get (query params)
        foreach ($request->query as $key => $value){
           $model->appends([$key => $value]);
        }

        //$model->setPath('custom/url');
        return view("contatos.index")
          ->with('model',$model)
          ->with('query',$query)
          ->with('pesquisa',$this->dao->getCamposPesquisa())
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


        $cidadesDAO = new CidadesDAO();
        $cidades = $cidadesDAO->all(0);

        //dd($cidades);

        // o form de inclusão e edição são os mesmos
    		return view('contatos.edit')
          			->with('model',$model)
                ->with('cidades',$cidades)
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
      $model->data_nascimento = $model->data_nascimento ? date('d/m/Y',
                                        strtotime($model->data_nascimento)) : '';

      $cidadesDAO = new CidadesDAO();
      $cidades = $cidadesDAO->all(0);

      // o form de inclusão e edição são os mesmos
      return view('contatos.edit')
              ->with('model',$model)
              ->with('cidades',$cidades)
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

        $all['cpf'] = str_replace('.', '', $all['cpf']);
        $all['cpf'] = str_replace('-', '', $all['cpf']);
        $all['cep'] = str_replace('-', '', $all['cep']);

        //dd($all);
        //str_replace('_', ' ', $str)

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
          'ligou',
          'id_usuario_ligou',
          'data_hora_ligou'
        ]);
        // De novo esse código???
        $all['cpf'] = str_replace('.', '', $all['cpf']);
        $all['cpf'] = str_replace('-', '', $all['cpf']);
        $all['cep'] = str_replace('-', '', $all['cep']);

        if ($editando){
          $data_nascimento = Carbon\Carbon::createFromFormat('d/m/Y', $all['data_nascimento'])->toDateString();
          $all['data_nascimento'] = $data_nascimento;

          $retorno = $this->dao->update($id,$all);
        } else {
          $data_nascimento = Carbon\Carbon::createFromFormat('d/m/Y', $all['data_nascimento']);
          $all['data_nascimento'] = $data_nascimento;
          //Remover `id_usuario_ligou`, `data_hora_ligou`
          $retorno = $this->dao->insert($all);
          //dd($retorno);
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

    // GET /contatos/ligar
    // Liga para o contato
    public function ligar(Request $request)
    {
      //dd('chamou contatos/ligar post');

      $nome_contato = $request->input('nome_contato');
      $id_contato = $request->input('id_contato');

      $retorno = $this->dao->ligar($id_contato);
      //dd($retorno);

      return redirect('contatos')->with('mensagem','Ligação efetuada com sucesso para ['.
      $nome_contato.'] ');
    }

    public function imprimir(Request $request){
      //$pdf = App::make('dompdf.wrapper');
      //$pdf->loadHTML('<h1>Test</h1>');
      //return $pdf->stream();
      //return $pdf->download('teste.pdf');

      $query = new PetraOpcaoFiltro();
      PetraInjetorFiltro::injeta($request, $query);

      //dd($query->getValorPrincipalFormatado());

      $model = $this->dao->listagemComFiltro($query);
      // Carrega parâmetros do get (query params)
      foreach ($request->query as $key => $value){
         $model->appends([$key => $value]);
      }

      //$model->setPath('custom/url');
      $view = view("contatos.imprimir")
        ->with('model',$model)
        ->with('query',$query)
        ->with('pesquisa',$this->dao->getCamposPesquisa())
        ->with('titulo','Listagem de Contatos')->render();

        //dd($view);

        $pdf = PDF::loadView($view);
        return $pdf->stream();




      $query = new PetraOpcaoFiltro();
      PetraInjetorFiltro::injeta($request, $query);

      //dd($query->getValorPrincipalFormatado());

      $model = $this->dao->listagemComFiltro($query);
      // Carrega parâmetros do get (query params)
      // foreach ($request->query as $key => $value){
      //    $model->appends([$key => $value]);
      // }

      $view =  View::make('contatos.index', ['model' => $model])->render();

      //$model->setPath('custom/url');
      // return view("contatos.index")
      //   ->with('model',$model)
      //   ->with('query',$query)

      $pdf = PDF::loadView($view);
      return $pdf->stream();

      //return $pdf->download('invoice.pdf');


      $pdf = PDF::loadView('contatos.index', $model);
      return $pdf->download('invoice.pdf');

      //return PDF::loadFile(public_path().'/myfile.html')->save('/path-to/my_stored_file.pdf')->stream('download.pdf');

      // PDF::loadHTML($html)->setPaper('a4', 'landscape')->setWarnings(false)->save('myfile.pdf')
    }

    // Não serve para nada. Veja store
    public function update(Request $request, $id){}

    // Não está sendo utilizado
    public function show($id){}
}
// 'end_date' => Carbon::now()->addDays(10)
