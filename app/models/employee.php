<?php


class Employee extends BaseModel{
    
    public $id, $etunimi, $sukunimi, $osoite, $puh;
  
    public function __construct($attributes){
       parent::__construct($attributes);
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
    
    $query = DB::connection()->prepare('INSERT INTO Employee (id, etunimi, sukunimi, osoite,puh) VALUES (:id, :etunimi, :sukunimi, :osoite, :puh) RETURNING id');
    
    $query->execute(array('id' => $this->id, 'etunimi' => $this->etunimi, 'sukunimi' => $this->sukunimi, 'osoite' => $this->osoite, 'puh' => $this->puh));
    
   
  }


    
    
}
