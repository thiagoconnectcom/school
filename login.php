<?php

    include_once('./services/api.php');

    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        try {
            $query = "SELECT * FROM users WHERE email = :email AND password = :senha";
            
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':senha', $senha);
            $stmt->execute();
            
            if ($stmt->rowCount() > 0) {
                $_SESSION['email'] = $email;
                header('Location: painel.php');
                exit();
            } else {
                $error = "Credenciais inválidas. Tente novamente.";
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
                        <h2>Login</h2>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-6 col-lg-4">
                        <div class="login-wrap p-0">
                            <form action="" class="signin-form" method="POST">
                                <div class="form-group mb-4">
                                    <input type="email" class="form-control" name="email" placeholder="Email" required="">
                                </div>
                                <div class="form-group mb-4">
                                    <input id="password-field" type="password" name="senha" class="form-control" placeholder="Password" required="">
                                </div>
                                <div class="form-group mb-4">
                                    <a href="register.php" class="text-success">cadastrar</a>
                                </div>
                        
                                <div class="form-group">
                                    <button type="submit" class="form-control btn btn-success submit px-3">Entrar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </body>
</html>