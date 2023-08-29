<?php


require_once $_SERVER['DOCUMENT_ROOT'] . "/application/models/BaseModel.php";

class Problem extends BaseModel
{
    public function paginate($limit, $data = null)
    {
        $tables = [
            'problems' => ['text', 'status'],
            'users' => ['login', 'email'],
        ];
        $whereClauses = array();
        $bindings = array();
        foreach ($tables as $table_name => $columns) {
            foreach ($columns as $column) {
                if (isset($data[$column])) {
                    $whereClauses[] = "$table_name.$column LIKE ?";
                    $bindings[] = '%' . $data[$column] . '%';
                }
            }
        }

        $whereClause = implode(' AND ', $whereClauses);

        $query = "
        SELECT SQL_CALC_FOUND_ROWS problems.*, users.email, users.login
        FROM problems
        LEFT JOIN users ON problems.user_id = users.id
        " . (!empty($whereClause) ? "WHERE $whereClause" : "") . "
        ORDER BY problems.id DESC
        LIMIT ?, ?
        ";

        $start = ($data['page'] - 1) * $limit;

        $sqlBindings = array_merge($bindings, [$start, $limit]);

        $results = R::getAll($query, $sqlBindings);

        $totalCount = R::getCell("SELECT FOUND_ROWS()");

        return [
            'problems' => $results,
            'totalCount' => $totalCount,
        ];
    }
    public function witoutUsersPaginate($limit, $data = null)
    {
        $whereClauses = array();
        $bindings = array();

        // Условие для выбора только проблем с user_id равным null
        $whereClauses[] = "problems.user_id IS NULL";

        if (isset($data['text'])) {
            $whereClauses[] = "problems.text LIKE ?";
            $bindings[] = '%' . $data['text'] . '%';
        }

        if (isset($data['status'])) {
            $whereClauses[] = "problems.status = ?";
            $bindings[] = $data['status'];
        }

        $whereClause = implode(' AND ', $whereClauses);

        $query = "
    SELECT SQL_CALC_FOUND_ROWS problems.*
    FROM problems
    " . (!empty($whereClause) ? "WHERE $whereClause" : "") . "
    ORDER BY problems.id DESC
    LIMIT ?, ?
    ";

        $start = ($data['page'] - 1) * $limit;

        $sqlBindings = array_merge($bindings, [$start, $limit]);

        $results = R::getAll($query, $sqlBindings);

        $totalCount = R::getCell("SELECT FOUND_ROWS()");

        return [
            'problems' => $results,
            'totalCount' => $totalCount,
        ];
    }


}
