<?php


class PlannedEmployee extends Employee{
    
    public $tasks;
    
     public function __construct($attributes){
       parent::__construct($attributes);
    }
    
    public static function findTasks($block_id){
        
        $query = DB::connection()->prepare('SELECT employee_id FROM Plan WHERE planBlock_id = :block_id');
        $query->execute(array('block_id' => $block_id));
        $rows = $query->fetchAll();
        
                
        $query = DB::connection()->prepare('SELECT * FROM Plan WHERE planBlock_id = :block_id');
        $query->execute(array('block_id' => $block_id));
        $rows = $query->fetchAll();
        $plannedEmps = array();
        
        foreach($rows as $row){
      
            $plannedEmps[] = new PlannedEmployee(array(
                'id' => $row['id'],
                'etunimi' => $row['etunimi'],
                'sukunimi' => $row['sukunimi'],
                'osoite' => $row['osoite'],
                'puh' => $row['puh']
        
            ));
        }

        return $plannedEmps;
    }
    
}
