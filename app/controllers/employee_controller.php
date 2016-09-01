<?php

// Tämä kontrolleri hoitaa työntekijään liittyvät tehtävät

class Employee_controller extends BaseController{
    
    public static function index(){
         
        $emps = Employee::all();
        
        View::make('employee/employees.html', array('employees' => $emps));
  
    }
    
    public static function show($id){
        
        $employee = Employee::find($id);
//        Kint::dump($employee);
        $tasks = Task::all();
       
        View::make('employee/editEmployee.html', array('emp' => $employee, 'tasks' => $tasks));
        
    }
    
    public static function create(){
       $tasks = Task::all();
       View::make('employee/addEmployee.html',array('tasks' => $tasks));     
    }
    
   
    public static function store(){
        $params = $_POST;
        
        if(array_key_exists('patevyydet',$params)){
            $qualification = $params['patevyydet'];
        }else{
            $qualification = array();
        } 
        $attr = array(
          'id' => $params['id'],
          'etunimi' => $params['etunimi'],
          'sukunimi' => $params['sukunimi'],
          'osoite' => $params['osoite'],
          'puh' => $params['puh'],
          'patevyydet' => $qualification
        );
               
        $emp = new Employee($attr);

        $errors = $emp->errors();
        
        $testEmp = $emp::find($emp->id);
        
        if($testEmp != NULL){
            $errors[] = 'Tällä henkilönumerolla löytyy jo henkilö';
        }
        
        if(count($errors) == 0){
            
            $emp->save();
           
            Redirect::to('/employees/' . $emp->id, array('message' => 'Työntekijä on lisätty!'));
            
        }else{
            $tasks = Task::all();

            View::make('employee/addEmployee.html', array('errors' => $errors, 'attributes' => $attr, 'tasks' => $tasks));
        }
        
        
        
        
    }
    
    public static function update($id){
        $params = $_POST;
        if(array_key_exists('patevyydet',$params)){
            $qualification = $params['patevyydet'];
        }else{
            $qualification = array();
        } 
        
        $attributes = array(
          'id' => $id,
          'etunimi' => $params['etunimi'],
          'sukunimi' => $params['sukunimi'],
          'osoite' => $params['osoite'],
          'puh' => $params['puh'],
          'patevyydet' => $qualification
        );

        
        $employee = new Employee($attributes);
        $errors = $employee->errors();
        
        if(count($errors) == 0){
            
            $employee->update();
                       
            Redirect::to('/employees/' . $employee->id, array('message' => 'Työntekijän tietoja on muokattu!'));
            
        }else{
            
            View::make('employee/editEmployee.html', array('errors' => $errors, 'emp' => $attributes));
        }
            
        
    }
    
     public static function destroy($id){
        
        $employee = new Employee(array('id'=>$id));
        
        $employee->destroy();

        Redirect::to('/employees', array('message' => 'Työntekijä "'. $id .'" poistettu!'));
        
    }
}
