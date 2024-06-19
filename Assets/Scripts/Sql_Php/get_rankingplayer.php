<?php
header("Content-Type: application/json");
$mysqli = new mysqli("localhost", "root", "", "juego2");
if ($mysqli->connect_error) {
    echo json_encode(["error" => "Error "]);
} else {
    $sql = "SELECT usuario.nombre AS nombre_usuario, ranking.puntaje FROM ranking 
            JOIN usuario  ON ranking.usuario_id = usuario.usuario_id
            JOIN nivel ON ranking.nivel_id = nivel.nivel_id
            WHERE nivel.nombre = ?
            ORDER BY ranking.puntaje DESC;";
    $query = $mysqli->prepare($sql);
    $nombre_nivel = $_POST["nombre_nivel"];
    $query->bind_param("s", $nombre_nivel);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows > 0) {
        echo json_encode(["ranking" => $result->fetch_all(MYSQLI_ASSOC)]);
    } else {
        echo json_encode(["ranking" => []]);
    }
    $mysqli->close();
}
?>