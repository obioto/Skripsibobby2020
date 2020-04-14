<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\Perkembangan;

use Illuminate\Http\Request;

class PerkembanganController extends Controller
{
    public function store($id,Request $request)
    {
        $this->validate($request,[
            'deskripsi'     => 'required|max:255',
            'gambar'        => 'max:255',
        ]);
        $file_name = str_slug($request->gambar).'.jpg';
        $request->file('gambar')->move(public_path('/uploads/images/Perkembangan'),$file_name);


        $perkembangan = new Perkembangan;
        $perkembangan->id_konten                      = $id;        
        $perkembangan->tanggal                        = Carbon::now('Asia/Jakarta');
        $perkembangan->deskripsi                      = $request->input('deskripsi'); 
        $perkembangan->gambar                         = $file_name;      
        $perkembangan->pengeluaran                    = $request->input('pengeluaran');               
        // dd($perkembangan);
        $perkembangan->save();

        return redirect()->route('show',['id' => $id]);

    }
}
