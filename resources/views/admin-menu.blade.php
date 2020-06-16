@extends('layouts.admin')

@section('content')
@php

@endphp
<div class="container">
    <h1>Menu RT {{ $current }}</h1>

    <div class='row'>
        <div class='col'>
            <div class='card'>
                <div class='card-header'>
                    Data KK Masuk
                </div>
                <div class='card-body'>
                    Data Kartu Keluarga yang masuk dan belum di-approve, sehingga tidak bisa melakukan pelaporan.
                </div>
                <div class='card-footer'>
                    <a class='btn btn-primary' href="{{ url('admin/' . $current . '/data-masuk') }}">Lihat</a>
                </div>
            </div>
        </div>
        <div class='col'>
            <div class='card'>
                <div class='card-header'>
                    Data KK
                </div>
                <div class='card-body'>
                    Data Kartu Keluarga yang ada dan sudah di-approve.
                     &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </div>
                <div class='card-footer'>
                    <a class='btn btn-primary' href="{{ url('admin/' . $current . '/data-kk') }}">Lihat</a>
                </div>
            </div>
        </div>
        <div class='col'>
            <div class='card'>
                <div class='card-header'>
                    Rekap Data Pekerjaan
                </div>
                <div class='card-body'>
                    Data Rekap berdasarkan pekerjaan penduduk.
                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </div>
                <div class='card-footer'>
                    <a class='btn btn-primary' href="{{ url('admin/' . $current . '/rekap-pekerjaan') }}">Lihat</a>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class='row'>
        <div class='col'>
            <div class='card'>
                <div class='card-header'>
                    Rekap Data Pendidikan
                </div>
                <div class='card-body'>
                    Data Rekap berdasarkan tingkat pendidikan penduduk.
                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </div>
                <div class='card-footer'>
                    <a class='btn btn-primary' href="{{ url('admin/' . $current . '/rekap-pendidikan') }}">Lihat</a>
                </div>
            </div>
        </div>
        <div class='col'>
            <div class='card'>
                <div class='card-header'>
                    Rekap Data Berdasarkan Usia
                </div>
                <div class='card-body'>
                    Data Rekap berdasarkan usia penduduk.
                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </div>
                <div class='card-footer'>
                    <a class='btn btn-primary' href="{{ url('admin/' . $current . '/rekap-usia') }}">Lihat</a>
                </div>
            </div>
        </div>
        <div class='col'>
            <div class='card'>
                <div class='card-header'>
                    Data Laporan
                </div>
                <div class='card-body'>
                    Data laporan yang masuk.
                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </div>
                <div class='card-footer'>
                    <a class='btn btn-primary' href="{{ url('admin/' . $current . '/laporan-masuk') }}">Lihat</a>
                </div>
            </div>
        </div>

    </div>
    <br><br><br>

</div>

@endsection
