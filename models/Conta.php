<?php

class Conta{
    
    public function buscaDadosCandidato($id_candidato){
        return $result = Db::queryOne("select * from candidato c where Id_candidato=?", array($id_candidato));
    }
    
    public function buscaDadosEmpresa($id_empresa){
        return $result = Db::queryOne("select * from empresa where ID_empresa=?", array($id_empresa));
    }
    
    public function alterarSenha($params = array()){
        return $result = Db::queryCount("UPDATE user SET senha=? WHERE Id_user=?", $params);
    }
    
}