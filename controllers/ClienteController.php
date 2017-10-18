<?php
    class ClienteController extends Controller{
        protected $controller;

        public function process($params){
            $data = new LogReg();
            $this->data['data'] = $data->getDate();
            $parsedUrl = $this->parseUrl($params[1]);
            if(empty($parsedUrl[0]))
                $this->redirect('cliente/dashboard');
            
            
            
            $controllerClass = $this->dashesToCamel($parsedUrl[0]).'Controller';

            if(file_exists("controllers/$controllerClass.php"))
                $this->controller = new $controllerClass;
            else
                $this->redirect('cliente/error');

            $this->controller->process($params);

            $this->head['title'] = $this->controller->head['title'];
            $this->head['desc'] = $this->controller->head['desc'];
            $this->view = 'layoutCliente';
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