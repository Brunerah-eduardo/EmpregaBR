<?php

class CandidatoDadoComplementar{
    
    public function buscarDados($id_user){
        return $result = Db::queryOne("SELECT * FROM dadocomplementar dc WHERE dc.FK_Id_candidato = ?", array($id_user));
    }
    
    public function inserirDados($params = array()){
        return $result = Db::queryCount("INSERT INTO dadocomplementar (FK_Id_candidato, tipohabilitacao, numerocnh, carteiratrabalho, carteiramilitar) VALUES (?,?,?,?,?)", $params);
    }
    
    public function atualizarDados($params = array()){
        return $result = Db::queryCount("UPDATE dadocomplementar dc SET dc.tipohabilitacao=?, dc.numerocnh=?, dc.carteiratrabalho=?, dc.carteiramilitar=? WHERE dc.FK_Id_candidato=?", $params);
    }
    
    
    
}