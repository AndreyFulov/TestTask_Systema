<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добро пожаловать</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
        }
        .title {
            color: #007bff;
        }
        .author {
            color: #6c757d;
        }
        .header {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
    <?php include_once('inc/header.php') ?>
    <div class="container">
        <div class="header text-center">
            <h1 class="title">Добро пожаловать!</h1>
            <h3 class="mb-4">Это моё решение тестового задания от компании "Система"</h3>
        </div>
        <h4 class="text-center">Для работы с этим сайтом, вам нужно создать пользователя при помощи формы<br/>Далее вам будет доступен остальной функционал сайта, а именно<br/>
    изменение фото пользователя<br/><br/>Для перехода между страницами сайта, используйте навигацию сверху страницы</h4>
        <p class="author text-center">выполнил: Андрей Егошин</p>
    </div>
</body>
</html>
