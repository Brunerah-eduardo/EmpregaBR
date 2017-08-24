<?php
    class CurriculoController extends Controller{
        
        public function process($params){
            
            $candidatoDadoPessoal = new CandidatoDadoPessoal();
            $dadoPessoal = $candidatoDadoPessoal->buscaDados($_SESSION['Id_user']);
            
            $candidatoConhecimento = new CandidatoConhecimento();
            $conhecimento = $candidatoConhecimento->buscaDados($_SESSION['Id_user']);
                    
            $candidatoDadoComplementar = new CandidatoDadoComplementar();
            $dadocomplementar = $candidatoDadoComplementar->buscaDados($_SESSION['Id_user']);
            
            $candidatoDadoProfissional = new CandidatoDadoProfissional();
            $dadoprofissional = $candidatoDadoProfissional->buscaDados($_SESSION['Id_user']);
            
            $candidatoExperiencia = new CandidatoExperiencia();
            $experiencia = $candidatoExperiencia->buscaDados($_SESSION['Id_user']);
            
            $this->data['error'] = '';
            
            if(isset($_POST['nome']) && isset($_POST['cpf'])&& isset($_POST['email'])){
                $dados = array($_POST['nome'],$_POST['cpf'],$_POST['email'], $_SESSION['Id_user']);
                $InsertDadoPessoal = $candidatoDadoPessoal->adicionarDados($dados);
                if(!count($InsertDadoPessoal)>0)
                    $this->data['error'] = 'Não foi possível atualizar seus dados no momento...';
                else
                    $this->data['error'] = 'Atualizado com Sucesso...';
                $this->redirect('cliente/curriculo');
            }
            
            if(isset($_POST['conhecimento'])){
                $dados = array($_SESSION['Id_candidato'], $_POST['conhecimento']);
                $InsertConhecimento = $candidatoConhecimento->inserirDados($dados);
                if(!count($InsertConhecimento)>0)
                    $this->data['error'] = 'Não foi possível inserir seus dados no momento...';
                else
                    $this->data['error'] = 'Registro Inserido com Sucesso...';
                $this->redirect('cliente/curriculo');
            }
            
            if(isset($_POST['tphabilitacao']) && isset($_POST['numerocnh'])&& isset($_POST['carteiraTrabalho']) && isset($_POST['carteiraMilitar'])){
                $dados = array($_SESSION['Id_candidato'], $_POST['tphabilitacao'], $_POST['numerocnh'], $_POST['carteiraTrabalho'], $_POST['carteiraMilitar']);
                $InsertDadoComplementar = $candidatoDadoComplementar->inserirDados($dados);
                if(!count($InsertDadoComplementar)>0)
                    $this->data['error'] = 'Não foi possível inserir seus dados no momento...';
                else
                    $this->data['error'] = 'Registro Inserido com Sucesso...';
                $this->redirect('cliente/curriculo');
            }
            
            if(isset($_POST['resumoprofissional']) && isset($_POST['objetivoprofissional'])){
                $dados = array($_POST['resumoprofissional'], $_POST['objetivoprofissional'], $_SESSION['Id_candidato']);
                $InsertDadoProfissional = $candidatoDadoProfissional->adicionarDados($dados);
                if(!count($InsertDadoProfissional)>0)
                    $this->data['error'] = 'Não foi possível inserir seus dados no momento...';
                else
                    $this->data['error'] = 'Registro Inserido com Sucesso...';
                $this->redirect('cliente/curriculo');
            }
            
            if(isset($_POST['empresa']) && isset($_POST['cargo'])){
                $dados = array($_SESSION['Id_candidato'], $_POST['empresa'], $_POST['cargo']);
                $InsertExperiencia = $candidatoExperiencia->inserirDados($dados);
                if(!count($InsertExperiencia)>0)
                    $this->data['error'] = 'Não foi possível inserir seus dados no momento...';
                else
                    $this->data['error'] = 'Registro Inserido com Sucesso...';
                $this->redirect('cliente/curriculo');
            }
            
            /*$areainteresse = new AreaInteresse();
            $result = $areainteresse->buscaDados($_SESSION['Id_user']);*/

            $this->head['title'] = 'Curriculos';
            $this->head['desc'] = '';
            $this->data['dadoPessoal'] = $dadoPessoal;
            $this->data['conhecimento'] = $conhecimento;
            $this->data['dadoComplementar'] = $dadocomplementar;
            $this->data['dadoProfissional'] = $dadoprofissional;
            $this->data['experiencia'] = $experiencia;
            
            $this->view = 'cliente/curriculo';
        }
    }
?>