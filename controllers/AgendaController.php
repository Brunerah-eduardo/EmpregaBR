<?php
    class AgendaController extends Controller{
        
        public function process($params){
            
            $this->head['title'] = 'Agenda de Eventos';
            $this->head['desc'] = '';
            $e = new Eventos();
            
            if($_SESSION['level']==1){
                $eventos = $e->buscaDados();
                $this->data['eventos'] = $eventos;
                $this->view = 'cliente/agenda';
            }else{
                $eventos = $e->buscaDados();
                $this->data['eventos'] = $eventos;
                $this->view = 'empresa/agenda';
            }
            
        }
    }
?>