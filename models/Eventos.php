<?php

class Eventos{
    
    public function buscaDados(){
        return $result = Db::queryAll("select * from eventos e");
    }
    
}