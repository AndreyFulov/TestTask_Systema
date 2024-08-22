<?php
require_once 'db_conn.php'; // Подключаем файл с классом Database

$database = new Database();
$errorMessage = '';

if (!empty($_POST["login"]) && !empty($_POST["password"])) {
    $login = $_POST["login"];
    $password = $_POST["password"];

    // Попытка войти в систему
    $errorMessage = $database->LoginUser($login, $password);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
    <?php include_once('inc/header.php')?>
    <div class="container">
    <form action="" method="post">
        <div class="form-outline mb-4">
            <input type="text" id="email_reg" class="form-control" name="login" required/>
            <label class="form-label" form="email_reg">Логин</label>
        </div>

        <div class="form-outline mb-4">
            <input type="password" id="pass_reg" class="form-control" name="password" required/>
            <label class="form-label" form="pass_reg">Пароль</label>
        </div>
        <input type="submit" class="btn btn-primary w-100 py-2" value="Войти"/>
    </form>
    <?php if (!empty($errorMessage)): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo htmlspecialchars($errorMessage); ?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>