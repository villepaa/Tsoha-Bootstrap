<?php

// Tämä hoitaa Planblockien hallinnoinnin. 

class Block extends BaseModel{
    
    public $id, $alkupaiva, $loppupaiva;
    
    public function __construct($attributes){
        parent::__construct($attributes);
        $this->validators = array('validate_dates');
    }
    
    public function validate_dates() {
        $errors = array();
        $alku = strtotime($this->alkupaiva);
        $loppu = strtotime($this->loppupaiva);
        if(($loppu - $alku) <= 0){
            $errors[] = 'Loppupäivämäärän tulee olla alkupäivämäärää suurempi';
        }
        
        return $errors;

    }
    
     public function save(){

        $query = DB::connection()->prepare('INSERT INTO Block (id, alkupaiva, loppupaiva) VALUES (:id, :alku, :loppu)');

        $query->execute(array('id' => $this->id, 'alku' => $this->alkupaiva, 'loppu' => $this->loppupaiva));

        
    }
    
    public static function all(){
        $query = DB::connection()->prepare('SELECT * FROM Block ORDER BY loppupaiva');
         
        $query->execute();
    
        $rows = $query->fetchAll();
        $blocks = array();
        
    
        foreach($rows as $row){

          $blocks[] = new Block(array(
                    'id' => $row['id'],
                    'alkupaiva' => $row['alkupaiva'],
                    'loppupaiva' => $row['loppupaiva']
                  ));
        }

        return $blocks;
    }
    
   
}
