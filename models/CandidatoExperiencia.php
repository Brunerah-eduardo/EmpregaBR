<?php

class CandidatoExperiencia{
    
    public function buscaDados($id_user){
        return $result = Db::queryAll("select * from experienciaprofissional ep WHERE ep.FK_Id_candidato= ?", array($id_user));
    }
    
    public function inserirDados($params = array()){
        return $result = Db::queryCount("INSERT INTO experienciaprofissional 
                (FK_Id_candidato, empresa, dataAdmissao, dataDemissao, cargo, atualEmprego, areaTrabalho, atividadesExercidas) 
                VALUES (?,?,?,?,?,?,?,?)", $params);
    }
    
    public function atualizarDados($params = array()){
        return $result = Db::queryCount(" UPDATE experienciaprofissional SET 
                empresa=?, 
                dataAdmissao=?, 
                dataDemissao=?, 
                cargo=? 
                atualEmprego=?, 
                areaTrabalho=?, 
                atividadesExercidas=?, 
                WHERE ID_experienciaprofissional=?", $params);
    }
    
}