@extends ("futebol-figurinha-2021.template")
@section("titulo", "Jogadores")
@section("cadastro")
	<div class = "conteiner col-2">
		<form class = "row-2"action = "/jogador" method = "post">
			<div>
				<label for  = "campoNome">Nome do jogador</label>
				<input type = "text" id = "campoNome" name = "nome_jogador" value = "{{$jogado->nome_jogador}}"/>
			</div>
			<div>
				<label for  = "campoData">Data de nascimento</label>
				<input type = "date" id = "campoData" name = "data_nascimento" value = "{{$jogado->data_nascimento}}"/>
			</div>
			<div>
				<label>Clube</label>
				<select id = "selecaoClube" name = "clube" >
					@foreach($clubes as $clube)	
						@if($jogado->clube == $clube->id)
							<option value = "{{$clube->id}}" selected = "selected">{{$clube->nome_clube}}</option>
						@else
							<option value = "{{$clube->id}}" >{{$clube->nome_clube}}</option>
						@endif
					@endforeach
				</select>
			</div>
			<div>
				<label>Posicao</label>
				<select id = "selecaoPosicao" name = "posicao" >
					@foreach($posicoes as $posicao)	
						@if($jogado->posicao == $posicao->id)
							<option value = "{{$posicao->id}}" selected = "selected">{{$posicao->pos}}</option>
						@else
							<option value = "{{$posicao->id}}" >{{$posicao->pos}}</option>
						@endif
					@endforeach
				</select>
			</div>
			<div>
				<input type = "submit" value  = "Salvar"/>
				<input type = "hidden" name = 'id' value = "{{$jogado->id}}"/>
				<input type = "text" name = 'ehColecao' value = "{{$jogado->ehColecao}}"/>
				<button class="btn bg-gradient-info" type="button" onclick="location.href='/jogador';">Novo</button>
			
			</div>	
			@csrf
			
		</form>
	</div>
@endsection
@section("listagem")
	<table>
		<thead>
			<th>Nome do jogador</th>
			<th>Data de nascimento</th>
			<th>Posicão</th>
			<th>Clube</th>
			<th>Esta na cloeção?</th>
			<th colspan = "2">Ações</th>
		</thead>
		<tbody>
			@foreach($jogadores as $jogador)
			<tr>
				
				<td>{{$jogador->nome_jogador}}</td>
				<td>{{$jogador->data_nascimento}}</td>
				<td>{{$jogador->posicao}}</td>
				<td>{{$jogador->clube}}</td>
				@if($jogador->colecao == "N")
					<td>
						<form method = "POST" action = "/jogador">
							<input type = "hidden" name = "id" value = "{{$jogador->id}}"/> 
							<input type = "hidden" name = "confirma" value = "S"/>
							<input type = "hidden" name = "acao" value = "att_colecao"/>
							
							<a onclick="this.closest('form').submit();return false;"><img src = "{{asset('img/botao-adicionar.png');}}" width = "25px"/></a>
							@csrf
						</form>
					</td>
				@else
					<td><img src = "{{asset('img/confirmado.png');}}" width = "25px"/></td>
				@endif
				<td><a href = "/jogador/{{$jogador->id}}/edit">Editar</a><td/>
				<td>
					<form method = "POST" action = "/jogador/{{$jogador->id}}">
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
