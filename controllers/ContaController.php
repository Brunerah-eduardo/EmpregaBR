<?php
    class ContaController extends Controller{
        
        public function process($params){
            
            $this->head['title'] = 'Opções da Conta';
            $this->head['desc'] = '';
            $this->view = 'empresa/conta';
        }
    }
?>