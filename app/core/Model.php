<?php

class Model
{
    // multiple inheritance using trait
    use Database;

    protected $table = 'users';
    protected $limit = 10;
    protected $offset = 0;


    public function where($data, $data_not = [])
    {
        $keys = array_keys($data);
        $keys_not = array_keys($data_not);

        $query = "select * from $this->table where";

        foreach ($keys as $key) {
            $query .= $key . " = :" . $key . " AND ";
        }

        // not equal filtering : optional 
        foreach ($keys_not as $key) {
            $query .= $key . " != :" . $key . " AND ";
        }

        $query = rtrim($query, ' AND ');
        $query .= "limit $this->limit offset $this->offset";

        // Combine the data for binding
        $params = [];
        foreach ($keys as $key) {
            $params[":$key"] = $data[$key];
        }
        foreach ($keys_not as $key) {
            $params[":$key"] = $data_not[$key];
        }

        return $this->query($query, $params);
    }

    public function first($data) {}


    public function insert($data) {}

    public function update($id, $data, $id_column = 'id') {}
    public function delete($id, $id_column = 'id') {}
}
