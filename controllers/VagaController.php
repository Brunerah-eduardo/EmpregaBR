<?php
    class VagaController extends Controller{
        public function process($params){
            $this->head['title'] = 'Vagas';
            $this->head['desc'] = '';
            
            if($params[0] == 'cliente'){
                $v = new Vaga();
                $vagas = $v->buscaDadosCandidato();

                $this->data['vagas'] = $vagas;
                $this->view='cliente/vaga';
            }else if($params[0] == 'empresa'){
                $v = new Vaga();
                $vagas = $v->buscaDados($_SESSION['Id_empresa']);

                $this->data['vagas'] = $vagas;
                $this->view='empresa/vaga';
            }else{
                $v = new Vaga();
                $vagas = $v->buscaDados();

                $this->data['vagas'] = $vagas;
                $this->view='analista/vaga';
            }
            
            
            
        }
    }
?>