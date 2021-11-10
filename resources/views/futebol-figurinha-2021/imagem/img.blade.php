<html>
	<head>
		<title>@yield("titulo")</title>
		<meta charset="utf-8"/>
		<link rel="stylesheet" href="{{ asset('css/bootstrap.css')}}"/>
		<link rel="stylesheet" href="{{ asset('css/magnific-popup.css')}}"/>
	</head>
	<body>
		
		<div class = "conteiner col-2">
			@if(Session::get("status") == "salvo")
			<div class = "alert alert-success" role = "alert">
				<strongs>Salvo com sucesso</strongs>
			</div>
			@endif
			
			@if(Session::get("status") == "atualizado")
			<div class = "alert alert-sucess" role = "alert"> 
				<strongs>Atualizado com sucesso</strongs>
			</div>
			@endif
			
			@if(Session::get("status") == "excluido")
			<div class = "alert alert-danger" role = "alert"> 
				<strongs>Excluido com sucesso</strongs>
			</div>
			@endif
			
			<form action = "/imagem" method = "post" enctype = "multipart/form-data">
				<div>
					<input type = "file" name = "url" class="form-control"/>
				</div>	
				<div>
					<input type = "submit" value  = "Salvar"/>
				</div>	
				@csrf
				<input type = "hidden" name = 'clube' value = "{{$clube}}"/>
			</form>
		</div>
		<div class = "conteiner col-2">
			<table>
				<thead>
					<th>Imagem</th>
					<th colspan = "2">Exluir</th>
				</thead>
				<tbody>
					@foreach($imagens as $imagem)
					<tr>
						<td><img src = "{{asset($imagem->url);}}" width = "100px"/></td>
						<td>
							<form method = "POST" action = "/imagem/{{$imagem->id}}">
								<input type = "hidden" name = "_method" value = "DELETE"/> 
								@csrf
								<input type = "submit" id = "excluirBotao" value = "Excluir"/>
							</form>
						</td>
					<tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</body>
	<script src="{{asset('js/jquery.js');}}"></script>
	<script src="{{asset('js/magnific-popup.js');}}"></script>

</html>