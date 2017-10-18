<?php
    class DashboardController extends Controller{
        public function process($params){
            $this->head['title'] = 'Dash';
            $this->head['desc'] = '';
            if($_SESSION['level'] == 1){
                $this->view = 'cliente/dashboard';
            }else{
                
                $v = new Vaga();
                $vagasAbertas = $v->buscaVagasAbertas($_SESSION['Id_empresa']);
                $this->data['vagasAbertas'] = $vagasAbertas;
                
                $p = new ProcessoSeletivo();
                $processosSeletivosAbertos = $p->buscaProcessoSeletivosPendentes(array('A', $_SESSION['Id_empresa']));
                $this->data['processosSeletivosAbertos'] = $processosSeletivosAbertos;
                
                $this->view = 'empresa/dashboard';
            }
            
            if(isset($_POST['+vagas'])){
                $this->redirect = 'empresa/conta';
            }else if(isset($_POST['+processosseletivos'])){
                $this->redirect = 'empresa/processo-seletivo';
            }
                
        }
    }
?>