<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <meta name="description" content=""/>
    <meta name="keywords" content=""/>
    <title>Тестовое задание</title>
    <!-- Добавьте это в секцию head -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css"/>
    <link href="http://fonts.googleapis.com/css?family=Kreon" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="/css/style.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="/js/jquery-1.6.2.js" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
            crossorigin="anonymous"></script>
</head>
<body>
<div style="padding-top: 10px;" class="container">
    <div class="row">
        <div class="col-md-2">
            <div class="row">
                <a class="link-primary nav-link" href="/main">Список задач</a>
            </div>
        </div>
        <div class="col-md-2">
            <div class="row">
                <a class="link-primary nav-link" href="/createproblem">Создать задачу</a>
            </div>
        </div>
        <?php
            if (!isset($_SESSION['user_id'])): ?>
        <div class="col-md-2">
            <div class="row">
                <a class="link-primary nav-link" href="signin">Войти</a>
            </div>
        </div>
                <div class="col-md-2">
                    <div class="row">
                        <a class="link-primary nav-link" href="signup">Регистрация</a>
                    </div>
                </div>
            <?php else: ?>
                <div class="col-md-2">
                    <div class="row">
                        <a class="link-primary nav-link" href="signout">Выйти</a>
                    </div>
                </div>
            <?php endif; ?>
    </div>
</div>
<?php echo $content ?>
</body>
</html>