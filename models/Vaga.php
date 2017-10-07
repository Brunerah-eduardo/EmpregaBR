<?php

class Vaga{
    
    public function buscaHistoricoVagas($id_user){
        return $result = Db::queryAll("select v.* from vagacandidato vc inner join vaga v on vc.FK_Id_vaga=v.ID_vaga where vc.FK_Id_candidato=?", array($id_user));
    }
    
    public function buscaDadosCandidato(){
        return $result = Db::queryAll("select e.nomeFantasia, v.* from vaga v inner join empresa e on v.`FK_Id_empresa`=e.`ID_empresa`");
    }
    
    public function detalhesVaga($id_vaga){
        return $result = Db::queryOne("select e.ID_empresa, e.nomeFantasia, a.descricao as areainteresse, v.* from vaga v inner join areainteresse a on v.FK_Id_areainteresse = a.ID_areainteresse inner join empresa e on v.FK_Id_empresa = e.ID_empresa where v.ID_vaga=?", array($id_vaga));
    }
    
    public function buscaQtdeVagas($id_vaga){
        return $result = Db::queryOne("select v.qtdevagas from vaga v where v.ID_vaga=?", array($id_vaga));
    }
    
    public function buscaDados($id_empresa){
        return $result = Db::queryAll("select a.descricao as areainteresse, v.* from vaga v inner join areainteresse a on v.FK_Id_areainteresse = a.ID_areainteresse where v.FK_Id_empresa=?", array($id_empresa));
    }
    
    public function buscaVagasAbertas($id_empresa){
        return $result = Db::queryAll("select a.descricao as areainteresse, v.* from vaga v inner join areainteresse a on v.FK_Id_areainteresse = a.ID_areainteresse where v.FK_Id_empresa=? and v.`statusVaga`='A'", array($id_empresa));
    }
    
    public function inserirDados($params = array()){
        return $result = Db::queryCount("INSERT INTO vaga (FK_Id_areainteresse, cargo, descricao, qtdeVagas, horarioTrabalho, tipoContrato, salario, detalhesVaga, dataCadastro, statusVaga, FK_Id_empresa) VALUES (?,?,?,?,?,?,?,?,?,?,?)", $params);
    }
    
    public function candidatarVaga($params = array()){
        $candidato = new CandidatoDadoPessoal();
        $c = $candidato->buscarDados($params[0]);
        
        $v = $this->detalhesVaga($params[1]);
        
        $result = Db::queryCount("INSERT INTO vagacandidato(FK_Id_candidato, FK_Id_vaga) VALUES (?,?)", $params);
        Db::queryCount("INSERT INTO historico(Id_candidato, candidato, Id_vaga, vaga, Id_empresa, empresa, descricao, dataCadastro) VALUES (?,?,?,?,?,?,?,?)", array( $c['Id_candidato'], $c['nome_completo'], $v['ID_vaga'], $v['cargo'], $v['ID_empresa'], $v['nomeFantasia'], 'Candidatado', date('Y:m:d')));
        return $result;
    }
   
    public function removerDados($id_vaga){
        return $result = Db::queryCount("DELETE FROM vaga WHERE ID_vaga=?", array($id_vaga));
    }
    
    public function buscaCandidatosVaga($id_vaga){
        return $result = Db::queryAll("select vc.FK_Id_candidato from vagacandidato vc where vc.FK_Id_vaga=?", array($id_vaga));
    }
    
    public function atualizarDados($params = array(), $id_vaga){
        array_push($params, $id_vaga);
        return $result = Db::queryCount("UPDATE vaga SET 
                FK_Id_areainteresse=?, 
                cargo=?, 
                descricao=?, 
                qtdeVagas=?, 
                horarioTrabalho=?, 
                tipoContrato=?, 
                salario=?, 
                detalhesVaga=?
                WHERE ID_vaga=?", $params);
        
    }
    
    
    
}