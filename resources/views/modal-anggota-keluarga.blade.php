{{-- Modal Tambah Anggota Keluarga --}}
<div class="modal fade" id="tambahAnggota" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content text-gray-800">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold text-gray-800" id="editRecordLabel">Tambah Anggota Keluarga</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>

            <div class="modal-body text-gray-800">
                <form action="/lihat-data/{{ $kk->no_kk.'/'. $kk->token  }}/tambah-anggota/" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="">Nama</label>
                        <input type="text" class="form-control" name='nama' required value='{{ old('nama') }}'>
                        <input type="text" class="form-control" name='id_kk' value='{{ $kk->id }}' hidden>
                    </div>
                    <div class="form-group">
                        <label for="">NIK</label>
                        <input  required type="text" class="form-control" name='NIK' value='{{ old('NIK') }}'>
                    </div>
                    <div class="form-group">
                        <label for="">Jenis Kelamin</label>
                        <select id="inputState" class="form-control" name='jenis_kelamin'>
                            <option value='L'
                            @if(old('jenis_kelamin') == 'L')
                                selected
                            @endif
                            >L</option>
                            <option value='P'
                            @if(old('jenis_kelamin') == 'P')
                                selected
                            @endif>P</option>

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Tempat Lahir</label>
                        <input type="text" class="form-control" name='tempat_lahir' required value='{{ old('tempat_lahir') }}'>
                    </div>
                    <div class="form-group">
                        <label for="">Tanggal Lahir</label>
                        <input type="date" class="form-control" name='tanggal_lahir' required value='{{ old('tanggal_lahir') }}'>
                    </div>
                    <div class="form-group">
                        <label for="">Agama</label>
                        <select id="inputState" class="form-control" name='agama'>
                            <option value='Islam'
                            @if(old('agama') == 'Islam')
                                selected
                            @endif
                            >Islam</option>
                            <option value='Kristen Protestan'
                            @if(old('agama') == 'Kristen Protestan')
                                selected
                            @endif>Kristen Protestan</option>
                            <option value='Katolik'
                            @if(old('agama') == 'Katolik')
                                selected
                            @endif>Katolik</option>
                            <option value='Hindu'
                            @if(old('agama') == 'Hindu')
                                selected
                            @endif>Hindu</option>
                            <option value='Budha'
                            @if(old('agama') == 'Budha')
                                selected
                            @endif>Budha</option>
                            <option value='Konghucu'
                            @if(old('agama') == 'Konghucu')
                                selected
                            @endif>Konghucu</option>
                        </select>
                    </div>
                    <div class="form-group ">
                        <label for="inputState">Pendidikan Terakhir</label>
                        <select id="inputState" class="form-control" name='pendidikan'>
                            <option value='S3'
                            @if(old('agama') == 'S3')
                                selected
                            @endif
                            >S3</option>
                            <option value='S2'
                            @if(old('agama') == 'S2')
                                selected
                            @endif>S2</option>
                            <option value='S1/D4'
                            @if(old('agama') == 'S1/D4')
                                selected
                            @endif>S1/D4</option>
                            <option value='D3'
                            @if(old('agama') == 'D3')
                                selected
                            @endif>D3</option>
                            <option value='D2'
                            @if(old('agama') == 'D2')
                                selected
                            @endif>D2</option>
                            <option value='D1'
                            @if(old('agama') == 'D1')
                                selected
                            @endif>D1</option>
                            <option value='SMA'
                            @if(old('agama') == 'SMA')
                                selected
                            @endif>SMA</option>
                            <option value='SMP'
                            @if(old('agama') == 'SMP')
                                selected
                            @endif>SMP</option>
                            <option value='SD'
                            @if(old('agama') == 'SD')
                                selected
                            @endif>SD</option>
                            <option value='lain-lain'
                            @if(old('agama') == 'lain-lain')
                                selected
                            @endif>lain-lain</option>
                        </select>
                    </div>
                     <div class="form-group">
                        <label for="">Pekerjaan</label><br>
                            <select id="inputState" class="form-control" name='pekerjaan'>
                                @foreach ($pekerjaan as $p)
                                    <option value='{{ $p }}'
                                    @if(old('pekerjaan') == $p)
                                        selected
                                    @endif
                                    >{{ $p }}</option>
                                @endforeach
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



