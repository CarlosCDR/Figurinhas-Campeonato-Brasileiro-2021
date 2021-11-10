@extends ("futebol-figurinha-2021.template")
@section("titulo", "Times")
@section("cadastro")
	<div class = "conteiner col-2">
		<form class = "row-2"action = "/clube" method = "post">
			
			<input type = "hidden" name = 'id' value = "{{$clube->id}}"/>
			<div>
				<label for  = "campoNome">Nome do clube</label>
				<input type = "text" id = "campoNome" name = "nome_clube" value = "{{$clube->nome_clube}}"/>
			</div>	
			<div>
				<input type = "submit" value  = "Salvar"/>
			</div>	
			@csrf
		</form>
	</div>
@endsection
@section("listagem")
	<table>
		<thead>
			<th>Nome do clube</th>
			<th> Escudo </th>
			<th colspan = "2">Ações</th>
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
						
						<td><a href = "/imagem/{{$clube->id}}" class = "imagem">Adicionar escudo</a></td>
					<?php }	?>
					<td><a href = "/clube/{{$clube->id}}/edit" >Editar</a></td>
						
					<td>
						<form method = "POST" action = "/clube/{{$clube->id}}">
							<input type = "hidden" name = "_method" value = "DELETE"/> 
							@csrf
							<input type = "submit" id = "excluirBotao" value = "Excluir"/>
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