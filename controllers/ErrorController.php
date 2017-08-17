<?php
    class ErrorController extends Controller{
        public function process($params){
            header("HTTP/1.0 404 Not Found");
            $this->head['title'] = 'Error';
            $this->view = 'error';
        }
    }
?>