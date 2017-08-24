<?php

class CandidatoRedeSocial{
    
    public function buscaDados($id_user){
        return $result = Db::queryAll("select * from redesocialcandidato rs WHERE rs.id_candidato= ?", array($id_user));
    }
    
    public function inserirDados($params = array()){
        return $result = Db::queryCount("INSERT INTO redesocialcandidato (id_candidato, redesocial, link_redesocial) VALUES (?,?,?)", $params);
    }
    
}