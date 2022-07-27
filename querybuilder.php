<?php

class QueryBuilder extends DatabaseConnection
{

    public $tablename, $select, $where, $group_by, $having, $column, $columns;

    public function select($columns)
    {

        $this->select = " SELECT ";

        foreach($columns as $key => $value)
        {
            if ($key == array_key_last($columns))
            {
                $this->select .= " $value ";
            }
            else {
                $this->select .= " $value, ";
            }
        }
        $this->select .= " FROM `$this->tablename` ";
        

        return $this;
    }

    public function group_by($column)
    {

        $this->group_by .= " GROUP BY $column ";
        return $this;

    }

    public function having($parameter, $condition, $value)
    {

        $this->having .= " HAVING $parameter $condition $value ";
        return $this;

    }

    public function where($values)
    {
        //print_r($values);
        $this->where .= " WHERE ";
        foreach ($values as $key => $value)
        {
            $this->where .= " $key = '$value' ";
        }
        return $this;
    }

    public function get()
    {
        $sql = $this->select.$this->where.$this->group_by.$this->having;
        if(strpos($sql, 'SELECT') == false)
        {
            $this->select = " SELECT * FROM `$this->tablename` ";
        }

        $sql = $this->select.$this->where.$this->group_by.$this->having;
        $result = $this->fetch_all($sql);
        return $result;

    }

}