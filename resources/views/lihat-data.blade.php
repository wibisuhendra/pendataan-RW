@extends('layouts.app')

@section('content')
<div class="container">
    <h1>
        @if ($kk == null)
            <h1>Data Keluarga</h1>
        @else
            <h1>Data Keluarga {{ $kk->nama_kepala_keluarga }}</h1>
        @endif
    </h1>
    <br>
    <div class="container">

            @if ($kk == null)
                <p>No KK atau Token salah! silahkan klik untuk kembali</p>
                <a href="/cari-kk">Kembali</a>
            @else
                <div class="container">
                    <div class='row'>

                        <div class='col'>
                            <table>
                                <tbody>
                                    <tr>
                                        <td><b>No KK </b></td>
                                        <td>:&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                        <td>{{ $kk->no_kk }}</td>
                                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                        <td rowspan="6"><a href="{{ asset('data_file/'.$kk->kartu_keluarga_img) }}"><img height='300' src="{{ asset('data_file/'.$kk->kartu_keluarga_img) }}" alt=""></a></td>
                                    </tr>
                                    <tr>
                                        <td><b>Kepala Keluarga </b></td>
                                        <td>:&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                        <td>{{ $kk->nama_kepala_keluarga }}</td>
                                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td><b>RT </b></td>
                                        <td>:&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                        <td>{{ $kk->rt }}</td>
                                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td> <b>Alamat</b></td>
                                        <td>:&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                        <td>{{ $kk->alamat }}</td>
                                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td><b>No. Kontak </b></td>
                                        <td>:&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                        <td>{{ $kk->no_kontak }}</td>
                                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td><b>Email Kontak </b></td>
                                        <td>:&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                        <td>{{ $kk->email_kontak }}</td>
                                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                            <a class="btn btn-primary" data-toggle="modal" data-target="#editKK" href="#">Edit</a>
                        </div>

                    </div>

            </div>
            <hr>
            <br><br>
            <h2>Data Anggota Keluarga <a class="btn btn-primary" data-toggle="modal" data-target="#tambahAnggota" href="#">+</a></h2>

            @if ($dapen->isEmpty())
            <br><br>
                <div class='center' style="text-align: center;">
                    Belum ada Data Anggota Keluarga. <br>
                    <a class='btn btn-primary' data-toggle="modal" data-target="#tambahAnggota" href="#">Tambah Data</a>
                </div>

            @else
                <table class='table '>
                    <thead>
                        <th>Nama</th>
                        <th>NIK</th>
                        <th>Jenis Kelamin</th>
                        <th>Tempat Lahir</th>
                        <th>Tanggal Lahir</th>
                        <th>Agama</th>
                        <th>Pendidikan</th>
                        <th>Pekerjaan</th>
                        <th>Aksi</th>
                    </thead>
                    <tbody>
                        @foreach ($dapen as $item)
                            <tr>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->NIK }}</td>
                                <td>{{ $item->jenis_kelamin }}</td>
                                <td>{{ $item->tempat_lahir }}</td>
                                <td>{{ $item->tanggal_lahir }}</td>
                                <td>{{ $item->agama }}</td>
                                <td>{{ $item->pendidikan }}</td>
                                <td>{{ $item->pekerjaan }}</td>
                                <td><a class="btn btn-warning" data-toggle="modal" data-target="#editAnggota{{ $item->id }}" href="#">edit</a> <a class="btn btn-danger" data-toggle="modal" data-target="#hapusAnggota{{ $item->id }}" href="#">hapus</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            @endif
            <hr>
            <br>
            <h2>Data Pelaporan <a class="btn btn-primary" data-toggle="modal" data-target="#tambahLaporan" href="#">+</a></h2>

            @if ($dalap->isEmpty())
                <div class='center' style="text-align: center;">
                    Belum ada Data Pelaporan. <br>
                </div>
            @else
            <div class="table-wrap" style="height: 300px; overflow-y: auto;">
                <table class='table'>
                    <td>
                        @foreach ($dalap as $item)
                            <div class="card">
                                <div class="card-header">
                                    <b>{{ $item->subjek }}</b><br>
                                    [{{ $item->judul }}]
                                </div>
                                <div class="card-body">
                                    <p>{{ $item->deskripsi }}</p>
                                </div>
                                <div class="card-footer">
                                    {{ $item->created_at }}
                                </div>
                            </div>
                            <br>
                        @endforeach
                    </td>
                </table>
            </div>
            @endif
            <br><br><br>
            @include('modal-anggota-keluarga')
        @endif

    </div>
</div>
@endsection


{{-- EDIT MODAL ----------------------------------------------- --}}

