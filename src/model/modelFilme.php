<?php

require_once 'connection.php';

class Filme{

    function registarFilme($codFilme, $nomeFilme, $anoFilme, $descricaoFilme, $tipoFilme){

        global $conn;
        $msg = "";
        $stmt = "";


        
        $stmt = $conn->prepare("INSERT INTO filmes (codigo_filme, nome, ano, descricao , id_tipo) 
        VALUES (?, ?, ?,?,?);");
        $stmt->bind_param("isisi", $codFilme, $nomeFilme, $anoFilme, $descricaoFilme , $tipoFilme);
  

        $stmt->execute();

        $msg = "Registado com sucesso!";

        $stmt->close();
        $conn->close();

        return $msg;

    }

    function listarFilme(){

        global $conn;
        $msg = "<table class='table'>";
        $msg .= "<thead>";
        $msg .= "<tr>";
        $msg .= "<th scope='col'>Codigo</th>";
        $msg .= "<th scope='col'>Nome</th>";
        $msg .= "<th scope='col'>Ano</th>";
        $msg .= "<th scope='col'>Descrição</th>";
        $msg .= "<th scope='col'>Tipo</th>";
 
        $msg .= "<th scope='col'>Remover</th>";
        $msg .= "<th scope='col'>Editar</th>";
        $msg .= "</tr>";
        $msg .= "</thead>";
        $msg .= "<tbody>";


        $stmt = $conn->prepare("SELECT filmes.*, tipofilme.descricao AS tipoF FROM filmes, tipofilme
        WHERE tipofilme.id_tipo = filmes.id_tipo;");
        $stmt->execute();

        $result = $stmt->get_result();

        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()) {
                $msg .= "<tr>";
              
                $msg .= "<th scope='row'>".$row['codigo_filme']."</th>";
                $msg .= "<td>".$row['nome']."</td>";
                $msg .= "<td>".$row['ano']."</td>";
                $msg .= "<td>".$row['descricao']."</td>";
                $msg .= "<td>".$row['tipoF']."</td>";
   
                $msg .= "<td><button type='button' class='btn btn-danger' onclick='removerFilme(".$row['codigo_filme'].")'>Remover</button></td>";
                $msg .= "<td><button type='button' class='btn btn-primary' onclick='getDadosFilme(".$row['codigo_filme'].")'>Editar</button></td>";
                $msg .= "</tr>";  
            }
        }else{
            $msg .= "<tr>";
            $msg .= "<th scope='row'>Sem resultados</th>";
            $msg .= "<td></td>";
            $msg .= "<td></td>";
            $msg .= "<td></td>";
            $msg .= "<td></td>";
            $msg .= "<td></td>";
            $msg .= "<td></td>";
            $msg .= "<td></td>";
            $msg .= "</tr>";
        }

        $msg .= "</tbody>";
        $msg .= "</table>";

        $stmt->close();
        $conn->close();
        return $msg;
    }

    function removerFilme($id){

        global $conn;
        $msg = "";

        $stmt = $conn->prepare("DELETE FROM filmes WHERE codigo_filme = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $msg = "Removido com sucesso!";

        $stmt->close();
        $conn->close();

        return $msg;
    }

    function getDadosFilme($id){

        global $conn;


        $stmt = $conn->prepare("SELECT * FROM filmes WHERE codigo_filme = ?;");
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        $stmt->close();
        $conn->close();

        return json_encode($row);

    }

    function editFilme($codFilme, $nomeFilme, $anoFilme ,$descricaoFilme ,$tipoFilme){

        global $conn;
        $msg = "";

        $stmt = $conn->prepare("UPDATE filmes 
        SET codigo_filme = ?,  nome = ?,  ano = ?  , descricao = ? , id_tipo = ?
        WHERE codigo_filme = ? ;");
        $stmt->bind_param("isisii", $codFilme, $nomeFilme, $anoFilme, $descricaoFilme, $tipoFilme , $codFilme);
        $stmt->execute();

        $msg = "Editado com sucesso!";

        $stmt->close();
        $conn->close();

        return $msg;
    }

    function getTipo(){

        global $conn;
        $msg = "<option value = '-1'>Escolha um Tipo</option>";


        $stmt = $conn->prepare("SELECT * FROM tipofilme");
        $stmt->execute();

        $result = $stmt->get_result();

        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()) {
                $msg .= "<option value = '".$row['id_tipo']."'>".$row['descricao']."</option>";
            }
        }else{
            $msg .= "<option value = '-1'>Sem Tipos registados</option>";
        }

        $stmt->close();
        $conn->close();
        return $msg;
    }


   

   
}
?>