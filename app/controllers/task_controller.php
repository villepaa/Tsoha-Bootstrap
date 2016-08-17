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

        $attr = array(
          'id' => $params['id'],
          'alkuaika' => $params['alkuaika'],
          'loppuaika' => $params['loppuaika'],
          'kesto' => $params['kesto'],
          'tietoja' => $params['tietoja'] 
        );
        $task = new Task($attr);
        $errors = $task->errors();
        if(count($errors) == 0){
            $task->save();
            Redirect::to('/tasks/' . $task->id, array('message' => 'Työvuoro on lisätty!'));
        }else{
            
            View::make('task/addTask.html',array('errors'=>$errors,'attr'=>$attr));
        }    
            
    }
    
    public static function update($id){
        $params = $_POST;

        $attributes = array(
          'id' => $id,
          'alkuaika' => $params['alkuaika'],
          'loppuaika' => $params['loppuaika'],
          'kesto' => $params['kesto'],
          'tietoja' => $params['tietoja'],
          
        );

        
        $task = new Task($attributes);
        $errors = $task->errors();
        if(count($errors) == 0){
            $task->update();
            Redirect::to('/tasks/' . $task->id, array('message' => 'Työvuoron tietoja on muokattu!'));
        }else{
            View::make('task/editTask.html', array('errors'=>$errors,'task' => $attributes));
        }
        
    }
    
     public static function destroy($id){
        
        $task = new Task(array('id'=>$id));
        
        $task->destroy();

        Redirect::to('/tasks', array('message' => 'Työvuoro "'.$id .'" poistettu!'));
        
    }
    
}
