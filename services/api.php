<?php
    // Configuração do banco de dados
    $servidor = "viaduct.proxy.rlwy.net";
    $db = "railway";
    $usuario = "root";
    $senha = "bYQgEleOQaaeENpCSMublKupZUOksdkp";
    $porta = "16784";
    // $porta = "21342";

    // Tentar estabelecer a conexão PDO
    try {
        // Cria uma nova conexão PDO
        $pdo = new PDO("mysql:host=$servidor;$posrta=$porta,dbname=$db", $usuario, $senha);

        // Define o modo de erro do PDO para exceções
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        // Em caso de falha na conexão, exibe uma mensagem de erro
        die("Falha na conexão: " . $e->getMessage());
    }
?>