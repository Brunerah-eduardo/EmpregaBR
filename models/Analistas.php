<?php

class Analistas{
    
    public function buscarDados(){
        return $result = Db::queryAll("select ps.*, v.cargo from processoseletivo ps inner join vaga v on ps.FK_Id_vaga = v.ID_vaga");
    }
    
    public function buscarAnalistas($id_empresa){
        return $result = Db::queryAll("select a.* from analista a where a.FK_Id_empresa=?", array($id_empresa));
    }
    
    public function buscaDados($id_user){
        $sql = "SELECT a.* FROM analista a
                INNER JOIN empresa e ON e.Id_empresa = a.FK_Id_empresa
                where e.Id_empresa = ?";
        $dados = array($id_user);
        return $result = Db::queryAll($sql, $dados);
    }
    
    public function atualizarDados($params = array()){
        return $result = Db::queryCount("UPDATE analista SET
                nome=?,
                email=?
                WHERE FK_Id_user=?", $params);
                
        
    }
    
}