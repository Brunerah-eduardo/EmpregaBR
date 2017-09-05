<?php

class CandidatoDadoPessoal{
    
    public function buscarDados($id_user){
        return $result = Db::queryOne("select * from candidato c WHERE c.FK_Id_user = ?", array($id_user));
    }
    
    public function atualizarDados($params = array()){
        return $result = Db::queryCount(" UPDATE candidato SET nome=?, cpf=?, email=? WHERE FK_Id_user=?", $params);
        
    }
    
}