@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Cari Data Keluarga</h1>
    <br>
    <div class="container">
        <div class="container">
            <form class="form-inline" action="temukan-kk" method="post">
                @csrf
                <div class="form-group">
                    <input type="text" class="form-control" name="no_kk" placeholder="No KK" required>
                </div> &nbsp; &nbsp;
                <div class="form-group">
                    <input type="text" class="form-control" name="token" placeholder="Token" required>
                </div> &nbsp; &nbsp;
                <button type="submit" class="btn btn-primary">Cari</button>
            </form>
        </div>
    </div>
</div>
@endsection
