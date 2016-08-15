<?php


class Plan_controller extends BaseController{
    
    public static function index(){
        $blocks = Block::all();
        $emps = Employee::all();
        
        View::make('plan/plan_front.html', array('blocks' => $blocks, 'emps' => $emps));
    }
    
    public static function show($block_id){
         
        $dates = Plan::findAllInPlanblock($block_id);
        
        
        View::make('plan/plan.html', array('dates' => $dates));
  
    }
    
     public static function store(){
        $params = $_POST;
        
        
        $alkupaiva = strtotime($params['alkupaiva']);
        
        $loppupaiva = strtotime($params['loppupaiva']);
        $paiva = $alkupaiva;
        
        $block_id = "Viikot:".date("W",$alkupaiva)."-".date("W",$loppupaiva);
        
        $block = new Block(array('id' => $block_id));
        
        $block->save();
        
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
                  'planner' => 1 
                ));
                $plan->save();
            }    
            $paiva = strtotime('+1 day',$paiva);
        }
        Redirect::to('/plan/' . $block_id, array('message' => 'Suunnitelma on luotu!'));
    }
    
    
}
