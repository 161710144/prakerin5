<?php

namespace App\Http\Controllers;

use App\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mem  = Member::all();
        return view('member.index', compact('mem'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('member.create');
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
            'foto' => 'required|',
            'alamat' => 'required|',
            'user_id' => 'required'
        ]);
        $mem = new Member;
        $mem->foto = $request->foto;
        $mem->alamat = $request->alamat;
        $mem->user_id = $request->user_id;
        $mem->save();
        Session::flash("flash_notification", [
        "level"=>"success",
        "message"=>"Berhasil menyimpan <b>$mem->email</b>"
        ]);
        return redirect()->route('member.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function show(Member $member)
    {
        $mem = Member::findOrFail($id);
        return view('member.show',compact('mem'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function edit(Member $member)
    {
        $mem = Member::findOrFail($id);
        $us = User::all();
        $selectedus = Member::findOrFail($id)->user_id;
        return view('member.edit',compact('us','mem','selectedus'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Member $member)
    {
        $this->validate($request,[
            'foto' => 'required|',
            'alamat' => 'required|',
            'user_id' => 'required'
        ]);
        $mem = Member::findOrFail($id);
        $mem->foto = $request->foto;
        $mem->alamat = $request->alamat;
        $mem->user_id = $request->user_id;
        $mem->save();
        Session::flash("flash_notification", [
        "level"=>"success",
        "message"=>"Berhasil mengedit <b>$mem->email</b>"
        ]);
        return redirect()->route('member.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function destroy(Member $member)
    {
        $mem = Member::findOrFail($id);
        $mem->delete();
        Session::flash("flash_notification", [
        "level"=>"success",
        "message"=>"Data Berhasil dihapus"
        ]);
        return redirect()->route('member.index');
    }
}
