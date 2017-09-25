<?php
    class ProcessoSeletivoController extends Controller{
        
        public function process($params){
            
            $this->head['title'] = 'Processos Seletivos';
            $this->head['desc'] = '';
            
            if($_SESSION['level']==1){
                $p = new ProcessoSeletivo();
                $processosativos = $p->buscarProcessosSeletivosAtivos();
                $this->data['processosativos'] = $processosativos;
                $this->view = 'cliente/processoseletivo';
            }
            else if($_SESSION['level']==2){
            
            $p = new ProcessoSeletivo();
            $processos = $p->buscarDados($_SESSION['Id_empresa']);
                        
            $ec = new EmpresaCandidato();
            $candidatos = $ec->buscarDados();
            
            $v = new Vaga();
            $vagas = $v->buscaDados($_SESSION['Id_empresa']);
            
            $dados = array('A', $_SESSION['Id_empresa']);
            $vagaspendentes = $p->buscaVagasPendentes($dados);
            
            if(isset($_POST['candidato'])){
                $array = $_POST['candidato'];
                $p = new ProcessoSeletivo();
                
                foreach($array as $value){
                    $dados = array($_SESSION['idprocesso'],$value,0);
                    $p->vinculaCandidatosProcessoSeletivo($dados);
                }
            }
            
            if(isset($_POST['avancacandidato1'])){
                $id_processoseletivo = $_POST['id_processoseletivo'];
                $array = $_POST['avancacandidato1'];
                $p = new ProcessoSeletivo();
                foreach($array as $value){
                    $notaEtapa = 9;
                    $avaliacaoEtapa = 'Avaliação RH';
                    $dados = array(1, $notaEtapa, $avaliacaoEtapa, $value, $id_processoseletivo);
                    $p->avancarCandidatosEtapa01($dados);
                    //echo $value."<br>";
                }
            }else if(isset($_POST['avancacandidato2'])){
                $id_processoseletivo = $_POST['id_processoseletivo'];
                $array = $_POST['avancacandidato2'];
                $p = new ProcessoSeletivo();
                foreach($array as $value){
                    $notaEtapa = 7;
                    $avaliacaoEtapa = 'Avaliação Depto.';
                    $dados = array(2, $notaEtapa, $avaliacaoEtapa, $value, $id_processoseletivo);
                    $p->avancarCandidatosEtapa02($dados);
                }
            } else if(isset($_POST['avancacandidato3'])){
                $id_processoseletivo = $_POST['id_processoseletivo'];
                $array = $_POST['avancacandidato3'];
                $p = new ProcessoSeletivo();
                foreach($array as $value){
                    $notaEtapa = 8;
                    $avaliacaoEtapa = 'Avaliação Final';
                    $feedback = 'Feedback após término do processo seletivo';
                    
                    $dados = array(3, $notaEtapa, $avaliacaoEtapa, $feedback, $value, $id_processoseletivo);
                    $p->avancarCandidatosEtapa03($dados);
                    $dados = array(4, $value, $id_processoseletivo);
                    $p->avancarCandidatosEtapa03($dados);
                    $p->debitarVagasRestantes(array($id_processoseletivo));
                }
            }
            
            
            $p = new ProcessoSeletivo();
            //Botão: Vincular Candidatos, presente no FORM Processo Seletivo
            if(isset($_POST['filtro_processocandidato'])){
                $ps = new ProcessoSeletivo();
                $candidatosvaga = $ps->buscarCandidatosVagas($_POST['filtro_processocandidato']);
                $this->data['idprocesso'] = $_POST['filtro_processocandidato'];
                $_SESSION['idprocesso'] = $_POST['filtro_processocandidato'];
                $this->data['candidatosvaga'] = $candidatosvaga;
                $this->view = 'empresa/processoseletivocandidato';
                
            }else{
                // Validação para Filtro dos Candidatos por Processo Seletivo
                if(isset($_POST['filtro'])){
                    $ps = new ProcessoSeletivo();
                    $candidatosvaga = $ps->buscarCandidatosVagas($_POST['processoseletivo']);
                    $this->data['idprocesso'] =$_POST['processoseletivo'];
                    $_SESSION['idprocesso'] = $_POST['filtro_processocandidato'];
                    $this->data['candidatosvaga'] = $candidatosvaga;
                    $this->view = 'empresa/processoseletivocandidato';
                }else{
                    $this->view = 'empresa/processoseletivo';
                }
                
            } 
            
            if(isset($_POST['etapa01'])){
                
                $id_processoseletivo = $_POST['etapa01'];
                $dados = array($id_processoseletivo,0);
                $candidatosetapa = $p->buscarCandidatosProcessosSeletivos($dados);
                $this->data['candidatosetapa'] = $candidatosetapa;
                $this->data['id_processoseletivo'] = $id_processoseletivo;
                $this->view = 'empresa/processoseletivo_etapa01';
                
            }else if(isset($_POST['etapa02'])){
                
                $id_processoseletivo = $_POST['etapa02'];
                $dados = array($id_processoseletivo,1);
                $candidatosetapa = $p->buscarCandidatosProcessosSeletivos($dados);
                $this->data['candidatosetapa'] = $candidatosetapa;
                $this->data['id_processoseletivo'] = $id_processoseletivo;
                $this->view = 'empresa/processoseletivo_etapa02';
                
            }else if(isset($_POST['etapa03'])){
                
                $id_processoseletivo = $_POST['etapa03'];
                $dados = array($id_processoseletivo,2);
                $candidatosetapa = $p->buscarCandidatosProcessosSeletivos($dados);
                $this->data['candidatosetapa'] = $candidatosetapa;
                $this->data['id_processoseletivo'] = $id_processoseletivo;
                $this->view = 'empresa/processoseletivo_etapa03';
                
            } else if(isset($_POST['etapa04'])){
                
                $id_processoseletivo = $_POST['etapa04'];
                $dados = array($id_processoseletivo,3);
                $candidatosetapa = $p->buscarCandidatosProcessosSeletivos($dados);
                $this->data['candidatosetapa'] = $candidatosetapa;
                $this->data['id_processoseletivo'] = $id_processoseletivo;
                $this->view = 'empresa/processoseletivo_etapa04';
                
            }
            
//---------- COMANDO PARA INSERÇÃO DA VAGA NO BANCO DE DADOS----------------------------------------------
            if(isset($_POST['vaga']) && isset($_POST['status'])){
                $qtdevagas = $v->buscaQtdeVagas($_POST['vaga']);

                $dados = array($_POST['vaga'], $_POST['status'], $qtdevagas['qtdevagas'], $_SESSION['Id_empresa']);
                print_r($dados);
                
                $InsertProcessoSeletivo = $p->inserirDados($dados);
                if(!count($InsertProcessoSeletivo)>0)
                    $this->data['error'] = 'Não foi possível inserir seus dados no momento...';
                else
                    $this->data['error'] = 'Registro Inserido com Sucesso...';
                $this->redirect('empresa/processoseletivo');
            }
            
            $this->data['processosSeletivos'] = $processos;
            $this->data['vagas'] = $vagas;
            $this->data['vagaspendentes'] = $vagaspendentes;
            $this->data['candidatos'] = $candidatos;
            }
            
        }
    }
?>