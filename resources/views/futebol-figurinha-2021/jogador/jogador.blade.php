@extends ("futebol-figurinha-2021.template")
@section("titulo", "Jogadores")
@section("cadastro")
	<div class = "p-3 mb-2 bg-secondary text-dark conteiner col-15">
		<form class = "row-2"action = "/jogador" method = "post">
			<div class="form-group col-md-6">
				<label class="h5" for  = "campoNome">Nome do jogador</label>
				<input type = "text" required="required" class="form-control" id = "campoNome" name = "nome_jogador" value = "{{$atleta->nome_jogador}}"/>
			</div>
			<div class="form-group col-md-6">
				<label class="h5" for  = "campoData">Data de nascimento</label>
				<input type = "date" required="required" class="form-control" id = "campoData" name = "data_nascimento" value = "{{$atleta->data_nascimento}}"/>
			</div>
			<div class="form-group col-md-6">
				<label class="h5">Clube</label>
				<select id = "selecaoClube" required="required" class="form-control" name = "clube" >
					<option value = "" selected = "selected">Selecione um clube</option>
				
				@foreach($clubes as $clube)	
						@if($atleta->clube == $clube->id)
							<option value = "{{$clube->id}}" selected = "selected">{{$clube->nome_clube}}</option>
						@else
							<option value = "{{$clube->id}}" >{{$clube->nome_clube}}</option>
						@endif
					@endforeach
				</select>
			</div>
			<div class="form-group col-md-6">
				<label class="h5">Posicao</label>
				<select id = "selecaoPosicao" required="required" class="form-control" name = "posicao" >
					<option value = "" selected = "selected">Selecione uma posição</option>
					
					@foreach($posicoes as $posicao)	
						@if($atleta->posicao == $posicao->id)
							<option value = "{{$posicao->id}}" selected = "selected">{{$posicao->pos}}</option>
						@else
							<option value = "{{$posicao->id}}" >{{$posicao->pos}}</option>
						@endif
					@endforeach
				</select>
				
			</div>
			<div class="form-check">
				@if($separado == "sim" || $atleta->ehColecao == "s")
					<input type = "checkbox" class="form-check-input" id = "ehCol" name = "ehColecao" checked/>
				@else
					<input type = "checkbox"  class="form-check-input" id = "ehCol" name = "ehColecao" />
				@endif
				<label class="form-check-label" for = "ehCol">Esta na coleção?</label>
				
			</div>
			<div class="form-group col-md-6">
				<input type = "submit" class = "btn btn-primary mb-2 col-md-1" value  = "Salvar"/>
				<input type = "hidden" name = 'id' value = "{{$atleta->id}}"/>
				<button class="btn btn-success mb-2 col-md-1" type="button" onclick="location.href='/jogador';">Novo</button>
			</div>	
			@csrf
			
		</form>
	</div>
@endsection
@section("listagem")
	<table class ="table">
		<thead class="thead-dark">
			<th scope="col" class="h5">Nome do jogador</th>
			<th scope="col" class="h5">Data de nascimento</th>
			<th scope="col" class="h5">Posicao</th>
			<th scope="col" class="h5">Clube</th>
			<th scope="col" class="h5">Esta na coleção?</th>
			<th  scope="col" class="h5" colspan = "2">Ações</th>
		</thead>
		<tbody>
			@foreach($jogadores as $jogador)
			<tr>
				
				<td>{{$jogador->nome_jogador}}</td>
				<td>{{$jogador->data_nascimento}}</td>
				<td>{{$jogador->posicao}}</td>
					<?php $clube = false;?>
					@foreach($escudos as $escudo)
						@if($jogador->idclube == $escudo->clube)
							<?php $clube = true; ?>
							@break
						@endif	
				    @endforeach
					@if($clube == true)
						<td><img src = "{{asset($escudo->url);}}" width = "50px"/></td>
					@endif
				@if($jogador->colecao == "nao")
					<td>
						<form method = "POST" action = "/jogador">
							<input type = "hidden" name = "id" value = "{{$jogador->id}}"/> 
							<input type = "hidden" name = "confirma" value = "S"/>
							<input type = "hidden" name = "acao" value = "att_colecao"/>
							
							<a onclick="this.closest('form').submit();return false;" class="btn btn-primary" style="text-decoration:none">Adquirir</a>
							@csrf
						</form>
					</td>
				@else
					<td><img src = "{{asset('img/confirmado.png');}}" width = "25px" class="img-responsive"/></td>
				@endif
				<td><a href = "/jogador/{{$jogador->id}}/edit" class="btn btn-secondary" style="text-decoration:none">Editar</a><td/>
				<td>
					<form method = "POST" action = "/jogador/{{$jogador->id}}">
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
