<?php


class Plan_controller extends BaseController{
    
    public static function index(){
        $blocks = Block::all();
        $emps = Employee::all();
        
        View::make('plan/plan_front.html', array('blocks' => $blocks, 'emps' => $emps));
    }
    
    public static function show($block_id){
         
        $emps = PlannedEmployee::findTasks($block_id);
        $dates = Plan::findDates($block_id);
        $tasksToPlan = Task::all();
       
        View::make('plan/plan.html', array('emps' => $emps,'dates'=>$dates, 'tasksToPlan' => $tasksToPlan, 'block'=>$block_id));
  
    }
    
    public static function update(){
        $params = $_POST;
        $attrArray = array_keys($params);
        $attrString = $attrArray[0];
        $attrArray = explode('|', $attrString);
        $paiva = strtotime($attrArray[1]);
        
        $plan = new Plan(array(
                  'employee_id' => $attrArray[0],
                  'task_id' => $params[$attrString],
                  'day' => date("Y-m-d",$paiva),
                  'planblock' => $attrArray[2],
                  'planner' => $_SESSION['user'] 
                ));
       
        $plan->update();
        
        Redirect::to('/plan/' . $attrArray[2], array('message' => 'Päivitetty!'));
    }


    public static function store(){
        $params = $_POST;
        
        
        $alkupaiva = strtotime($params['alkupaiva']);
        
        $loppupaiva = strtotime($params['loppupaiva']);
        $paiva = $alkupaiva;
        
        $block_id = "Viikot:".date("W",$alkupaiva)."-".date("W",$loppupaiva)."_".date("Y",$alkupaiva);
              
        $employees = $params['valitut'];
        
        $splitted = array();
        
        while($paiva <= $loppupaiva){
            foreach($employees as $emp){
                $splitted = explode("-", $emp);
                $emp_id = $splitted[0];
                
                $plan = new Plan(array(
                  'employee_id' => $emp_id,
                  'task_id' => 'VP',
                  'day' => date("Y-m-d",$paiva),
                  'planblock' => $block_id,
                  'planner' => $_SESSION['user'] 
                ));
                
                $plan->save();
            }    
            $paiva = strtotime('+1 day',$paiva);
        }
        Redirect::to('/plan/' . $block_id, array('message' => 'Suunnitelma on luotu!'));
    }
    
    
}
