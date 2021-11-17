<html>
	<head>
		<title>@yield("titulo")</title>
		<meta charset="utf-8"/>
		<link rel="stylesheet" href="{{ asset('css/bootstrap.css')}}"/>
		<link rel="stylesheet" href="{{ asset('css/magnific-popup.css')}}"/>
	</head>
	<body>
		 <nav class="navbar navbar-expand-lg navbar navbar-dark bg-dark">
			<a class="navbar-brand" href="/home">Figurinhas</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
			  <ul class="navbar-nav mr-auto">
				<li class="nav-item active">
				  <a class="nav-link" href="/home">Home <span class="sr-only"></span></a>
				</li>
				<li class="nav-item">
				  <a class="nav-link" href="/posicao">Posição</a>
				</li>
				<li class="nav-item">
				  <a class="nav-link" href="/clube">Clubes</a>
				</li>
				<li class="nav-item">
				   <a class="nav-link" href="/jogador">Jogadores</a>
				</li>
			  </ul>
			</div>
		 </nav>
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
		@if(Session::get("status") == "adicionado")
		<div class = "alert alert-sucess" role = "alert"> 
			<strongs>Adicionado a coleção</strongs>
		</div>
		@endif
		@if(Session::get("status") == "excluido")
		<div class = "alert alert-danger" role = "alert"> 
			<strongs>Excluido com sucesso</strongs>
		</div>
		@endif
		
		
		@if(Session::get("status") == "erro_data")
		<div class = "alert alert-error" role = "alert"> 
			<strongs>A data é invalida. Verifique a sua data de nascimento</strongs>
		</div>
		@endif
		@if(Session::get("status") == "erro_exc")
		<div class = "alert alert-error" role = "alert"> 
			<strongs>Não foi possivel exluir o item. Existem elementos que dependem dele</strongs>
		</div>
		@endif
		
		@yield("cadastro")
		@yield("listagem")
	</body>
	<script src="{{asset('js/jquery.js');}}"></script>
	<script src="{{asset('js/magnific-popup.js');}}"></script>
	
</html>