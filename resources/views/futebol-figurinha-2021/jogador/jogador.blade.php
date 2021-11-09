@extends ("futebol-figurinha-2021.template")
@section("titulo", "Jogadores")
@section("cadastro")
	<div class = "conteiner col-2">
		<form class = "row-2"action = "/jogador" method = "post">
			<div>
				<label for  = "campoNome">Nome do jogador</label>
				<input type = "text" id = "campoNome" name = "nome_jogador" value = "{{$jogador->nome_jogador}}"/>
			</div>
			<div>
				<label for  = "campoData">Data de nascimento</label>
				<input type = "date" id = "campoData" name = "data_nascimento" value = "{{$jogador->data_nascimento}}"/>
			</div>
			<div>
				<label>Clube</label>
				<select id = "selecaoClube" name = "clube" >
					@foreach($clubes as $clube)	
						@if($jogador->clube == $clube->id)
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
						@if($jogador->posicao == $posicao->id)
							<option value = "{{$posicao->id}}" selected = "selected">{{$posicao->pos}}</option>
						@else
							<option value = "{{$posicao->id}}" >{{$posicao->pos}}</option>
						@endif
					@endforeach
				</select>
			</div>
			<div>
				<input type = "submit" value  = "Salvar"/>
			</div>	
			@csrf
			<input type = "hidden" name = 'id' value = "{{$jogador->id}}"/>
			<input type = "hidden" name = 'ehColecao' value = "{{$jogador->ehColecao}}"/>
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
				<td>{{$jogador->ehColecao}}</td>
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
