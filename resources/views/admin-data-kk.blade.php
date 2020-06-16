@extends('layouts.admin')

@section('content')
@php

@endphp
<div class="container">
    <h1>Data KK RT {{ $current }}</h1>
    @if ($kk != NULL)
        <table class='table table-responsive'>
            <thead class='center'>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">No KK</th>
                    <th scope="col">Kepala Keluarga</th>
                    <th scope="col">RT</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">No Kontak</th>
                    <th scope="col">Email Kontak</th>
                    <th scope="col">Gambar KK</th>
                    <th scope="col">Token</th>
                    <th scope="col" width='14%'>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 1;
                @endphp
                @foreach ($kk as $item)
                    <tr>
                        <td>{{ $i }}</td>
                        <td>{{ $item->no_kk }}</td>
                        <td>{{ $item->nama_kepala_keluarga }}</td>
                        <td>{{ $item->rt }}</td>
                        <td>{{ $item->alamat }}</td>
                        <td>{{ $item->no_kontak }}</td>
                        <td>{{ $item->email_kontak }}</td>

                        <td>
                            @if ($item->kartu_keluarga_img!=NULL)
                                <a href="{{ asset('data_file/'.$item->kartu_keluarga_img) }}">lihat kk</a>
                            @endif

                        </td>
                        <td>{{ $item->token }}</td>
                        <td><a href="#" data-toggle="modal" data-target="#editRecord{{$item->id}}" class="btn btn-warning btn-sm btn-action">Edit</a>
                            <a href="{{ url('admin/'.$current.'/data-kk/detail/'.$item->id) }}" class="btn btn-info btn-sm btn-action">Detail</a>
                        <a href="#" data-toggle="modal" data-target="#hapusRecord{{$item->id}}" class="btn btn-danger btn-sm btn-action"> <i class="fa fa-trash"></i> </a></td>
                        {{-- DELETE MODAL ----------------------------------------------- --}}
                        <div class="modal fade" id="hapusRecord{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content text-gray-800">
                                    <div class="modal-header">
                                        <h5 class="modal-title font-weight-bold text-gray-800" id="deleteRecordLabel">Hapus Record ?</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                    </div>
                                    <div class="modal-body text-gray-800">
                                        Pastikan anda yakin untuk menghapus record, lalu klik Hapus.
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Batal</button>
                                        <a class="btn btn-danger" href="{{ url('admin/'.$current.'/data-kk/hapus/'.$item->id) }}">Hapus</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- DELETE MODAL ----------------------------------------------- --}}
                        {{-- EDIT MODAL ----------------------------------------------- --}}
                        <div class="modal fade" id="editRecord{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content text-gray-800">
                                    <div class="modal-header">
                                        <h5 class="modal-title font-weight-bold text-gray-800" id="editRecordLabel">Edit Record</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                    </div>

                                    <div class="modal-body text-gray-800">
                                        <form action="data-kk/update" method="POST" enctype="multipart/form-data">
                                            {{ csrf_field() }}

                                            <div class="form-group">
                                                <label for="">No KK</label>
                                                <input type="text" class="form-control" name='no_kk' required value='{{ $item->no_kk }}'>
                                                <input type="text" class="form-control" name='id' value='{{ $item->id }}' hidden>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Kepala Keluarga</label>
                                                <input  required type="text" class="form-control" name='nama_kepala_keluarga' value='{{ $item->nama_kepala_keluarga }}'>
                                            </div>
                                            <div class="form-group">
                                                <label for="">RT</label>
                                                <select id="inputState" class="form-control" name='rt'>
                                                    <option value='1'
                                                    @if($item->rt == '1')
                                                        selected
                                                    @endif
                                                    >1</option>
                                                    <option value='2'
                                                    @if($item->rt == '2')
                                                        selected
                                                    @endif>2</option>
                                                    <option value='3'
                                                    @if($item->rt == '3')
                                                        selected
                                                    @endif>3</option>
                                                    <option value='4'
                                                    @if($item->rt == '4')
                                                        selected
                                                    @endif>4</option>
                                                    <option value='5'
                                                    @if($item->rt == '5')
                                                        selected
                                                    @endif>5</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Alamat</label>
                                                <input type="text" class="form-control" name='alamat' required value='{{ $item->alamat }}'>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Kontak (telp/wa)</label>
                                                <input type="text" class="form-control" name='no_kontak' required value='{{ $item->no_kontak }}'>
                                            </div>
                                            <div class="form-group">
                                                <label for="">email (opsional)</label>
                                                <input type="text" class="form-control" name='email_kontak' value='{{ $item->email_kontak }}'>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Token</label>
                                                <input type="text" class="form-control" name='token' value='{{ $item->token }}'>
                                            </div>
                                            <div class="form-group ">
                                                <label for="inputState">Status</label>
                                                <select id="inputState" class="form-control" name='approval' disabled>
                                                    <option value='1'
                                                    @if($item->approval == '1')
                                                        selected
                                                    @endif
                                                    >Disetujui</option>
                                                    <option value='0'
                                                    @if($item->approval == '0')
                                                        selected
                                                    @endif>Belum</option>
                                                </select>
                                            </div>



                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Batal</button>


                                            <button type="submit" class="btn btn-primary btn-ok btn-sm">Simpan</a>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- EDIT MODAL ----------------------------------------------- --}}

                    </tr>
                    @php
                        $i++;
                    @endphp
                @endforeach


            </tbody>
        </table>
    @else
        tidak ada data.
    @endif
</div>

@endsection
