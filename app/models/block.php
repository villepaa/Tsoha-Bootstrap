<?php

class Block extends BaseModel{
    
    public $id;
    
    public function construct($attributes){
        parent::__construct($attributes);
        $this->validators = array();
    }
    
    public static function all(){
        $query = DB::connection()->prepare('SELECT DISTINCT planblock_id FROM Plan');
         
        $query->execute();
    
        $rows = $query->fetchAll();
        $blocks = array();
        
    
        foreach($rows as $row){

          $blocks[] = $row['planblock_id'];
        }

        return $blocks;
    }
    
   
}
