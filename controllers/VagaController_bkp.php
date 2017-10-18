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
                
                if(isset($_POST['areaInteresse']) && isset($_POST['cargo']) && isset($_POST['descricao']) && isset($_POST['qtdeVagas'])){
                    $dados = array($_POST['areaInteresse'], $_POST['cargo'], $_POST['descricao'], $_POST['qtdeVagas'], $_POST['horarioTrabalho'], $_POST['tipoContrato'],$_POST['salario'],$_POST['detalhes'],  $_SESSION['Id_empresa']);
                    $InsertVaga = $v->inserirDados($dados);
                    if(!count($InsertVaga)>0)
                        $this->data['error'] = 'Não foi possível inserir seus dados no momento...';
                    else
                        $this->data['error'] = 'Registro Inserido com Sucesso...';
                    $this->redirect('empresa/vaga');
                }

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