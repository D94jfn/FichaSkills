function registarSala(){

  let dados = new FormData();
  dados.append('codSala', $('#codSala').val());
  dados.append('descricaoSala', $('#descricaoSala').val());
  dados.append('cinemaSala', $('#cinemaSala').val());

  dados.append('op', 1);

 
  $.ajax({
    url: "src/controller/controllerSala.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData:false,
  })
  
  .done(function( msg ) {
     alerta("success", msg);
     listaSalas();
  })
  
  .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
  });

}

function listaSalas(){

  let dados = new FormData();
  dados.append('op', 2);

 
  $.ajax({
    url: "src/controller/controllerSala.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData:false,
  })
  
  .done(function( msg ) {

    $('#tableSalas').html(msg);
     
  })
  
  .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
  });

}





function removerSala(id){
  let dados = new FormData();
  dados.append('codSala', id);
  dados.append('op', 3);

 
  $.ajax({
    url: "src/controller/controllerSala.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData:false,
  })
  
  .done(function( msg ) {

    alerta("success", msg);
    listaSalas();
     
  })
  
  .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
  });

}

function getDadosSala(id){

  $('#modalEditSala').modal('show');

  let dados = new FormData();
  dados.append('codSala', id);
  dados.append('op', 4);

 
  $.ajax({
    url: "src/controller/controllerSala.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData:false,
  })
  
  .done(function( msg ) {
    let obj = JSON.parse(msg);
    $('#codSalaEdit').val(obj.codigo_sala);  
    $('#descricaoSalaEdit').val(obj.descricao);
    $('#cinemaSalaEdit').val(obj.id_cinema);
   
    $('#btnGuardarEdit').attr('onclick', 'guardaEditSala('+id+')')
  })
  
  .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
  });
}

function guardaEditSala(id){

  let dados = new FormData();
  dados.append('codSala', $('#codSalaEdit').val());

  dados.append('descricaoSala', $('#descricaoSalaEdit').val());
  dados.append('cinemaSala', $('#cinemaSalaEdit').val());

  dados.append('op', 5);

 
  $.ajax({
    url: "src/controller/controllerSala.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData:false,
  })
  
  .done(function( msg ) {

    alerta("success", msg);
    listaSalas();
    $('#modalEdit').modal('hide');  
  })
  
  .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
  });
}

function getCinema(){
  let dados = new FormData();
  dados.append('op', 6);

 
  $.ajax({
    url: "src/controller/controllerSala.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData:false,
  })
  
  .done(function( msg ) {

   $('#cinemaSala').html(msg)
   $('#cinemaSalaEdit').html(msg)


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
  listaSalas();
  getCinema();
});
