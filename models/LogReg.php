<?php
    class LogReg{
        public function userRegister($login, $senha, $level){
            $result = Db::queryCount("INSERT INTO user(login, senha) VALUES (?,?)", array($login, $senha));
            
            if($result > 0){
                $result = Db::queryOne("SELECT Id_user FROM user WHERE login = ?", array($login));
                if(count($result) > 0){
                    Db::queryCount("INSERT INTO level(FK_Id_user, level) VALUES(?,?)", array($result['Id_user'], $level));
                    if(!($level == 3))
                        $this->userLoginForRegister($login, $senha);
                    else
                        return $analista = $result['Id_user'];
                    
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }
        
        public function analistaRegister($login, $senha, $level){
            $analista = $this->userRegister($login, $senha, $level);
            return Db::queryCount("INSERT INTO analista(FK_Id_user, FK_Id_empresa) VALUES(?,?)", array($analista, $_SESSION['Id_empresa']));
        }
       
        public function empresaRegister($login, $senha, $level){
            $this->userRegister($login, $senha, $level);
            return Db::queryCount("INSERT INTO empresa(confirmado, FK_Id_user) VALUES(?,?)", array(1, $_SESSION['Id_user']));
        }
       
        public function clienteRegister($login, $senha, $level){
            $this->userRegister($login, $senha, $level);
            return Db::queryCount("INSERT INTO candidato(FK_Id_user) VALUES(?)", array($_SESSION['Id_user']));
           
        }
        
        public function userLoginForRegister($login, $senha){
            
            $result = Db::queryOne("SELECT u.*, l.level FROM user u 
                    INNER JOIN level l ON u.Id_user = l.FK_Id_user WHERE u.login = ?", array($login));
            if(count($result) > 0 && ($senha == $result['senha'])){
                if($result['level'] == 1){
                    $candidato = Db::queryOne ("SELECT c.Id_candidato FROM candidato c
                            INNER JOIN user u ON c.FK_Id_user = u.Id_user WHERE u.Id_user = ?", array($result['Id_user']));
                    $_SESSION['Id_candidato'] = $candidato['Id_candidato'];
                }else if($result['level'] == 2){
                    $empresa = Db::queryOne ("SELECT e.Id_empresa FROM empresa e
                            INNER JOIN user u ON e.FK_Id_user = u.Id_user WHERE u.Id_user = ?", array($result['Id_user']));
                    $_SESSION['Id_empresa'] = $empresa['Id_empresa'];    
                }
                $_SESSION['Id_user'] = $result['Id_user'];
                $_SESSION['level'] = $result['level'];
                return $resultado = true;
            }else{
                return $resultado = false;
            }
        }

        public function userLogin($login, $senha){
            $result = Db::queryOne("SELECT u.*, l.level FROM user u INNER JOIN level l ON u.Id_user = l.FK_Id_user WHERE u.login = ?", array($login));
            $_SESSION['Id_user'] = $result['Id_user'];
            if(count($result) > 0 && ($senha == $result['senha'])){
                $result = Db::queryAll("SELECT l.level FROM user u INNER JOIN level l ON u.Id_user = l.FK_Id_user WHERE u.login = ?", array($login));
                if(count($result) > 1){
                    return $result;
                }else{
                    return $result[0]['level'];
                }
            }else{
                return false;
            }
        }

        public function userType($user, $level){
            if($level == 1){
                $candidato = Db::queryOne ("SELECT c.Id_candidato FROM candidato c
                    INNER JOIN user u ON c.FK_Id_user = u.Id_user WHERE u.Id_user = ?", array($user));
                $_SESSION['Id_candidato'] = $candidato['Id_candidato'];
                $_SESSION['level'] = $level;
            }else if($level == 2){
                $empresa = Db::queryOne ("SELECT e.Id_empresa FROM empresa e
                    INNER JOIN user u ON e.FK_Id_user = u.Id_user WHERE u.Id_user = ?", array($user));
                $_SESSION['Id_empresa'] = $empresa['Id_empresa'];
                $_SESSION['level'] = $level;
            }else{
                $analista = Db::queryOne ("SELECT a.Id_analista FROM analista a
                    INNER JOIN user u ON a.FK_Id_user = u.Id_user WHERE u.Id_user = ?", array($user));
                $_SESSION['Id_analista'] = $analista['Id_analista'];
                $_SESSION['level'] = $level;
            }
        }

        public static function isLogged(){
            if(isset($_SESSION['Id_candidato']) || isset($_SESSION['Id_empresa']) || isset($_SESSION['Id_analista'])){
                return true;
            }else {
                return false;
            }
        }
    }

?>