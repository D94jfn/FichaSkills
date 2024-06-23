<?php
require_once '../model/modelSessao.php';

$sessao = new Sessao();

if($_POST['op'] == 1){
    $resposta = $sessao -> registarSessao(
        $_POST['idSessao'], 
        $_POST['dataSessao'], 
        $_POST['horaSessao'], 
        $_POST['estadoSessao'], 
        $_POST['salaSessao'], 
        $_POST['filmeSessao'], 
      
     );
    echo($resposta);
}else if($_POST['op'] == 2){
    $resposta = $sessao -> listarSessao();
    echo($resposta);
}else if($_POST['op'] == 3){
    $resposta = $sessao -> removerSessao($_POST['idSessao']);
    echo($resposta);
}else if($_POST['op'] == 4){
    $resposta = $sessao -> getDadosSessao($_POST['idSessao']);
    echo($resposta);
}else if($_POST['op'] == 5){
    $resposta = $sessao -> editSessao(    
    $_POST['idSessao'], 
    $_POST['dataSessao'], 
    $_POST['horaSessao'], 
    $_POST['estadoSessao'], 
    $_POST['salaSessao'], 
    $_POST['filmeSessao'], );
    echo($resposta);
}else if($_POST['op'] == 6){
    $resposta = $sessao -> getFilmes();
    echo($resposta);
}else if($_POST['op'] == 7){
    $resposta = $sessao -> getSalas();
    echo($resposta);
}else if($_POST['op'] == 8){
    $resposta = $sessao -> desativarSessao($_POST['idSessao'], $_POST['estadoSessao']);
    echo($resposta);
}
?>