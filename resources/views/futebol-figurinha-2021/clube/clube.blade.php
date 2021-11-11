@extends ("futebol-figurinha-2021.template")
@section("titulo", "Clubes")
@section("cadastro")
   <div class="p-3 mb-2 bg-success text-dark">
    <form method="POST" action="/clube">
        <div class="form-row" >
            <div class="form-group col-md-6">
                <label for="campoNome">Nome do clube</label>
                <input type="text" id="campoPos" name="nome_clube"  class="form-control"  value = "{{$clube->nome_clube}}" required="required" />
            </div>
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Salvar</button>
        <br>
        @csrf
        <input type = "hidden" name = 'id' value = "{{$clube->id}}"/>
    </form>
    <img src="{!! asset('img/img14.jpg') !!}" class="img-fluid" alt="Responsive image">
@endsection
@section("listagem")
	<table class="table">
		<thead class="thead-dark">
			<th scope="col">Nome do clube</th>
			<th scope="col"> Escudo </th>
			<th scope="col" colspan = "2">Ações</th>
		</thead>
		<tbody>
			@foreach($clubes as $clube)
				<tr>
					<?php $escudo = false;?>
					
					<td>{{$clube->nome_clube}}</td>
					@foreach($compare as $compara)
						@if($clube->id == $compara->id)
							<?php $escudo = true; ?>
							@break
						@endif	
				    @endforeach
					<?php if($escudo == true){ ?>
						<td><img src = "{{asset($compara->url);}}" width = "100px"/></td>
					<?php }else{ ?>
						
						<td><a href = "/imagem/{{$clube->id}}" class = "btn btn-dark imagem" style="text-decoration:none">Adicionar escudo</a></td>
					<?php }	?>
					<td><a href = "/clube/{{$clube->id}}/edit" class="btn btn-dark" style="text-decoration:none">Editar</a></td>
						
					<td>
						<form method = "POST" action = "/clube/{{$clube->id}}">
							<input type = "hidden" name = "_method" value = "DELETE"/> 
							@csrf
							<input type = "submit" id = "excluirBotao" class="btn btn-danger" value = "Excluir"/>
						</form>
					</td>
				<tr>
				
			@endforeach
		</tbody>
	</table>
@endsection
<script>
	window.addEventListener("load", function(){
		$(document).ready(function(){
			$('.imagem').magnificPopup({
				type: 'iframe'
			});
		});
	});
</script>