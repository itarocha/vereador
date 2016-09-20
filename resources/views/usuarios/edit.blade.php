<!-- cidades.edit -->
@extends('layouts.tema')
@section('content')

<script>
$(function(){
	$("#name").focus();
});
</script>


<form action="/usuarios" method="POST">
   {{ csrf_field() }}
   <input type="hidden" id="id" name="id" value="{{ $model->id }}">


	 <div class="row">
     <div class="col-md-6">
       <label for="name" class="input-label f-left">Nome:</label>
       <input type="text" class="input-text f-left" id="name" name="name" value="{{ $model->name }}">
     </div>

 		<div class="col-md-6">
       <label for="email" class="input-label f-left">E-Mail:</label>
       <input type="text" class="input-text f-left" id="email" name="email" value="{{ $model->email }}">
     </div>
   </div>


	 @if ( $model->id == 0 )
	 <div class="row">
     <div class="col-md-6">
       <label for="password" class="input-label f-left">Senha:</label>
       <input type="password" class="input-text f-left" id="password" name="password">
     </div>

 		<div class="col-md-6">
       <label for="password_confirmation" class="input-label f-left">Confirmação:</label>
       <input type="password" class="input-text f-left" id="password_confirmation" name="password_confirmation">
     </div>
   </div>
	 @endif


	 <div class="row">
		 <div class="col-md-4">
       <label for="isAdmin" class="input-label f-left">Administrador?</label>
       <input type="isAdmin" class="input-text f-left" id="isAdmin" name="isAdmin" value="{{ $model->isAdmin }}">
     </div>

		 <div class="col-md-4">
        <label for="podeIncluir" class="input-label f-left">Pode Incluir Candidato?</label>
        <input type="text" class="input-text f-left" id="podeIncluir" name="podeIncluir"  value="{{ $model->podeIncluir }}">
      </div>

			<div class="col-md-4">
	       <label for="podeAlterar" class="input-label f-left">Pode Alterar Candidato?</label>
	       <input type="text" class="input-text f-left" id="podeAlterar" name="podeAlterar"  value="{{ $model->podeAlterar }}">
	     </div>
   </div>


  <div class="row">
    <div class="col-md-12 pt-20">
     <input type="submit" class="btn btn-success" value="Gravar">
     <a href="/usuarios" class="btn btn-default">Voltar</a>
    </div>
  </div>
</form>
</div>
@stop
