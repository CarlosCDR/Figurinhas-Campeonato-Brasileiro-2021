<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Imagem;
use Illuminate\Support\Facades\Storage;
class ImagemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $imagem = new Imagem();//
		$imagem->clube = $request->get("clube");
		$url = $request->file("url")->store("public/clube");
		$url = str_replace("public/","storage/",$url);
		$imagem->url = $url;
		$imagem->save();
		$request->session()->flash("status", "salvo");
		return redirect("/imagem/".$request->get("clube"));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
		$imagens = Imagem::Where("clube", "=", $id)->get();
        return view(
					"futebol-figurinha-2021.imagem.img", 
					[
						"clube" => $id, 
						"imagens" => $imagens,
					]
		);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $imagem = Imagem::Find($id);
		$url = $imagem->url;
		$clube = $imagem->clube;
		$imagem->delete();
		$url = str_replace("storage/","public/",$url);
		Storage::delete($url);
		$request->session()->flash("status", "excluido");
		return redirect("/imagem/".$clube);
    }
}
