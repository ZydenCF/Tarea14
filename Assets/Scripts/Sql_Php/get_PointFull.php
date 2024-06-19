<?php
header("Content-Type: application/json");
$mysqli = new mysqli("localhost", "root", "", "juego2");
if ($mysqli->connect_error) {
    echo json_encode(["error" => "Error"]);
} else {
    $sql = "SELECT usuario.nombre AS nombre_usuario, SUM(ranking.puntaje) AS puntaje_total FROM ranking 
            JOIN usuario  ON ranking.usuario_id = usuario.usuario_id
            GROUP BY usuario.nombre
            ORDER BY puntaje_total DESC;";
    $query = $mysqli->prepare($sql);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows > 0) {
        echo json_encode(["puntajes_totales" => $result->fetch_all(MYSQLI_ASSOC)]);
    } else {
        echo json_encode(["puntajes_totales" => []]);
    }
    $mysqli->close();
}
?>