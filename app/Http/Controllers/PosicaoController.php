<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Posicao;
class PosicaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$posicao = new Posicao();
		$posicoes = Posicao::All();
		return view(
			"futebol-figurinha-2021.posicao.posicao",
			[
				"posicao" => $posicao,
				"posicoes" => $posicoes
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
        if ($request->get('id')!=""){
			$posicao = Posicao::Find($request->get('id'));
		}else{
			$posicao = new Posicao;
		}
		$posicao->pos = $request->get("pos");
		$posicao->descricao = $request->get("desc");
		$posicao->save();
		$request>session()->flash("status", "salvo");
		return redirect("/posicao");
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
        $posicao = Posicao::Find($id);
		$posicoes = Posicao::All();
		return view(
			"futebol-figurinha-2021.posicao.posicao",
			[
				"posicao" => $posicao,
				"posicoes" => $posicoes
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
    public function destroy($id, Request $request)
    {
        Posicao::Destroy($id);
		$request>session()->flash("status", "excluido");
		return Redirect("/posicao");
    }
}
