<?php

class BaseModel
{
    protected $table_name;

    public function __construct()
    {
        $this->table_name = strtolower(get_class($this) . 's');
    }
    public function buildWhere($data,$operator = "AND",$sign = " =? ")
    {
        $sql = '';
        $values = [];
        foreach ($data as $field => $value) {
            if ($sql !== '') {
                $sql .= ' '.$operator.' ';
            }
            $sql .= $field . $sign;
            $values[] = $value;
        }
        return ['sql' => $sql,'values' => $values];
    }
    public function find($data,$operator = "AND",$sign = " =? ")
    {
        $query = $this->buildWhere($data,$operator,$sign);
        return R::findOne($this->table_name,$query['sql'],$query['values']);
    }
    public function create($data)
    {
        $element = R::dispense($this->table_name);
        $element->import($data);
        $data['id'] = R::store($element);
        return $data;
    }
    public function deleteById($id)
    {
        $element = R::load($this->table_name, $id);
        if ($element->id != 0) {
            R::trash($element);
            return true; // Успешно удалено
        } else {
            return false; // Не удалось найти запись для удаления
        }
    }



}