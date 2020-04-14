<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Perpanjangan;

class PerpanjanganController extends Controller
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
    public function store($id,Request $request)
    {
        $this->validate($request,[
            'jumlah_hari'   => 'required|max:255',
            'alasan'        => 'required|max:255',
        ]);
        $perpanjangan = new Perpanjangan;
        $perpanjangan->jumlah_hari                    = $request->input('jumlah_hari');
        $perpanjangan->alasan                         = $request->input('alasan');        
        $perpanjangan->id_konten                      = $id;        
        // dd($perpanjangan);
        $perpanjangan->save();

        return redirect()->route('show',['id' => $id])->with('success','Terima Kasih, Perpanjangan akan diverifikasi oleh Penggalang Dana');

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
    public function destroy($id)
    {
        //
    }
}
