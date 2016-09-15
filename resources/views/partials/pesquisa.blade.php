<script>
  $(document).ready(function() {
    var p = {!! json_encode($pesquisa) !!};
    var query = {!! json_encode($query) !!};
    var comparacao = [{"display":"Igual a", "name":"igual"},
                      {"display":"Semelhante a", "name":"semelhante"},
                      {"display":"Diferente de", "name":"diferente"} ];
    // name, type, display

    // Montagem dos campos de seleção
    var q_campo = $('#q_campo');
    q_campo.html('');
    p.forEach(function(data){
      var option = $('<option></option>');
      q_campo.append(
          option.val(data.name).html(data.display));
          if (data.name == query.campo) {
              option.attr('selected', 'selected');
          }
    }); // end forEach

    // Montagem dos operadores
    var q_operador = $('#q_operador');
    q_operador.html('');
    comparacao.forEach(function(data){
      var option = $('<option></option>');
      q_operador.append(
          option.val(data.name).html(data.display));
          if (data.name == query.operador) {
              option.attr('selected', 'selected');
          }
    }); // end forEach

    // Valor selecionado
    $('#q_valor_principal').val(query.valor_principal);
  });
</script>

<form method="GET" class="navbar-form navbar-left" role="search">
  <div class="form-group">
    <select class="form-control" id="q_campo"  name="q_campo"></select>
    <select class="form-control" id="q_operador" name="q_operador"></select>
    <input type="text" class="form-control" placeholder="Conteúdo" id="q_valor_principal" name="q_valor_principal">
    <input type="text" class="form-control" placeholder="Complemento" id="q_valor_complemento" name="q_valor_complemento" style="display:none">
  </div>
  <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Pesquisar</button>
</form>
