<?php
header("Content-Type: application/json");
$mysqli = new mysqli("localhost", "root", "", "juego2");
if ($mysqli->connect_error) {
    echo json_encode(["error" => "Error"]);
} else {
    $sql = "SELECT nivel.nombre AS nombre_nivel, ranking.puntaje FROM ranking 
            JOIN usuario ON ranking.usuario_id = usuario.usuario_id
            JOIN nivel  ON ranking.nivel_id = nivel.nivel_id
            WHERE usuario.nombre = ?;";
    $query = $mysqli->prepare($sql);
    $nombre = $_POST["nombre"];
    $query->bind_param("s", $nombre);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows > 0) {
        echo json_encode(["puntajes" => $result->fetch_all(MYSQLI_ASSOC)]);
    } else {
        echo json_encode(["puntajes" => []]);
    }
    $mysqli->close();
}
?>