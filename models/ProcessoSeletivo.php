<?php

class ProcessoSeletivo{

    public function buscarProcessosSeletivosAtivos(){
        return $result = Db::queryAll("select ps.*, v.cargo from processoseletivo ps inner join vaga v on ps.FK_Id_vaga = v.ID_vaga where ps.status='A'");
    }
    
    public function buscarDados($id_empresa){
        return $result = Db::queryAll("select ps.*, v.cargo from processoseletivo ps inner join vaga v on ps.FK_Id_vaga = v.ID_vaga where ps.FK_Id_empresa=?", array($id_empresa));
    }
    
    public function inserirDados($params = array()){
        return $result = Db::queryCount("INSERT INTO processoseletivo (FK_Id_vaga, status, vagasrestantes, FK_Id_empresa) VALUES (?,?,?,?)", $params);
    }
    
    public function buscaProcessoSeletivosPendentes($params = array()){
        return $result = Db::queryAll("SELECT ps.* FROM processoseletivo ps WHERE ps.status=? and ps.FK_Id_empresa=?", $params);
    }
    
    public function buscaVagasPendentes($params = array()){
        return $result = Db::queryAll("SELECT v.ID_vaga, v.cargo FROM vaga v WHERE v.statusVaga=? and v.FK_Id_empresa=?", $params);
    }
    
    public function buscarCandidatosVagas($id_processo){
        return $result = Db::queryAll("SELECT ps.FK_Id_vaga, vc.fk_Id_candidato, c.nome_completo FROM processoseletivo ps inner join vagacandidato vc on ps.FK_Id_vaga=vc.FK_Id_vaga inner join candidato c on vc.FK_Id_candidato=c.Id_candidato WHERE ID_processoseletivo=?", array($id_processo));
    }
    
    public function buscarCandidatosProcessosSeletivos($params = array()){
        return $result = Db::queryAll("SELECT c.*, psc.* FROM processoseletivo_candidato psc inner join candidato c on psc.FK_Id_candidato=c.Id_candidato WHERE psc.FK_Id_processoseletivo=? and psc.etapa_candidato=?", $params);
    }

    public function vinculaCandidatosProcessoSeletivo($params = array()){
        return $result = Db::queryCount("INSERT INTO processoseletivo_candidato (FK_Id_processoseletivo, FK_Id_candidato, etapa_candidato) VALUES (?,?,?)", $params);
    }
    
    public function avancarCandidatosEtapa01($params = array()){
        return $result = Db::queryCount("UPDATE processoseletivo_candidato SET
                etapa_candidato=?,
                avaliacaoRH=?, 
                comentarioRH=?
                WHERE FK_Id_candidato=? and FK_Id_processoseletivo=?", $params);
    }
    
    public function avancarCandidatosEtapa02($params = array()){
        return $result = Db::queryCount("UPDATE processoseletivo_candidato SET
                etapa_candidato=?,
                avaliacaoDepto=?, 
                comentarioDepto=?
                WHERE FK_Id_candidato=? and FK_Id_processoseletivo=?", $params);
    }
    
    public function contratarCandidatos($params = array()){
        $result = Db::queryCount("UPDATE processoseletivo_candidato SET
                etapa_candidato=?,
                avaliacaoFinal=?, 
                comentarioAvalFinal=?
                WHERE FK_Id_candidato=? and FK_Id_processoseletivo=?", $params);
        return $result;
    }
    
    public function debitarVagasRestantes($params = array()){
        $result = Db::queryCount("UPDATE processoseletivo SET
                vagasrestantes=vagasrestantes-1
                WHERE ID_processoseletivo=? and vagasrestantes >= 0", $params);
        $result = Db::queryOne("SELECT vagasrestantes FROM processoseletivo WHERE ID_processoseletivo=?", $params);
        if($result['vagasrestantes'] == 0){
            return Db::queryCount("UPDATE processoseletivo SET status = 'C' where ID_processoseletivo=?", $params);
        }
    }
    
    
}