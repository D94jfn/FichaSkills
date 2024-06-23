<?php
require_once '../model/modelFilme.php';

$filme = new Filme();

if($_POST['op'] == 1){
    $resposta = $filme -> registarFilme(
        $_POST['codFilme'], 
        $_POST['nomeFilme'], 
        $_POST['anoFilme'], 
        $_POST['descricaoFilme'], 
        $_POST['tipoFilme'], 
      
     );
    echo($resposta);
}else if($_POST['op'] == 2){
    $resposta = $filme -> listarfilme();
    echo($resposta);
}else if($_POST['op'] == 3){
    $resposta = $filme -> removerfilme($_POST['codFilme']);
    echo($resposta);
}else if($_POST['op'] == 4){
    $resposta = $filme -> getDadosfilme($_POST['codFilme']);
    echo($resposta);
}else if($_POST['op'] == 5){
    $resposta = $filme -> editfilme($_POST['codFilme'],  $_POST['nomeFilme'], $_POST['anoFilme'], $_POST['descricaoFilme'], $_POST['tipoFilme']);
    echo($resposta);
}else if($_POST['op'] == 6){
    $resposta = $filme -> getTipo();
    echo($resposta);
}
?>