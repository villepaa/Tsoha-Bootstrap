<?php



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

        $emp = new Employee(array(
          'id' => $params['id'],
          'etunimi' => $params['etunimi'],
          'sukunimi' => $params['sukunimi'],
          'osoite' => $params['osoite'],
          'puh' => $params['puh'] 
        ));

       
        $emp->save();
        
        Redirect::to('/employees/' . $emp->id, array('message' => 'Työntekijä on lisätty!'));
    }
}
