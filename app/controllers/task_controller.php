<?php


class Task_controller extends BaseController{
    
    public static function index(){
         
        $tasks = Task::all();
        
        View::make('task/tasks.html', array('tasks' => $tasks));
  
    }
    
    public static function show($id){
        
        $task = Task::find($id);
        
        View::make('task/editTask.html', array('task' => $task));
        
    }
    
    
    
    public static function create(){
        
        View::make('task/addTask.html');
        
    }
    
    public static function store(){
        $params = $_POST;

        $task = new Task(array(
          'id' => $params['id'],
          'alkuaika' => $params['alkuaika'],
          'loppuaika' => $params['loppuaika'],
          'kesto' => $params['kesto'],
          'tietoja' => $params['tietoja'] 
        ));

        
        $task->save();

        Redirect::to('/tasks/' . $task->id, array('message' => 'Työvuoro on lisätty!'));
    }
    
}
