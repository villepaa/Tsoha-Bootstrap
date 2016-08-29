<?php

// Suunnitelmasta löytyvä työvuoro, jolle lisätty päivämäärä


class PlannedTask extends Task{
    
    public $day;
            
    public function __contruct($attributes) {
        parent::__construct($attributes);
    }        
}
