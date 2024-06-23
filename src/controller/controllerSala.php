<?php
require_once '../model/modelSala.php';

$sala = new Sala();

if($_POST['op'] == 1){
    $resposta = $sala -> registarSala(
        $_POST['codSala'], 
        $_POST['descricaoSala'], 
        $_POST['cinemaSala'], 
      
     );
    echo($resposta);
}else if($_POST['op'] == 2){
    $resposta = $sala -> listarSalas();
    echo($resposta);
}else if($_POST['op'] == 3){
    $resposta = $sala -> removerSala($_POST['codSala']);
    echo($resposta);
}else if($_POST['op'] == 4){
    $resposta = $sala -> getDadosSala($_POST['codSala']);
    echo($resposta);
}else if($_POST['op'] == 5){
    $resposta = $sala -> editSala(
        $_POST['codSala'],
        $_POST['descricaoSala'],
        $_POST['cinemaSala']);
    echo($resposta);
}else if($_POST['op'] == 6){
    $resposta = $sala -> getCinemas();
    echo($resposta);
}
?>