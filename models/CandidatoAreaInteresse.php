<?php

class CandidatoAreaInteresse{
    
    public function buscarDados($id_user){
        return $result = Db::queryAll("select ai.descricao, aic.* from areainteressecandidato aic "
                . "INNER JOIN areainteresse ai ON ai.ID_areainteresse = aic.FK_Id_areainteresse "
                . "WHERE aic.FK_Id_candidato= ?", array($id_user));
    }
    
    public function buscarAreasInteresse(){
        return $result = Db::queryAll("select * from areainteresse ai");
    }
    
    public function inserirDados($params = array()){
        return $result = Db::queryCount("INSERT INTO areainteressecandidato (FK_Id_candidato, FK_Id_areainteresse) VALUES (?,?)", $params);
    }
    
    public function removerDados($params = array()){
        return $result = Db::queryCount("DELETE FROM areainteressecandidato aic WHERE aic.ID_areainteressecandidato=?", $params);
    }
    
}