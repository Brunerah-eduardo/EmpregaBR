<?php

class Historico{
    
    public function buscarRegistros($id_user){
        return $result = Db::queryAll("select * from historico h where h.Id_candidato=?", array($id_user));
    }
    
    
    
}