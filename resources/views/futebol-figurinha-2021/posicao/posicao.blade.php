@extends ("futebol-figurinha-2021.template")
@section("titulo", "Posições")
@section("cadastro")
  <div class="p-3 mb-2 bg-success text-dark">
    <form method="POST" action="/posicao">
        <div class="form-row" >
            <div class="form-group col-md-6">
                <label for="campoPos">Posição</label>
                <input type="text" id="campoPos" name="pos"  class="form-control"  value = "{{$posicao->pos}}" required="required" />
            </div>
            <div class="form-group col-md-6">
                <label for="campoDesc">Descrição</label>
                <input type="text" id="campoDesc" name = "desc" class="form-control"  value = "{{$posicao->descricao}}" required="required" />
            </div>
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Salvar</button>
        <br>
        @csrf
        <input type = "hidden" name = 'id' value = "{{$posicao->id}}"/>
    </form>
 
    <img src="{!! asset('img/img2.png') !!}" class="img-fluid" alt="Responsive image">
@endsection
@section("listagem")
 <table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Posições</th>
      <th scope="col">Descrição</th>
      <th scope="col">Ações</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      @foreach($posicoes as $posicao)
			<tr>
				<td>{{$posicao->pos}}</td>
				<td>{{$posicao->descricao}}</td>
				<td><a href = "/posicao/{{$posicao->id}}/edit" class="btn btn-dark" style="text-decoration:none">Editar</a><td/>
				<td>
					<form method = "POST" action = "/posicao/{{$posicao->id}}">
						<input type = "hidden" name = "_method" value = "DELETE"/> 
						@csrf
						<input type = "submit" class="btn btn-danger" id = "excluirBotao" value = "Excluir"/>
					</form>
				</td>
			<tr>
			@endforeach
    </tr>  
  </tbody>
</table>
@endsection
</div>