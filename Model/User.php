<?php
require_once ("../Database.php");


class User extends Database{
    private $table = 'users';
    public function isUnique($column ,$value){
        $query = "SELECT * FROM $this->table WHERE $column =:value" ;
        $result = $this->connect->prepare($query);
        $result->execute(['value' => $value]);
        return ($result->rowCount() == 0) ;
    }

    public function insert($data){

        if (empty($data)) {
            return false ;
        }       
    
        $columns = implode(', ', array_keys($data));
        $placeholders = ':' . implode(', :', array_keys($data));
    
        $query = "INSERT INTO {$this->table} ({$columns}) VALUES ({$placeholders})";
        $result = $this->connect->prepare($query);
    
    
        return $result->execute($data);
    }
    public function All(){

        $query = "SELECT * FROM $this->table WHERE role != 'admin'" ;
        $result = $this->connect->prepare($query);
        $result->execute();
    
        return $result;
    }
    public function single($column ,$value){

        $query = "SELECT * FROM $this->table WHERE $column =:value" ;
        $result = $this->connect->prepare($query);
        $result->execute(['value' => $value]);
    
        return $result;
    }
    
}
?>