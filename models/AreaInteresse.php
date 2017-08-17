<?php

class AreaInteresse{
    
    public function buscaDados($id_user){
        $sql = "select ai.descricao from areainteresse_candidato aic
                INNER JOIN areainteresse ai ON aic.ID_areainteresse = ai.ID_areainteresse
                where aic.ID_user = ?";
        $dados = array($id_user);
        return $result = Db::queryAll($sql, $dados);
    }
    
}