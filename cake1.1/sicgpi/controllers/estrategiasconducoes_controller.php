<?php
class EstrategiasconducoesController extends AppController {

	var $name = 'Estrategiasconducoes';
	var $helpers = array('Html', 'Form' , 'Ajax', 'Javascript');

	function index() {
		$this->checkAcess();
    $this->Estrategiasconducao->recursive = 0;
		$this->set('estrategiasconducoes', $this->Estrategiasconducao->findAll('','','Estrategiasconducao.id desc'));
	}

	function view($id = null) {
		$this->checkAcess();
    if(!$id) {
			$this->Session->setFlash('ID inválido para Estrategiasconducao.');
			$this->redirect('/estrategiasconducoes/index');
		}
		$this->set('estrategiasconducao', $this->Estrategiasconducao->read(null, $id));
	}

	function add() {
		$this->checkAcess();
    if(empty($this->data)) {
			$this->set('declaracoesescopos', $this->Estrategiasconducao->Declaracoesescopo->generateList(null,'id desc', null, '{n}.Declaracoesescopo.id', '{n}.Declaracoesescopo.ds_declaracao_escopo'));
			$this->render();
		} else {
			$this->cleanUpFields();
			if($this->Estrategiasconducao->save($this->data)) {
				$this->Session->setFlash('Estratégia de condução inserida com sucesso.');
				$this->redirect('/estrategiasconducoes/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
				$this->set('declaracoesescopos', $this->Estrategiasconducao->Declaracoesescopo->generateList(null,'id desc', null, '{n}.Declaracoesescopo.id', '{n}.Declaracoesescopo.ds_declaracao_escopo'));
			}
		}
	}

	function edit($id = null) {
	  $this->checkAcess();
		if(empty($this->data)) {
			if(!$id) {
				$this->Session->setFlash('Id inválido para Estrategiasconducao');
				$this->redirect('/estrategiasconducoes/index');
			}
			$this->data = $this->Estrategiasconducao->read(null, $id);
			$this->set('declaracoesescopos', $this->Estrategiasconducao->Declaracoesescopo->generateList(null,'id desc', null, '{n}.Declaracoesescopo.id', '{n}.Declaracoesescopo.ds_declaracao_escopo'));
		} else {
			$this->cleanUpFields();
			if($this->Estrategiasconducao->save($this->data)) {
				$this->Session->setFlash('Estratégia de condução editada com sucesso.');
				$this->redirect('/estrategiasconducoes/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
				$this->set('declaracoesescopos', $this->Estrategiasconducao->Declaracoesescopo->generateList(null,'id desc', null, '{n}.Declaracoesescopo.id', '{n}.Declaracoesescopo.ds_declaracao_escopo'));
			}
		}
	}

	function delete($id = null) {
		$this->checkAcess();
    if(!$id) {
			$this->Session->setFlash('ID inválido para Estrategiasconducao');
			$this->redirect('/estrategiasconducoes/index');
		}
		if($this->Estrategiasconducao->del($id)) {
			$this->Session->setFlash('Estratégia de condução Excluída: id '.$id.'');
			$this->redirect('/estrategiasconducoes/index');
		}
	}

}
?>
