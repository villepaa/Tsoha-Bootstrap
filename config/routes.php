<?php

    $routes->get('/', function() {
        HelloWorldController::index();
    });

    $routes->get('/hiekkalaatikko', function() {
        HelloWorldController::sandbox();
    });

    $routes->get('/login', function() {
        HelloWorldController::login();
    });

    $routes->get('/', function() {
        HelloWorldController::login();
    });

    $routes->get('/login', function() {
        HelloWorldController::login();
    });
    
    $routes->get('/employees', function() {
        HelloWorldController::employee_list();
    });
    
    $routes->get('/editEmployee', function() {
        HelloWorldController::edit_emp();
    });
    
    $routes->get('/duties', function() {
        HelloWorldController::duty_list();
    });
    
    $routes->get('/plan',function(){
        HelloWorldController::plan();
    });
    
    $routes->get('/etusivu',function(){
        HelloWorldController::front_page();
    });