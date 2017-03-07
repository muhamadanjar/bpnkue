function xhr_get(url) {

  return $.ajax({
    url: url,
    type: 'get',
    dataType: 'json'
  })
  .pipe(function(data) {
    return data.responseCode != 200 ?
      $.Deferred().reject( data ) :
      data;
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
    return data.responseCode != 200 ?
      $.Deferred().reject( data ) :
      data;
  })
  .fail(function(data) {
    if ( data.responseCode )
      console.log( data.responseCode );
  }).then(function(data){
    window.location = '/home';
  });
}
