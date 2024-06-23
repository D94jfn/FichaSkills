<?php

require_once 'connection.php';

class Dashboard{

    function getContagemCinemas(){

        global $conn;
        $stmt = $conn->prepare("SELECT COUNT(*) AS total FROM cinemas;");
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
    
        $stmt->close();
        $conn->close();
    
        return $row['total'];

    }


    function getContagemFilmes(){

        global $conn;
        $stmt = $conn->prepare("SELECT COUNT(*) AS totalF FROM filmes;");
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
    
        $stmt->close();
        $conn->close();
    
        return $row['totalF'];

    }




    function listarSessoes(){

        global $conn;
        $msg = "<table class='table'>";
        $msg .= "<thead>";
        $msg .= "<tr>";
        $msg .= "<th scope='col'>ID</th>";
        $msg .= "<th scope='col'>Sala</th>";
        $msg .= "<th scope='col'>Filme</th>";
        $msg .= "<th scope='col'>Data</th>";
        $msg .= "<th scope='col'>Hora</th>";
 

        $msg .= "</tr>";
        $msg .= "</thead>";
        $msg .= "<tbody>";


        $stmt = $conn->prepare("SELECT sessoes.*, salas.descricao AS nSala, filmes.nome AS nFilme FROM salas, sessoes, filmes 
        WHERE salas.codigo_sala = sessoes.codigo_sala 
        AND filmes.codigo_filme = sessoes.codigo_filme 
        AND sessoes.estado = 0;");
        $stmt->execute();

        $result = $stmt->get_result();

        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()) {
                $msg .= "<tr>";
              
                $msg .= "<th scope='row'>".$row['id_sessao']."</th>";
                $msg .= "<td>".$row['nSala']."</td>";
                $msg .= "<td>".$row['nFilme']."</td>";
                $msg .= "<td>".$row['data_sessao']."</td>";
                $msg .= "<td>".$row['hora']."</td>";

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

            $msg .= "</tr>";
        }

        $msg .= "</tbody>";
        $msg .= "</table>";

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



    
    function filtraCinema($cinema){
        global $conn;
        $msg = "<table class='table'>";
        $msg .= "<thead>";
        $msg .= "<tr>";
        $msg .= "<th scope='col'>ID</th>";
        $msg .= "<th scope='col'>Sala</th>";
        $msg .= "<th scope='col'>Filme</th>";
        $msg .= "<th scope='col'>Data</th>";
        $msg .= "<th scope='col'>Hora</th>";
 
       
        $msg .= "</tr>";
        $msg .= "</thead>";
        $msg .= "<tbody>";


           // JOIN para evitar magia negra estranha
            $stmt = $conn->prepare("
                SELECT sessoes.*, salas.descricao AS nSala, filmes.nome AS nFilme
                FROM sessoes
                JOIN salas ON salas.codigo_sala = sessoes.codigo_sala
                JOIN filmes ON filmes.codigo_filme = sessoes.codigo_filme
                WHERE sessoes.estado = 0
                AND salas.id_cinema = ?;
            ");
            $stmt->bind_param("i", $cinema);
            $stmt->execute();
            $result = $stmt->get_result();

        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()) {
                $msg .= "<tr>";
              
                $msg .= "<th scope='row'>".$row['id_sessao']."</th>";
                $msg .= "<td>".$row['nSala']."</td>";
                $msg .= "<td>".$row['nFilme']."</td>";
                $msg .= "<td>".$row['data_sessao']."</td>";
                $msg .= "<td>".$row['hora']."</td>";

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

            $msg .= "</tr>";
        }

        $msg .= "</tbody>";
        $msg .= "</table>";

        $stmt->close();
        $conn->close();
        return $msg;
    }




   

   
}
?>