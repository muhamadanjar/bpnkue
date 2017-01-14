$.ajaxSetup({
    headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') }
});
(function($, window, document){}(jQuery, window, document));
$.extend({
    getValues: function(url) {
        var result = null;
        $.ajax({
            url: url,
            type: 'get',
            dataType: 'json',
            async: false,
            success: function(data) {
                result = data;
            }
        });
        return result;
    }
});
/*        
tinymce.init({
    selector: ".tinymce_rsmmm",
            theme: "modern",
                //skin: "light",
    width: 580,
    height: 200,    
    /*plugins: [
        "advlist autolink link image lists charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking spellchecker",
        "table contextmenu directionality emoticons paste textcolor responsivefilemanager code "
    ],*/
    /*relative_urls: false,
    browser_spellcheck : true ,
    filemanager_title:"Responsive Filemanager",
    external_filemanager_path:"http://"+window.location.hostname+"/filemanager/",
    external_plugins: { "filemanager" : "../../filemanager/plugin.min.js"},
    codemirror: {
        indentOnInit: true, // Whether or not to indent code on init. 
        path: 'CodeMirror'
    },  
    image_advtab: true,
    toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect",
    toolbar2: "| responsivefilemanager | image | media | link unlink anchor | print preview code  | youtube | qrcode | flickr | picasa | easyColorPicker"
});
*/
function numeralsOnly(evt) {
    evt = (evt) ? evt : event;
    var charCode = (evt.charCode) ? evt.charCode : ((evt.keyCode) ? evt.keyCode :
    ((evt.which) ? evt.which : 0));
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            alert("Hanya Nomor yang bisa di input pada kolom ini.");
            console.log(evt);
            return false;
        }
    return true;
}

function lettersOnly(evt) {
    evt = (evt) ? evt : event;
    var charCode = (evt.charCode) ? evt.charCode : ((evt.keyCode) ? evt.keyCode :
        ((evt.which) ? evt.which : 0));
    if (charCode > 31 && (charCode < 65 || charCode > 90) && (charCode < 97 || charCode > 122)) {
        alert("Enter letters only.");
        return false;
    }
    return true;
}

function ynOnly(evt) {
    evt = (evt) ? evt : event;
    var charCode = (evt.charCode) ? evt.charCode : ((evt.keyCode) ? evt.keyCode : ((evt.which) ? evt.which : 0));
    if (charCode > 31 && charCode != 78 && charCode != 89 && charCode != 110 && charCode != 121) {
    alert("Enter \"Y\" or \"N\" only.");

    return false;
    }
    return true;
}

function valBetweenAlt(v, min, max) {
    if (val > min) {
        if (val < max) {
            return val;
        } else return max;
    } else return min;
}

function rangeNumber(evt) {

    evt = (evt) ? evt : event;
    var charCode = (evt.charCode) ? evt.charCode : ((evt.keyCode) ? evt.keyCode :
    ((evt.which) ? evt.which : 0));
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            alert("Hanya Nomor yang bisa di input pada kolom ini.");
                $(this).val(0);
            return false;
        }
        var max = 100;
        var min = 0;
        if ($(this).val() > max){
             $(this).val(max);
        }else if($(this).val() < min){
             $(this).val(min);
        }
        
        
        
    return true;
}

(function($, window, document){
    $('.frmKuesioner').on('click', function(e) {
        e.preventDefault();
        
        var el = $(this).parent();
        var title = el.attr('data-title');
        var msg = el.attr('data-message');
        var dataForm = el.attr('data-form');
        
        $('#frmKuesioner')
        .find('#frm_body').html('<h6>'+msg+'</h6>')
        .end().find('#frm_title').html(title)
        .end().modal('show');
        
        $('#frmKuesioner').find('#frm_submit').attr('data-form', dataForm);
    });

    $('#frmKuesioner').on('click', '#frm_submit', function(e) {
        var id = $(this).attr('data-form');
        console.log(id);
        $(id).submit();
    });

}(jQuery, window, document));

(function($, window, document){
    $('#kuesioner_satu').DataTable();
    $('#kuesioner_dua').DataTable();
    $('#kuesioner_tiga').DataTable();
}(jQuery, window, document));