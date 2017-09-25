<?php

class CandidatoDadoProfissional{
    
    public function buscarDados($id_user){
        return $result = Db::queryOne("select * from dadoprofissional dp WHERE dp.FK_Id_candidato= ?", array($id_user));
    }
    
    public function inserirDados($params = array()){
        return $result = Db::queryCount("INSERT INTO dadoprofissional (FK_Id_candidato, resumoprofissional, objetivoprofissional) VALUES (?,?,?)", $params);
    }
    
    public function atualizarDados($params = array()){
        return $result = Db::queryCount("UPDATE dadoprofissional SET resumoprofissional=?, objetivoprofissional=? WHERE FK_Id_candidato=?", $params);
    }
    
}