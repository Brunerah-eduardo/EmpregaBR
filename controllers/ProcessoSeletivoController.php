<?php
    class ProcessoSeletivoController extends Controller{
        
        public function process($params){
            
            $this->head['title'] = 'Processos Seletivos';
            $this->head['desc'] = '';
            $this->view = 'empresa/processoseletivo';
        }
    }
?>