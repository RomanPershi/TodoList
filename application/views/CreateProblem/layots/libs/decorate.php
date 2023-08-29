<?php

function printProblem($problem)
{
    $result = '
        <div class="container mt-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">User: ' . $problem['login'] . '</h5>
                    <span class="badge ' . ($problem['status'] == 1 ? 'bg-success' : 'bg-secondary') . '">' . ($problem['status'] == 1 ? 'Completed' : 'Pending') . '</span>
                </div>
                <div class="card-body">
                    <h6 class="card-subtitle mb-2 text-muted">Email: ' . $problem['email'] . '</h6>
                    <p class="card-text">' . $problem['text'] . '</p>
                </div>
            </div>
        </div>';

    echo $result;
}
