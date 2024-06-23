<?php

require_once 'connection.php';

class Cinema{

    function registarCinema($idCinema, $nomeCinema, $cinemaLocal){

        global $conn;
        $msg = "";
        $stmt = "";


        
        $stmt = $conn->prepare("INSERT INTO cinemas (id_cinema, nome, id_local) 
        VALUES (?, ?, ?);");
        $stmt->bind_param("iss", $idCinema, $nomeCinema, $cinemaLocal);
  

        $stmt->execute();

        $msg = "Registado com sucesso!";

        $stmt->close();
        $conn->close();

        return $msg;

    }

    function listarCinemas(){

        global $conn;
        $msg = "<table class='table'>";
        $msg .= "<thead>";
        $msg .= "<tr>";
        $msg .= "<th scope='col'>ID</th>";
        $msg .= "<th scope='col'>Nome</th>";
        $msg .= "<th scope='col'>Localização</th>";
 
        $msg .= "<th scope='col'>Remover</th>";
        $msg .= "<th scope='col'>Editar</th>";
        $msg .= "</tr>";
        $msg .= "</thead>";
        $msg .= "<tbody>";


        $stmt = $conn->prepare("SELECT cinemas.*, localizacoes.descricao AS descr FROM cinemas, localizacoes
        WHERE localizacoes.id_local = cinemas.id_local;");
        $stmt->execute();

        $result = $stmt->get_result();

        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()) {
                $msg .= "<tr>";
              
                $msg .= "<th scope='row'>".$row['id_cinema']."</th>";
                $msg .= "<td>".$row['nome']."</td>";
                $msg .= "<td>".$row['descr']."</td>";
   
                $msg .= "<td><button type='button' class='btn btn-danger' onclick='removerCinema(".$row['id_cinema'].")'>Remover</button></td>";
                $msg .= "<td><button type='button' class='btn btn-primary' onclick='getDadosCinema(".$row['id_cinema'].")'>Editar</button></td>";
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

    function removerCinema($id){

        global $conn;
        $msg = "";

        $stmt = $conn->prepare("DELETE FROM cinemas WHERE id_cinema = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $msg = "Removido com sucesso!";

        $stmt->close();
        $conn->close();

        return $msg;
    }

    function getDadosCinema($id){

        global $conn;


        $stmt = $conn->prepare("SELECT * FROM cinemas WHERE id_cinema = ?;");
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        $stmt->close();
        $conn->close();

        return json_encode($row);

    }

    function editCinema($id_cinema, $nome, $id_local){

        global $conn;
        $msg = "";

        $stmt = $conn->prepare("UPDATE cinemas 
        SET id_cinema = ?,  nome = ?,  id_local = ?  
        WHERE id_cinema = ? ;");
        $stmt->bind_param("isii", $id_cinema, $nome, $id_local, $id_cinema);
        $stmt->execute();

        $msg = "Editado com sucesso!";

        $stmt->close();
        $conn->close();

        return $msg;
    }

    function getLocalizacao(){

        global $conn;
        $msg = "<option value = '-1'>Escolha uma Localização</option>";


        $stmt = $conn->prepare("SELECT * FROM localizacoes");
        $stmt->execute();

        $result = $stmt->get_result();

        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()) {
                $msg .= "<option value = '".$row['id_local']."'>".$row['descricao']."</option>";
            }
        }else{
            $msg .= "<option value = '-1'>Sem Localizacoes registadas</option>";
        }

        $stmt->close();
        $conn->close();
        return $msg;
    }


   

   
}
?>