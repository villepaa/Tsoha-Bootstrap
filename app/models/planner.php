<?php


class Planner extends BaseModel{
    
    public $id, $name, $password;
    
    public function contruct($attributes){
        parent::__construct($attributes);
    }
    
}
