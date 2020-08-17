<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Konten;
use App\User;
use Illuminate\Http\Request;

class ListKontenController extends Controller
{
    public function createview()
    {
        $check_id = backpack_auth()->user()->id;
        $check    = User::find($check_id);
        if ($check->confirmed != True) {
            return redirect()->route('home');  
        };
        $konten = Konten::with('Owner')->where('id_user',$check_id)->get();
        return view('Konten.ListKonten',['kontens' => $konten]);
    }
}
