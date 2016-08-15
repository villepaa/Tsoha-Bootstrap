<?php

    
    $routes->post('/tasks', function(){
        Task_controller::store();
    });
    
     $routes->post('/employees', function(){
         Employee_controller::store();
    });
    
    $routes->post('/plan',function(){
        Plan_controller::store();
    });
    
    $routes->get('/hiekkalaatikko', function() {
        HelloWorldController::sandbox();
    });

    $routes->get('/tasks', function() {
        Task_controller::index();
    });
    
    $routes->get('/tasks/new', function() {
        Task_controller::create();
    });
    
     $routes->get('/tasks/:id', function($id) {
        Task_controller::show($id);
    });

    $routes->get('/', function() {
        HelloWorldController::login();
    });

    $routes->get('/login', function() {
        HelloWorldController::login();
    });
    
    $routes->get('/employees', function() {
        Employee_controller::index();
    });
    
    $routes->get('/employees/new', function() {
        Employee_controller::create();
    });
    
    $routes->get('/employees/:id', function($id) {
        Employee_controller::show($id);
    });
    
    
   
    $routes->get('/plan',function(){
        Plan_controller::index();
    });
    
     $routes->get('/plan/:block_id',function($block_id){
        Plan_controller::show($block_id);
    });
    
    
    
   