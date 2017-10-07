<?php
    class HistoricoController extends Controller{
        
        public function process($params){
            
            $this->head['title'] = 'Históricos de Processos Seletivos';
            $this->head['desc'] = '';
            
            if($_SESSION['level']==1){
                /*$v = new Vaga();
                $historicovagas = $v->buscaHistoricoVagas($_SESSION['Id_candidato']);*/
                $h = new Historico();
                $historico = $h->buscarRegistros($_SESSION['Id_candidato']);
                $this->data['historico'] = $historico;
                $this->view = 'cliente/historico';
            }else{
                $this->view = 'empresa/historico';
            }    
        }
    }
?>