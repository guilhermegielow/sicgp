<?php
class MapasController extends AppController {

	var $name = 'Mapas';
	var $helpers = array('Html', 'Form' );
	var $uses = array('Usuario','Elementoseap', 'Estudosviabilidade', 'Passosworkflow', 'Processosaquisicao', 'Controlesmudanca', 'Termosaceitesprojeto');
    function analista(){
        $this->checkAcess();
        $usuario = $_SESSION['Usuario'];
		$this->Elementoseap->recursive = 0;
		$this->set('elementoseaps', $this->Elementoseap->findAll("Elementoseap.user_responsavel = '$usuario' and Elementoseap.vl_perc_concluido < 100"));

    }
    function adm()
    {
    }
    function gerente()
    {
    }
    function contabil()
    {
        $usuario = $_SESSION['Usuario'];
		$this->Estudosviabilidade->recursive = 0;
		$this->set('estudosviabilidades', $this->Estudosviabilidade->findAll("Estudosviabilidade.log_envio_contabilidade = 1 and
        Estudosviabilidade.log_classificado < 1"));
	}
	function patrocinador()
    {
        $usuario = $_SESSION['Usuario'];
		$this->Estudosviabilidade->recursive = 0;
		$this->set('estudosviabilidades', $this->Estudosviabilidade->findAll("Estudosviabilidade.log_envio_patrocinador = 1 and
        Estudosviabilidade.user_aprovacao = ''"));
        
		$this->Processosaquisicao->recursive = 0;
		$this->set('processosaquisicoes', $this->Processosaquisicao->findAll("Processosaquisicao.log_envio_patrocinador = 1 and
        Processosaquisicao.user_aprovacao = ''"));
        
        $this->Controlesmudanca->recursive = 0;
		$this->set('controlesmudancas', $this->Controlesmudanca->findAll("Controlesmudanca.log_envio_patrocinador = 1 and
        Controlesmudanca.user_aprovacao = ''"));
        
		$this->Termosaceitesprojeto->recursive = 0;
		$this->set('termosaceitesprojetos', $this->Termosaceitesprojeto->findAll("Termosaceitesprojeto.log_envio_patrocinador = 1 and
        Termosaceitesprojeto.user_aceite = ''"));
    }
}
