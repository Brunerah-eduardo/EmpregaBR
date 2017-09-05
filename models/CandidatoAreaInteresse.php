<?php

class CandidatoAreaInteresse{
    
    public function buscarDados($id_user){
        return $result = Db::queryAll("select * from areainteressecandidato aic WHERE aic.id_candidato= ?", array($id_user));
    }
    
    public function inserirDados($params = array()){
        return $result = Db::queryCount("INSERT INTO areainteressecandidato (id_candidato, areaInteresse) VALUES (?,?)", $params);
    }
    
    public function removerDados($params = array()){
        return $result = Db::queryCount("DELETE FROM areainteressecandidato aic WHERE aic.areaInteresse=? and aic.id_candidato=?", $params);
    }
    
}