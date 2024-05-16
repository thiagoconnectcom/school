<?php

include_once('./services/api.php');

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $course = $_POST['course'];
    $title = $_POST['title'];
    $duration = $_POST['duration'];

    try {
        $insert_query = "INSERT INTO courses (course, title, duration) VALUES (:course, :title, :duration)";
        $insert_stmt = $pdo->prepare($insert_query);
        $insert_stmt->bindParam(':course', $course);
        $insert_stmt->bindParam(':title', $title);
        $insert_stmt->bindParam(':duration', $duration);
        $insert_stmt->execute();

        header("Location: ".$_SERVER['REQUEST_URI']);
        exit();
    } catch (PDOException $e) {
        echo "Erro de conexão: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html class="h-100">
    <?php include './includes/head.php'; ?>
    
    <body class="h-100 login">
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Dashboard</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </nav>
        <div class="container mt-3">
            <form action="" class="signup-form" method="POST">
                <div class="form-group mb-4">
                    <input type="text" class="form-control" name="course" placeholder="Área do curso" required="">
                </div>
                <div class="form-group mb-4">
                    <input type="text" class="form-control" name="title" placeholder="Titulo" required="">
                </div>
                <div class="form-group mb-4">
                    <input type="text" name="duration" class="form-control" placeholder="Duração" required="">
                </div>
                <div class="form-group mb-5">
                    <button type="submit" class="form-control btn btn-success submit px-3">Cadastrar</button>
                </div>
            </form>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Curso</th>
                        <th scope="col">Título</th>
                        <th scope="col">Duração</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Consulta os cursos do banco de dados e exibe na tabela
                    $query = "SELECT * FROM courses";
                    $stmt = $pdo->query($query);
                    $count = 1;
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>";
                        echo "<th scope='row'>" . $count . "</th>";
                        echo "<td>" . $row['course'] . "</td>";
                        echo "<td>" . $row['title'] . "</td>";
                        echo "<td>" . $row['duration'] . "</td>";
                        echo "</tr>";
                        $count++;
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </body>
</html>
