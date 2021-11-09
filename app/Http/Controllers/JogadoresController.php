<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jogador;
use App\Models\Posicao;
use App\Models\Clube;
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
        $jogador = new Jogador();
		$jogadores = DB::table("jogador AS j")->join("posicao AS p","j.posicao", "=","p.id")->join("clube AS c","j.clube", "=","c.id")->select("j.nome_jogador","j.data_nascimento","p.pos AS posicao", "c.nome_clube AS clube", "j.ehColecao", "j.id")->get();
		$posicoes = Posicao::All();
		$clubes = Clube::All();
		return view(
			"futebol-figurinha-2021.jogador.jogador",
			[
				"jogador" => $jogador,
				"jogadores" => $jogadores,
				"posicoes" => $posicoes,
				"clubes" => $clubes
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
        if($request->get("id")== ""){
			$jogador = new Jogador();
			$acao = "salvo";
		}else{
			$jogador = Jogador::Find($request->get("id"));
			$acao = "editado";
		}
		$jogador->nome_jogador = $request->get("nome_jogador");
		$jogador->data_nascimento  = $request->get("data_nascimento");
		$jogador->posicao = $request->get("posicao");
		$jogador->clube = $request->get("clube");
		$col = $request->get("ehColecao");
		
		if($col == "" || $col == "N"){
			$col = "N";
		}
		$jogador->ehColecao  = $col;
		$jogador->save();
        $request->Session()->flash("acao", $acao);
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
		$jogador = Jogador::Find($id);
		$jogadores = DB::table("jogador AS j")->join("posicao AS p","j.posicao", "=","p.id")->join("clube AS c","j.clube", "=","c.id")->select("j.nome_jogador","j.data_nascimento","p.pos AS posicao", "c.nome_clube AS clube", "j.ehColecao", "j.id")->get();
		$posicoes = Posicao::All();
		$clubes = Clube::All();
		return view(
			"futebol-figurinha-2021.jogador.jogador",
			[
				"jogador" => $jogador,
				"jogadores" => $jogadores,
				"posicoes" => $posicoes,
				"clubes" => $clubes
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
        //
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
        $request->Session()->flash("acao", "excluido");
		return redirect("/jogador");
    }
}
