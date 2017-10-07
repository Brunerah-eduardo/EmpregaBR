<?php
    class UsuarioController extends Controller{
        
        public function process($params){
            $this->data['error'] = "";
            $analistas = new Analistas();
            $result = $analistas->buscaDados($_SESSION['Id_user']);
            $this->data['result'] = $result;

            if(!empty($result)){
                $this->data['result'] = $result;
            }else{
                $this->data['result'] = '';
            }
            
            if(isset($_POST['login']) && isset($_POST['senha'])){
                $regObj = new LogReg();
                $result = $regObj->analistaRegister($_POST['login'], $_POST['senha'],3);
                
        
                if(!($result > 0))
                    $this->data['error'] = "Deu algum erro ao se registrar";
                else
                    $this->redirect ('empresa/usuario');
            }
            $this->head['title'] = 'Usuarios';
            $this->head['desc'] = '';
            
            $this->view = 'empresa/usuario';
        }
    }
?>