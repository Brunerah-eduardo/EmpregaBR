<?php
    class ContaController extends Controller{
        
        public function process($params){

            if(isset($_FILES['foto'])){
                echo "Upload de Arquivo realizado com sucesso!";
            }
            
            if(isset($_POST['password'])){
                $c = new Conta();
                
                $dados = array($_POST['password'], $_SESSION['Id_user']);
                $c->alterarSenha($dados);
            }
            
            if($params[0] == 'cliente'){

                $c = new Conta();
                $dadosconta = $c->buscaDadosCandidato($_SESSION['Id_candidato']);
                $this->data['dadosconta'] = $dadosconta;
                $this->view='cliente/conta';
                
            }else if($params[0] == 'empresa'){
                
                $c = new Conta();
                $dadosconta = $c->buscaDadosEmpresa($_SESSION['Id_empresa']);
                $this->data['dadosconta'] = $dadosconta;
                $this->view='empresa/dadosempresa';
                
            }
            
            
            $this->head['title'] = 'Opções da Conta';
            $this->head['desc'] = '';
            //$this->view = 'empresa/conta';
        }
    }
?>