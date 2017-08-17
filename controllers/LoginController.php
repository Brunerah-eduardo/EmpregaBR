<?php
    class LoginController extends Controller{

        public function process($params){
            if(LogReg::isLogged()){
                $this->redirect("cliente");
            }
            
            $this->data['error'] = "";

            if(isset($_POST['login']) && isset($_POST['senha'])){
                $logObj = new LogReg;
                $login = $logObj->userLogin($_POST['login'],$_POST['senha']);

                if($login == true){
                    $this->redirect("cliente");
                }else{
                    $this->data['error'] = "Error";
                }
            }
            
            $this->head['title'] = 'Login';
            $this->head['desc'] = 'Login';
            $this->view = 'login';
        }
        
    }
?>