function ubahForm() {
    document.getElementById('thn-tahun').value = document.getElementById('tahun').value;
    document.getElementById('form-tahun').submit();
}

// event tutup periode
function tutupForm(id, tgl, tahun, periode) {
    document.getElementById('t-id').value = id;
    document.getElementById('t-tgl_tutup').value = tgl;
    document.getElementById('t-tahun').value = tahun;
    document.getElementById('t-periode').value = periode;
    // document.getElementById('form-tutup').submit();
    $('#modal-tutup').modal('show');
}
$('#modal-tutup').on('show.bs.modal', function (event) {
    $('#modal-tutup').find('.modal-title').text('Tutup Periode ' + document.getElementById('t-periode').value);
})
// event edit periode
function editForm(id, bulan, tgl_buka, tgl_tutup, periode) {
    document.getElementById('ed-id').value = id;
    document.getElementById('ed-bulan').value = bulan;
    document.getElementById('ed-tgl_buka').value = tgl_buka;
    document.getElementById('ed-tgl_tutup').min = tgl_buka;
    document.getElementById('ed-tgl_tutup').value = tgl_tutup;
    document.getElementById('ed-periode').value = periode;
    $('#modal-edit').modal('show');
}
$('#modal-edit').on('show.bs.modal', function (event) {
    $('#modal-edit').find('.modal-title').text('Edit Periode ' + document.getElementById('ed-periode').value);
    const id = document.getElementById('ed-id').value;
    const thn = document.getElementById('ed-tahun').value;
    bulanOpt(id, thn, 'ed-bulan');
})
// event edit periode
function bukaForm(id, bulan, tgl_buka, tgl_tutup, periode) {
    document.getElementById('bk-id').value = id;
    document.getElementById('bk-bulan').value = bulan;
    document.getElementById('bk-tgl_buka').value = tgl_buka;
    document.getElementById('bk-tgl_tutup').min = tgl_buka;
    document.getElementById('bk-tgl_tutup').value = tgl_tutup;
    document.getElementById('bk-periode').value = periode;
    $('#modal-buka').modal('show');
}
$('#modal-buka').on('show.bs.modal', function (event) {
    $('#modal-buka').find('.modal-title').text('Buka Periode ' + document.getElementById('bk-periode').value);
})
//
$('#modal-tambah').on('show.bs.modal', function (event) {
    const thn = document.getElementById('tahun').value;
    document.getElementById('tb-tahun').value = thn;
    bulanOpt(null, thn, 'tb-bulan');
}) 

// $('#tgl_buka_tri').change(function () {
//     var cdate = new Date($(this).val());
//     cdate.setDate(cdate.getDate()+1);
//     $('#tgl_tutup_tri').val(cdate.toDateInputValue());
//     $('#tgl_tutup_tri').attr("min", cdate.toDateInputValue());
// })

// ganti tanggal tutup otomatis
$('.tgl-buka').change(function () {
    tgl_tutup = $('#'+$(this).data('tgl-tutup'));
    var cdate = new Date($(this).val());
    $(tgl_tutup ).attr("min", cdate.toDateInputValue());
    cdate.setDate(cdate.getDate()+1);
    if (Date.parse($(this).val()) >= Date.parse($(tgl_tutup).val())) {
        $(tgl_tutup ).val(cdate.toDateInputValue());
    }
})
Date.prototype.toDateInputValue = (function() {
    var local = new Date(this);
    local.setMinutes(this.getMinutes() - this.getTimezoneOffset());
    return local.toJSON().slice(0,10);
});
$(document).ready(function(e) {

    // cek periode
    $('#tb-btn').click(function (e) {
        e.preventDefault();
        var thn = $('#tb-tahun').val();
        var bln = $('#tb-bulan').val();
        checkPeriode(thn, bln, $('#form-tambah'));
    });

    $(document).ajaxStart(function(){
        $('body').addClass("loading");
    });
    $(document).ajaxComplete(function(){
        $('body').removeClass("loading")
    });
});

function checkPeriode(thn, bln, form) {
    $.ajax({
        url: '/admin/periode/check',
        type: 'GET',
        data:{
            tahun: thn,
            bulan: bln
        },
        success: function(data) {
            $(form).submit();
        },
        error: function(){
            alert('Periode sudah ada');
        }
    });
}

function bulanOpt(_id, thn, blnid) {
    const blnselect = $('#'+blnid);
    $.ajax({
        url: '/admin/periode/bulanopt',
        type: 'GET',
        data:{
            tahun: thn,
            id: _id
        },
        success: function(data) {
            console.log(thn)
            console.log({_id, data});
            $(blnselect).empty();
            for (const [key, value] of Object.entries(data)) {
                $(blnselect).append(new Option(value, value));
                if(key === 'selected'){
                    console.log('selected');
                    $(blnselect).val(value);
                }
            }
        },
        error: function(){
            alert('error');
        }
    });
}