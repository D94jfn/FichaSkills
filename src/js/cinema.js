function registarCinema(){

  let dados = new FormData();
  dados.append('idCinema', $('#idCinema').val());
  dados.append('nomeCinema', $('#nomeCinema').val());
  dados.append('cinemaLocal', $('#cinemaLocal').val());

  dados.append('op', 1);

 
  $.ajax({
    url: "src/controller/controllerCinema.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData:false,
  })
  
  .done(function( msg ) {
     alerta("success", msg);
     listaCinemas();
  })
  
  .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
  });

}

function listaCinemas(){

  let dados = new FormData();
  dados.append('op', 2);

 
  $.ajax({
    url: "src/controller/controllerCinema.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData:false,
  })
  
  .done(function( msg ) {

    $('#tableCinemas').html(msg);
     
  })
  
  .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
  });

}





function removerCinema(id){
  let dados = new FormData();
  dados.append('id_cinema', id);
  dados.append('op', 3);

 
  $.ajax({
    url: "src/controller/controllerCinema.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData:false,
  })
  
  .done(function( msg ) {

    alerta("success", msg);
    listaCinemas();
     
  })
  
  .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
  });

}

function getDadosCinema(id){

  $('#modalEditCinema').modal('show');

  let dados = new FormData();
  dados.append('id_cinema', id);
  dados.append('op', 4);

 
  $.ajax({
    url: "src/controller/controllerCinema.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData:false,
  })
  
  .done(function( msg ) {
    let obj = JSON.parse(msg);
    $('#idCinemaEdit').val(obj.id_cinema);  
    $('#nomeCinemaEdit').val(obj.nome);
    $('#cinemaLocalEdit').val(obj.id_local);
   
    $('#btnGuardarEdit').attr('onclick', 'guardaEditCinema('+id+')')
  })
  
  .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
  });
}

function guardaEditCinema(id){

  let dados = new FormData();
  dados.append('id_cinema', $('#idCinemaEdit').val());

  dados.append('nome', $('#nomeCinemaEdit').val());
  dados.append('id_local', $('#cinemaLocalEdit').val());

  dados.append('op', 5);

 
  $.ajax({
    url: "src/controller/controllerCinema.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData:false,
  })
  
  .done(function( msg ) {

    alerta("success", msg);
    listaCinemas();
    $('#modalEdit').modal('hide');  
  })
  
  .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
  });
}

function getlocal(){
  let dados = new FormData();
  dados.append('op', 6);

 
  $.ajax({
    url: "src/controller/controllerCinema.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData:false,
  })
  
  .done(function( msg ) {

   $('#cinemaLocal').html(msg)
   $('#cinemaLocalEdit').html(msg)


  })
  
  .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
  });

}

function alerta(icon, msg){
  Swal.fire({
    icon: icon,
    text: msg,
  });
}


// Shorthand for $( document ).ready()
$(function() {
  listaCinemas();
  getlocal();
});
