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