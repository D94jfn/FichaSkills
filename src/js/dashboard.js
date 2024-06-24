function getContagem() {

  let dados = new FormData();


  dados.append('op', 1);


  $.ajax({
    url: "src/controller/controllerDashboard.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData: false,
  })

    .done(function (msg) {

      $('#cinemasCount').html(msg);
    })

    .fail(function (jqXHR, textStatus) {
      alert("Request failed: " + textStatus);
    });

}


function getContagemFilmes() {

  let dados = new FormData();


  dados.append('op', 2);


  $.ajax({
    url: "src/controller/controllerDashboard.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData: false,
  })

    .done(function (msg) {

      $('#filmesCount').html(msg);
    })

    .fail(function (jqXHR, textStatus) {
      alert("Request failed: " + textStatus);
    });

}



function listarSessoes() {

  let dados = new FormData();


  dados.append('op', 3);
  dados.append('op', 3);


  $.ajax({
    url: "src/controller/controllerDashboard.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData: false,
  })

    .done(function (msg) {

      $('#tableFilmesFiltro').html(msg);
    })

    .fail(function (jqXHR, textStatus) {
      alert("Request failed: " + textStatus);
    });

}



function getCinema() {
  let dados = new FormData();
  dados.append('op', 6);


  $.ajax({
    url: "src/controller/controllerSala.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData: false,
  })

    .done(function (msg) {

      $('#cinemasFiltro').html(msg)


    })

    .fail(function (jqXHR, textStatus) {
      alert("Request failed: " + textStatus);
    });

}

function filtraCinema(cinema) {

  if (cinema != -1) {

    let dados = new FormData();

    dados.append('cinema', cinema);
    dados.append('op', 4);


    $.ajax({
      url: "src/controller/controllerDashboard.php",
      method: "POST",
      data: dados,
      dataType: "html",
      cache: false,
      contentType: false,
      processData: false,
    })

      .done(function (msg) {

        $('#tableFilmesFiltro').html(msg)


      })

      .fail(function (jqXHR, textStatus) {
        alert("Request failed: " + textStatus);
      });

  }else { listarSessoes(); }





}




function alerta(icon, msg) {
  Swal.fire({
    icon: icon,
    text: msg,
  });
}


// Shorthand for $( document ).ready()
$(function () {
  getCinema();
  getContagem();
  getContagemFilmes();
  listarSessoes();
});
