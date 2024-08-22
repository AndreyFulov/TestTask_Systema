<header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
      <div class="col-md-3 mb-2 mb-md-0">
        <a href="./" class="d-inline-flex link-body-emphasis text-decoration-none">
          Главная
        </a>
      </div>

      <ul class="nav col-12 col-md-auto mb-2">
      <?php if (!empty($_COOKIE["login"])): ?>
            <li><a href="./profile.php" class="nav-link px-2 link-secondary">Профиль: <?php echo htmlspecialchars($_COOKIE['login'])?></a></li>
        <?php endif; ?>
      </ul>

      <div class="col-md-3 text-end">
        <?php if (!empty($_COOKIE["login"])): ?>
          <button type="button" class="btn btn-outline-primary me-2" href="./logout.php">Выйти</button>
        <?php else:?>
          <a type="button" class="btn btn-outline-primary me-2" href="./login.php">Войти</a>
          <a type="button" class="btn btn-primary" href="./register.php">Регистрация</a>
        <?php endif; ?>
      </div>
    </header>