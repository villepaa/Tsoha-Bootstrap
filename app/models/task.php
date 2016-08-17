<?php


class Task extends BaseModel{
    
    public $id, $alkuaika, $loppuaika, $kesto, $tietoja;
    
    public function construct($attributes){
        parent::__construct($attributes);
        $this->validators = array('validate_id','validate_alkuaika','validate_loppuaika');
        
    }
    
    public function validate_id() {
        $errors = array();
        if($this->id == '' || $this->id == null){
            $errors[] = 'Tunnus ei saa olla tyhjä!';
        }
       
        return $errors;

    }
    
    public function validate_alkuaika() {
        
    }
    
    public function validate_loppuaika() {
        
    }
    
    
    
    public static function all(){
        $query = DB::connection()->prepare('SELECT * FROM Task');
         
        $query->execute();
    
        $rows = $query->fetchAll();
        $tasks = array();

    
    foreach($rows as $row){
      
      $tasks[] = new Task(array(
        'id' => $row['id'],
        'alkuaika' => $row['alkuaika'],
        'loppuaika' => $row['loppuaika'],
        'kesto' => $row['kesto'],
        'tietoja' => $row['tietoja']
        
      ));
    }

    return $tasks;
  }
  
  public static function find($id){
    $query = DB::connection()->prepare('SELECT * FROM Task WHERE id = :id LIMIT 1');
    $query->execute(array('id' => $id));
    $row = $query->fetch();

    if($row){
      $task = new Task(array(
        'id' => $row['id'],
        'alkuaika' => $row['alkuaika'],
        'loppuaika' => $row['loppuaika'],
        'kesto' => $row['kesto'],
        'tietoja' => $row['tietoja']
      ));

      return $task;
    }

    return null;
  }
  
  public function save(){
    
    $query = DB::connection()->prepare('INSERT INTO Task (id, alkuaika, loppuaika, kesto,tietoja) VALUES (:id, :alkuaika, :loppuaika, :kesto, :tietoja) RETURNING id');
    
    $query->execute(array('id' => $this->id, 'alkuaika' => $this->alkuaika, 'loppuaika' => $this->loppuaika, 'kesto' => $this->kesto, 'tietoja' => $this->tietoja));
    
   
  }
  
  public function update(){
    $query = DB::connection()->prepare('UPDATE Task SET alkuaika=:alkuaika, loppuaika=:loppuaika, kesto=:kesto,tietoja=:tietoja WHERE id = :id');
    
    $query->execute(array('alkuaika' => $this->alkuaika, 'loppuaika' => $this->loppuaika, 'kesto' => $this->kesto, 'tietoja' => $this->tietoja, 'id' => $this->id));
    
  } 
  
  public function destroy(){
    $query = DB::connection()->prepare('DELETE FROM Task WHERE id = :id');
    
    $query->execute(array('id' => $this->id));
     
  }
    
    
    
}
