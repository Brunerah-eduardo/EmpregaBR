<?php

class CandidatoRedeSocial{
    
    public function buscarDados($id_user){
        return $result = Db::queryAll("select * from redesocialcandidato rs WHERE rs.id_candidato= ?", array($id_user));
    }
    
    public function inserirDados($params = array()){
        return $result = Db::queryCount("INSERT INTO redesocialcandidato (id_candidato, redesocial, link_redesocial) VALUES (?,?,?)", $params);
    }
    
    public function atualizarDados($params = array()){
        return $result = Db::queryCount("UPDATE redesocialcandidato rsc SET rsc.link_redesocial=? WHERE rsc.id_candidato=? AND rsc.redesocial=?", $params);
    }
    
    public function removerDados($params = array()){
        return $result = Db::queryCount("DELETE FROM redesocialcandidato rsc WHERE rsc.id_candidato=? AND rsc.redesocial=?", $params);
    }
    
}