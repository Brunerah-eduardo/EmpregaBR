<?php
    class EmpresaCandidatoController extends Controller{
        
        public function process($params){
            
            $c = new EmpresaCandidato();
            $candidatos = $c->buscarDados();

            $this->head['title'] = 'Candidatos';
            $this->head['desc'] = '';
            $this->data['candidatos'] = $candidatos;
            $this->view = 'empresa/candidato';
        }
    }
?>