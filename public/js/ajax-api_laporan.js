// file pasangan input_laporan.js

function APICheck(btn, array) {
    btn_check = $(btn, modal_context);
    var input_id = btn_check.data("id-input");
    var input_value = $("#"+input_id, modal_context).val();

    // console.log(input_value);

    // empty
    if(!input_value.trim()){
        return;
    }

    var button_id = btn_check.attr("id");
    var api = btn_check.attr("data-api");
    var fname = btn_check.data("fname");

    // console.log(input_id);
    // console.log(input_value);
    // console.log(array);

    if(api == 'mhs'){
        $.ajax({
            url: '/api/mahasiswa',
            type: 'GET',
            data:{
                q:input_value,
                array:false
            },
            dataType: 'json',
            timeout: 3000,
            success: function(data) {
                // res = data[0].STUDENTID + ':' + data[0].STUDENTNAME + ':' + data[0].CURRENTPROGRAM.substring(0, 4);
                var res = {
                    id: data.STUDENTID + ':' + data.STUDENTNAME + ':' + data.CURRENTPROGRAM.substring(0, 4),
                    nama: data.STUDENTNAME,
                    prodi: data.prodi
                }
                // console.log(res);
                // console.log(res.nama);
                // console.log(res['nama']);
                array.forEach(element => {
                    if($('#'+fname+'-fieldset > .row', modal_context).length >= array.length){
                        $('#'+fname+element.id, modal_context).val(res[element.id]);
                    }else{
                        // html = '<div class="col-12 pt-2">';
                        var html = '<div class="row">';
                        html += '<label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm text-gray-900">';
                        html += element.label;
                        html += '</label>';
                        html += '<div class="col-sm-6 input-group">'
                        html += '<input type="text" class="form-control form-control-sm" id="'+fname+element.id+'" value="'+res[element.id]+'"disabled>';
                        html += '</div>';
                        html += '</div>';
                        // html += '</div>';
                        $('#'+fname+'-fieldset', modal_context).append(html);
                    }
                });
            },
            error: function(){
                alert("NIM tidak ditemukan")
                // kosongkan field
                if(typeof arr_results != 'undefined') {
                    if($('#'+fname+'-fieldset > .row', modal_context).length >= array.length){
                        array.forEach(element => {
                            $('#'+fname+element.id, modal_context).val('');
                        });
                    }
                }
                return;
            },
            cache: true
        })
    }
}

// ketika submit form
// hanya utk input text
function apiResult(index, array) {
    // array inputan nim/nip
    var arrinput = [];
    // array id input
    var arrid = [];
    // get input value
    // console.log(array);
    array.forEach(element => {
        arrinput.push($('#'+element.in, modal_context).val());
        arrid.push(element.id);
    });

    //flag
    var submitform = false;

    switch (dynamic_field[index].api) {
        case 'mhs':
            $.ajax({
                url: '/api/mahasiswa/multi',
                type: 'GET',
                data:{
                    q:arrinput
                },
                dataType: 'json',
                delay: 850,
                async:false,
                success: function(data) {
                    // res = data[0].STUDENTID + ':' + data[0].STUDENTNAME + ':' + data[0].CURRENTPROGRAM.substring(0, 4);
                    var res = $.map(data, function (item) {
                        if(!jQuery.isEmptyObject(item)){
                            return {
                                text: item.STUDENTNAME + ' - ' + item.STUDENTID,
                                id: item.STUDENTID + ':' + item.STUDENTNAME + ':' + item.CURRENTPROGRAM.substring(0, 4)
                            }
                        }
                    })
                    console.log(res);
                    for (let index = 0; index < arrid.length; index++) {
                        const value = arrid[index];
                        if(!jQuery.isEmptyObject(res[index])){
                            $('#'+value, modal_context).val(res[index].id);
                            console.log(value);
                            console.log($('#'+value, modal_context).val());
                        }
                    }
                    // submit
                    // $('form', modal_context).submit();
                    submitform = true;
                },
                error: function(){
                    alert("NIM tidak ditemukan")
                    // kosongkan field check
                    if(typeof arr_results != 'undefined') {
                        for (let index = 0; index < arrid.length; index++) {
                            const fname = arrid[index];
                            if($('#'+fname+'-fieldset > .row', modal_context).length >= arr_results[dynamic_field[index].id].length){
                                arr_results[dynamic_field[index].id].forEach(element => {
                                    $('#'+fname+element.id, modal_context).val('');
                                });
                            }
                        }
                    }
                    return;
                },
                cache: true
            })
            break;
        case 'pegawai':
            // select2Pegawai(item.id);
            break;
        default:
            // $('#'+item.id).select2();
            // break;
    }

    return submitform;
}


