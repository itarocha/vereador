<!DOCTYPE html>
<html lang="pt-br">
    <head>

      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
      <title>{{ env('APP_TITLE') }}</title>

       <link href="{{ URL::asset('css/complemento.css') }}" rel="stylesheet">

      <!-- Bootstrap -->
      <!-- Latest compiled and minified CSS -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <!-- Optional theme -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">

      <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
      <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
      <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->

      <link href="/css/starter-template.css" rel="stylesheet">

      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    </head>
  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Um Vereador de Verdade</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="/">Principal</a></li>
            <li><a href="/contatos">Contatos</a></li>
            <li><a href="/cidades">Cidades</a></li>
            <li><a href="/bairros">Bairros</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>


    <div class="container">
      <div>
        <h2>{{ isset($titulo) ? $titulo : 'Bem-Vindo' }}</h2>
      </div>

      @if(count($errors) > 0 )
      <div class="row">
          <div class="col-md-12 alert alert-danger" role="alert">
                 @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
          </div>
      </div>
      @endif

      @yield('content')

    </div><!-- /.container -->

    <!-- <footer class="bs-docs-footer" role="contentinfo">
        <div class="row">
            <div class="col-sd-8">
                Laboratório Linx - Sistemas para Tudo<br/>
                Rua Beleza dos Santos Granero, 5000 . Jardim Patrícia . Uberlândia MG . CEP 38230-511<br/>
                Tel.: (34) 3230 1520 . Fax: (34) 3251 0766
            </div>
        </div>
    </footer> -->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>


</body>
</html>
