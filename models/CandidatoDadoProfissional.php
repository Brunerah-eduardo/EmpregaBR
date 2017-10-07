<?php

class CandidatoDadoProfissional{
    
    public function buscarDados($id_user){
        return $result = Db::queryOne("select * from dadoprofissional dp WHERE dp.id_candidato= ?", array($id_user));
    }
    
    public function atualizarDados($params = array()){
        return $result = Db::queryCount("UPDATE dadoprofissional SET resumoprofissional=?, objetivoprofissional=? WHERE id_candidato=?", $params);
    }
    
}