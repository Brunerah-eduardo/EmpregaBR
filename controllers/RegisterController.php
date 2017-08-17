<?php
    class RegisterController extends Controller{

        public function process($params){

            if(LogReg::isLogged()){
                $this->redirect("cliente");
            }
            
            $this->data['error'] = "";

            if(isset($_POST['login']) && isset($_POST['senha']) && isset($_POST['level'])){
                $regObj = new LogReg();
                $result = $regObj->userRegister($_POST['login'], $_POST['senha'],$_POST['level']);

                if(!($result >0))
                    $this->data['error'] = "Deu algum erro ao se registrar";
                else
                    $this->data['error'] = "Você foi registrado com sucesso";
            }

            $this->head['title'] = 'Register';
            $this->head['desc'] = 'Register';
            $this->view = 'register';
        }
    }

?>