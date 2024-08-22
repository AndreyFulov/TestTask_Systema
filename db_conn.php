<?php
class Database {
    private $conn;
    private function InitConnection() {
        try {
        $env = parse_ini_file('.env');
        $this->conn = new PDO($env['DB_TYPE'].":host=".$env['DB_HOST'].";port=".$env['DB_PORT'].";dbname=".$env['DB_NAME'], $env['DB_LOGIN'], $env['DB_PASS']);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e) {
            echo ''.$e->getMessage();
        }
    }

    public function CreateNewUser($login, $password, $photo) {
        try {
            $this->InitConnection();
            if(!$this->IsUserExist($login)) {

            $sql = "INSERT INTO users (username, password, photo) VALUES (:username, :password, :photo)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':username', $login, PDO::PARAM_STR);
            $stmt->bindParam(':password', $password, PDO::PARAM_STR);
            $stmt->bindParam(':photo', $photo, PDO::PARAM_LOB);
            if ($stmt->execute()) {
                setcookie('login', $login,0,'/');
                return "Новый пользователь успешно добавлен!";
            } else {
                return "Ошибка при добавлении пользователя.";
            }
        }else {
            return "Пользователь уже существует!";
        }
        }catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function LoginUser($login, $password) {
        try {
            $this->InitConnection();

            // Запрос для получения хеша пароля пользователя
            $sql = "SELECT password FROM users WHERE username = :username";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':username', $login, PDO::PARAM_STR);
            $stmt->execute();
            $hashedPassword = $stmt->fetchColumn();

            if ($hashedPassword && password_verify($password, $hashedPassword)) {
                // Успешная аутентификация
                setcookie('login', $login,0,'/');
                return "Успешный вход!";
            } else {
                return "Неверный логин или пароль.";
            }
        } catch (PDOException $e) {
            return "Ошибка при входе: " . $e->getMessage();
        }
    }

    public function UpdateUserPhoto($login, $photoPath) {
        try {
            $this->InitConnection();

            // Проверка существования пользователя
            if (!$this->IsUserExist($login)) {
                return "Пользователь не найден.";
            }

            // Путь для временного хранения измененного изображения
            $tempPhotoPath = 'temp_' . basename($photoPath);

            // Изменение размера изображения до 256x256 пикселей
            resizeImage($photoPath, $tempPhotoPath, 256, 256);

            // Чтение содержимого измененного файла изображения
            $photo = file_get_contents($tempPhotoPath);

            // Удаление временного файла
            unlink($tempPhotoPath);

            // Подготовка SQL-запроса для обновления фотографии
            $sql = "UPDATE users SET photo = :photo WHERE username = :username";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':photo', $photo, PDO::PARAM_LOB);
            $stmt->bindParam(':username', $login, PDO::PARAM_STR);

            if ($stmt->execute()) {
                return "Фотография успешно обновлена!";
            } else {
                return "Ошибка при обновлении фотографии.";
            }
        } catch (PDOException $e) {
            return "Ошибка: " . $e->getMessage();
        }
    }
    public function IsUserExist($login) {
        $checkUserSql = "SELECT COUNT(*) FROM users WHERE username = :username";
        $stmt = $this->conn->prepare($checkUserSql);
        $stmt->bindParam(':username', $login, PDO::PARAM_STR);
        $stmt->execute();
        $userExists = $stmt->fetchColumn();
        return $userExists;
    }
    public function GetUserByLogin($login) {
        try {
            $this->InitConnection();

            $sql = "SELECT username, password, photo FROM users WHERE username = :username";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':username', $login, PDO::PARAM_STR);
            $stmt->execute();

            // Проверяем, нашлись ли записи
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                // Если пользователь найден, возвращаем его данные
                return [
                    'login' => $user['username'],
                    'password' => $user['password'],
                    'photo' => $user['photo']
                ];
            } else {
                // Если пользователь не найден
                return "Пользователь не найден.";
            }
        } catch (PDOException $e) {
            return "Ошибка: " . $e->getMessage();
        }
    }
}






function resizeImage($sourcePath, $destinationPath, $width, $height) {
    // Получаем информацию о изображении
    list($originalWidth, $originalHeight, $imageType) = getimagesize($sourcePath);

    // Создаем новое изображение в формате GD
    $image = imagecreatetruecolor($width, $height);

    // В зависимости от типа изображения загружаем его
    switch ($imageType) {
        case IMAGETYPE_JPEG:
            $sourceImage = imagecreatefromjpeg($sourcePath);
            break;
        case IMAGETYPE_PNG:
            $sourceImage = imagecreatefrompng($sourcePath);
            break;
        case IMAGETYPE_GIF:
            $sourceImage = imagecreatefromgif($sourcePath);
            break;
        default:
            throw new Exception('Неподдерживаемый формат изображения');
    }

    // Изменяем размер изображения
    imagecopyresampled($image, $sourceImage, 0, 0, 0, 0, $width, $height, $originalWidth, $originalHeight);

    // Сохраняем измененное изображение в указанный путь
    switch ($imageType) {
        case IMAGETYPE_JPEG:
            imagejpeg($image, $destinationPath, 90);
            break;
        case IMAGETYPE_PNG:
            imagepng($image, $destinationPath);
            break;
        case IMAGETYPE_GIF:
            imagegif($image, $destinationPath);
            break;
    }

    // Освобождаем память
    imagedestroy($image);
    imagedestroy($sourceImage);
}
?>