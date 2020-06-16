<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\KartuKeluarga;
use App\DataPenduduk;
use App\Laporan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;



class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $menu = ['semua','1','2','3','4','5'];
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

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['menu'] = $this->menu;
        return view('home', $data);
    }

    public function menu($rt){
        $data['current'] = $rt;
        $data['menu'] = $this->menu;

        return view('admin-menu', $data);
    }

    public function dataMasuk($rt){
        $data['current'] = $rt;
        $data['url'] = Storage::url('');
        $data['menu'] = $this->menu;
        if ($rt!='semua') {
            $data['kk'] = KartuKeluarga::where('approval', '=', '0')->where('rt','=',$rt)->get();
        } else {
            $data['kk'] = KartuKeluarga::where('approval', '=', '0')->get();
        }


        if($data['kk']->isEMpty()){
            $data['kk'] = null;
        }

        return view('admin-data-masuk', $data);
    }


    public function hapusDataKK($rt,$id){
        $data['current'] = $rt;
        $kk = KartuKeluarga::find($id);
        $kk->delete();
        // DataPenduduk::where('id_kk', $id)->delete();
        return redirect('admin/'.$rt.'/data-masuk');
    }

    public function updateDataKK($rt, Request $request){
        $data['current'] = $rt;
        $item = $request->all();
        $kk = KartuKeluarga::find($item['id']);
        $kk->no_kk = $item['no_kk'];
        $kk->nama_kepala_keluarga = $item['nama_kepala_keluarga'];
        $kk->rt = $item['rt'];
        $kk->alamat = $item['alamat'];
        $kk->no_kontak = $item['no_kontak'];
        $kk->email_kontak = $item['email_kontak'];
        $kk->approval = $item['approval'];
        $kk->save();
        return redirect('admin/' . $rt . '/data-masuk');
    }

    public function dataKK($rt)
    {
        $data['current'] = $rt;
        $data['url'] = Storage::url('');
        $data['menu'] = $this->menu;
        if ($rt != 'semua') {
            $data['kk'] = KartuKeluarga::where('rt', '=', $rt)->get();
        } else {
            $data['kk'] = KartuKeluarga::all();
        }


        if ($data['kk']->isEMpty()) {
            $data['kk'] = null;
        }

        return view('admin-data-kk', $data);
    }

    public function hapusDataKKFix($rt, $id)
    {
        $data['current'] = $rt;
        $kk = KartuKeluarga::find($id);
        $kk->delete();
        // DataPenduduk::where('id_kk', $id)->delete();
        return redirect('admin/' . $rt . '/data-kk');
    }

    public function updateDataKKFix($rt, Request $request)
    {
        $data['current'] = $rt;
        $item = $request->all();
        $kk = KartuKeluarga::find($item['id']);
        $kk->no_kk = $item['no_kk'];
        $kk->nama_kepala_keluarga = $item['nama_kepala_keluarga'];
        $kk->rt = $item['rt'];
        $kk->alamat = $item['alamat'];
        $kk->no_kontak = $item['no_kontak'];
        $kk->email_kontak = $item['email_kontak'];
        $kk->save();
        return redirect('admin/' . $rt . '/data-kk');
    }

    public function detailDataKK($rt,$id)
    {
        $data['current'] = $rt;
        $data['url'] = Storage::url('');
        $data['menu'] = $this->menu;
        $data['current'] = $rt;
        $data['pekerjaan'] = $this->pekerjaan;
        $data['kk'] = KartuKeluarga::where('id', '=', $id)->first();
        if ($data['kk'] != null) {
            $data['dapen'] = DataPenduduk::where('id_kk', '=', $data['kk']->id)->get();
            $data['dalap'] = Laporan::where('id_kk', '=', $id)->orderBy('created_at', 'DESC')->get();
        }

        return view('admin-detail-kk',$data);
    }

    public function rekapPekerjaan($rt){

        $data['current'] = $rt;
        $data['judul'] = 'Pekerjaan';
        $data['url'] = Storage::url('');
        $data['menu'] = $this->menu;
        if($rt=='semua'){
            $data['input'] = DB::select("
                select * from ((select ll.pekerjaan, ll.L, pp.P
                from (select pekerjaan, count(*) as L from data_penduduk where jenis_kelamin = 'L' group by pekerjaan) ll
                left join
                (select pekerjaan, count(*) as P from data_penduduk where jenis_kelamin = 'P' group by pekerjaan) pp
                on pp.pekerjaan = ll.pekerjaan)
                union all
                (select pp.pekerjaan, ll.L, pp.P
                from (select pekerjaan, count(*) as L from data_penduduk where jenis_kelamin = 'L' group by pekerjaan) ll
                right join
                (select pekerjaan, count(*) as P from data_penduduk where jenis_kelamin = 'P' group by pekerjaan) pp
                on pp.pekerjaan = ll.pekerjaan)) abc group by pekerjaan;
            ");
        }else{
            $data['input'] = DB::select("
                select * from ((select ll.pekerjaan, ll.L, pp.P
                from (select pekerjaan, count(*) as L from data_penduduk where jenis_kelamin = 'L' and rt='" . $rt . "' group by pekerjaan) ll
                left join
                (select pekerjaan, count(*) as P from data_penduduk where jenis_kelamin = 'P' and rt='".$rt. "' group by pekerjaan) pp
                on pp.pekerjaan = ll.pekerjaan)
                union all
                (select pp.pekerjaan, ll.L, pp.P
                from (select pekerjaan, count(*) as L from data_penduduk where jenis_kelamin = 'L' and rt='" . $rt . "' group by pekerjaan) ll
                right join
                (select pekerjaan, count(*) as P from data_penduduk where jenis_kelamin = 'P' and rt='" . $rt . "' group by pekerjaan) pp
                on pp.pekerjaan = ll.pekerjaan)) abc group by pekerjaan;
            ");
        }
        return view('admin-rekap-pekerjaan',$data);
    }
    public function rekapPendidikan($rt){

        $data['current'] = $rt;
        $data['judul'] = 'Pendidikan';
        $data['url'] = Storage::url('');
        $data['menu'] = $this->menu;
        if($rt=='semua'){
            $data['input'] = DB::select("
                select * from ((select ll.pendidikan, ll.L, pp.P
                from (select pendidikan, count(*) as L from data_penduduk where jenis_kelamin = 'L' group by pendidikan) ll
                left join
                (select pendidikan, count(*) as P from data_penduduk where jenis_kelamin = 'P' group by pendidikan) pp
                on pp.pendidikan = ll.pendidikan)
                union all
                (select pp.pendidikan, ll.L, pp.P
                from (select pendidikan, count(*) as L from data_penduduk where jenis_kelamin = 'L' group by pendidikan) ll
                right join
                (select pendidikan, count(*) as P from data_penduduk where jenis_kelamin = 'P' group by pendidikan) pp
                on pp.pendidikan = ll.pendidikan)) abc group by pendidikan;
            ");
        }else{
            $data['input'] = DB::select("
                select * from ((select ll.pendidikan, ll.L, pp.P
                from (select pendidikan, count(*) as L from data_penduduk where jenis_kelamin = 'L' and rt='" . $rt . "' group by pendidikan) ll
                left join
                (select pendidikan, count(*) as P from data_penduduk where jenis_kelamin = 'P' and rt='".$rt. "' group by pendidikan) pp
                on pp.pendidikan = ll.pendidikan)
                union all
                (select pp.pendidikan, ll.L, pp.P
                from (select pendidikan, count(*) as L from data_penduduk where jenis_kelamin = 'L' and rt='" . $rt . "' group by pendidikan) ll
                right join
                (select pendidikan, count(*) as P from data_penduduk where jenis_kelamin = 'P' and rt='" . $rt . "' group by pendidikan) pp
                on pp.pendidikan = ll.pendidikan)) abc group by pendidikan;
            ");
        }
        return view('admin-rekap-pendidikan',$data);
    }

    public function rekapUsia($rt){

        $data['current'] = $rt;
        $data['judul'] = 'Usia';
        $data['url'] = Storage::url('');
        $data['menu'] = $this->menu;
        if($rt=='semua'){
            $temp = DB::select("
                select * from (select ll.usia, ll.L, pp.P from
                (select usia, count(*) as L from (select *, YEAR(CURDATE())-YEAR(tanggal_lahir) as usia from data_penduduk) a where jenis_kelamin = 'L' group by usia) ll
                left join
                (select usia, count(*) as P from (select *, YEAR(CURDATE())-YEAR(tanggal_lahir) as usia from data_penduduk) a where jenis_kelamin = 'P' group by usia) pp
                on pp.usia = ll.usia
                union all
                select pp.usia, ll.L, pp.P from
                (select usia, count(*) as L from (select *, YEAR(CURDATE())-YEAR(tanggal_lahir) as usia from data_penduduk) a where jenis_kelamin = 'L' group by usia) ll
                right join
                (select usia, count(*) as P from (select *, YEAR(CURDATE())-YEAR(tanggal_lahir) as usia from data_penduduk) a where jenis_kelamin = 'P' group by usia) pp
                on pp.usia = ll.usia) abc group by usia;
            ");
        }else{
            $temp = DB::select("
                select * from (select ll.usia, ll.L, pp.P from
                (select usia, count(*) as L from (select *, YEAR(CURDATE())-YEAR(tanggal_lahir) as usia from data_penduduk) a where jenis_kelamin = 'L' and rt ='" . $rt . "' group by usia) ll
                left join
                (select usia, count(*) as P from (select *, YEAR(CURDATE())-YEAR(tanggal_lahir) as usia from data_penduduk) a where jenis_kelamin = 'P' and rt ='".$rt. "' group by usia) pp
                on pp.usia = ll.usia
                union all
                select pp.usia, ll.L, pp.P from
                (select usia, count(*) as L from (select *, YEAR(CURDATE())-YEAR(tanggal_lahir) as usia from data_penduduk) a where jenis_kelamin = 'L' and rt ='" . $rt . "' group by usia) ll
                right join
                (select usia, count(*) as P from (select *, YEAR(CURDATE())-YEAR(tanggal_lahir) as usia from data_penduduk) a where jenis_kelamin = 'P' and rt ='" . $rt . "' group by usia) pp
                on pp.usia = ll.usia) abc group by usia;
            ");
        }
        $input = [];
        $input['bayi']['kelompok'] = 'Bayi [0-1]';
        $input['bayi']['L'] = 0;
        $input['bayi']['P'] = 0;
        $input['balita']['kelompok'] = 'Balita [2-5]';
        $input['balita']['L'] = 0;
        $input['balita']['P'] = 0;
        $input['anak']['kelompok'] = 'Anak-anak [6-10]';
        $input['anak']['L'] = 0;
        $input['anak']['P'] = 0;
        $input['remaja']['kelompok'] = 'Remaja [11-19]';
        $input['remaja']['L'] = 0;
        $input['remaja']['P'] = 0;
        $input['dewasa']['kelompok'] = 'Dewasa [20-60]';
        $input['dewasa']['L'] = 0;
        $input['dewasa']['P'] = 0;
        $input['lansia']['kelompok'] = 'Lansia [>60]';
        $input['lansia']['L'] = 0;
        $input['lansia']['P'] = 0;
        foreach($temp as $item){
            if($item->usia >= 0 && $item->usia <= 1){
                if($item->L != null){
                    $input['bayi']['L'] = $input['bayi']['L'] + $item->L;
                }
                if ($item->P != null) {
                    $input['bayi']['P'] = $input['bayi']['P']+ $item->P;
                }
            }
            if ($item->usia >= 2 && $item->usia <= 5) {
                if ($item->L != null) {
                    $input['balita']['L'] = $input['balita']['L'] + $item->L;
                }
                if ($item->P != null) {
                    $input['balita']['P'] = $input['balita']['P'] + $item->P;
                }
            }
            if ($item->usia >= 6 && $item->usia <= 10) {
                if ($item->L != null) {
                    $input['anak']['L'] = $input['anak']['L'] + $item->L;
                }
                if ($item->P != null) {
                    $input['anak']['P'] = $input['anak']['P'] + $item->P;
                }
            }
            if ($item->usia >= 11 && $item->usia <= 19) {
                if ($item->L != null) {
                    $input['remaja']['L'] = $input['remaja']['L'] + $item->L;
                }
                if ($item->P != null) {
                    $input['remaja']['P'] = $input['remaja']['P'] + $item->P;
                }
            }
            if ($item->usia >= 20 && $item->usia <= 60) {
                if ($item->L != null) {
                    $input['dewasa']['L'] = $input['dewasa']['L'] + $item->L;
                }
                if ($item->P != null) {
                    $input['dewasa']['P'] = $input['dewasa']['P'] + $item->P;
                }
            }
            if ($item->usia >= 61) {
                if ($item->L != null) {
                    $input['lansia']['L'] = $input['lansia']['L'] + $item->L;
                }
                if ($item->P != null) {
                    $input['lansia']['P'] = $input['lansia']['P'] + $item->P;
                }
            }
        }
        $data['input'] = $input;
        // dd($data['input'], $temp);
        return view('admin-rekap-usia',$data);
    }

    public function laporanMasuk($rt){

        $data['current'] = $rt;
        $data['judul'] = 'Laporan';
        $data['url'] = Storage::url('');
        $data['menu'] = $this->menu;
        if($rt!='semua'){

            $laporan = Laporan::where('rt', $rt)->orderBy('created_at', 'DESC')->get();
        }else{
            $laporan = Laporan::orderBy('created_at', 'DESC')->get();
        }
        $data['laporan'] = $laporan;

        return view('admin-laporan-masuk', $data);

    }


}
