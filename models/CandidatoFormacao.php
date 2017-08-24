<?php

class CandidatoFormacao{
    
    public function buscaDados($id_user){
        return $result = Db::queryAll("select * from formacaocandidato fc WHERE fc.id_candidato= ?", array($id_user));
    }
    
    public function inserirDados($params = array()){
        return $result = Db::queryCount("INSERT INTO formacaocandidato (id_candidato, curso, instituicao, situacao, dataInicio, dataFim) VALUES (?,?,?,?,?,?)", $params);
    }
    
}