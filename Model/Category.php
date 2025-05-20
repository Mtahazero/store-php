<?php
require_once ("../Database.php");


class Category extends Database{

    private $table = 'categories';

    
    public function isUnique($value){
        $query = "SELECT * FROM $this->table WHERE title =:value" ;
        $result = $this->connect->prepare($query);
        $result->execute(['value' => $value]);
        return ($result->rowCount() == 0) ;
    }

    public function insert($title){     
    
        $query = "INSERT INTO {$this->table} (title) VALUES (:title)";
        $result = $this->connect->prepare($query);
        
        $result->bindValue(":title", $title);
    
        return $result->execute();
    }
    public function All(){

        $query = "SELECT * FROM $this->table " ;
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
  
  
    public function update($title, $id) {
       
        $query = "UPDATE $this->table set title = :title where id = :id";
        $result = $this->connect->prepare($query);

        $result->bindValue(':id', $id);
        $result->bindValue(':title', $title);
        
        return $result->execute();
    }

    public function delete($id){
        $query="DELETE FROM $this->table WHERE id =:id";
        $result = $this->connect->prepare($query);
        $result->bindValue(":id", $id);
        return $result->execute();
    }
}