<?php
    class DashboardController extends Controller{
        public function process($params){
            $this->head['title'] = 'Dash';
            $this->head['desc'] = '';
            if($_SESSION['level'] == 1){
                $this->view = 'cliente/dashboard';
            }else{
                $this->view = 'empresa/dashboard';
            }
            
        }
    }
?>