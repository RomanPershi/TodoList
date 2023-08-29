<?php
    $display = isset($_SESSION['user_id']) ? 'none' : 'block';
    $id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : "";
    $email = isset($_SESSION['email']) ? $_SESSION['email'] : "";
    $name = isset($_SESSION['login']) ? $_SESSION['login'] : "";
?>
<div class="row justify-content-center">
    <div class="col-md-6">
        <form method="post" action="oncreateproblem">
            <div style="padding-top: 20px;" class="form-group">
                <label for="exampleTextbox">Текст задачи</label>
                <textarea type="text" name = "text" class="form-control" id="exampleTextbox" placeholder="Введите текст"></textarea>
            </div>
            <button style="width: 100%; margin-top: 20px;" type="submit" class="btn btn-success">Создать</button>
        </form>
    </div>
</div>
