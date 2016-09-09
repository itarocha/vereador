@extends('layouts.default')
@section('content')

<div class="container-fluid">
  <div class="row">
    <a href="/cidades/create" class="btn btn-primary">Nova Cidade</a>
  </div>
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
		<table class="table table-striped">
			<thead>
				<tr>
          <th>Nome</th>
          <th>UF</th>
					<th>Ações</th>
				</tr>
			</thead>
			<tbody>
			@foreach($model as $item)
				<tr>
          <td>{{ $item->nome }}</td>
          <td>{{ $item->uf }}</td>
					<td>
						<a href="/cidades/{{ $item->id }}/edit" class="btn btn-xs btn-info">Editar</a>
						<a href="/cidades/{{ $item->id }}/delete" class="btn btn-xs btn-danger">Excluir</a>
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
