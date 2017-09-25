<?php
    class EmpresaCandidatoController extends Controller{
        
        public function process($params){
            
            $c = new EmpresaCandidato();
            $candidatos = $c->buscarDados();

            $this->head['title'] = 'Candidatos';
            $this->head['desc'] = '';
            $this->data['candidatos'] = $candidatos;
            $this->view = 'empresa/candidato';
            
            if(isset($_POST['candidato'])){
                $array = $_POST['candidato'];
                
                //print_r($array);
                $p = new ProcessoSeletivo();
                print_r($array);
                foreach($array as $value){
                    $dados = array(1,$value,0);
                    //$p->vinculaCandidatosProcessoSeletivo($dados);
                    
                    //echo $value . "<br>";
                }
            }
        }
    }
?>