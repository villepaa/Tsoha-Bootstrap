<?php


class Employee extends BaseModel{
    
    public $id, $etunimi, $sukunimi, $osoite, $puh;
  
    public function __construct($attributes){
       parent::__construct($attributes);
       $this->validators = array('validate_name','validate_id','validate_osoite','validate_puh');
    }
    
    public function validate_name() {
        $errors = array();
        if($this->etunimi == '' || $this->etunimi == null){
            $errors[] = 'Etunimi ei saa olla tyhjä!';
        }
        if($this->sukunimi == '' || $this->sukunimi == null){
            $errors[] = 'Sukunimi ei saa olla tyhjä!';
        }
        
        return $errors;

    }
    
    public function validate_id() {
        $errors = array();
        if($this->id == '' || $this->id == null){
            $errors[] = 'Henkilönumero ei saa olla tyhjä!';
        }
        if(!is_numeric($this->id)){
            $errors[] = 'Henkilönumeron pitää koostua numeroista!';
        }
        if(strlen($this->id) > 6){
            $errors[] = 'Henkilönumeron maksimi pituus on 6 numeroa!';
        }
        return $errors;
    }
    
    public function validate_puh() {
        $errors = array();
        
        if(strlen($this->puh) > 20){
            $errors[] = 'Puhelinnumeron maksimi pituus on 20 numeroa!';
        }
        return $errors;
    }
    
    public function validate_osoite() {
        $errors = array();
        
        if(strlen($this->osoite) > 50){
            $errors[] = 'Osoitteen maksimi pituus on 50 merkkiä!';
        }
        return $errors;
    }
    
    public static function all(){
        $query = DB::connection()->prepare('SELECT * FROM Employee');
         
        $query->execute();
    
        $rows = $query->fetchAll();
        $emps = array();

    
    foreach($rows as $row){
      
      $emps[] = new Employee(array(
        'id' => $row['id'],
        'etunimi' => $row['etunimi'],
        'sukunimi' => $row['sukunimi'],
        'osoite' => $row['osoite'],
        'puh' => $row['puh']
        
      ));
    }

    return $emps;
  }
  
  public static function find($id){
    $query = DB::connection()->prepare('SELECT * FROM Employee WHERE id = :id LIMIT 1');
    $query->execute(array('id' => $id));
    $row = $query->fetch();

    if($row){
      $employee = new Employee(array(
        'id' => $row['id'],
        'etunimi' => $row['etunimi'],
        'sukunimi' => $row['sukunimi'],
        'osoite' => $row['osoite'],
        'puh' => $row['puh']
      ));

      return $employee;
    }

    return null;
  }
  
  public function save(){
    
    $query = DB::connection()->prepare('INSERT INTO Employee (id, etunimi, sukunimi, osoite,puh) VALUES (:id, :etunimi, :sukunimi, :osoite, :puh)');
    
    $query->execute(array('id' => $this->id, 'etunimi' => $this->etunimi, 'sukunimi' => $this->sukunimi, 'osoite' => $this->osoite, 'puh' => $this->puh));
    
   
  }

  public function update(){
    $query = DB::connection()->prepare('UPDATE Employee SET etunimi=:etunimi, sukunimi=:sukunimi, osoite=:osoite,puh=:puh WHERE id = :id');
    
    $query->execute(array('etunimi' => $this->etunimi, 'sukunimi' => $this->sukunimi, 'osoite' => $this->osoite, 'puh' => $this->puh, 'id' => $this->id));
    
  } 
  
  public function destroy(){
     $query = DB::connection()->prepare('DELETE FROM Employee WHERE id = :id');
    
    $query->execute(array('id' => $this->id));
     
  }

    
    
}
