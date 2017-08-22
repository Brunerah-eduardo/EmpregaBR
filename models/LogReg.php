<?php
    class LogReg{
        public function userRegister($login, $senha, $level){
            $result = Db::queryCount("INSERT INTO user(login, senha) VALUES (?,?)", array($login, $senha));
            
            if($result > 0){
                $result = Db::queryOne("SELECT Id_user FROM user WHERE login = ?", array($login));
                if(count($result) > 0){
                    Db::queryCount("INSERT INTO level(FK_Id_user, level) VALUES(?,?)", array($result['Id_user'], $level));
                    $this->userLogin($login, $senha);
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }
        
       public function analistaRegister($login, $senha, $level){
           $this->userRegister($login, $senha, $level);
       }
       
       public function empresaRegister($login, $senha, $level){
           $this->userRegister($login, $senha, $level);
       }
       
       public function clienteRegister($login, $senha, $level){
           $this->userRegister($login, $senha, $level);
           return Db::queryCount("INSERT INTO candidato(FK_Id_user) VALUES(?)", array($_SESSION['Id_user']));
           
       }

        public function userLogin($login, $senha){
            
            $result = Db::queryOne("SELECT u.*, l.level FROM user u 
                    INNER JOIN level l ON u.Id_user = l.FK_Id_user WHERE u.login = ?", array($login));
            if(count($result) > 0 && ($senha == $result['senha'])){
                $_SESSION['Id_user'] = $result['Id_user'];
                $_SESSION['level'] = $result['level'];
                return $resultado = true;
            }else{
                return $resultado = false;
            }
        }

        public static function isLogged(){
            if(isset($_SESSION['Id_user'])){
                return true;
            }else {
                return false;
            }
        }
    }

?>