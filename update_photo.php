<?php
require_once 'db_conn.php'; // Подключаем файл с классом Database

$database = new Database();
$message = '';

if (!empty($_COOKIE["login"]) && !empty($_FILES["photo"]["tmp_name"])) {
    $login = $_COOKIE["login"];
    $photoPath = $_FILES["photo"]["tmp_name"];

    // Попытка обновить фотографию пользователя
    $message = $database->UpdateUserPhoto($login, $photoPath);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Обновление фотографии</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
<?php include_once('inc/header.php')?>
    <div class="container mt-5">
        <h1 class="mb-4">Обновление фотографии пользователя</h1>
        <?php if (!empty($message)): ?>
            <div class="alert alert-info" role="alert">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>
        <form action="" method="post" enctype="multipart/form-data">

            <div class="form-outline mb-4">
                <input type="file" id="photo" class="form-control" name="photo" accept="image/*" required/>
                <label class="form-label" for="photo">Выберите фотографию</label>
            </div>
            <input type="submit" class="btn btn-primary w-100 py-2" value="Обновить фотографию"/>
        </form>
    </div>
</body>
</html>
