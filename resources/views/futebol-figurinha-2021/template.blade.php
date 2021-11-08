<html>
	<head>
		<title>@yield("titulo")</title>
		<meta charset="utf-8"/>
		<link rel="stylesheet" href="{{ asset('css/bootstrap.css')}}"/>
	</head>
	<body>
		<div class = "card">
			<h1><p>Em produção</p></h1>
		</div>
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
		
		@yield("cadastro")
		@yield("listagem")
	</body>
</html>