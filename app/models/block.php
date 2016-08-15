<?php

class Block extends BaseModel{
    
    public $id;
    
    public function construct($attributes){
        parent::__construct($attributes);
    }
    
    public static function all(){
        $query = DB::connection()->prepare('SELECT * FROM PlanBlock');
         
        $query->execute();
    
        $rows = $query->fetchAll();
        $blocks = array();
        
    
    foreach($rows as $row){
      
      $blocks[] = new Block(array('id' => $row['id']));
    }

    return $blocks;
    }
    
    public function save(){
    
        $query = DB::connection()->prepare('INSERT INTO PlanBlock (id) VALUES (:id)');

        $query->execute(array('id' => $this->id));
    
   
      }
    
}
