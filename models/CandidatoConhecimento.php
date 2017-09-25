<?php

class CandidatoConhecimento{
    
    public function buscaDados($id_user){
        return $result = Db::queryOne("select * from conhecimento c WHERE c.FK_Id_candidato = ?", array($id_user));
    }
    
    public function inserirDados($params = array()){
        return $result = Db::queryCount("INSERT INTO conhecimento (FK_Id_candidato, conhecimento) VALUES (?,?)", $params);
    }
    
    public function removerDados($params = array()){
        return $result = Db::queryCount("DELETE FROM conhecimento c WHERE c.ID_conhecimento=?", $params);
    }
    
    
    
}