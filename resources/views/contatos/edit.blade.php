<!-- cidades.edit -->
@extends('layouts.tema')
@section('content')

<script>
$(function(){
	$("#nome").focus();
});
</script>

<!-- {{ Auth::user()->id }} -->

<form action="/contatos" method="POST">
   {{ csrf_field() }}
	 <input type="hidden" id="id" name="id" value="{{ $model->id }}">
	 <input type="hidden" id="ligou" name="ligou" value="{{ $model->ligou }}">
	 <input type="hidden" id="id_usuario_cadastro" name="id_usuario_cadastro" value="{{ $model->id_usuario_cadastro }}">
	 <input type="hidden" id="data_hora_cadastro" name="data_hora_cadastro" value="{{ $model->data_hora_cadastro }}">
	 <div class="row">
     <div class="col-md-6">
       <label for="nome" class="input-label f-left">Nome:</label>
       <input type="text" class="input-text f-left" id="nome" name="nome" value="{{ $model->nome }}">
     </div>

 		<div class="col-md-3">
       <label for="data_nascimento" class="input-label f-left">Data Nascimento:</label>
       <input type="text" class="input-text f-left" id="data_nascimento" name="data_nascimento" value="{{ $model->data_nascimento }}">
     </div>

 		<div class="col-md-3">
       <label for="cpf" class="input-label f-left">CPF:</label>
       <input type="text" class="input-text f-left" id="cpf" name="cpf" value="{{ $model->cpf }}">
     </div>
   </div> <!-- end linha -->
	 <div class="row">
     <div class="col-md-6">
       <label for="titulo" class="input-label f-left">Título de Eleitor:</label>
       <input type="text" class="input-text f-left" id="titulo" name="titulo" value="{{ $model->titulo }}">
     </div>

 		<div class="col-md-3">
       <label for="secao" class="input-label f-left">Seção:</label>
       <input type="text" class="input-text f-left" id="secao" name="secao" value="{{ $model->secao }}">
     </div>

 		<div class="col-md-3">
       <label for="zona" class="input-label f-left">Zona:</label>
       <input type="text" class="input-text f-left" id="zona" name="zona" value="{{ $model->zona }}">
     </div>
   </div> <!-- end linha -->
	 <div class="row">
     <div class="col-md-6">
       <label for="endereco" class="input-label f-left">Endereço:</label>
       <input type="text" class="input-text f-left" id="endereco" name="endereco" value="{{ $model->endereco }}">
     </div>

 		<div class="col-md-1">
       <label for="secao" class="input-label f-left">Número:</label>
       <input type="text" class="input-text f-left" id="numero" name="numero" value="{{ $model->numero }}">
     </div>

 		<div class="col-md-5">
       <label for="zona" class="input-label f-left">Complemento:</label>
       <input type="text" class="input-text f-left" id="complemento" name="complemento" value="{{ $model->complemento }}">
     </div>
   </div> <!-- end linha -->

	 <div class="row">
     <div class="col-md-8">
       <label for="endereco" class="input-label f-left">Bairro:</label>
       <input type="text" class="input-text f-left" id="id_bairro" name="id_bairro" value="{{ $model->id_bairro }}">
     </div>

 		<div class="col-md-4">
       <label for="secao" class="input-label f-left">CEP:</label>
       <input type="text" class="input-text f-left" id="cep" name="cep" value="{{ $model->cep }}">
     </div>
   </div> <!-- end linha -->

	 <div class="row">
		 <div class="col-md-4">
       <label for="telefone1" class="input-label f-left">Telefone 1:</label>
       <input type="text" class="input-text f-left" id="telefone1" name="telefone1" value="{{ $model->telefone1 }}">
     </div>

		 <div class="col-md-4">
       <label for="telefone2" class="input-label f-left">Telefone 2:</label>
       <input type="text" class="input-text f-left" id="telefone2" name="telefone2" value="{{ $model->telefone2 }}">
     </div>

		 <div class="col-md-4">
       <label for="telefone3" class="input-label f-left">Telefone 3:</label>
       <input type="text" class="input-text f-left" id="telefone3" name="telefone3" value="{{ $model->telefone3 }}">
     </div>
   </div> <!-- end linha -->

	 <div class="row">
		 <div class="col-md-8">
       <label for="telefone4" class="input-label f-left">Telefone 4:</label>
       <input type="text" class="input-text f-left" id="telefone4" name="telefone4" value="{{ $model->telefone4 }}">
     </div>

		 <div class="col-md-4">
       <label for="telefone5" class="input-label f-left">Telefone 5:</label>
       <input type="text" class="input-text f-left" id="telefone5" name="telefone5" value="{{ $model->telefone5 }}">
     </div>
   </div> <!-- end linha -->

  <div class="row">
    <div class="col-md-12 pt-20">
     <input type="submit" class="btn btn-success" value="Gravar">
     <a href="/contatos" class="btn btn-default">Voltar</a>
    </div>
  </div>
</form>
</div>
@stop
