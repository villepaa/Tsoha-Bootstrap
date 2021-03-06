<?php


class Plan extends BaseModel{
    
    public $employee_id, $task_id, $day, $planblock, $planner;
    
    public function contruct($attributes) {
        parent::__construct($attributes);
        $this->validators = array();
    }
    
       
    public function save(){
        
        $query = DB::connection()->prepare('INSERT INTO Plan (employee_id, task_id, day_of_task, planblock_id,planner_id) VALUES (:employee_id, :task_id, :day_of_task, :planblock_id,:planner_id)');
    
        $query->execute(array('employee_id' => $this->employee_id, 'task_id' => $this->task_id, 'day_of_task' => $this->day, 'planblock_id' => $this->planblock, 'planner_id' => $this->planner));
        
    }
    
    public static function findDates($planBlock_id){
        $query = DB::connection()->prepare('SELECT DISTINCT day_of_task FROM Plan WHERE planBlock_id = :planBlock_id ORDER BY day_of_task');
         
        $query->execute(array('planBlock_id' => $planBlock_id));
    
        $rows = $query->fetchAll();
        $dates = array();

    
        foreach($rows as $row){

            $dates[] = strtotime($row['day_of_task']);
        }

        return $dates;
    }
    
    public function update(){
        
         
            $query = DB::connection()->prepare('UPDATE Plan SET task_id=:task_id, planblock_id=:planblock_id, planner_id=:planner_id WHERE employee_id =:employee_id AND day_of_task =:day_of_task');

            $query->execute(array('task_id' => $this->task_id, 'planblock_id' =>$this->planblock, 'planner_id' => $this->planner, 'employee_id'=>$this->employee_id, 'day_of_task' => $this->day ));
    
   
    }
    
    
}
