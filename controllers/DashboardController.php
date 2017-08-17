<?php
    class DashboardController extends Controller{
        public function process($params){
            $this->head['title'] = 'Dash';
            $this->head['desc'] = '';
            $this->view = 'cliente/dashboard';
        }
    }
?>