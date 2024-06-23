function registarFilme(){

  let dados = new FormData();
  dados.append('codFilme', $('#codFilme').val());
  dados.append('nomeFilme', $('#nomeFilme').val());
  dados.append('anoFilme', $('#anoFilme').val());
  dados.append('descricaoFilme', $('#descricaoFilme').val());
  dados.append('tipoFilme', $('#tipoFilme').val());

  dados.append('op', 1);

 
  $.ajax({
    url: "src/controller/controllerFilme.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData:false,
  })
  
  .done(function( msg ) {
     alerta("success", msg);
     listaFilmes();
  })
  
  .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
  });

}

function listaFilmes(){

  let dados = new FormData();
  dados.append('op', 2);

 
  $.ajax({
    url: "src/controller/controllerFilme.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData:false,
  })
  
  .done(function( msg ) {

    $('#tableFilmes').html(msg);
     
  })
  
  .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
  });

}





function removerFilme(id){
  let dados = new FormData();
  dados.append('codFilme', id);
  dados.append('op', 3);

 
  $.ajax({
    url: "src/controller/controllerFilme.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData:false,
  })
  
  .done(function( msg ) {

    alerta("success", msg);
    listaFilmes();
     
  })
  
  .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
  });

}

function getDadosFilme(id){

  $('#modalEditFilme').modal('show');

  let dados = new FormData();
  dados.append('codFilme', id);
  dados.append('op', 4);

 
  $.ajax({
    url: "src/controller/controllerFilme.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData:false,
  })
  
  .done(function( msg ) {
    let obj = JSON.parse(msg);
    $('#codFilmeEdit').val(obj.codigo_filme);  
    $('#nomeFilmeEdit').val(obj.nome);
    $('#anoFilmeEdit').val(obj.ano);
    $('#descricaoFilmeEdit').val(obj.descricao);
    $('#tipoFilmeEdit').val(obj.id_tipo);
   
    $('#btnGuardarEdit').attr('onclick', 'guardaEditFilme('+id+')')
  })
  
  .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
  });
}

function guardaEditFilme(id){

  let dados = new FormData();
  dados.append('codFilme', $('#codFilmeEdit').val());

  dados.append('nomeFilme', $('#nomeFilmeEdit').val());
  dados.append('anoFilme', $('#anoFilmeEdit').val());
  dados.append('descricaoFilme', $('#descricaoFilmeEdit').val());
  dados.append('tipoFilme', $('#tipoFilmeEdit').val());

  dados.append('op', 5);

 
  $.ajax({
    url: "src/controller/controllerFilme.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData:false,
  })
  
  .done(function( msg ) {

    alerta("success", msg);
    listaFilmes();
    $('#modalEdit').modal('hide');  
  })
  
  .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
  });
}

function getTipo(){
  let dados = new FormData();
  dados.append('op', 6);

 
  $.ajax({
    url: "src/controller/controllerFilme.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData:false,
  })
  
  .done(function( msg ) {

   $('#tipoFilme').html(msg)
   $('#tipoFilmeEdit').html(msg)


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
  listaFilmes();
  getTipo();
});
