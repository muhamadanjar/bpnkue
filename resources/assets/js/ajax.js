function xhr_get(url) {

  return $.ajax({
    url: url,
    type: 'get',
    dataType: 'json'
  })
  .pipe(function(data) {

    return data.responseCode != 200 ? $.Deferred().reject( data ) : data;
  })
  .fail(function(data) {
    if ( data.responseCode )

      console.log( data.responseCode );
  });
}

function xhr_post(url,data) {

  return $.ajax({
    url: url,
    type: 'post',
    dataType: 'json',
    data: data,
  })
  .pipe(function(data) {
    $('#statussave').html('Data berhasil disimpan');
    setInterval(function() {
      $('#statussave').html('');
    }, 3000);
    return data.responseCode != 200 ?
      $.Deferred().reject( data ) : data;
  })
  .fail(function(data) {

    if ( data.responseCode )
      $('#statussave').html('Data berhasil tidak disimpan');
      setInterval(function() {
        $('#statussave').html('');
      }, 3000);
      console.log( data.responseCode );
  }).then(function(data){
    window.location = '/home';
  });
}
