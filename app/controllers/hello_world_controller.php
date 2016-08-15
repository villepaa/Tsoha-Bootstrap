<?php
    
    require 'app/models/employee.php';

  class HelloWorldController extends BaseController{
      
    public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
      View::make('home.html');
    }

    public static function sandbox(){
      // Testaa koodiasi täällä
//      View::make('HelloWorld.html');
        $emps = Employee::all();
        
        Kint::dump($emps);
    }
    
    public static function employee_list(){
        View::make('suunnitelmat/employees.html');
    }
    
    public static function login(){
        View::make('suunnitelmat/login.html');
    }
    
    public static function edit_emp(){
        View::make('suunnitelmat/editEmployee.html');
    }
    
     public static function duty_list(){
        View::make('suunnitelmat/duties.html');
    }
    
    public static function plan(){
        View::make('suunnitelmat/plan.html');
    }
    
     public static function front_page(){
        View::make('suunnitelmat/etusivu.html');
    }
  }
