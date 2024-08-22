<?php
require_once 'db_conn.php'; // Подключаем файл с классом Database

$database = new Database();
$userData = '';

if (!empty($_COOKIE["login"])) {
    $login = $_COOKIE["login"];

    // Попытка получить данные о пользователе
    $userData = $database->GetUserByLogin($login);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Поиск пользователя</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
<?php include_once('inc/header.php')?>
    <div class="container mt-5">

        <?php if (is_array($userData)): ?>
            <div class="mt-4">
                <h3>Данные пользователя</h3>
                <p><strong>Логин:</strong> <?php echo htmlspecialchars($userData['login']); ?></p>
                <p><strong>Фото:</strong></p>
                <?php if ($userData['photo']): ?>
                    <img src="data:image/jpeg;base64,<?php echo base64_encode($userData['photo']); ?>" alt="User Photo" width="256" height="256"/>
                <?php else: ?>
                    <p>Фото отсутствует.</p>
                <?php endif; ?>
            </div>
        <?php elseif (is_string($userData)): ?>
            <div class="alert alert-info mt-4" role="alert">
                <?php echo htmlspecialchars($userData); ?>
            </div>
        <?php endif; ?>
        <a class="btn btn-primary w-25 py-2" href="update_photo.php">Обновить фотографию</a>
    </div>
</body>
</html>