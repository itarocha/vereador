@extends('layouts.default')
@section('content')

<div>
  <a href="/cidades/create" class="btn btn-primary">Nova Cidade</a>
</div>

@if (count($model) > 0)

<div class="container-fluid">
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
{{ $model->links() }}
</div>
@endif

@stop

<!-- <php echo $var->format('m/d/Y H:i'); > -->
