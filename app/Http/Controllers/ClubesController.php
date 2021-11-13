<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clube;
use App\Models\Imagem;
use App\Models\Jogador;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\DB;
class ClubesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clube = new Clube();
		$clubes = Clube::All();
		$habilita = false;
		$compare = DB::table("clube AS c")->join("imagem AS i","i.clube", "=","c.id")->select("c.id","i.url AS url")->get();
		return view(
			"futebol-figurinha-2021.clube.clube",
			[
				"clube" => $clube,
				"clubes" => $clubes,
				"compare" => $compare,
				"habilita" => $habilita
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
			$clube = Clube::Find($request->get('id'));
			$imagem = Imagem::where("clube", $request->get('id'))->first();
			$hab = true;
		}else{
			$clube = new Clube;
			$imagem = new Imagem;
			$hab = false;
		}
		
		$clube->nome_clube = $request->get("nome_clube");
		$clube->save();
		$idc = $clube->id;
		
		if($hab == false){
			$imagem->clube = $idc;
			$url = $request->file("url")->store("public/clube");
			$url = str_replace("public/","storage/",$url);
			$imagem->url = $url;
			$imagem->save();
		}
		$request>session()->flash("status", "salvo");
		return redirect("/clube");
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
        $clube = Clube::Find($id);
		$clubes = Clube::All();
		$compare = DB::table("clube AS c")->join("imagem AS i","i.clube", "=","c.id")->select("c.id","i.url AS url")->get();
		$habilita = true;
		return view(
			"futebol-figurinha-2021.clube.clube",
			[
				"clube" => $clube,
				"clubes" => $clubes,
				"compare" => $compare,
				"habilita" => $habilita
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
		
        $jogadores = DB::table('jogador')->where("clube", "=",$id)->count();
		$clube = Clube::Find($id);
		$imagem = Imagem::where("clube", $id)->first();
		
		
		if($jogadores > 0){
			$status = "erro_exc";
		}else{
			$imagem->delete();
			$url = $imagem->url;
			$url = str_replace("storage/","public/",$url);
			Storage::delete($url);
			$clube->delete();
			$status = "excluido";
		}
		$request>session()->flash("status", $status);
		return Redirect("/clube");
    }
}
