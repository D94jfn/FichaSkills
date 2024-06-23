<?php
require_once '../model/modelCinema.php';

$cinema = new Cinema();

if($_POST['op'] == 1){
    $resposta = $cinema -> registarCinema(
        $_POST['idCinema'], 
        $_POST['nomeCinema'], 
        $_POST['cinemaLocal'], 
      
     );
    echo($resposta);
}else if($_POST['op'] == 2){
    $resposta = $cinema -> listarCinemas();
    echo($resposta);
}else if($_POST['op'] == 3){
    $resposta = $cinema -> removerCinema($_POST['id_cinema']);
    echo($resposta);
}else if($_POST['op'] == 4){
    $resposta = $cinema -> getDadosCinema($_POST['id_cinema']);
    echo($resposta);
}else if($_POST['op'] == 5){
    $resposta = $cinema -> editCinema($_POST['id_cinema'],  $_POST['nome'], $_POST['id_local']);
    echo($resposta);
}else if($_POST['op'] == 6){
    $resposta = $cinema -> getLocalizacao();
    echo($resposta);
}
?>