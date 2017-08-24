<?php

class CandidatoAreaInteresse{
    
    public function buscaDados($id_user){
        return $result = Db::queryAll("select * from areainteressecandidato aic WHERE aic.id_candidato= ?", array($id_user));
    }
    
    public function inserirDados($params = array()){
        return $result = Db::queryCount("INSERT INTO areainteressecandidato (id_candidato, areaInteresse) VALUES (?,?)", $params);
    }
    
}