<?php

class CandidatoDadoComplementar{
    
    public function buscaDados($id_user){
        return $result = Db::queryAll("SELECT * FROM dadocomplementarcandidato dc WHERE dc.id_candidato = ?", array($id_user));
    }
    
    public function inserirDados($params = array()){
        return $result = Db::queryCount("INSERT INTO dadocomplementarcandidato (id_candidato, tipohabilitacao, numerocnh, carteiratrabalho, carteiramilitar) VALUES (?,?,?,?,?)", $params);
    }
    
}