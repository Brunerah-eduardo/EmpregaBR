<?php

class CandidatoIdioma{
    
    public function buscaDados($id_user){
        return $result = Db::queryAll("select * from idioma i WHERE i.FK_Id_candidato= ?", array($id_user));
    }
    
    public function inserirDados($params = array()){
        return $result = Db::queryCount("INSERT INTO idioma (FK_Id_candidato, idioma, nivel) VALUES (?,?,?)", $params);
    }
    
    public function removerDados($params = array()){
        return $result = Db::queryCount("DELETE FROM idioma i WHERE i.ID_idioma=?", $params);
    }
    
}