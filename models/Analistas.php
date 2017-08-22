<?php

class Analistas{
    
    public function buscaDados($id_user){
        $sql = "SELECT a.* FROM analista a
                INNER JOIN empresa e ON e.Id_empresa = a.FK_Id_empresa
                where e.Id_empresa = ?";
        $dados = array($id_user);
        return $result = Db::queryAll($sql, $dados);
    }
    
}