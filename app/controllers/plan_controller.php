<?php
// Tässä kontrollerissa käsitellään suunnitelman sivuun liittyviä asioita

class Plan_controller extends BaseController{
    
//    Seuraava funktio hakee Planblockit ja työntekijät ja valmistelee suunnitelman etusivun
    
    public static function index(){
        $blocks = Block::all();
        $emps = Employee::all();
        
        View::make('plan/plan_front.html', array('blocks' => $blocks, 'emps' => $emps));
    }

//  Tämä funktio hakee tiedot suunnitelman näyttämistä varten ja renderöi ko. näkymän  
    
    public static function show($block_id){
         
        $emps = PlannedEmployee::findTasks($block_id);
        $dates = Plan::findDates($block_id);
        
       
        View::make('plan/plan.html', array('emps' => $emps,'dates'=>$dates, 'block'=>$block_id));
  
    }
    
    // Tämä päivittää suunnitelman kun siihen tehdään muutoksia
    
    public static function update(){
        $params = $_POST;
        $attrArray_apu = array_keys($params);
        $attrString = $attrArray_apu[0];
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

    
    // Tämä tallentaa uuden suunnitelman ja alustaa sen tyhjillä listoilla

    public static function store(){
        $params = $_POST;
        
        
        $alkupaiva = strtotime($params['alkupaiva']);
        
        $loppupaiva = strtotime($params['loppupaiva']);
        $paiva = $alkupaiva;
        
        $block_id = "Viikot:".date("W",$alkupaiva)."-".date("W",$loppupaiva)."_".date("Y",$alkupaiva);
        
        $block = new Block(array(
                'id' => $block_id,
                'alkupaiva' => $params['alkupaiva'],
                'loppupaiva' => $params['loppupaiva']
            ));
        $errors = $block->errors();
        if(count($errors) == 0){
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
                      'planner' => $_SESSION['user'] 
                    ));

                    $plan->save();
                }    
                $paiva = strtotime('+1 day',$paiva);
            }
            Redirect::to('/plan/' . $block_id, array('message' => 'Suunnitelma on luotu!'));
        }else{
            $blocks = Block::all();
            $emps = Employee::all();
        
            View::make('plan/plan_front.html', array('blocks' => $blocks, 'emps' => $emps, 'errors' => $errors));
        }
            
        
        
    }
    
    
}
