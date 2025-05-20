<?php
require_once ("../Database.php");


class Product extends Database{

    private $table = 'products';

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

    function generateProductQuery($category ='all' , $sortOrder = 'default',$limit = 0 ,$offset = 4) {

        $validSortOrders = ['default', 'ASC', 'DESC'];
        if (!in_array($sortOrder, $validSortOrders)) {
            $sortOrder = 'default';
        }

       
        $query = "SELECT * FROM " . $this->table;
        $conditions = [];
        $params = [];

       
        if ($category !== 'all') {
            if (!is_numeric($category)) {
                throw new Exception("Invalid category ID");
            }
            $conditions[] = "category_id = :category";
            $params[':category'] = $category;
        }

        
        if (!empty($conditions)) {
            $query .= " WHERE " . implode(" AND ", $conditions);
        }

       
        if ($sortOrder !== 'default') {
            $query .= " ORDER BY price " . $sortOrder;
        }

        // Add LIMIT and OFFSET
        $query .= " LIMIT " . $limit . " , " . $offset;


        $result = $this->connect->prepare($query);
        $result->execute($params);
        return $result->fetchAll(PDO::FETCH_ASSOC);

        // $validSortOrders = ['default', 'ASC', 'DESC'];
        // if (!in_array($sortOrder, $validSortOrders)) {
        //     $sortOrder = 'default';
        // }
    
        // // Validate and sanitize limit and offset
        // $limit = max(1, (int)$limit); // Ensure limit is at least 1
        // $offset = max(0, (int)$offset); // Ensure offset is not negative
    
        // $query = "SELECT * FROM " . $this->table;
        // $conditions = [];
        // $params = [];
    
        // if ($category !== 'all') {
        //     if (!is_numeric($category)) {
        //         throw new Exception("Invalid category ID");
        //     }
        //     $conditions[] = "category_id = :category";
        //     $params[':category'] = $category;
        // }
    
        // if (!empty($conditions)) {
        //     $query .= " WHERE " . implode(" AND ", $conditions);
        // }
    
        // if ($sortOrder !== 'default') {
        //     $query .= " ORDER BY price " . $sortOrder;
        // }
    
        // // Add LIMIT and OFFSET directly to query string with proper spacing
        // $query .= " LIMIT " . $limit . " , " . $offset;
    
        // $result = $this->connect->prepare($query);
        // $result->execute($params);
        // return $result->fetchAll(PDO::FETCH_ASSOC);
      
        
    }
    public function getCategory($column,$value){
        // SELECT categories.title FROM categories join products ON categories.id = products.category_id;
        $query = "SELECT categories.title FROM categories right join $this->table ON categories.id = $this->table.category_id WHERE $this->table.$column =:value" ;
        $result = $this->connect->prepare($query);
        $result->execute(['value' => $value]);
    
        return $result->fetch(PDO::FETCH_ASSOC);
    }
    public function update($data,$id){
        if (empty($data) || empty($id)) {
            return false;
        }     
        $setClause = implode(', ', array_map(
            fn($col) => "`$col` = :$col", 
            array_keys($data)
        ));
        
        $query = "UPDATE `{$this->table}` SET {$setClause} WHERE id = :id";
        $result = $this->connect->prepare($query);
        foreach ($data as $key => $value) {
            $result->bindValue(":$key", $value);
        }
        $result->bindValue(':id', $id, PDO::PARAM_INT);

        return $result->execute();

    }

    public function delete($id){
        $query="DELETE FROM $this->table WHERE id =:id";
        $result = $this->connect->prepare($query);
        $result->bindValue(":id", $id);
        return $result->execute();
    }


}