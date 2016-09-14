<script>
  $(document).ready(function() {
    var p = {!! json_encode($pesquisa) !!};
    var query = {!! json_encode($q) !!};
    var comparacao = [{"display":"Igual a", "name":"igual"},
                      {"display":"Semelhante a", "name":"like"},
                      {"display":"Diferente de", "name":"diferente"} ];

    var campo_selecionado = ((query.length > 0) ? query[0] : '');
    var opcao_selecionada = ((query.length > 1) ? query[1] : '');
    var valor_selecionado = ((query.length > 2) ? query[2] : '');

    // name, type, display

    // Montagem dos campos de seleção
    var q_campo = $('#q_campo');
    q_campo.html('');
    p.forEach(function(data){
      var opcao = $('<option></option>');
      q_campo.append(
          opcao.val(data.name).html(data.display));
          if (data.name == campo_selecionado) {
              opcao.attr('selected', 'selected');
          }
    }); // end forEach

    // Montagem das opções
    var q_opcao = $('#q_opcao');
    q_opcao.html('');
    comparacao.forEach(function(data){
      var opcao = $('<option></option>');
      q_opcao.append(
          opcao.val(data.name).html(data.display));
          if (data.name == opcao_selecionada) {
              opcao.attr('selected', 'selected');
          }
    }); // end forEach

    // Valor selecionado
    $('#q_valor').val(valor_selecionado);
  });
</script>

<form method="GET" class="navbar-form navbar-left" role="search">
  <div class="form-group">
    <select class="form-control" id="q_campo"  name="q_campo"></select>
    <select class="form-control" id="q_opcao" name="q_opcao"></select>
    <input type="text" class="form-control" placeholder="Conteúdo" id="q_valor" name="q_valor">
  </div>
  <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Pesquisar</button>
</form>
