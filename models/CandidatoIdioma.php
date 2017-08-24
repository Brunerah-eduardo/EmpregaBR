<?php

class CandidatoIdioma{
    
    public function buscaDados($id_user){
        return $result = Db::queryAll("select * from idiomacandidato ic WHERE ic.id_candidato= ?", array($id_user));
    }
    
    public function inserirDados($params = array()){
        return $result = Db::queryCount("INSERT INTO idiomacandidato (id_candidato, idioma, nivel) VALUES (?,?,?)", $params);
    }
    
}