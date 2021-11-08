@extends ("futebol-figurinha-2021.template")
@section("titulo", "Posições")
@section("cadastro")
	<div class = "conteiner col-2">
		<form class = "row-2"action = "/posicao" method = "post">
			<div>
				<label for  = "campoPos">Posicao</label>
				<input type = "text" id = "campoPos" name = "pos" value = "{{$posicao->pos}}"/>
			</div>	
			<div>
				<label for  = "campoDesc">Descrição</label>
				<input type = "text" id = "campoDesc" name = "desc" value = "{{$posicao->descricao}}"/>
     		</div>	
			<div>
				<input type = "submit" value  = "Salvar"/>
			</div>	
			@csrf
			<input type = "hidden" name = 'id' value = "{{$posicao->id}}"/>
		</form>
	</div>
@endsection
@section("listagem")
	<table>
		<thead>
			<th>Posicão</th>
			<th>Descricão</th>
			<th colspan = "2">Ações</th>
		</thead>
		<tbody>
			@foreach($posicoes as $posicao)
			<tr>
				<td>{{$posicao->pos}}</td>
				<td>{{$posicao->descricao}}</td>
				<td><a href = "/posicao/{{$posicao->id}}/edit">Editar</a><td/>
				<td>
					<form method = "POST" action = "/posicao/{{$posicao->id}}">
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