@foreach ($dapen as $item)
{{-- Modal Edit Anggota Keluarga --}}
    <div class="modal fade" id="editAnggota{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content text-gray-800">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold text-gray-800" id="editRecordLabel">Tambah Anggota Keluarga</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>

                <div class="modal-body text-gray-800">
                    <form action="/lihat-data/{{ $kk->no_kk.'/'. $kk->token  }}/update-anggota/" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="">Nama</label>
                            <input type="text" class="form-control" name='nama' required value='{{ $item->nama }}'>
                            <input type="text" class="form-control" name='id_kk' value='{{ $kk->id }}' hidden>
                            <input type="text" class="form-control" name='id' value='{{ $item->id }}' hidden>
                        </div>
                        <div class="form-group">
                            <label for="">NIK</label>
                            <input  required type="text" class="form-control" name='NIK' value='{{ $item->NIK }}'>
                        </div>
                        <div class="form-group">
                            <label for="">Jenis Kelamin</label>
                            <select id="inputState" class="form-control" name='jenis_kelamin'>
                                <option value='L'
                                @if($item->jenis_kelamin == 'L')
                                    selected
                                @endif
                                >L</option>
                                <option value='P'
                                @if($item->jenis_kelamin == 'P')
                                    selected
                                @endif>P</option>

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Tempat Lahir</label>
                            <input type="text" class="form-control" name='tempat_lahir' required value='{{ $item->tempat_lahir }}'>
                        </div>
                        <div class="form-group">
                            <label for="">Tanggal Lahir</label>
                            <input type="date" class="form-control" name='tanggal_lahir' required value='{{ $item->tanggal_lahir }}'>
                        </div>
                        <div class="form-group">
                            <label for="">Agama</label>
                            <select id="inputState" class="form-control" name='agama'>
                                <option value='Islam'
                                @if($item->agama == 'Islam')
                                    selected
                                @endif
                                >Islam</option>
                                <option value='Kristen Protestan'
                                @if($item->agama == 'Kristen Protestan')
                                    selected
                                @endif>Kristen Protestan</option>
                                <option value='Katolik'
                                @if($item->agama == 'Katolik')
                                    selected
                                @endif>Katolik</option>
                                <option value='Hindu'
                                @if($item->agama == 'Hindu')
                                    selected
                                @endif>Hindu</option>
                                <option value='Budha'
                                @if($item->agama == 'Budha')
                                    selected
                                @endif>Budha</option>
                                <option value='Konghucu'
                                @if($item->agama == 'Konghucu')
                                    selected
                                @endif>Konghucu</option>
                            </select>
                        </div>
                        <div class="form-group ">
                            <label for="inputState">Pendidikan Terakhir</label>
                            <select id="inputState" class="form-control" name='pendidikan'>
                                <option value='S3'
                                @if($item->pendidikan == 'S3')
                                    selected
                                @endif
                                >S3</option>
                                <option value='S2'
                                @if($item->pendidikan == 'S2')
                                    selected
                                @endif>S2</option>
                                <option value='S1/D4'
                                @if($item->pendidikan == 'S1/D4')
                                    selected
                                @endif>S1/D4</option>
                                <option value='D3'
                                @if($item->pendidikan == 'D3')
                                    selected
                                @endif>D3</option>
                                <option value='D2'
                                @if($item->pendidikan == 'D2')
                                    selected
                                @endif>D2</option>
                                <option value='D1'
                                @if($item->pendidikan == 'D1')
                                    selected
                                @endif>D1</option>
                                <option value='SMA'
                                @if($item->pendidikan == 'SMA')
                                    selected
                                @endif>SMA</option>
                                <option value='SMP'
                                @if($item->pendidikan == 'SMP')
                                    selected
                                @endif>SMP</option>
                                <option value='SD'
                                @if($item->pendidikan == 'SD')
                                    selected
                                @endif>SD</option>
                                <option value='lain-lain'
                                @if($item->pendidikan == 'lain-lain')
                                    selected
                                @endif>lain-lain</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Pekerjaan</label><br>
                            <select id="inputState" class="form-control" name='pekerjaan'>
                                @foreach ($pekerjaan as $p)
                                    <option value='{{ $p }}'
                                    @if($item->pekerjaan == $p)
                                        selected
                                    @endif
                                    >{{ $p }}</option>
                                @endforeach
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

