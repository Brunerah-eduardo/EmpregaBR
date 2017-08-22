<?php
    class RegisterController extends Controller{

        public function process($params){

            if(LogReg::isLogged()){
                if($_SESSION['level'] == 1){
                    $this->redirect("cliente");
                }else{
                    $this->redirect("empresa");
                }
                
            }
            
            $this->data['error'] = "";

            if(isset($_POST['login']) && isset($_POST['senha']) && isset($_POST['level'])){
                $regObj = new LogReg();
                $result = $regObj->clienteRegister($_POST['login'], $_POST['senha'],$_POST['level']);

                if(!($result > 0))
                    $this->data['error'] = "Deu algum erro ao se registrar";
                else
                    $this->redirect ('login');
            }

            $this->head['title'] = 'Register';
            $this->head['desc'] = 'Register';
            $this->view = 'register';
        }
    }

?>