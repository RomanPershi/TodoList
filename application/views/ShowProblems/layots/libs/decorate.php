<?php
function buildPaginationLink($page, $data) {
    $queryParams = http_build_query(array_merge($data, ['page' => $page]));
    return "?$queryParams";
}

function printProblem($problem)
{
    $login = isset($problem['login']) ? $problem['login'] : 'Неизвестный';
    $email = isset($problem['email']) ? $problem['email'] : 'Неизвестный';

    $statusBadge = ($problem['status'] == 1) ? 'bg-success' : 'bg-secondary';
    $statusText = ($problem['status'] == 1) ? 'Отредактировано администратором' : 'Неотредактировано администратором';

    $editForm = '';
    $deleteForm = '';
    $problemText = '';

    if ($_SESSION['role'] == 2) {
        $editForm = '
        <form action="/edit" method="post" class="mt-2">
            <input type="hidden" name="user_id" value="' . $problem['user_id'] . '">
            <input type="hidden" name="id" value="' . $problem['id'] . '">
            <textarea name="text" class="edited-text form-control" rows="3">' . htmlspecialchars($problem['text']) . '</textarea>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" name="status" id="taskCheckbox'.$problem['id'].'" ' . ($problem['status'] == 1 ? 'checked' : '') . '>
                <label class="form-check-label" for="taskCheckbox'.$problem['id'].'">Задача готова</label>
            </div>
                <input type="hidden" name="original_query_params" value="'.$_SERVER['QUERY_STRING'].'">
            <button type="submit" class="btn btn-primary mt-2">Сохранить</button>
        </form>';
    } else {
        $problemText = '<p class="card-text">' . $problem['text'] . '</p>';
    }

    if ($_SESSION['role'] == 2) {
        $deleteForm = '
        <form action="/delete" method="post">
            <input type="hidden" name="id" value="' . $problem['id'] . '">
            <input type="hidden" name="original_query_params" value="'.$_SERVER['QUERY_STRING'].'">
            <button type="submit" class="btn btn-danger mt-2">Удалить</button>
        </form>';
    }

    $result = '
        <div class="container mt-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">User: ' . $login . '</h5>
                    <h6 class="card-subtitle mb-2 text-muted">Email: ' . $email . '</h6>
                    <span class="badge ' . $statusBadge . '">' . $statusText . '</span>
                </div>
                <div class="card-body">
                    <h6 class="card-subtitle mb-2 text-muted">Текст задачи:</h6>
                    ' . $problemText . '
                    ' . $editForm . '
                    ' . $deleteForm . '
                </div>
            </div>
        </div>';

    echo $result;
}

?>
