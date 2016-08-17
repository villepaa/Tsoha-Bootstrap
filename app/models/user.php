<?php


class User extends BaseModel{
    public $id,$username, $password;
    
    public function __construct($attributes){
        parent::__construct($attributes);
        $this->validators = array('validate_username','validate_password');
    }
    
    public function validate_username(){
        $errors = array();
        if($this->username == '' || $this->username == null){
            $errors[] = 'Käyttäjänimi ei saa olla tyhjä!';
        }
        return $errors;
    }
    
    public function validate_password(){
        $errors = array();
        if($this->password == '' || $this->password == null){
            $errors[] = 'Salasana ei saa olla tyhjä!';
        }
        return $errors;
    }

    public static function find($id){
        $query = DB::connection()->prepare('SELECT * FROM Planner WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();
        
        $user = new User(array(
            'id'=> $row['id'],
            'username'=>$row['name'],
            'password'=>$row['password']
        ));
        return $user;
    }
    
    public static function authenticate($name,$password){
        $query = DB::connection()->prepare('SELECT * FROM Planner WHERE name = :name AND password = :password LIMIT 1');
        $query->execute(array('name' => $name, 'password' => $password));
        $row = $query->fetch();
        
        if($row){
            $user = new User(array(
              'id' => $row['id'],  
              'username'=> $row['name'],
              ' password' => $row['password']
            ));
            return $user;
        }else{
            return null;
        }
    }
}
