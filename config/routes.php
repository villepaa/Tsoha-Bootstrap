<?php

    function check_logged_in(){
        BaseController::check_logged_in();
    }
    
    $routes->post('/tasks', function(){
        Task_controller::store();
    });
    
    $routes->post('/tasks/:id', function($id){
        Task_controller::update($id);
    });
    
    $routes->post('/tasks/:id/destroy', function($id){
        Task_controller::destroy($id);
    });
    
    $routes->post('/logout', function(){
        User_controller::logout();
    });
    
     $routes->post('/employees' ,function(){
         Employee_controller::store();
    });
    
    $routes->post('/plan',function(){
        Plan_controller::store();
    });
    
    $routes->post('/plan/:id',function($id){
        Plan_controller::update($id);
    });
    
    $routes->post('/login', function() {
        User_controller::handle_login();
    });
    
    $routes->post('/employees/:id', function($id) {
        Employee_controller::update($id);
    });
    
     $routes->post('/employees/:id/destroy', function($id) {
        Employee_controller::destroy($id);
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
        User_controller::index();
    });

    $routes->get('/login', function() {
        User_controller::login();
    });
    
    $routes->get('/employees', function() {
        Employee_controller::index();
    });
    
    $routes->get('/employees/new', function() {
        Employee_controller::create();
    });
    
    $routes->get('/employees/:id','check_logged_in', function($id) {
        Employee_controller::show($id);
    });
    
    
   
    $routes->get('/plan',function(){
        Plan_controller::index();
    });
    
     $routes->get('/plan/:block_id',function($block_id){
        Plan_controller::show($block_id);
    });
    
    
    
   