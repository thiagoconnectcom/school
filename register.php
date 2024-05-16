<?php

    include_once('./services/api.php');

    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        try {
            // Verifique se o email já está cadastrado
            $check_query = "SELECT * FROM users WHERE email = :email";
            $check_stmt = $pdo->prepare($check_query);
            $check_stmt->bindParam(':email', $email);
            $check_stmt->execute();

            if ($check_stmt->rowCount() > 0) {
                $error = "Este email já está sendo usado. Por favor, escolha outro.";
            } else {
                // Insira o novo usuário no banco de dados
                $insert_query = "INSERT INTO users (name, email, password) VALUES (:name, :email, :senha)";
                $insert_stmt = $pdo->prepare($insert_query);
                $insert_stmt->bindParam(':name', $name);
                $insert_stmt->bindParam(':email', $email);
                $insert_stmt->bindParam(':senha', $senha);
                $insert_stmt->execute();

                // Redirecione para a página de login após o cadastro bem-sucedido
                header('Location: login.php');
                exit();
            }
        } catch (PDOException $e) {
            echo "Erro de conexão: " . $e->getMessage();
        }
    }
?>

<!DOCTYPE html>
<html class="h-100">
    <?php include './includes/head.php'; ?>
    
    <body class="h-100 login">
        <section class="h-100 d-flex align-items-center">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6 text-center mb-5">
                        <h2>Cadastro</h2>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-6 col-lg-4">
                        <div class="login-wrap p-0">
                            <form action="" class="signup-form" method="POST">
                                <div class="form-group mb-4">
                                    <input type="text" class="form-control" name="name" placeholder="Nome" required="">
                                </div>
                                <div class="form-group mb-4">
                                    <input type="email" class="form-control" name="email" placeholder="Email" required="">
                                </div>
                                <div class="form-group mb-4">
                                    <input id="password-field" type="password" name="senha" class="form-control" placeholder="Senha" required="">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="form-control btn btn-success submit px-3">Cadastrar</button>
                                </div>
                                <div class="form-group">
                                    <p class="text-muted text-center">Já tem uma conta? <a href="login.php" class="text-success">Entrar</a></p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </body>
</html>
