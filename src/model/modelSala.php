<?php

require_once 'connection.php';

class Sala{

    function registarSala($codSala, $descricaoSala, $cinemaSala){

        global $conn;
        $msg = "";
        $stmt = "";


        
        $stmt = $conn->prepare("INSERT INTO salas (codigo_sala, descricao, id_cinema) 
        VALUES (?, ?, ?);");
        $stmt->bind_param("isi", $codSala, $descricaoSala, $cinemaSala);
  

        $stmt->execute();

        $msg = "Registado com sucesso!";

        $stmt->close();
        $conn->close();

        return $msg;

    }

    function listarSalas(){

        global $conn;
        $msg = "<table class='table'>";
        $msg .= "<thead>";
        $msg .= "<tr>";
        $msg .= "<th scope='col'>ID</th>";
        $msg .= "<th scope='col'>Descrição</th>";
        $msg .= "<th scope='col'>Cinema</th>";
 
        $msg .= "<th scope='col'>Remover</th>";
        $msg .= "<th scope='col'>Editar</th>";
        $msg .= "</tr>";
        $msg .= "</thead>";
        $msg .= "<tbody>";


        $stmt = $conn->prepare("SELECT salas.*, cinemas.nome AS nomeCin FROM salas, cinemas
        WHERE cinemas.id_cinema = salas.id_cinema;");
        $stmt->execute();

        $result = $stmt->get_result();

        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()) {
                $msg .= "<tr>";
              
                $msg .= "<th scope='row'>".$row['codigo_sala']."</th>";
                $msg .= "<td>".$row['descricao']."</td>";
                $msg .= "<td>".$row['nomeCin']."</td>";
   
                $msg .= "<td><button type='button' class='btn btn-danger' onclick='removerSala(".$row['codigo_sala'].")'>Remover</button></td>";
                $msg .= "<td><button type='button' class='btn btn-primary' onclick='getDadosSala(".$row['codigo_sala'].")'>Editar</button></td>";
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

    function removerSala($id){

        global $conn;
        $msg = "";

        $stmt = $conn->prepare("DELETE FROM salas WHERE codigo_sala = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $msg = "Removido com sucesso!";

        $stmt->close();
        $conn->close();

        return $msg;
    }

    function getDadosSala($id){

        global $conn;


        $stmt = $conn->prepare("SELECT * FROM salas WHERE codigo_sala = ?;");
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        $stmt->close();
        $conn->close();

        return json_encode($row);

    }

    function editSala($codSala, $descricaoSala, $cinemaSala){

        global $conn;
        $msg = "";

        $stmt = $conn->prepare("UPDATE salas 
        SET codigo_sala = ?,  descricao = ?,  id_cinema = ?  
        WHERE codigo_sala = ? ;");
        $stmt->bind_param("isii", $codSala, $descricaoSala, $cinemaSala, $codSala);
        $stmt->execute();

        $msg = "Editado com sucesso!";

        $stmt->close();
        $conn->close();

        return $msg;
    }

    function getCinemas(){

        global $conn;
        $msg = "<option value = '-1'>Escolha um Cinema</option>";


        $stmt = $conn->prepare("SELECT * FROM cinemas");
        $stmt->execute();

        $result = $stmt->get_result();

        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()) {
                $msg .= "<option value = '".$row['id_cinema']."'>".$row['nome']."</option>";
            }
        }else{
            $msg .= "<option value = '-1'>Sem cinemas registados</option>";
        }

        $stmt->close();
        $conn->close();
        return $msg;
    }


   

   
}
?>