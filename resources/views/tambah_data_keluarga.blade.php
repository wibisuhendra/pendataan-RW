@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Data Keluarga</h1>
    <br>
    <div class="container">
        <div class="container">
            <div class="col-md-8">
                @if($errors->any())
                    Terdapat kesalahan!
                    @foreach ($errors->all() as $error)
                        <div class='alert-danger'> &nbsp  {{ $error }}</div>
                    @endforeach
                    <br>
                @endif
                <form action="save-kk" method="POST" enctype="multipart/form-data">
                     {{ csrf_field() }}

                    <div class="form-group">
                        <label for="">No KK</label>
                        <input type="text" class="form-control" name='no_kk' required value="{{ old('no_kk') }}">
                    </div>
                    <div class="form-group">
                        <label for="">Kepala Keluarga</label>
                        <input  required type="text" class="form-control" name='nama_kepala_keluarga' value="{{ old('nama_kepala_keluarga') }}">
                    </div>
                    <div class="form-group">
                        <label for="">RT</label>
                        <select id="inputState" class="form-control" name='rt'>
                            <option value='1'
                            @if(old('rt') == '1')
                                selected
                            @endif
                            >1</option>
                            <option value='2'
                            @if(old('rt') == '2')
                                selected
                            @endif>2</option>
                            <option value='3'
                            @if(old('rt') == '3')
                                selected
                            @endif>3</option>
                            <option value='4'
                            @if(old('rt') == '4')
                                selected
                            @endif>4</option>
                            <option value='5'
                            @if(old('rt') == '5')
                                selected
                            @endif>5</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Alamat</label>
                        <input type="text" class="form-control" name='alamat' required value="{{ old('alamat') }}">
                    </div>
                    <div class="form-group">
                        <label for="">Kontak (telp/wa)</label>
                        <input type="text" class="form-control" name='no_kontak' required value="{{ old('no_kontak') }}">
                    </div>
                    <div class="form-group">
                        <label for="">email (opsional)</label>
                        <input type="text" class="form-control" name='email_kontak' value="{{ old('email_kontak') }}">
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlFile1">Kartu Keluarga</label>
                        <input type="file" class="form-control-file" name="kartu_keluarga_img" required >
                    </div>

                    <button type="submit" class='btn btn-primary'>Submit</button>

                </form>

            </div>
        </div>
    </div>
</div>
@endsection
