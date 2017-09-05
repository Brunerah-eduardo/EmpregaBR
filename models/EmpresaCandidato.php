<?php

class EmpresaCandidato{
    
    public function buscarDados(){
        return $result = Db::queryAll("select * from candidato");
    }
    
    
}