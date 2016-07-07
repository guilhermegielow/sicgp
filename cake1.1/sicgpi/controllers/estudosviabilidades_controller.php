<?php
class EstudosviabilidadesController extends AppController {

	var $name = 'Estudosviabilidades';
	var $helpers = array('Html', 'Form' , 'Ajax', 'Javascript');

	function index() {
	    $this->checkAcess();
	    $this->pageTitle = 'Estudo de viabilidade';
        $usuario = $_SESSION['Usuario'];
		$this->Estudosviabilidade->recursive = 0;
		$this->set('estudosviabilidades', $this->Estudosviabilidade->findAll("Estudosviabilidade.user_created = '$usuario'", '',
        'Estudosviabilidade.id desc'));
	}

	function view($id = null) {
		$this->checkAcess();
		$this->pageTitle = 'Estudo de viabilidade';
        if(!$id) {
			$this->Session->setFlash('ID inválido para Estudosviabilidade.');
			$this->redirect('/estudosviabilidades/index');
		}
		$this->set('estudosviabilidade', $this->Estudosviabilidade->read(null, $id));
	}

	function add() {
	  $this->checkAcess();
	  $this->pageTitle = 'Estudo de viabilidade';
      $usuario = $_SESSION['Usuario'];
		if(empty($this->data)) {
			$this->set('atividades', $this->Estudosviabilidade->Atividade->generateList("Atividade.user_created = '$usuario'",'ds_atividade', null, '{n}.Atividade.id', '{n}.Atividade.ds_atividade'));
			$this->set('selectedAtividades', null);
			$this->set('usuarios', $this->Estudosviabilidade->Usuario->generateList(null,'nm_usuario', null, '{n}.Usuario.id', '{n}.Usuario.nm_usuario'));
			$this->set('selectedUsuarios', null);
			$this->set('tiposservicos', $this->Estudosviabilidade->Tiposservico->generateList(null,'ds_tipo_servico', null, '{n}.Tiposservico.id', '{n}.Tiposservico.ds_tipo_servico'));
			$this->set('projetos', $this->Estudosviabilidade->Projeto->generateList("Projeto.user_created = '$usuario'",'id desc', null, '{n}.Projeto.id', '{n}.Projeto.ds_titulo'));
			$this->render();
		} else {
			$this->cleanUpFields();
			$this->data['Estudosviabilidade']['user_aprovacao'] = '';
			if($this->Estudosviabilidade->save($this->data)) {
				$this->Session->setFlash('Estudo de viabilidade inserido com sucesso.');
				$this->redirect('/estudosviabilidades/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
				$this->set('atividades', $this->Estudosviabilidade->Atividade->generateList("Atividade.user_created = '$usuario'",'ds_atividade', null, '{n}.Atividade.id', '{n}.Atividade.ds_atividade'));
				if(empty($this->data['Atividade']['Atividade'])) { $this->data['Atividade']['Atividade'] = null; }
				$this->set('selectedAtividades', $this->data['Atividade']['Atividade']);
				$this->set('usuarios', $this->Estudosviabilidade->Usuario->generateList(null,'nm_usuario', null, '{n}.Usuario.id', '{n}.Usuario.nm_usuario'));
				if(empty($this->data['Usuario']['Usuario'])) { $this->data['Usuario']['Usuario'] = null; }
				$this->set('selectedUsuarios', $this->data['Usuario']['Usuario']);
				$this->set('tiposservicos', $this->Estudosviabilidade->Tiposservico->generateList(null,'ds_tipo_servico', null, '{n}.Tiposservico.id', '{n}.Tiposservico.ds_tipo_servico'));
				$this->set('projetos', $this->Estudosviabilidade->Projeto->generateList("Projeto.user_created = '$usuario'",'ds_titulo', null, '{n}.Projeto.id', '{n}.Projeto.ds_titulo'));
			}
		}
	}

	function edit($id = null) {
		$this->checkAcess();
        $usuario = $_SESSION['Usuario'];
        $this->pageTitle = 'Estudo de viabilidade';
		if(empty($this->data)) {
			if(!$id) {
				$this->Session->setFlash('Id inválido para Estudosviabilidade');
				$this->redirect('/estudosviabilidades/index');
			}
			$this->data = $this->Estudosviabilidade->read(null, $id);
			$this->set('atividades', $this->Estudosviabilidade->Atividade->generateList("Atividade.user_created = '$usuario'",'ds_atividade', null, '{n}.Atividade.id', '{n}.Atividade.ds_atividade'));
			if(empty($this->data['Atividade'])) { $this->data['Atividade'] = null; }
			$this->set('selectedAtividades', $this->_selectedArray($this->data['Atividade']));
			$this->set('usuarios', $this->Estudosviabilidade->Usuario->generateList(null,'nm_usuario', null, '{n}.Usuario.id', '{n}.Usuario.nm_usuario'));
			if(empty($this->data['Usuario'])) { $this->data['Usuario'] = null; }
			$this->set('selectedUsuarios', $this->_selectedArray($this->data['Usuario']));
			$this->set('tiposservicos', $this->Estudosviabilidade->Tiposservico->generateList(null,'ds_tipo_servico', null, '{n}.Tiposservico.id', '{n}.Tiposservico.ds_tipo_servico'));
			$this->set('projetos', $this->Estudosviabilidade->Projeto->generateList("Projeto.user_created = '$usuario'",'ds_titulo', null, '{n}.Projeto.id', '{n}.Projeto.ds_titulo'));
		} else {
			$this->cleanUpFields();
			if($this->Estudosviabilidade->save($this->data)) {
				$this->Session->setFlash('Estudo de viabilidade editado com sucesso.');
				$this->redirect('/estudosviabilidades/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
				$this->set('atividades', $this->Estudosviabilidade->Atividade->generateList("Atividade.user_created = '$usuario'",'ds_atividade', null, '{n}.Atividade.id', '{n}.Atividade.ds_atividade'));
				if(empty($this->data['Atividade']['Atividade'])) { $this->data['Atividade']['Atividade'] = null; }
				$this->set('selectedAtividades', $this->data['Atividade']['Atividade']);
				$this->set('usuarios', $this->Estudosviabilidade->Usuario->generateList(null,'nm_usuario', null, '{n}.Usuario.id', '{n}.Usuario.nm_usuario'));
				if(empty($this->data['Usuario']['Usuario'])) { $this->data['Usuario']['Usuario'] = null; }
				$this->set('selectedUsuarios', $this->data['Usuario']['Usuario']);
				$this->set('tiposservicos', $this->Estudosviabilidade->Tiposservico->generateList(null,'ds_tipo_servico', null, '{n}.Tiposservico.id', '{n}.Tiposservico.ds_tipo_servico'));
				$this->set('projetos', $this->Estudosviabilidade->Projeto->generateList("Projeto.user_created = '$usuario'",'ds_titulo', null, '{n}.Projeto.id', '{n}.Projeto.ds_titulo'));
			}
		}
	}
  function delete($id = null) {
		$this->checkAcess();
        if(!$id) {
			$this->Session->setFlash('ID inválido para Estudosviabilidade');
			$this->redirect('/estudosviabilidades/index');
		}
		if($this->Estudosviabilidade->del($id)) {
			$this->Session->setFlash('Estudo de viabilidade Excluído: id '.$id.'');
			$this->redirect('/estudosviabilidades/index');
		}
	}
  function enviarcontabilidade($id) {
        $this->checkAcess();
		$this->set('estudosviabilidade', $this->Estudosviabilidade->read(null, $id));
        $someone = $this->Estudosviabilidade->Usuario->findByDs_usuario($_SESSION['Usuario']);
        $projeto = $this->Estudosviabilidade->findById($id);
        //grava como enviado para contabilidade
        $dados = array("Estudosviabilidade"=>
        array(
              "id"=>$id,
              "log_envio_contabilidade"=>1
              )
              );
        $this->Estudosviabilidade->set($dados);
        $this->Estudosviabilidade->save();
        //gravar historico do envio para contabilidade
        $this->Estudosviabilidade->salvaHistorico(0,$projeto['Estudosviabilidade']['projeto_id'],
        $someone['Usuario']['id']);
        //gerar mensagem para analista contabil
        $this->Estudosviabilidade->enviaMensagem(1,$projeto['Estudosviabilidade']['projeto_id'],
        $someone['Usuario']['id']);
        $this->Session->setFlash('Estudo de Viabilidade Enviado para Contabilidade com sucesso');
        $this->redirect('/estudosviabilidades/index');
    }
  function classificarcontabil($id) {
    $this->pageTitle = 'Classificar Estudo de viabilidade';
    $usuario = $_SESSION['Usuario'];
    if(empty($this->data)) {
			if(!$id) {
				$this->Session->setFlash('Id inválido para Estudosviabilidade');
				$this->redirect('/estudosviabilidades/index');
			}
			$this->data = $this->Estudosviabilidade->read(null, $id);
			$this->set('contascustos', $this->Estudosviabilidade->Contascusto->generateList(null,'ds_contacusto', null, '{n}.Contascusto.id', '{n}.Contascusto.ds_contacusto'));
			if(empty($this->data['Contascusto'])) { $this->data['Contascusto'] = null; }
			$this->set('selectedContas', $this->_selectedArray($this->data['Contascusto']));
			$this->set('projetos', $this->Estudosviabilidade->Projeto->generateList('','id desc', null, '{n}.Projeto.id', '{n}.Projeto.ds_titulo'));
		} else {
			$this->cleanUpFields();
			if($this->Estudosviabilidade->save($this->data)) {
                $projeto = $this->Estudosviabilidade->findById($id);
                $someone = $this->Estudosviabilidade->Usuario->findByDs_usuario($_SESSION['Usuario']);
                //grava como classificado contabilmente
                $dados = array("Estudosviabilidade"=>
                array(
                "id"=>$id,
                "log_classificado"=>1
                )
                );
                $this->Estudosviabilidade->set($dados);
                $this->Estudosviabilidade->save();
                //gravar historico da classificacao de estudo de viabilidade
			    $this->Estudosviabilidade->salvaHistorico(1,$this->data['Estudosviabilidade']['projeto_id'],$someone['Usuario']['id']);
			    //gerar mensagem para gerente de projetos
                $this->Estudosviabilidade->enviaMensagem(2,$projeto['Estudosviabilidade']['projeto_id'],$someone['Usuario']['id']);
                $this->Session->setFlash('Estudo de Viabilidade Classificado com sucesso');
                $this->redirect($_SESSION['Mapa']);
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
				$this->set('contascustos', $this->Estudosviabilidade->Contascusto->generateList(null,'vl_conta', null, '{n}.Contascusto.id', '{n}.Contascusto.vl_conta'));
				if(empty($this->data['Contascusto']['Contascusto'])) { $this->data['Contascusto']['Contascusto'] = null; }
				$this->set('selectedContas', $this->data['Contascusto']['Contascusto']);
				$this->set('projetos', $this->Estudosviabilidade->Projeto->generateList('','id desc', null, '{n}.Projeto.id', '{n}.Projeto.ds_titulo'));
			}
		}
	}
  function enviarpatrocinador($id) {
             $this->checkAcess();
             $this->data = $this->Estudosviabilidade->read(null, $id);
             $someone = $this->Estudosviabilidade->Usuario->findByDs_usuario($_SESSION['Usuario']);
             $projeto = $this->Estudosviabilidade->findById($id);
             //grava como enviado para patrocinador
             $dados = array("Estudosviabilidade"=>
             array(
              "id"=>$id,
              "log_envio_patrocinador"=>1
              )
              );
              $this->Estudosviabilidade->set($dados);
              $this->Estudosviabilidade->save();
             //gravar historico da envio para patrocinador
             $this->Estudosviabilidade->salvaHistorico(2,$this->data['Estudosviabilidade']['projeto_id'],$someone['Usuario']['id']);
             //gerar mensagem para patrocinador
              $this->Estudosviabilidade->enviaMensagem(3,$projeto['Estudosviabilidade']['projeto_id'],$someone['Usuario']['id']);
             $this->Session->setFlash('Estudo de Viabilidade Enviado para Patrocinador com sucesso');
             $this->redirect('/estudosviabilidades/index');
    }
     // nao aceitar classificacao da contabilidade
     function naceitarclassificacao($id) {
             $this->checkAcess();
             $this->data = $this->Estudosviabilidade->read(null, $id);
             $someone = $this->Estudosviabilidade->Usuario->findByDs_usuario($_SESSION['Usuario']);
             $projeto = $this->Estudosviabilidade->findById($id);
             //grava como nao classificado na contabilidade
             $dados = array("Estudosviabilidade"=>
             array(
              "id"=>$id,
              "log_classificado"=>0,
              "log_envio_contabilidade"=>0
              )
              );
              $this->Estudosviabilidade->set($dados);
              $this->Estudosviabilidade->save();
             //gravar historico da cancelamento da classificacao do estudo
             $this->Estudosviabilidade->salvaHistorico(4,$this->data['Estudosviabilidade']['projeto_id'],$someone['Usuario']['id']);
             //gerar mensagem para contabilidade
              $this->Estudosviabilidade->enviaMensagem(5,$projeto['Estudosviabilidade']['projeto_id'],$someone['Usuario']['id']);
             $this->Session->setFlash('Cancelada a classificação contábil do Estudo de Viabilidade');
             $this->redirect('/estudosviabilidades/index');
    }
  function aprovacao($id = null) {
        if(!$id) {
			$this->Session->setFlash('ID inválido para Estudosviabilidade.');
			$this->redirect('/estudosviabilidades/index');
		}
		$this->set('estudosviabilidade', $this->Estudosviabilidade->read(null, $id));
	}
  function aprovarestudo($id){
        $data = date('y-m-d');
        $this->set('estudosviabilidade', $this->Estudosviabilidade->read(null, $id));
        $someone = $this->Estudosviabilidade->Usuario->findByDs_usuario($_SESSION['Usuario']);
        $projeto = $this->Estudosviabilidade->findById($id);
        //grava como aprovado o estudo de viabilidade
        $dados = array("Estudosviabilidade"=>
           array(
              "id"=>$id,
              "dt_aprovacao"=>$data,
              "user_aprovacao"=>$_SESSION['Usuario']
              )
              );
              $this->Estudosviabilidade->set($dados);
              $this->Estudosviabilidade->save();
        //grava historico de aprovacao de estudo de viabilidade
      	$this->Estudosviabilidade->salvaHistorico(3,$projeto['Estudosviabilidade']['projeto_id'],$someone['Usuario']['id']);
      	//gerar mensagem para gerente de projetos
      	$this->Estudosviabilidade->enviaMensagem(4,$projeto['Estudosviabilidade']['projeto_id'],$someone['Usuario']['id']);
      	$this->Session->setFlash('Estudo de Viabilidade Aprovado com sucesso');
        $this->redirect($_SESSION['Mapa']);
	}
	  function reprovarestudo($id){
        $data = date('y-m-d');
        $this->set('estudosviabilidade', $this->Estudosviabilidade->read(null, $id));
        $someone = $this->Estudosviabilidade->Usuario->findByDs_usuario($_SESSION['Usuario']);
        $projeto = $this->Estudosviabilidade->findById($id);
        //grava como reprovado o estudo de viabilidade
        $dados = array("Estudosviabilidade"=>
           array(
              "id"=>$id,
              "log_envio_patrocinador"=>0
              )
              );
              $this->Estudosviabilidade->set($dados);
              $this->Estudosviabilidade->save();
        //grava historico de reprovacao de estudo de viabilidade
      	$this->Estudosviabilidade->salvaHistorico(5,$projeto['Estudosviabilidade']['projeto_id'],$someone['Usuario']['id']);
      	//gerar mensagem para gerente de projetos
      	$this->Estudosviabilidade->enviaMensagem(6,$projeto['Estudosviabilidade']['projeto_id'],$someone['Usuario']['id']);
      	$this->Session->setFlash('Estudo de Viabilidade Reprovado com sucesso');
        $this->redirect($_SESSION['Mapa']);
	}
}
?>