function select2Mahasiswa(id_select, context, nimOnly, flag_edit) {
    // console.log(context);
    $('#'+id_select, context).select2({
        placeholder: 'Ketik nama atau nim mahasiswa',
        ajax: {
          url: '/api/mahasiswa',
          dataType: 'json',
          delay: 850,
        //   timeout: 3000,
          processResults: function (data) {
            return {
                results:  $.map(data, function (item) {
                    if(nimOnly){
                        return {
                            text: item.STUDENTNAME + ' - ' + item.STUDENTID,
                            id: item.STUDENTID
                        }
                    }else{
                        return {
                            text: item.STUDENTNAME + ' - ' + item.STUDENTID,
                            id: item.STUDENTID + ':' + item.STUDENTNAME + ':' + item.CURRENTPROGRAM.substring(0, 4)
                        }
                    }
                  })
              };
        },
          cache: true
        }
    });

    var s2 = $('#'+id_select, context);
    var val = s2.data("pre-value");
    if(flag_edit && val != '__pre-value__' && val != ''){
        $.ajax({
            type: 'GET',
            url: '/api/mahasiswa/s/',
            // timeout: 3000,
            data:{
                q:val
            },
            dataType: 'json'
        }).then(function (data) {
            // console.log(data)
            // create the option and append to Select2
            var opt;
            if(nimOnly){
                opt = {
                    text: data.STUDENTNAME + ' - ' + data.STUDENTID,
                    id: data.STUDENTID
                }
            }else{
                opt = {
                    text: data.STUDENTNAME + ' - ' + data.STUDENTID,
                    id: data.STUDENTID + ':' + data.STUDENTNAME + ':' + data.CURRENTPROGRAM.substring(0, 4)
                }
            }
            var option = new Option(opt.text, opt.id, true, true);
            s2.append(option).trigger('change');

            // manually trigger the `select2:select` event
            s2.trigger({
                type: 'select2:select',
                params: {
                    data: data
                }
            });
        });
    }
}

function select2Pegawai(id_select, context, nipOnly, flag_edit) {
    $('#'+id_select, context).select2({
        placeholder: 'Ketik nama atau nip',
        ajax: {
          url: '/api/pegawai',
          dataType: 'json',
          delay: 750,
        //   timeout: 3000,
          quietMillis: 20,
        //   async:false,
          processResults: function (data) {
            return {
                results:  $.map(data, function (item) {
                    if(nipOnly){
                        return {
                            text: item.GELARNAMA + ' - ' + item.NIP,
                            id: item.NIP
                        }
                    }else{
                        return {
                            text: item.GELARNAMA + ' - ' + item.NIP,
                            id: item.NIP + ':' + item.GELARNAMA
                        }
                    }
                  })
              };
        },
          cache: true
        }
    });

    var s2 = $('#'+id_select, context);
    var val = s2.data("pre-value");
    if(flag_edit && val != '__pre-value__' && val != ''){
        $.ajax({
            type: 'GET',
            url: '/api/pegawai/s/',
            // timeout: 3000,
            // async:false,
            data:{
                q:val
            },
            dataType: 'json',
        }).then(function (data) {
            // console.log(data)
            // create the option and append to Select2
            var opt;
            if(nipOnly){
                opt = {
                    text: data.GELARNAMA + ' - ' + data.NIP,
                    id: data.NIP
                }
            }else{
                opt = {
                    text: data.GELARNAMA + ' - ' + data.NIP,
                    id: data.NIP + ':' + data.GELARNAMA
                }
            }
            var option = new Option(opt.text, opt.id, true, true);
            s2.append(option).trigger('change');

            // manually trigger the `select2:select` event
            s2.trigger({
                type: 'select2:select',
                params: {
                    data: data
                }
            });
        });
    }
}
