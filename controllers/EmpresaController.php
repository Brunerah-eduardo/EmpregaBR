<?php
    class EmpresaController extends Controller{
        protected $controller;

        public function process($params){
            $parsedUrl = $this->parseUrl($params[0]);
            if(empty($parsedUrl[0]))
                $this->redirect('empresa/dashboard');
                
            $controllerClass = $this->dashesToCamel(array_shift($parsedUrl)).'Controller';

            if(file_exists("controllers/$controllerClass.php"))
                $this->controller = new $controllerClass;
            else
                $this->redirect('empresa/error');

            $this->controller->process($parsedUrl);

            $this->head['title'] = $this->controller->head['title'];
            $this->head['desc'] = $this->controller->head['desc'];
            $this->view = 'layoutEmpresa';
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
?>