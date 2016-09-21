@section('content')


<div id="container-main" class="container-fluid">
<!-- <div class="row">
  </div> -->
@if (count($model) > 0)
		<table class="table table-bordered table-striped">
			<thead>
				<tr>
          <th>Contato</th>
          <th>Localização</th>
          <th>Situação</th>
					<th>Ações</th>
				</tr>
			</thead>
			<tbody>
			@foreach($model as $item)
				<tr>
          <td>
            <h3 class="text-warning">{{ $item->nome }}</h3>
            <p class="info small">{{ date('d/m/Y', strtotime($item->data_nascimento)) }}</p>
          </td>
          <td><h4>{{ $item->nome_bairro }}</h4>
            <p class="info small">{{ $item->nome_cidade }}-{{ $item->uf }}</p>
          </td>
          <td>
            @if($item->ligou == 'S')
            <p class="info small"> Ligou {{ date('d/m/Y', strtotime($item->data_hora_ligou)) }} - {{ $item->nome_usuario_ligou }}</p>
            @else
            <span class="label label-danger pull-down pull-down-right">Não Ligou</span>
            @endif
          </td>
					<td>
						<a href="/contatos/{{ $item->id }}/edit" class="btn btn-sm btn-default"><span class="text-info fa fa-edit fa-fw"></span> Editar</a>
						<a href="/contatos/{{ $item->id }}/delete" class="btn btn-sm btn-default"><span class="text-danger fa fa-trash-o fa-fw"></span> Excluir</a>
            @if($item->ligou == 'N')
            <a class="btn btn-sm btn-default" role="button" data-id="{{ $item->id }}" data-nome="{{ $item->nome }}"
               data-toggle="modal" data-target="#myModal"><span class="text-info fa fa-phone fa-fw"></span> Ligar</a>
            @endif
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
