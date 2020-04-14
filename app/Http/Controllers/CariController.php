<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Konten;

class CariController extends Controller
{
    /**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
    		// mengambil data dari table konten
		$konten = Konten::with('Owner')->paginate(50);
 
    		// mengirim data konten ke view index
		return view('Konten.cari',['konten' => $konten]);
 
	}
	public function getjudul(Request $request)
	{
		// menangkap data pencarian
		$getjudul = $request->getjudul;
 
    		// mengambil data dari table pegawai sesuai pencarian data
		$konten = Konten::with('Owner')->where('judul','like',"%".$getjudul."%")->paginate();
 
    		// mengirim data pegawai ke view index
		return view('Konten.cari',['konten' => $konten]);
 
	}
}
