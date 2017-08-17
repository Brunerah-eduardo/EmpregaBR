<?php

    session_start();

    class LogReg{
        public function userRegister($login, $senha, $level){
            return Db::queryCount("INSERT INTO user(login, senha, level) VALUES (?,?,?)", array($login, $senha, $level));
        }

        public function userLogin($login, $senha){
            
            $result = Db::queryOne("SELECT ID_user, login, senha, level FROM user WHERE login = ?", array($login));
            if(count($result) > 0 && ($senha == $result['senha'])){
                $_SESSION['ID_user'] = $result['ID_user'];
                $_SESSION['level'] = $result['level'];
                return $resultado = true;
            }else{
                return $resultado = false;
            }
        }

        public static function isLogged(){
            if(isset($_SESSION['ID_user'])){
                return true;
            }else {
                return false;
            }
        }
    }

?>