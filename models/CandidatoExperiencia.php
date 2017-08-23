<?php

class CandidatoExperiencia{
    
    public function buscaDados($id_user){
        return $result = Db::queryAll("select * from experienciacandidato ec WHERE ec.id_candidato= ?", array($id_user));
    }
    
    public function inserirDados($params = array()){
        return $result = Db::queryCount("INSERT INTO experienciacandidato (id_candidato, empresa, cargo) VALUES (?,?,?)", $params);
    }
    
}