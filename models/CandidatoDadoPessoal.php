<?php

class CandidatoDadoPessoal{
    
    public function buscarDados($id_user){
        return $result = Db::queryOne("select * from candidato c WHERE c.FK_Id_user = ?", array($id_user));
    }
    
    public function atualizarDados($params = array()){
        return $result = Db::queryCount("UPDATE candidato SET
                nome_completo=?,
                cpf=?, 
                rg=?, 
                orgao_emissor=?, 
                data_expedicao=?,
                sexo=?, 
                data_nascimento=?, 
                estado_civil=?, 
                email=?, 
                nome_pai=?, 
                nome_mae=?, 
                endereco=?, 
                bairro=?, 
                regiao=?, 
                cidade=?, 
                cep=?, 
                estado=?, 
                telefone=?, 
                celular=?
                WHERE FK_Id_user=?", $params);
                
        
    }
    
}