@extends('layouts.admin')

@section('content')
@php

@endphp
<div class="container">
    <h1>Rekap Pendidikan RT {{ $current }}</h1>
    <table class='table'>
        <thead>
            <th>No</th>
            <th>Tingkat Pendidikan</th>
            <th>L</th>
            <th>P</th>
            <th>Jumlah</th>
        </thead>
        @php
            $total = 0;
            $no=1;
            $jmll=0;
            $jmlp=0;
        @endphp
         <tbody>
        @foreach ($input as $item)
            @php
                $jmllp = $item->L + $item->P
            @endphp
            <tr>
                <td>{{ $no }}</td>
                <td>{{ $item->pendidikan }}</td>
                <td>
                    @if ($item->L == null)
                        0
                    @endif
                    {{ $item->L }}
                </td>
                <td>
                     @if ($item->P == null)
                        0
                    @endif
                    {{ $item->P }}
                </td>
                <td>{{ $jmllp }}</td>
            </tr>

            @php
                $total = $total + $jmllp;
                $jmll = $jmll + $item->L;
                $jmlp= $jmlp + $item->P;
                $no++
            @endphp
        @endforeach
        <tr>
            <td colspan='2'><b> TOTAL</b></td>
            <td><b>{{ $jmll }}</b></td>
            <td><b>{{ $jmlp }}</b></td>
            <td><b>{{ $total }}</b></td>
        </tr>
        </tbody>
    </table>

    <br><br><br>

</div>

@endsection
