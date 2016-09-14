@extends('layouts.tema')
@section('content')

<!-- bairros.index -->

<script>
var p = {!! json_encode($pesquisa) !!};
</script>

<div>
  <a href="/bairros/create" class="btn btn-primary">Novo Bairro</a>
</div>

@if (count($model) > 0)
<div class="container-fluid">
		<table class="table table-bordered table-striped">
			<thead>
				<tr>
          <th>Bairro</th>
          <th>Cidade</th>
          <th>UF</th>
					<th>Ações</th>
				</tr>
			</thead>
			<tbody>
			@foreach($model as $item)
				<tr>
          <td>{{ $item->nome }}</td>
          <td>{{ $item->cidade_nome }}</td>
          <td>{{ $item->uf }}</td>
					<td>
						<a href="/bairros/{{ $item->id }}/edit" class="btn btn-xs btn-info">Editar</a>
						<a href="/bairros/{{ $item->id }}/delete" class="btn btn-xs btn-danger">Excluir</a>
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
