<?php
    class LoginController extends Controller{

        public function process($params){
            if(LogReg::isLogged()){
                if($_SESSION['level'] == 1){
                    $this->redirect("cliente");
                }else if($_SESSION['level'] == 2){
                    $this->redirect("empresa");
                }else if($_SESSION['level'] == 3){
                    $this->redirect("analista");
                }
            }
            $this->head['title'] = 'Login';
            $this->head['desc'] = 'Login';
            $this->data['error'] = "";

            if(isset($_POST['login']) && isset($_POST['senha'])){
                $logObj = new LogReg;
                $login = $logObj->userLogin($_POST['login'],$_POST['senha']);

                if($login == true){
                    if(is_array($login)){
                        $this->view = 'doubleLogin';
                    }else{
                        $logObj->userType($_SESSION['Id_user'], (int)$login);
                        $this->redirect('login');
                    }
                }else{
                    $this->data['error'] = "Error";
                }

            }else if(isset($_POST['loginLevel'])){
                $logObj = new LogReg;
                $logObj->userType($_SESSION['Id_user'], $_POST['loginLevel']);
                $this->redirect("login");
            }else{
                $this->view = 'login';
            }
        }
        
    }
?>