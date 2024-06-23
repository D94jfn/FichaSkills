<?php
require_once '../model/modelDashboard.php';

$dashboard = new Dashboard();

if($_POST['op'] == 1){
    $resposta = $dashboard -> getContagemCinemas();
    echo($resposta);
}else if($_POST['op'] == 2){
    $resposta = $dashboard -> getContagemFilmes();
    echo($resposta);
}else if($_POST['op'] == 3){
    $resposta = $dashboard -> listarSessoes();
    echo($resposta);
}else if($_POST['op'] == 4){
    $resposta = $dashboard -> filtraCinema($_POST['cinema']);
    echo($resposta);
}
?>