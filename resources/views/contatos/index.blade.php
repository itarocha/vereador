@extends('layouts.tema')
@section('content')

<a href="/contatos/create" class="btn btn-primary">Novo Contato</a>
<div class="container-fluid">
<!-- <div class="row">
  </div> -->
  <form method="GET" class="navbar-form navbar-left" role="search">
    <div class="form-group">
      <select class="form-control" name="q_campo">
        <option value="nome" {{ ($q and $q[0] == 'nome') ? 'selected="selected"' : '' }}>Cidade</option>
        <option value="uf" {{ ($q and $q[0] == 'uf') ? 'selected="selected"' : '' }}>UF</option>
      </select>
      <select class="form-control" name="q_opcao">
        <option value="igual" {{ ($q and $q[1] == 'igual') ? 'selected="selected"' : '' }}>Igual a</option>
        <option value="like" {{ ($q and $q[1] == 'like') ? 'selected="selected"' : '' }}>Semelhante a</option>
        <option value="diferente" {{ ($q and $q[1] == 'diferente') ? 'selected="selected"' : '' }}>Diferente de</option>
      </select>
      <input type="text" class="form-control" placeholder="Conteúdo" name="q_valor"
        value="{{ $q ? $q[2] : '' }}">
    </div>
    <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Pesquisar</button>
  </form>


@if (count($model) > 0)
		<table class="table table-bordered table-striped">
			<thead>
				<tr>
          <th>Nome</th>
          <th>Nascimento</th>
          <th>Cidade</th>
          <th>Bairro</th>
          <th>Situação</th>
					<th>Ações</th>
				</tr>
			</thead>
			<tbody>
			@foreach($model as $item)
				<tr>
          <td>{{ $item->nome }}</td>
          <td>{{ date('d/m/Y', strtotime($item->data_nascimento))   }}</td>
          <td>{{ $item->nome_cidade }}</td>
          <td>{{ $item->nome_bairro }}</td>
          <td>
            @if($item->ligou == 'S')
            <span class="label label-success pull-down pull-down-right">Ligou</span>
            @else
            <span class="label label-danger pull-down pull-down-right">Não Ligou</span>
            @endif
          </td>
					<td>
						<a href="/contatos/{{ $item->id }}/edit" class="btn btn-xs btn-info">Editar</a>
						<a href="/contatos/{{ $item->id }}/delete" class="btn btn-xs btn-danger">Excluir</a>
					</td>
				</tr>
			@endforeach
			</tbody>
		</table>
{!! $model->links() !!}
@else
<div class="row">
    <div class="col-md-12 alert alert-warning" role="alert">
      <p>Nenhum registro encontrado</p>
    </div>
</div>

@endif
</div>

@stop

<!-- <php echo $var->format('m/d/Y H:i'); > -->
