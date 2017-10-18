<?php

class CandidatoFormacao{
    
    public function buscarDados($id_user){
        return $result = Db::queryAll("select * from formacaoacademica fa WHERE fa.FK_Id_candidato= ?", array($id_user));
    }
    
    public function inserirDados($params = array()){
        return $result = Db::queryCount("INSERT INTO formacaoacademica (FK_Id_candidato, curso, instituicao, situacao, dataInicio, dataFim, previsaoTermino) VALUES (?,?,?,?,?,?,?)", $params);
    }
    
    public function atualizarDados($params = array()){
        return $result = Db::queryCount(" UPDATE formacaoacademica SET curso=?, instituicao=?, situacao=?, dataInicio=?, dataFim=? WHERE ID_formacaoacademica=?", $params);
    }
    
    public function removerDados($params = array()){
        return $result = Db::queryCount("DELETE FROM formacaoacademica fa WHERE fa.ID_formacaoacademica=?", $params);
    }
    
}