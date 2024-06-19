<?php

$mysqli = new mysqli("localhost", "root", "", "juego2");
if ($mysqli->connect_error) {
    echo "Error";
} else {
    $sql = "SELECT usuario_id FROM usuario WHERE nombre = ?;";
    $query = $mysqli->prepare($sql);
    $nombre = $_POST["nombre"];
    $query->bind_param("s", $nombre);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $usuario_id = $row['usuario_id'];
    } else {
        $sql = "INSERT INTO usuario (nombre) VALUES (?);";
        $query = $mysqli->prepare($sql);
        $query->bind_param("s", $nombre);
        if ($query->execute()) {
            $usuario_id = $mysqli->insert_id;
            echo "Exito!";
        } else {
            echo "Error";
            $mysqli->close();
            exit();
        }
    }

    $sql = "SELECT nivel_id FROM nivel WHERE nombre = ?;";
    $query = $mysqli->prepare($sql);
    $nombre_nivel = $_POST["nombre_nivel"];
    $query->bind_param("s", $nombre_nivel);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $nivel_id = $row['nivel_id'];
    } else {
        $sql = "INSERT INTO nivel (nombre) VALUES (?);";
        $query = $mysqli->prepare($sql);
        $query->bind_param("s", $nombre_nivel);
        if ($query->execute()) {
            $nivel_id = $mysqli->insert_id;
            echo "Exito!";
        } else {
            echo "Error";
            $mysqli->close();
            exit();
        }
    }

    $sql = "INSERT INTO ranking (usuario_id, nivel_id, puntaje) VALUES (?, ?, ?);";
    $query = $mysqli->prepare($sql);
    $puntaje = $_POST["puntaje"];
    $query->bind_param("iii", $usuario_id, $nivel_id, $puntaje);
    if ($query->execute()) {
        echo "Exito!";
    } else {
        echo "Error ";
    }
    $mysqli->close();
}
?>