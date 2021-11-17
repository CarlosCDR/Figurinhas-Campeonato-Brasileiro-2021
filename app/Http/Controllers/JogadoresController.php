<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jogador;
use App\Models\Posicao;
use App\Models\Clube;
use App\Models\Imagem;
use Illuminate\Support\Facades\DB;

class JogadoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $atleta = new Jogador();
		$jogadores = DB::table("jogador AS j")->join("posicao AS p","j.posicao", "=","p.id")->join("clube AS c","j.clube", "=","c.id")->select("j.nome_jogador","j.data_nascimento","p.pos AS posicao", "c.nome_clube AS clube", "j.ehColecao AS colecao", "j.id","c.id AS idclube" )->get();
		$escudos = DB::table("clube AS c")->join("imagem AS i","i.clube", "=","c.id")->select("i.clube","i.url AS url")->get();
		$posicoes = Posicao::All();
		$clubes = Clube::All();
		$separado = "";
		return view(
			"futebol-figurinha-2021.jogador.jogador",
			[
				"atleta" => $atleta,
				"jogadores" => $jogadores,
				"posicoes" => $posicoes,
				"clubes" => $clubes,
				"escudos" => $escudos,
				"separado" => $separado
			]
		);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {	
		$notData = false;
		if(!empty($request->get("data_nascimento"))){
			$dtn = $request->get("data_nascimento");
			$partes = explode('-',$dtn);
			$anoNasc = $partes[0];
			$ano = date('Y');
		}else{
			$notData = true;
		}
		if($request->get("acao") != "att_colecao"){		
			if($notData == false){
				if($request->get("id")== ""){
					$jogador = new Jogador();
					$acao = "salvo";
				}else{
					$jogador = Jogador::Find($request->get("id"));
					$acao = "atualizado";
				}
				if($anoNasc <= $ano){
					$jogador->nome_jogador = $request->get("nome_jogador");
					$jogador->data_nascimento  = $request->get("data_nascimento");
					$jogador->posicao = $request->get("posicao");
					$jogador->clube = $request->get("clube");
					$col = $request->get("ehColecao");
					if($col == "on"){
						$col = "sim";
					}else{
						$col = "nao";
					}
					$jogador->ehColecao  = $col;
					$jogador->save();
				}else{
					$acao = "erro_data";
				}
			}else{
				$acao = "erro_data";
			}
		}else{
			$jogador = Jogador::Find($request->get("id"));
			$jogador->ehColecao = "sim"; 
			$acao = "adicionado";
			$jogador->save();			
		}
	    $request->Session()->flash("status", $acao);
		return redirect("/jogador");
	
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        new Jogador();
		$atleta = Jogador::Find($id);
		$jogadores = DB::table("jogador AS j")->join("posicao AS p","j.posicao", "=","p.id")->join("clube AS c","j.clube", "=","c.id")->select("j.nome_jogador","j.data_nascimento","p.pos AS posicao", "c.nome_clube AS clube", "j.ehColecao AS colecao", "j.id","c.id AS idclube" )->get();
		$posicoes = Posicao::All();
		$escudos = DB::table("clube AS c")->join("imagem AS i","i.clube", "=","c.id")->select("i.clube","i.url AS url")->get();
		$clubes = Clube::All();
		$separado = $atleta->ehColecao;
		/*
			Professor, esta ocorrendo um problema no trabalho da minha equipe. Na tabela jogador eu tenho o campo ehColecao,  esse campo recebe "sim" se o jogador estiver na coleção 
			ou não  se ele estiver fora. Blz, ate ai tudo bem, eu cadastro o jogador com um formulario onde uso o chek: se estiver marcado é sim, se desmarcado é não. 
			Quando eu cadastro ele salva normalmente e corretamente os dados. O problema começa aqui, eu salvo um jogador como "adiquirido". Blz, ele atualiza no banco de dados, 
			normal e correto. Porém quando eu clico em editar, ele "não consegue" atribuir o valor da coluna ehColecao. Parece que ele pega o valor, mas quando vou atribuir a outra 
			variável ele atribui o valor nulo e não o original do banco. Quando tento "setar" esse valor em um campo do tipo text, por via de teste, ele mostra um campo em branco.
			Usei um dd($atleta) para ver se todos os dados estavam sendo recuperados, e sim estão sendo recuperados, e só essa coluna esta com esse problema. Ja enfreitei esse problema
			no Symfony e la tambem não consegui descobrir o problema (no symfony usamos o doctrine no lugar do eloquent).
		*/
		//dd($separado);//Usei para ver se o valor da coluna ehColecao estava sendo atribuido
		//dd($atleta);//Usei para ver se o "jogador", no caso o atleta (mudei o nome para ver se estava ocorrendo algum conflito de variavel), estava recebendo os valores do banco, e sim esta
		return view(
			"futebol-figurinha-2021.jogador.jogador",
			[
				"atleta" => $atleta,
				"jogadores" => $jogadores,
				"posicoes" => $posicoes,
				"clubes" => $clubes,
				"escudos" => $escudos,
				"separado" => $separado
			]
		);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,Request $request)
    {
        Jogador::Destroy($id);
        $request->Session()->flash("status", "excluido");
		return redirect("/jogador");
    }
}
