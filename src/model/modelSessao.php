<?php

require_once 'connection.php';

class Sessao{

    function registarSessao($idSessao, $dataSessao, $horaSessao, $estadoSessao, $salaSessao, $filmeSessao){

        global $conn;
        $msg = "";
        $stmt = "";


        
        $stmt = $conn->prepare("INSERT INTO sessoes (id_sessao, data_sessao, hora, estado , codigo_sala, codigo_filme) 
        VALUES (?, ?, ?, ?, ?, ?);");
        $stmt->bind_param("iiiiii", $idSessao, $dataSessao, $horaSessao, $estadoSessao , $salaSessao, $filmeSessao);
  

        $stmt->execute();

        $msg = "Registado com sucesso!";

        $stmt->close();
        $conn->close();

        return $msg;

    }

    function listarSessao(){

        global $conn;
        $msg = "<table class='table'>";
        $msg .= "<thead>";
        $msg .= "<tr>";
        $msg .= "<th scope='col'>ID</th>";
        $msg .= "<th scope='col'>Data</th>";
        $msg .= "<th scope='col'>Hora</th>";
        $msg .= "<th scope='col'>Estado</th>";
        $msg .= "<th scope='col'>Sala</th>";
        $msg .= "<th scope='col'>Filme</th>";
 
        $msg .= "<th scope='col'>Remover</th>";
        $msg .= "<th scope='col'>Editar</th>";
        $msg .= "<th scope='col'>Desativar</th>";
        $msg .= "</tr>";
        $msg .= "</thead>";
        $msg .= "<tbody>";


        $stmt = $conn->prepare("SELECT sessoes.*, salas.descricao AS salaDesc , filmes.nome AS  fNome  FROM sessoes, filmes , salas
        WHERE salas.codigo_sala = sessoes.codigo_sala AND filmes.codigo_filme = sessoes.codigo_filme;");
        $stmt->execute();

        $result = $stmt->get_result();

        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()) {
                $msg .= "<tr>";
              
                $msg .= "<th scope='row'>".$row['id_sessao']."</th>";
                $msg .= "<td>".$row['codigo_sala']."</td>";
                $msg .= "<td>".$row['hora']."</td>";
                if($row['estado'] == 1){
                $msg .= "<td>".'Inativa'."</td>";}
                else{
                $msg .= "<td>".'Ativa'."</td>";}
                $msg .= "<td>".$row['salaDesc']."</td>";
                $msg .= "<td>".$row['fNome']."</td>";
   
                $msg .= "<td><button type='button' class='btn btn-danger' onclick='removerSessao(".$row['id_sessao'].")'>Remover</button></td>";
                $msg .= "<td><button type='button' class='btn btn-primary' onclick='getDadosSessao(".$row['id_sessao'].")'>Editar</button></td>";
                $msg .= "<td><button type='button' class='btn btn-danger' onclick='desativarSessao(".$row['id_sessao'].")'>Desativar</button></td>";
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

    function removerSessao($id){

        global $conn;
        $msg = "";

        $stmt = $conn->prepare("DELETE FROM sessoes WHERE id_sessao = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $msg = "Removido com sucesso!";

        $stmt->close();
        $conn->close();

        return $msg;
    }

    function getDadosSessao($id){

        global $conn;


        $stmt = $conn->prepare("SELECT * FROM sessoes WHERE id_sessao = ?;");
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        $stmt->close();
        $conn->close();

        return json_encode($row);

    }


    function editSessao($idSessao, $dataSessao, $horaSessao, $estadoSessao, $salaSessao, $filmeSessao) {
        global $conn;
        $msg = "";
    
        $stmt = $conn->prepare("UPDATE sessoes 
        SET codigo_sala = ?, codigo_filme = ?, data_sessao = ?, hora = ?, estado = ? 
        WHERE id_sessao = ?;");
        
        $stmt->bind_param("iissii", $salaSessao, $filmeSessao, $dataSessao, $horaSessao, $estadoSessao, $idSessao);
        $stmt->execute();
    
        if ($stmt->error) {
            $msg = "Error: " . $stmt->error;
        } else {
            $msg = "Editado com sucesso!";
        }
    
        $stmt->close();
        $conn->close();
    
        return $msg;
    }

    function desativarSessao($idSessao, $estadoSessao) {
        global $conn;
        $msg = "";
    
        $stmt = $conn->prepare("UPDATE sessoes 
        SET estado = ? 
        WHERE id_sessao = ?;");
        
        $stmt->bind_param("ii", $estadoSessao, $idSessao);
        $stmt->execute();
    
        if ($stmt->error) {
            $msg = "Error: " . $stmt->error;
        } else {
            $msg = "Editado com sucesso!";
        }
    
        $stmt->close();
        $conn->close();
    
        return $msg;
    }
    

    





    function getSalas(){

        global $conn;
        $msg = "<option value = '-1'>Escolha uma Sala</option>";


        $stmt = $conn->prepare("SELECT * FROM salas");
        $stmt->execute();

        $result = $stmt->get_result();

        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()) {
                $msg .= "<option value = '".$row['codigo_sala']."'>".$row['descricao']."</option>";
            }
        }else{
            $msg .= "<option value = '-1'>Sem Tipos registados</option>";
        }

        $stmt->close();
        $conn->close();
        return $msg;
    }


    function getFilmes(){

        global $conn;
        $msg = "<option value = '-1'>Escolha um Filme</option>";


        $stmt = $conn->prepare("SELECT * FROM filmes");
        $stmt->execute();

        $result = $stmt->get_result();

        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()) {
                $msg .= "<option value = '".$row['codigo_filme']."'>".$row['descricao']."</option>";
            }
        }else{
            $msg .= "<option value = '-1'>Sem Filmes registados</option>";
        }

        $stmt->close();
        $conn->close();
        return $msg;
    }



   

   
}
?>