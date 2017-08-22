<?php
    class CurriculoController extends Controller{
        
        public function process($params){
            $areainteresse = new AreaInteresse();
            $result = $areainteresse->buscaDados($_SESSION['Id_user']);

            $this->head['title'] = 'Curriculos';
            $this->head['desc'] = '';
            $this->data['result'] = $result;
            
            $this->view = 'cliente/curriculo';
        }
    }
?>