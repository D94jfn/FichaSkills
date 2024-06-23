function registarSessao(){

  let dados = new FormData();
  dados.append('idSessao', $('#idSessao').val());
  dados.append('dataSessao', $('#dataSessao').val());
  dados.append('horaSessao', $('#horaSessao').val());
  dados.append('estadoSessao', $('#estadoSessao').val());
  dados.append('salaSessao', $('#salaSessao').val());
  dados.append('filmeSessao', $('#filmeSessao').val());

  dados.append('op', 1);

 
  $.ajax({
    url: "src/controller/controllerSessao.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData:false,
  })
  
  .done(function( msg ) {
     alerta("success", msg);
     listaSessoes();
  })
  
  .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
  });

}

function listaSessoes(){

  let dados = new FormData();
  dados.append('op', 2);

 
  $.ajax({
    url: "src/controller/controllerSessao.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData:false,
  })
  
  .done(function( msg ) {

    $('#tableSessoes').html(msg);
     
  })
  
  .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
  });

}





function removerSessao(id){
  let dados = new FormData();
  dados.append('idSessao', id);
  dados.append('op', 3);

 
  $.ajax({
    url: "src/controller/controllerSessao.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData:false,
  })
  
  .done(function( msg ) {

    alerta("success", msg);
    listaSessoes();
     
  })
  
  .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
  });

}

function getDadosSessao(id){

  $('#modalEditSessao').modal('show');

  let dados = new FormData();
  dados.append('idSessao', id);
  dados.append('op', 4);

 
  $.ajax({
    url: "src/controller/controllerSessao.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData:false,
  })
  
  .done(function( msg ) {
    let obj = JSON.parse(msg);
    $('#idSessaoEdit').val(obj.id_sessao);  
    $('#dataSessaoEdit').val(obj.data_sessao);
    $('#horaSessaoEdit').val(obj.hora);
    $('#salaSessaoEdit').val(obj.codigo_sala);
    $('#filmeSessaoEdit').val(obj.codigo_filme);
    $('#estadoSessaoEdit').val(obj.estado);
   
    $('#btnGuardarEdit').attr('onclick', 'guardaEditSessao('+id+')')
  })
  
  .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
  });
}

function guardaEditSessao(id) {
  let dados = new FormData();
  dados.append('idSessao', $('#idSessaoEdit').val());
  dados.append('dataSessao', $('#dataSessaoEdit').val());
  dados.append('horaSessao', $('#horaSessaoEdit').val());
  dados.append('estadoSessao', $('#estadoSessaoEdit').val());
  dados.append('salaSessao', $('#salaSessaoEdit').val());
  dados.append('filmeSessao', $('#filmeSessaoEdit').val());
  dados.append('op', 5);

  $.ajax({
    url: "src/controller/controllerSessao.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData: false,
  })
  .done(function(msg) {
    alerta("success", msg);
    listaSessoes();
    $('#modalEdit').modal('hide');
  })
  .fail(function(jqXHR, textStatus) {
    alert("Request failed: " + textStatus);
  });
}

function desativarSessao(id){


  let dados = new FormData();
  dados.append('idSessao', id);
  dados.append('estadoSessao', 1);
  dados.append('op', 8);

 
  $.ajax({
    url: "src/controller/controllerSessao.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData:false,
  })
  
  .done(function( msg ) {
    // let obj = JSON.parse(msg);
    listaSessoes();

  })
  
  .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
  });
}


function getFilmes(){
  let dados = new FormData();
  dados.append('op', 6);

 
  $.ajax({
    url: "src/controller/controllerSessao.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData:false,
  })
  
  .done(function( msg ) {

   $('#filmeSessao').html(msg)
   $('#filmeSessaoEdit').html(msg)


  })
  
  .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
  });

}


function getSalas(){
  let dados = new FormData();
  dados.append('op', 7);

 
  $.ajax({
    url: "src/controller/controllerSessao.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData:false,
  })
  
  .done(function( msg ) {

   $('#salaSessao').html(msg)
   $('#salaSessaoEdit').html(msg)


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
  listaSessoes();
  getFilmes();
  getSalas();
});
