<?php

// Suunnitelmasta löytyvä työntekijä, jolle lisätty työvuoroja edustava taulukko

class PlannedEmployee extends Employee{
    
    public $tasks;
    
     public function __construct($attributes){
       parent::__construct($attributes);
    }
    
    public static function findTasks($block_id){
        
        $query = DB::connection()->prepare('SELECT DISTINCT employee_id '
                . 'FROM Plan '
                . 'WHERE planBlock_id = :block_id');
        $query->execute(array('block_id' => $block_id));
        $rows = $query->fetchAll();
        $plannedEmps = array();
        
        
        foreach($rows as $row){
            
            $tasks = array();
            $emp_id = $row['employee_id'];
            $query = DB::connection()->prepare('SELECT task_id, day_of_task '
                    . 'FROM Plan '
                    . 'WHERE planBlock_id = :block_id AND employee_id = :emp_id '
                    . 'ORDER BY day_of_task');
            $query->execute(array('block_id' => $block_id, 'emp_id' => $emp_id));
            $taskRows = $query->fetchAll();
            foreach($taskRows as $taskRow){
                $task = PlannedTask::find($taskRow['task_id']);
                $task->day = $taskRow['day_of_task'];
                $tasks[] = $task;
            }
            $emp = PlannedEmployee::find($emp_id);
            $emp->tasks = $tasks;
            $plannedEmps[] = $emp;
        }
        
        return $plannedEmps;
    }
    
}
