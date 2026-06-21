<?php

try {
    $pdo = new PDO(
        "mysql:host=127.0.0.1;dbname=bancodoprojeto;charset=utf8mb4",
        "root",
        ""
    );

    echo "Conectado com sucesso!";
} catch (PDOException $e) {
    echo $e->getMessage();
}