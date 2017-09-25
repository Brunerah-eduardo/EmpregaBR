<?php
    class UsuarioController extends Controller{
        
        public function process($params){
            $this->data['error'] = "";
            $a = new Analistas();
            $result = $a->buscaDados($_SESSION['Id_user']);
            $analistas = $a->buscarAnalistas($_SESSION['Id_empresa']);
            $this->data['analistas'] = $analistas;
            $this->data['result'] = $result;

            if(!empty($result)){
                $this->data['result'] = $result;
            }else{
                $this->data['result'] = '';
            }
            
            if(isset($_POST['login']) && isset($_POST['senha'])){
                $regObj = new LogReg();
                $result = $regObj->analistaRegister($_POST['nome'], $_POST['email'], $_POST['login'], $_POST['senha'],3);

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