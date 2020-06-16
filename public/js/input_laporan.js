// add-edt flag
var addrecord_flag = false;
var editrecord_flag = false;

// select2 flag
var select2 = false;
// select2 list
var s2_list = [];

// api 1 field
// var single_field_api_flag = false;
// var sf_list = [];

// dynamic field flag
var dynamic_field_flag = false;
var dynamic_field_type = [];
// string html utk field dinamis
var dynamic_field_htmlstring=[];
// object berisi id dan api dari field dinamis
var dynamic_field=[];
// array berisi field dinamis yang masih aktif
var df_list = [];
var df_counter = [];

// index list field dinamis
var i=0;
// 
var modal_context={};

$(document).ready(function() {
    // console.log(dynamic_field_htmlstring.replace(/__rowid__/g, 1));

    // modal selector
    // $('#tambahModal').on('show.bs.modal', function (event) {
    //     refreshDFields();
    //     modal_context = this;
    // })
    // $('.editrecord-modal').on('show.bs.modal', function (event) {
    //     refreshDFields();
    //     modal_context = this;
    //     if(!jQuery.isEmptyObject(modal_context)){
    //         console.log(modal_context);
    //     }
    // })

    // modal show event
    $('.rc-modal').on('show.bs.modal', function (event) {
        var modal_rec =  $(this).data("rec");
        // set modal context
        modal_context = this;
        
        // reset field dinamis
        if(modal_rec == 'add' && addrecord_flag == false){
            addrecord_flag = true;
            editrecord_flag = false;
            refreshDFields();
        }        
        if(modal_rec == 'edit'){
            addrecord_flag = false;
            editrecord_flag = true;
            refreshDFields();
            fillDFFields(this);
        }

        if(select2 == true){
            s2_list.forEach(element => {
                addSelect2(element, modal_context, editrecord_flag);
            });
        }

        // idm = $(this).attr("id");
        if(dynamic_field_flag == true){
            $('.add-detail', modal_context).off('click').click(function(){
                var index_df = $(this).data("index-df");
                addDFField(index_df, '', editrecord_flag)
            });
            $(modal_context).off('click').on('click', '.remove-detail', function(){
                var button_id = $(this).attr("id");
                var index_df = $(this).data("index-df");
                $('#row'+index_df+''+button_id, modal_context).remove();
                delete df_list[index_df][button_id];
                df_counter[index_df]--;
            }); 
        }

        // submit listener
        $('.submit-record', modal_context).off('click').click(function (e) {
            e.preventDefault();
            if(dynamic_field_flag == true){
                for (let index = 0; index < dynamic_field_type.length; index++) {
                    const element = dynamic_field_type[index];
                    if(df_counter[index] > 0){
                        if(element == 'text' && dynamic_field[index].api == 'mhs'){
                            apiResult(index, df_list[index]);
                        }
                    }
                }
                // $('form', modal_context).submit();
            }
            $('form', modal_context).submit();
        });
    })
});

// context add-detail btn
function addDFField(index_df, pre_val, flag_edit) {
    // console.log(dynamic_field[index_df]);
    // console.log(dynamic_field[index_df].id+df_counter[index_df])
    // console.log(dynamic_field_type[index_df])

    var html = dynamic_field_htmlstring[index_df].replace(/__rowid__/g, df_counter[index_df]);

    // If value array
    if(Array.isArray(pre_val)){
        pre_val.forEach(element => {
            // console.log(pre_val);
            // replace one each time
            html = html.replace('__pre-value__', element); 
            // console.log(html);
        });
    }else{
        // global replace
        html = html.replace(/__pre-value__/g, pre_val);
    }

    $('#dfield'+index_df, modal_context).append(html);

    // add select2
    if(dynamic_field_type[index_df] == 'select2'){
        // console.log(dynamic_field[index_df].id+df_counter[index_df])
        addSelect2({id:dynamic_field[index_df].id+df_counter[index_df], api:dynamic_field[index_df].api}, modal_context,flag_edit);
    }else{
        df_list[index_df][df_counter[index_df]] = {id:dynamic_field[index_df].id+df_counter[index_df], in:dynamic_field[index_df].id+df_counter[index_df]+'-input'};
        if(dynamic_field[index_df].api.length > 0){
            var btnid = '#'+dynamic_field[index_df].id+df_counter[index_df]+'-check';
            var btn = $(btnid, modal_context);
            // console.log(btn);
            btn.click();
            // APICheck(btn, arr_results[dynamic_field[index_df].id])
        }
    }

    df_counter[index_df]++;
}

function refreshDFields() {
    for (let index = 0; index < df_list.length; index++) {
        const value = df_list[index];
        // hapus row
        $(modal_context).find(".df-row").each(function () {
            this.remove();
        });
        df_list[index].splice(0, df_list[index].length);
        df_counter[index] = 0;
    }
    // df_list.splice(1, df_list.length);
    // console.log(fillDF);
    i=0;
    console.log("refreshed")
}

var fillDF = []
function addFillDFList(mdid ,index_df, pre_val) {
    fillDF.push({mdid:mdid, id:index_df, val:pre_val});
}
function fillDFFields(mdcontext) {
    var mdid = $(mdcontext).attr('id');
    fillDF.forEach(element => {
        if(element.mdid == mdid){
            addDFField(element.id, element.val, true);
        }
    });
}

function addSelect2(item, mdcontext, flag_edit) {
    switch (item.api) {
        case 'mhs':
            select2Mahasiswa(item.id, mdcontext, item.returnOne, flag_edit);
            break;
        case 'pegawai':
            select2Pegawai(item.id, mdcontext, item.returnOne, flag_edit);
            break;
        default:
            $('#'+item.id, mdcontext).select2();
            break;
    }
}

// 
function addS2List(_id, _api, _returnOne) {
    s2_list.push({id:_id, api:_api, returnOne:_returnOne});
}
// function addSFList(_id, _api) {
//     sf_list.push({id:_id, api:_api});
// }
