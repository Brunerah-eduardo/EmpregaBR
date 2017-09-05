<?php
    class HistoricoController extends Controller{
        
        public function process($params){
            
            $this->head['title'] = 'Históricos de Processos Seletivos';
            $this->head['desc'] = '';
            
            if($_SESSION['level']==1)
                $this->view = 'cliente/historico';
            else
                $this->view = 'empresa/historico';
        }
    }
?>