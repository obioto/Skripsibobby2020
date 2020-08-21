<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Konten;
use App\User;
use App\Models\Perkembangan;
use App\Models\Perpanjangan;
use App\Models\Donatur;
use Validator;
use Carbon\Carbon;

class KontenController extends Controller
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
    public function createview()
    {
        $check_id = backpack_auth()->user()->id;
        $check    = User::find($check_id);
        if ($check->confirmed != True) {
            return redirect()->route('home');
        }
        return view('Konten.buat');
    }

    public function validasi(array $data)
    {
        $konten = new Konten;
        $kontens_table = $konten->getTable();

        return Validator::make($data, [
            'judul'                            => 'required',
            'deskripsi'                        => 'required',
            'gambar'                           => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'target'                           => 'required|min:6|max:255',
            'lama_donasi'                      => 'required',
            'nomorRekening'                    => 'required|max:255',
            'bank'                    => 'required|max:255',
        ]);
    }

    public function createKonten(array $data)
    {
        $konten = new Konten;
        $id = backpack_auth()->user()->id;
        $nama_gambar = str_slug($data['gambar']) . '.jpg';
        $time = Carbon::now('Asia/Jakarta')->toDateTimeString();
        $limit = Carbon::parse($time)->addDays($data['lama_donasi'])->addDay();
        // dd($limit);

        return $konten->create([
            'id_user'                          => $id,
            'judul'                            => $data['judul'],
            'deskripsi'                        => $data['deskripsi'],
            'gambar'                           => $nama_gambar,
            'target'                           => $data['target'],
            'terkumpul'                        => '0',
            'lama_donasi'                      => $limit,
            'nomorRekening'                    => $data['nomorRekening'],
            'bank'                             => $data['bank'],
            'create_at'                        => Carbon::now('Asia/Jakarta')->toDateTimeString(),
            'updated_at'                       => Carbon::now('Asia/Jakarta')->toDateTimeString(),
        ]);
    }

    public function storeKonten(Request $request)
    {
        $konten = new Konten;


        $this->validasi($request->all())->validate();
        $file_name = str_slug($request->gambar) . '.jpg';
        $request->file('gambar')->move(public_path('/uploads/images/GambarKonten'), $file_name);

        $konten = $this->createKonten($request->all());
        // dd($konten,$file_name);
        // dd($konten);
        return view('Konten.TungguVerifikasi');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storedonasi($konten, Request $request)
    {
        $this->validate($request, [
            'namaLengkap'   => 'required|max:255',
            'nomorTelepon'  => 'required|max:255',
            'jumlah'        => 'required|max:255',
            'bukti'         => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048,'
        ]);
        $file_name = str_slug($request->bukti) . '.jpg';
        $request->file('bukti')->move(public_path('/uploads/images/buktitransfer'), $file_name);
        if (isset($_POST['isanonim'])) {
            $account = '1';
        } else if (!isset($_POST['isanonim'])) {
            $account = '0';
        }

        $donasi = new Donatur;
        $donasi->id_konten    = $konten;
        $donasi->namaLengkap  = $request->input('namaLengkap');
        $donasi->jumlah       = $request->input('jumlah');
        $donasi->nomorTelepon = $request->input('nomorTelepon');
        $donasi->bukti        = $file_name;
        $donasi->isconfirmed  = '0';
        $donasi->isanonim     = $account;
        $donasi->created_at   = Carbon::now('Asia/Jakarta');
        $donasi->updated_at   = Carbon::now('Asia/Jakarta');
        // dd($donasi);
        $donasi->save();

        return redirect()->route('show', ['id' => $konten])->with('success', 'Terima Kasih, Donasi akan diverifikasi oleh Penggalang Dana');
    }

    public function konfirmasidonasi($id, Request $request)
    {
        $donasi = Donatur::where('id', $id)->find($id);
        $donasi->isconfirmed = 1;
        $show = $donasi->id_konten;

        $konten = Konten::with('Persondonate')->where('id', $show)->find($show);
        $kontenterkumpul = $konten->terkumpul;
        $mendonasi = $donasi->jumlah;
        $getmoney = $kontenterkumpul + $mendonasi;
        $konten->terkumpul = $getmoney;
        // dd($konten);
        $donasi->save();
        $konten->save();
        // dd([$konten,$donasi]);

        return redirect()->route('show', ['id' => $show])->with('success', 'Semoga Donasi yang telah diterima dapat berguna');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $konten = Konten::with('Owner', 'Persondonate')->find($id);
        $perkembangan = Perkembangan::with('perkembangan')->where('id_konten', $id)->get();
        $donatur = Donatur::with('donate')->where('id_konten', $id)->get();
        $unregisted = Donatur::with('donate')->where('id_konten', $id)->where('isconfirmed', '0')->get();
        $count = Donatur::with('donate')->where('id_konten', $id)->where('isconfirmed', '1')->count();
        $limit = Konten::find($id)->lama_donasi;
        $perpanjangan = Perpanjangan::with('konten')->where('id_konten', $id)->get();
        $diff = Carbon::now('Asia/Jakarta')->diffInDays($limit);

        return view('Konten.show', compact('konten', 'perkembangan', 'donatur', 'count', 'unregisted', 'diff', 'perpanjangan'));
    }

    // public function donate($id)
    // {
    //     $konten = Konten::with('Owner','Persondonate')->find($id);
    //     $perkembangan = Perkembangan::with('perkembangan')->where('id_konten',$id)->get();
    //     $donatur = Donatur::with('donate')->where('id_konten',$id)->get(); 
    //     // dd($perkembangan);
    //     return view('Konten.donate',compact('konten','perkembangan','donatur'));
    // }

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
