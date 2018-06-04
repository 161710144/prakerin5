<?php

namespace App\Http\Controllers;

use App\Perusahaan;
use Illuminate\Http\Request;

class PerusahaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $per = Perusahaan::with('member')->get();
        return view('perusahaan.index',compact('per'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $mem = Member::all();
        return view('perusahaan.create',compact('mem'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'logo' => 'required|',
            'deskripsi' => 'required|max:255',
            'kategori' => 'required|max:115',
            'subkategori' => 'required|max:115',
            'judul' => 'required|max:50',
            'gaji' => 'required|number',
            'tgl_mulai' => 'required|',
            'email' => 'required|unique:perusahaans',
            'telepon' => 'required|',
            'user_id' => 'required|unique:members'
        ]);
        $per = new Perusahaan;
        $per->logo = $request->logo;
        $per->deskripsi = $request->deskripsi;
        $per->kategori = $request->kategori;
        $per->subkategori = $request->subkategori;
        $per->judul = $request->judul;
        $per->gaji = $request->gaji;
        $per->tgl_mulai = $request->tgl_mulai;
        $per->email = $request->email;
        $per->telepon = $request->telepon;
        $per->user_id = $request->user_id;
        
        $per->save();
        Session::flash("flash_notification", [
        "level"=>"success",
        "message"=>"Berhasil menyimpan <b>$per->logo</b>"
        ]);
        return redirect()->route('perusahaan.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Perusahaan  $perusahaan
     * @return \Illuminate\Http\Response
     */
    public function show(Perusahaan $perusahaan)
    {   
        $per = Perusahaan::findOrFail($id);
        return view('perusahaan.show',compact('per'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Perusahaan  $perusahaan
     * @return \Illuminate\Http\Response
     */
    public function edit(Perusahaan $perusahaan)
    {
        $per = Perusahaan::findOrFail($id);
        $us = User::all();
        $selectedus = Perusahaan::findOrFail($id)->user_id;
        // dd($selected);
        return view('perusahaan.edit',compact('per','us','selectedus'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Perusahaan  $perusahaan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Perusahaan $perusahaan)
    {
        $this->validate($request,[
            'logo' => 'required|',
            'deskripsi' => 'required|max:255',
            'kategori' => 'required|max:115',
            'subkategori' => 'required|max:115',
            'judul' => 'required|max:50',
            'gaji' => 'required|',
            'tgl_mulai' => 'required|',
            'email' => 'required|',
            'telepon' => 'required|',
            'user_id' => 'required|unique:members'
        ]);
        $per = Perusahaan::findOrFail($id);
        $per->logo = $request->logo;
        $per->deskripsi = $request->deskripsi;
        $per->kategori = $request->kategori;
        $per->subkategori = $request->subkategori;
        $per->judul = $request->judul;
        $per->gaji = $request->gaji;
        $per->tgl_mulai = $request->tgl_mulai;
        $per->email = $request->email;
        $per->telepon = $request->telepon;
        $per->user_id = $request->user_id;
        $per->save();
        Session::flash("flash_notification", [
        "level"=>"success",
        "message"=>"Berhasil mengedit <b>$per->logo</b>"
        ]);
        return redirect()->route('perusahaan.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Perusahaan  $perusahaan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Perusahaan $perusahaan)
    {
        $per = Perusahaan::findOrFail($id);
        $per->delete();
        Session::flash("flash_notification", [
        "level"=>"success",
        "message"=>"Data Berhasil dihapus"
        ]);
        return redirect()->route('perusahaan.index');
    }
}
