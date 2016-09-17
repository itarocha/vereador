<?php

namespace App\Http\Middleware;

use Closure;

class VerificaPermissoes
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

       // method = GET
       //dd("role is ".$role);

      //  $info = array( 'method'=>$request->method(),
      //                 'pathInfo'=>$request->pathInfo(),
      //                 'requestUri'=>$request->requestUri());

        $rota = $request->route();
        $acao = $rota->getAction();

        //dd($rota);


        if(array_key_exists('as', $acao))
        {
          $request->session()->flash('mensagem','Ação "'.$acao['as'].'"' );
          // cidades.index
          // xxx.create, xxx.delete
          if ($acao['as'] == 'contatos.ligar'){
              $request->session()->flash('msgerro','VOCÊ NÃO PODE LIGAR PARA NINGUÉM. ORA VEJAM SÓ!' );
              return redirect('/home')->with('msgerro','VOCÊ NÃO PODE LIGAR PARA NINGUÉM. ORA VEJAM SÓ! QUE COISA!' );
          }

        } else {
          $request->session()->flash('mensagem','Livre acesso' );
        }

        return $next($request);
    }
}
