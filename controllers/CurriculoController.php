<?php
    session_start();
    
    class CurriculoController extends Controller{
        
        public function process($params){
            $areainteresse = new AreaInteresse();
            $result = $areainteresse->buscaDados($_SESSION['ID_user']);

            $this->head['title'] = 'Curriculos';
            $this->head['desc'] = '';
            $this->data['result'] = $result;
            
            $this->view = 'cliente/curriculo';
        }
    }
?>