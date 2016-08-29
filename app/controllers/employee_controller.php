<?php

// Tämä kontrolleri hoitaa työntekijään liittyvät tehtävät

class Employee_controller extends BaseController{
    
    public static function index(){
         
        $emps = Employee::all();
        
        View::make('employee/employees.html', array('employees' => $emps));
  
    }
    
    public static function show($id){
        
        $employee = Employee::find($id);
        
        View::make('employee/editEmployee.html', array('emp' => $employee));
        
    }
    
    public static function create(){
      
       View::make('employee/addEmployee.html');     
    }
    
   
    public static function store(){
        $params = $_POST;

        $attr = array(
          'id' => $params['id'],
          'etunimi' => $params['etunimi'],
          'sukunimi' => $params['sukunimi'],
          'osoite' => $params['osoite'],
          'puh' => $params['puh'] 
        );
        
        $emp = new Employee($attr);
        $errors = $emp->errors();
        if(count($errors) == 0){
            
            $emp->save();
            Redirect::to('/employees/' . $emp->id, array('message' => 'Työntekijä on lisätty!'));
            
        }else{
            
            View::make('employee/addEmployee.html', array('errors' => $errors, 'attributes' => $attr));
        }
        
        
        
        
    }
    
    public static function update($id){
        $params = $_POST;

        $attributes = array(
          'id' => $id,
          'etunimi' => $params['etunimi'],
          'sukunimi' => $params['sukunimi'],
          'osoite' => $params['osoite'],
          'puh' => $params['puh'],
          
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
