<?php

    abstract class Controller{
        protected $data = array();
        protected $view = "";
        protected $head = array('title' => '', 'desc' => '');

        abstract function process($params);

        public function renderView(){
            if($this->view){
                extract($this->protect($this->data));
                extract($this->data, EXTR_PREFIX_ALL, "");
                require("views/$this->view.phtml");
            }
        }

        public function redirect($url){
            header("Location: /$url");
            header("Connection: close");
            exit;
        }

        private function protect($x = null){
            if(!isset($x)){
                return null;
            }else if(is_string($x)){
                return htmlspecialchars($x, ENT_QUOTES);
            }else if(is_array($x)){
                foreach($x as $k => $v){
                    $x[$k] = $this->protect($v);
                }
                return $x;
            }else{
                return $x;
            }
        }
    }

?>