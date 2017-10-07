<?php

class Vaga{
    
    public function buscaDadosCandidato(){
        return $result = Db::queryAll("select * from vaga v");
    }
    
    public function buscaDados($id_empresa){
        return $result = Db::queryAll("select * from vaga v where v.FK_Id_empresa=?", array($id_empresa));
    }
    
    public function candidatarVaga($params = array()){
        return $result = Db::queryCount("INSERT INTO vagacandidato(FK_Id_candidato, FK_Id_vaga) VALUES (?,?)", $params);
    }
   
    public function removerDados($params = array()){
        return $result = Db::queryCount("DELETE FROM vaga v WHERE v.Id_vaga=?", $params);
    }
    
}