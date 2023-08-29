<div class="col-md-3">
    <form method="get" action="../../../../main">
        <div style="padding-top: 10px;" class="form-group">
            <label for="email">Email</label>
            <input value="<?php echo isset($data['email']) ? $data['email'] : ''; ?>" type="text" name="email" class="form-control" id="email" placeholder="Email">
        </div>
        <div style="padding-top: 20px;" class="form-group">
            <label for="email">Имя пользователя</label>
            <input type="text" value="<?php echo isset($data['login']) ? $data['login'] : ''; ?>" name="login" class="form-control" id="name" placeholder="Имя пользователя">
        </div>
        <div style="padding-top: 20px;" class="form-group">
            <label for="status">Отредактировано администратором</label>
            <select style="height: 80px;margin-top: 10px;" name="status" id="status" class="form-select" size="2" aria-label="size 3 select example">
                <option value="1" <?php if (isset($data['status']) && $data['status'] === '1') echo 'selected'; ?>>Да</option>
                <option value="0" <?php if (isset($data['status']) && $data['status'] === '0') echo 'selected'; ?>>Нет</option>
                <option value="" <?php if (!isset($data['status']) || $data['status'] === '') echo 'selected'; ?>>Любой</option>
            </select>
        </div>
        <div style="padding-top: 20px;" class="form-group">
            <label for="exampleTextbox">Текст задачи</label>
            <textarea name="text" type="text" class="form-control" id="exampleTextbox" placeholder="Введите текст"><?php echo isset($data['text']) ? $_GET['text'] : ''; ?></textarea>
        </div>
        <button style="width: 100%;margin-top: 20px;" type="submit" class="btn btn-success">Найти</button>
    </form>
</div>
