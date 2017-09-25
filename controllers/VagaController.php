<?php
    class VagaController extends Controller{
        public function process($params){
            $this->head['title'] = 'Vagas';
            $this->head['desc'] = '';
            
            if(isset($_POST['Salvar'])){
                $this->view = 'empresa/dashboard';
            }else{
                $this->view = 'empresa/vaga';
            }        
            
            if(isset($_POST['cancelarVaga'])){
                echo $_POST['cancelarVaga'];
            }else{
                //$this->view = 'empresa/vaga';
            }        
            
            if(!empty($params[2])){ 
                //faz sql
                //se sql = 0, $this->redirect("empresa/vaga");
                //senao
                if($params[0] == 'cliente'){
                    $v = new Vaga();
                    $vaga = $v->detalhesVaga($params[2]);
                    //$historicovagas = $v->buscaHistoricoVagas($_SESSION['Id_candidato']);
                    $this->data['id'] = $params[2];
                    $this->data['vaga'] = $vaga;
                    //$this->data['historicovagas'] = $historicovagas;
                    
                    $this->view='cliente/templateVagas';
                }else if($params[0] == 'empresa'){
                    $v = new Vaga();
                    $vaga = $v->detalhesVaga($params[2]);
                    $this->data['id'] = $params[2];
                    $this->data['vaga'] = $vaga;
                    $this->view='empresa/templateVagas';
                }
                
                if(isset($_POST['candidatar'])){
                    $v = new Vaga();
                    $dados = array($_SESSION['Id_candidato'], $params[2]);
                    $vaga = $v->candidatarVaga($dados);
                    //$this->view='cliente/vaga';
                }
                
                
                
                    
            }else{
                if($params[0] == 'cliente'){
                    $v = new Vaga();
                    $vagas = $v->buscaDadosCandidato();

                    $this->data['vagas'] = $vagas;
                    $this->view='cliente/vaga';
                    
                    if(isset($_POST['detalhesTemp'])){
                        $detalhe = $_POST['detalhesTemp'];
                        $this->redirect("cliente/vaga/$detalhe");
                    }
                }else if($params[0] == 'empresa'){
                
                    $v = new Vaga();
                    $vagas = $v->buscaDados($_SESSION['Id_empresa']);
                    //$vagasjacandidatos = $v->buscaCandidatosVaga($id_vaga);
                    $this->data['vagas'] = $vagas;
                    if(isset($_POST['detalhesTemp'])){
                        $detalhe = $_POST['detalhesTemp'];
                        $this->redirect("empresa/vaga/$detalhe");
                    }
                
                if(isset($_POST['botao'])){
                    if($_POST['botao'] == 'Adicionar'){
                        if(isset($_POST['areaInteresse']) && isset($_POST['cargo']) && isset($_POST['descricao']) && isset($_POST['qtdeVagas'])){
                            date_default_timezone_set('America/Sao_Paulo');
                            $data = date('Y-m-d');
                            $dados = array($_POST['areaInteresse'], $_POST['cargo'], $_POST['descricao'], $_POST['qtdeVagas'], $_POST['horarioTrabalho'], $_POST['tipoContrato'],$_POST['salario'],$_POST['detalhes'], $data, 'A', $_SESSION['Id_empresa']);
                            $v->inserirDados($dados);
                            $this->redirect('empresa/vaga');
                        }
                    }else if($_POST['botao'] == 'Deletar'){
                        if(isset($_POST['id_vaga'])){
                            //$v->removerDados($_POST['id_vaga']);
                            echo $_POST['id_vaga'];
                            //$this->redirect('empresa/vaga');
                        }    
                    }else if($_POST['botao'] == 'Editar'){
                            //$dados = array($_POST['areaInteresse'], $_POST['cargo'], $_POST['descricao'], $_POST['qtdeVagas'], $_POST['horarioTrabalho'], $_POST['tipoContrato'], $_POST['salario'], $_POST['detalhes'], $_SESSION['Id_empresa'], $_POST['id_vaga']);
                            $dados = array($_POST['areaInteresse'], $_POST['cargo'], $_POST['descricao'], $_POST['qtdeVagas'], $_POST['horarioTrabalho'], $_POST['tipoContrato'], $_POST['salario'], $_POST['detalhes']);
                            //$result = $v->atualizarDados($dados, $_POST['id_vaga']);
                            echo 'Teste'.$_POST['id_vaga'];
                            /*if($result>0){
                                $this->redirect ('empresa/vaga');
                            }else{
                                $this->data['error'] = "erro";
                            }*/
                        //}
                    }
                }
                    //$this->view='empresa/vaga';
                }else{
                    $v = new Vaga();
                    $vagas = $v->buscaDados();

                    $this->data['vagas'] = $vagas;
                    $this->view='analista/vaga';
                }
                }
            
        }
    }
?>