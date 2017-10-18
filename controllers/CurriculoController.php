<?php
    class CurriculoController extends Controller{
        
        public function process($params){
          
            $candidatoDadoProfissional = new CandidatoDadoProfissional();
            $dadoprofissional = $candidatoDadoProfissional->buscarDados($_SESSION['Id_candidato']);
            
            
            if(isset($_POST['resumoprofissional']) && isset($_POST['objetivoprofissional'])){
                $this->data['teste'] = $_POST['resumoprofissional'].$_POST['objetivoprofissional'];
                $dados = array($_SESSION['Id_candidato'],$_POST['resumoprofissional'], $_POST['objetivoprofissional']);
                    $InsertDadoProfissional = $candidatoDadoProfissional->inserirDados($dados);
                    if(!count($InsertDadoProfissional)>0)
                        $this->data['error'] = 'Não foi possível inserir seus dados no momento...';
                    else
                        $this->data['error'] = 'Registro Inserido com Sucesso...';
                    //$this->redirect('cliente/curriculo');
            }
            $candidatoDadoPessoal = new CandidatoDadoPessoal();
            $dadoPessoal = $candidatoDadoPessoal->buscarDados($_SESSION['Id_user']);
            
           
            $candidatoAreaInteresse = new CandidatoAreaInteresse();
            $areaInteresseCandidato = $candidatoAreaInteresse->buscarDados($_SESSION['Id_candidato']);
            $areaInteresse = $candidatoAreaInteresse->buscarAreasInteresse();
            
            $candidatoRedeSocial = new CandidatoRedeSocial();
            $redeSocial = $candidatoRedeSocial->buscarDados($_SESSION['Id_candidato']);
            
            $candidatoDadoComplementar = new CandidatoDadoComplementar();
            $dadocomplementar = $candidatoDadoComplementar->buscarDados($_SESSION['Id_candidato']);
            
            $candidatoFormacao = new CandidatoFormacao();
            $formacao = $candidatoFormacao->buscarDados($_SESSION['Id_candidato']);
            
            $candidatoIdioma = new CandidatoIdioma();
            $idioma = $candidatoIdioma->buscaDados($_SESSION['Id_candidato']);
            
            $candidatoConhecimento = new CandidatoConhecimento();
            $conhecimento = $candidatoConhecimento->buscaDados($_SESSION['Id_candidato']);
            
            $candidatoExperiencia = new CandidatoExperiencia();
            $experiencia = $candidatoExperiencia->buscaDados($_SESSION['Id_candidato']);
            
            $this->data['error'] = '';
            
            if(isset($_POST['nome']) && isset($_POST['cpf'])&& isset($_POST['rg'])&& isset($_POST['orgao_emissor'])&& isset($_POST['data_expedicao'])&& isset($_POST['sexo'])&& isset($_POST['data_nascimento'])&& isset($_POST['estado_civil'])&& isset($_POST['email'])&& isset($_POST['nome_pai'])&& isset($_POST['nome_mae'])&& isset($_POST['endereco'])&& isset($_POST['bairro'])&& isset($_POST['regiao'])&& isset($_POST['cidade'])&& isset($_POST['cep'])&& isset($_POST['estado'])&& isset($_POST['telefone'])&& isset($_POST['celular'])){
                $dados = array($_POST['nome'], $_POST['cpf'], $_POST['rg'], $_POST['orgao_emissor'], $_POST['data_expedicao'], $_POST['sexo'], $_POST['data_nascimento'], $_POST['estado_civil'], $_POST['email'], $_POST['nome_pai'], $_POST['nome_mae'], $_POST['endereco'], $_POST['bairro'], $_POST['regiao'], $_POST['cidade'], $_POST['cep'], $_POST['estado'], $_POST['telefone'], $_POST['celular'], $_SESSION['Id_user']);
                $InsertDadoPessoal = $candidatoDadoPessoal->atualizarDados($dados);
                if(!count($InsertDadoPessoal)>0)
                    $this->data['error'] = 'Não foi possível atualizar seus dados no momento...';
                else
                    $this->data['error'] = 'Atualizado com Sucesso...';
                $this->redirect('cliente/curriculo');
            }
            
//            if(isset($_POST['resumoprofissional']) && isset($_POST['objetivoprofissional'])){
//                if(count($candidatoDadoProfissional->buscarDados($_SESSION['Id_candidato']))>0){
//                    $dados = array($_POST['resumoprofissional'], $_POST['objetivoprofissional'],$_SESSION['Id_candidato']);
//                    $InsertDadoProfissional = $candidatoDadoProfissional->atualizarDados($dados);
//                    if(!count($InsertDadoProfissional)>0)
//                        $this->data['error'] = 'Não foi possível inserir seus dados no momento...';
//                    else
//                        $this->data['error'] = 'Registro Inserido com Sucesso...';
//                    $this->redirect('cliente/curriculo');
//                }else{
//                    $dados = array($_SESSION['Id_candidato'],$_POST['resumoprofissional'], $_POST['objetivoprofissional']);
//                    $InsertDadoProfissional = $candidatoDadoProfissional->inserirDados($dados);
//                    if(!count($InsertDadoProfissional)>0)
//                        $this->data['error'] = 'Não foi possível inserir seus dados no momento...';
//                    else
//                        $this->data['error'] = 'Registro Inserido com Sucesso...';
//                    $this->redirect('cliente/curriculo');
//                }
//                    
//            }
            
            if(isset($_POST['areaInteresse'])){
                $dados = array($_SESSION['Id_candidato'], $_POST['areaInteresse']);
                $InsertAreaInteresse = $candidatoAreaInteresse->inserirDados($dados);
                if(!count($InsertAreaInteresse)>0)
                    $this->data['error'] = 'Não foi possível inserir seus dados no momento...';
                else
                    $this->data['error'] = 'Registro Inserido com Sucesso...';
                $this->redirect('cliente/curriculo');
            }
            
            if(isset($_POST['redesocial']) && isset($_POST['link_redesocial'])){
                $dados = array($_SESSION['Id_candidato'], $_POST['redesocial'], $_POST['link_redesocial']);
                $InsertRedeSocial = $candidatoRedeSocial->inserirDados($dados);
                if(!count($InsertRedeSocial)>0)
                    $this->data['error'] = 'Não foi possível inserir seus dados no momento...';
                else
                    $this->data['error'] = 'Registro Inserido com Sucesso...';
                $this->redirect('cliente/curriculo');
            }
            
            if(isset($_POST['tphabilitacao']) && isset($_POST['numerocnh'])&& isset($_POST['carteiraTrabalho']) && isset($_POST['carteiraMilitar'])){
                if(count($candidatoDadoComplementar->buscarDados($_SESSION['Id_candidato']))>0){
                    $dados = array($_POST['tphabilitacao'], $_POST['numerocnh'], $_POST['carteiraTrabalho'], $_POST['carteiraMilitar'], $_SESSION['Id_candidato']);
                    $InsertDadoComplementar = $candidatoDadoComplementar->atualizarDados($dados);
                    if(!count($InsertDadoComplementar)>0)
                        $this->data['error'] = 'Não foi possível inserir seus dados no momento...';
                    else
                        $this->data['error'] = 'Registro Inserido com Sucesso...';
                    $this->redirect('cliente/curriculo');
                }else{
                    $dados = array($_SESSION['Id_candidato'], $_POST['tphabilitacao'], $_POST['numerocnh'], $_POST['carteiraTrabalho'], $_POST['carteiraMilitar']);
                    $InsertDadoComplementar = $candidatoDadoComplementar->inserirDados($dados);
                    if(!count($InsertDadoComplementar)>0)
                        $this->data['error'] = 'Não foi possível inserir seus dados no momento...';
                    else
                        $this->data['error'] = 'Registro Inserido com Sucesso...';
                    $this->redirect('cliente/curriculo');
                }
            }
            
            if(isset($_POST['curso']) && isset($_POST['instituicao'])&& isset($_POST['situacao']) && isset($_POST['dataInicio']) && isset($_POST['dataFim'])&& isset($_POST['previsaoTermino'])){
                    $dados = array($_SESSION['Id_candidato'], $_POST['curso'], $_POST['instituicao'], $_POST['situacao'], $_POST['dataInicio'], $_POST['dataFim'], $_POST['previsaoTermino']);
                    $InsertFormacao = $candidatoFormacao->inserirDados($dados);
                    if(!count($InsertFormacao)>0)
                        $this->data['error'] = 'Não foi possível inserir seus dados no momento...';
                    else
                        $this->data['error'] = 'Registro Inserido com Sucesso...';
                    $this->redirect('cliente/curriculo');
            }
                    
            
            if(isset($_POST['idioma']) && isset($_POST['nivel'])){
                $dados = array($_SESSION['Id_candidato'], $_POST['idioma'], $_POST['nivel']);
                $InsertIdioma = $candidatoIdioma->inserirDados($dados);
                if(!count($InsertIdioma)>0)
                    $this->data['error'] = 'Não foi possível inserir seus dados no momento...';
                else
                    $this->data['error'] = 'Registro Inserido com Sucesso...';
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
            
            /*if(isset($_POST['id'])){
                $dados = array($_POST['empresa'], $_POST['cargo'], $_POST['id']);
                $InsertExperiencia = $candidatoExperiencia->atualizarDados($dados);
                if(!count($InsertExperiencia)>0)
                    $this->data['error'] = 'Não foi possível inserir seus dados no momento...';
                else
                    $this->data['error'] = 'Registro Inserido com Sucesso...';
                $this->redirect('cliente/curriculo');
            }*/
            if(isset($_POST['empresa']) && isset($_POST['cargo'])){
                //if(isset($_POST['id'])){
                    $dados = array($_SESSION['Id_candidato'],$_POST['empresa'],$_POST['dataAdmissao'],$_POST['dataDemissao'],$_POST['cargo'],$_POST['atualEmprego'],$_POST['areaTrabalho'],$_POST['atividadesExercidas']);
                    $InsertExperiencia = $candidatoExperiencia->inserirDados($dados);
                    if(!count($InsertExperiencia)>0)
                        $this->data['error'] = 'Não foi possível inserir seus dados no momento...';
                    else
                        $this->data['error'] = 'Registro Inserido com Sucesso...';
                    $this->redirect('cliente/curriculo');
                //}else{
                    /*$dados = array($_SESSION['Id_candidato'],$_POST['empresa'], $_POST['cargo']);
                    $InsertExperiencia = $candidatoExperiencia->inserirDados($dados);
                    if(!count($InsertExperiencia)>0)
                        $this->data['error'] = 'Não foi possível inserir seus dados no momento...';
                    else
                        $this->data['error'] = 'Registro Inserido com Sucesso...';
                    $this->redirect('cliente/curriculo');*/
                //}
                
            }

            $this->head['title'] = 'Curriculos';
            $this->head['desc'] = '';
            $this->data['dadoPessoal'] = $dadoPessoal;
            $this->data['conhecimento'] = $conhecimento;
            $this->data['dadoComplementar'] = $dadocomplementar;
            $this->data['dadoProfissional'] = $dadoprofissional;
            $this->data['experiencia'] = $experiencia;
            $this->data['formacao'] = $formacao;
            $this->data['areaInteresseCandidato'] = $areaInteresseCandidato;
            $this->data['areaInteresse'] = $areaInteresse;
            $this->data['idioma'] = $idioma;
            $this->data['redeSocial'] = $redeSocial;
            
            $this->view = 'cliente/curriculo';
        }
    }
?>