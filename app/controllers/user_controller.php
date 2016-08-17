<?php


class User_controller extends BaseController{
   
    public static function index(){
        $blocks = Block::all();
        View::make('etusivu.html', array('blocks'=>$blocks));
    
    }
    
    public static function login(){
        
        View::make('user/login.html');
    }
    
    public static function logout(){
        $_SESSION['user'] = null;
        Redirect::to('/login', array('message' => 'Olet kirjautunut ulos!'));
    }
    
    public static function handle_login(){
        
        $params = $_POST;

        $user = User::authenticate($params['username'], $params['password']);
        
        if(!$user){
            View::make('user/login.html', array('error' => 'Väärä käyttäjätunnus tai salasana!', 'username' => $params['username']));
        }else{
            $_SESSION['user'] = $user->id;

            Redirect::to('/');
        }
    
    }
}
