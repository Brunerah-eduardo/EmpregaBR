<?php

class CandidatoConhecimento{
    
    public function buscaDados($id_user){
        return $result = Db::queryAll("select * from conhecimentocandidato c WHERE c.id_candidato = ?", array($id_user));
    }
    
    public function inserirDados($params = array()){
        return $result = Db::queryCount("INSERT INTO conhecimentocandidato (id_candidato, conhecimento) VALUES (?,?)", $params);
    }
    
}