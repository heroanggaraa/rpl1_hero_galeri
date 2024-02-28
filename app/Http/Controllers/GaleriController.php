<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GaleriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $user = Auth::user()->id;
        $galeri = Galeri::where('id_user',$user)->latest()->get();
        return view('timeline',['galeris' => $galeri]);
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
        $namafoto = Auth::user()->id.'-'.date('YmdHis').$request->foto->getClientOriginalName();
        $request -> foto -> move(public_path('gambar'),$namafoto);
        $data = ([
            'judul'=>$request['judul'],
            'deskripsi'=>$request['deskripsi'],
            'foto'=>$request['foto'],
            'tanggal'=>$request['tanggal'],
        ]);
        Galeri::create($data);
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Galeri  $galeri
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        Galeri::where('id','=',$id)->delete();
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Galeri  $galeri
     * @return \Illuminate\Http\Response
     */
    public function edit(Galeri $galeri)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Galeri  $galeri
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Galeri $galeri)
    {
        if ($request->hasFile('foto'))
         {
            $namafoto = Auth::user()->id.'-'.date('YmdHis').$request->foto->getClientOriginalName();
            $request -> foto -> move(public_path('gambar'),$namafoto);
            $galeri->judul=$request->judul;
            $galeri->deskripsi=$request->deskripsi;
            $galeri->foto=$namafoto;
            $galeri->tanggal=now();
            $galeri->id_user=Auth::user();
            $galeri->save();
        }else{
            $galeri->judul=$request->judul;
            $galeri->deskripsi=$request->deskripsi;
            $galeri->foto=$request->foto;
            $galeri->tanggal=now();
            $galeri->id_user=Auth::user();
            $galeri->save();
        }
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Galeri  $galeri
     * @return \Illuminate\Http\Response
     */
    public function destroy(Galeri $galeri)
    {
        //
    }
}
