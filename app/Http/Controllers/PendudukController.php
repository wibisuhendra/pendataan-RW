<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\KartuKeluarga;
use App\DataPenduduk;
use App\Laporan;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PendudukController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    protected $url;
    protected $pekerjaan = [
        'BELUM/TIDAK BEKERJA',
        'MENGURUS RUMAH TANGGA',
        'PELAJAR/MAHASISWA',
        'PENSIUNAN',
        'PEGAWAI NEGERI SIPIL',
        "TENTARA NASIONAL INDONESIA",
        'KEPOLISIAN RI',
        'BURUH',
        'WIRASWASTA',
        'PEGAWAI BUMN/D',
        'ANGGOTA DEWAN',
        'PRESIDEN',
        'WAKIL PRESIDEN',
    ];
    public function index()
    {
        return view('welcome');
    }

    public function addKK()
    {
        return view('tambah_data_keluarga');
    }

    public function saveKK(Request $request){
        $items = $request->all();
        $file = $request->file('kartu_keluarga_img');
        $tujuan_upload = 'data_file';
        $nama_file = $items['no_kk'] . $items['nama_kepala_keluarga'] .'.'.$file->getClientOriginalExtension();
        $file->move($tujuan_upload, $nama_file);

        $validator = $request->validate([
            'no_kk' => 'numeric|required|unique:kartu_keluarga',
        ]);

        // if ($validator->fails()) {
        //     return Redirect::back()->withErrors($validator);
        // }

        $items['approval'] = 0;
        $items['kartu_keluarga_img'] = $nama_file;
        $items['token'] = Str::random(16);

        KartuKeluarga::create($items);

        echo 'simpan token ini untuk melakukan penambahan atau perubahan data: <b>'.$items['token'].'</b> mohon untuk tidak disebarkan! <br>';
        echo '<a href="lihat-data/'.$items['no_kk'].'/'.$items['token'].'">lanjutkan</a>';


    }

    public function cariKK(){
        return view('cari-kk');
    }

    public function temukanKK(Request $request){
        $temp = $request->all();
        return redirect('lihat-data/'.$temp['no_kk'].'/'.$temp['token']);
    }

    public function lihatKK($no_kk,$token){
        $data['pekerjaan'] = $this->pekerjaan;
        $data['kk'] = KartuKeluarga::where('no_kk','=',$no_kk)->where('token','=',$token)->first();
        if($data['kk']!=null){
            $data['dapen'] = DataPenduduk::where('id_kk', '=', $data['kk']->id)->get();
            $data['dalap'] = Laporan::where('no_kk','=',$no_kk)->orderBy('created_at', 'DESC')->get();
        }



        return view('lihat-data',$data);

    }

    public function updateDataKK($no_kk,$token,Request $request)
    {

        $file = $request->file('kartu_keluarga_img');
        $item = $request->all();
        $kk = KartuKeluarga::find($item['id']);
        if(count($request->file()) != 0){
            $tujuan_upload = 'data_file';
            $nama_file = $no_kk . $item['nama_kepala_keluarga'] . '.' . $file->getClientOriginalExtension();
            $kk->kartu_keluarga_img = $nama_file;
            $file->move($tujuan_upload, $nama_file);

        }
        $kk->nama_kepala_keluarga = $item['nama_kepala_keluarga'];
        $kk->rt = $item['rt'];
        $kk->alamat = $item['alamat'];
        $kk->no_kontak = $item['no_kontak'];
        $kk->email_kontak = $item['email_kontak'];
        $kk->save();
        return redirect('lihat-data/' . $no_kk . '/' . $token);
    }

    public function tambahAnggotaKeluarga($no_kk,$token,Request $request)
    {

        $items = $request->all();
        $kk = KartuKeluarga::where('no_kk', '=', $no_kk)->first();
        $items['rt'] = $kk->rt;
        DataPenduduk::create($items);

        return redirect('lihat-data/' . $no_kk . '/' . $token);
    }

    public function updateAnggotaKeluarga($no_kk, $token, Request $request)
    {

        $item = $request->all();
        $dapen = DataPenduduk::find($item['id']);

        $dapen->nama = $item['nama'];
        $dapen->NIK = $item['NIK'];
        $dapen->jenis_kelamin = $item['jenis_kelamin'];
        $dapen->tempat_lahir = $item['tempat_lahir'];
        $dapen->tanggal_lahir = $item['tanggal_lahir'];
        $dapen->agama = $item['agama'];
        $dapen->pendidikan = $item['pendidikan'];
        $dapen->pekerjaan = $item['pekerjaan'];
        $dapen->save();
        return redirect('lihat-data/' . $no_kk . '/' . $token);
    }

    public function hapusAnggotaKeluarga($no_kk, $token, $id)
    {

        $dapen = DataPenduduk::find($id);
        $dapen->delete();
        return redirect('lihat-data/' . $no_kk . '/' . $token);
    }

    public function tambahLaporan($no_kk, $token, Request $request)
    {

        $item = $request->all();
        $kk = KartuKeluarga::where('no_kk', '=', $no_kk)->first();
        $item['rt'] = $kk->rt;
        $item['id_kk'] = $kk->id;
        Laporan::create($item);
        return redirect('lihat-data/' . $no_kk . '/' . $token);
    }

}
