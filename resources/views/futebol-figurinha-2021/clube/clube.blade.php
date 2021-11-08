@extends ("futebol-figurinha-2021.template")
@section("titulo", "Times")
@section("cadastro")
	<div class = "conteiner col-2">
		<form class = "row-2"action = "/clube" method = "post">
			<div>
				<label for  = "campoNome">Nome do clube</label>
				<input type = "text" id = "campoNome" name = "nome_clube" value = "{{$clube->nome_clube}}"/>
			</div>	
			<div>
				<input type = "submit" value  = "Salvar"/>
			</div>	
			@csrf
			<input type = "hidden" name = 'id' value = "{{$clube->id}}"/>
		</form>
	</div>
@endsection
@section("listagem")
	<table>
		<thead>
			<th>Nome do clube</th>
			<th colspan = "2">Ações</th>
		</thead>
		<tbody>
			@foreach($clubes as $clube)
			<tr>
				<td>{{$clube->nome_clube}}</td>
				<td><a href = "/clube/{{$clube->id}}/edit">Editar</a><td/>
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
