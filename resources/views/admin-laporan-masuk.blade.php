@extends('layouts.admin')

@section('content')
@php

@endphp
<div class="container">
    <h1>Laporan Masuk RT {{ $current }}</h1>

    <div class="table-wrap" style="height: 390px; overflow-y: auto;">
            <table class='table'>
                <td>
                    @foreach ($laporan as $item)
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


    <br><br><br>

</div>

@endsection