{{-- Modal hapus Anggota Keluarga --}}
    <div class="modal fade" id="hapusAnggota{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <a class="btn btn-danger" href="{{ url('lihat-data/' . $kk->no_kk . '/' . $kk->token.'/hapus-anggota'.'/'.$item->id) }}">Hapus</a>
                </div>
            </div>
        </div>
    </div>
@endforeach


{{-- Modal Tambah Laporan --}}
<div class="modal fade" id="tambahLaporan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content text-gray-800">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold text-gray-800" id="editRecordLabel">Tambah Laporan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>

            <div class="modal-body text-gray-800">
                <form action="/lihat-data/{{ $kk->no_kk.'/'. $kk->token  }}/tambah-laporan/" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="">Judul</label>
                        <input type="text" class="form-control" name='judul' required value='{{ old('judul') }}'>
                        <input type="text" class="form-control" name='no_kk' value='{{ $kk->no_kk }}' hidden>
                    </div>

                    <div class="form-group">
                        <label for="">Subjek</label>
                        <select id="inputState" class="form-control" name='subjek'>
                            <option value='Kemalingan'
                            @if(old('subjek') == 'Kemalingan')
                                selected
                            @endif
                            >Kemalingan</option>
                            <option value='KTP'
                            @if(old('subjek') == 'KTP')
                                selected
                            @endif>KTP</option>
                            <option value='Bantuan Bencana'
                            @if(old('subjek') == 'Bantuan Bencana')
                                selected
                            @endif>Bantuan Bencana</option>
                            <option value='Kegiatan'
                            @if(old('subjek') == 'Kegiatan')
                                selected
                            @endif>Kegiatan</option>
                            <option value='lain-lain'
                            @if(old('subjek') == 'lain-lain')
                                selected
                            @endif>lain-lain.</option>

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Deskripsi</label>
                        <textarea name="deskripsi" class='form-control' id="" cols="30" rows="10">{{ old('deskripsi') }}</textarea>
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
<div class="modal fade" id="editKK" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content text-gray-800">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold text-gray-800" id="editRecordLabel">Approve Record</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>

            <div class="modal-body text-gray-800">
                <form action="/lihat-data/{{ $kk->no_kk.'/'. $kk->token  }}/update-kk/" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="">No KK</label>
                        <input type="text" class="form-control" name='no_kk' required value='{{ $kk->no_kk }}' disabled>
                        <input type="text" class="form-control" name='id' value='{{ $kk->id }}' hidden>
                    </div>
                    <div class="form-group">
                        <label for="">Kepala Keluarga</label>
                        <input  required type="text" class="form-control" name='nama_kepala_keluarga' value='{{ $kk->nama_kepala_keluarga }}'>
                    </div>
                    <div class="form-group">
                        <label for="">RT</label>
                        <select id="inputState" class="form-control" name='rt'>
                            <option value='1'
                            @if($kk->rt == '1')
                                selected
                            @endif
                            >1</option>
                            <option value='2'
                            @if($kk->rt == '2')
                                selected
                            @endif>2</option>
                            <option value='3'
                            @if($kk->rt == '3')
                                selected
                            @endif>3</option>
                            <option value='4'
                            @if($kk->rt == '4')
                                selected
                            @endif>4</option>
                            <option value='5'
                            @if($kk->rt == '5')
                                selected
                            @endif>5</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Alamat</label>
                        <input type="text" class="form-control" name='alamat' required value='{{ $kk->alamat }}'>
                    </div>
                    <div class="form-group">
                        <label for="">Kontak (telp/wa)</label>
                        <input type="text" class="form-control" name='no_kontak' required value='{{ $kk->no_kontak }}'>
                    </div>
                    <div class="form-group">
                        <label for="">email (opsional)</label>
                        <input type="text" class="form-control" name='email_kontak' value='{{ $kk->email_kontak }}'>
                    </div>
                    <div class="form-group ">
                        <label for="inputState">Approval</label>
                        <select id="inputState" class="form-control" name='approval' disabled>
                            <option value='1'
                            @if($kk->approval == '1')
                                selected
                            @endif
                            >Disetujui</option>
                            <option value='0'
                            @if($kk->approval == '0')
                                selected
                            @endif>Belum</option>
                        </select>
                    </div>
                     <div class="form-group">
                        <label for="">Kartu Keluarga</label><br>
                        <input type="file"  name='kartu_keluarga_img'>
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
