<?php
    class UsuarioController extends Controller{
        
        public function process($params){
            $this->head['title'] = 'Usuarios';
            $this->head['desc'] = '';
            
            $this->view = 'empresa/usuario';
        }
    }
?>