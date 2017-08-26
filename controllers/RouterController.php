<?php

    class RouterController extends Controller{
        protected $controller;

        public function process($params){
            echo "level: " . $_SESSION['level'] . "<br>";
            echo "Id_user: " . $_SESSION['Id_user'] . "<br>";
            echo "Id_candidato: " . $_SESSION['Id_candidato'] . "<br>";
            echo "Id_empresa: " . $_SESSION['Id_empresa'] . "<br>";
            echo "Id_analista: " . $_SESSION['Id_analista'] . "<br>";
            $parsedUrl = $this->parseUrl($params[0]);
            if(empty($parsedUrl[0]))
                $this->redirect('login');
                
            $controllerClass = $this->dashesToCamel(array_shift($parsedUrl)).'Controller';

            if(file_exists("controllers/$controllerClass.php")){
                $this->controller = new $controllerClass;
            }else{
                if(LogReg::isLogged()){
                    if($_SESSION['level'] == 1){
                        $this->redirect("cliente/error");
                    }else if($_SESSION['level'] == 2){
                        $this->redirect("empresa/error");
                    }else if($_SESSION['level'] == 3){
                        $this->redirect("analista/error");
                    }
                }else{
                    $this->redirect('error');
                }
            }

            $this->controller->process($parsedUrl);

            $this->data['title'] = $this->controller->head['title'];
            $this->data['desc'] = $this->controller->head['desc'];

            $this->view = 'layoutAuth';
        }

        private function parseUrl($url){
            $parsedUrl = parse_url($url);
            $parsedUrl["path"] = ltrim($parsedUrl["path"], "/");
            $parsedUrl["path"] = trim($parsedUrl["path"]);

            return $explodedUrl = explode("/", $parsedUrl["path"]);
        }

        private function dashesToCamel($text){
            $text = str_replace('-', ' ', $text);
            $text = ucwords($text);

            return $text = str_replace(' ', '', $text);
        }
    }