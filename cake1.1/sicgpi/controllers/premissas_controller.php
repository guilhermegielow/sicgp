<?php
class PremissasController extends AppController {

	var $name = 'Premissas';
	var $helpers = array('Html', 'Form' , 'Ajax', 'Javascript');

	function index() {
		$this->checkAcess();
    $this->Premissa->recursive = 0;
		$this->set('premissas', $this->Premissa->findAll('','','Premissa.id desc'));
	}

	function view($id = null) {
		$this->checkAcess();
    if(!$id) {
			$this->Session->setFlash('ID inválido para Premissa.');
			$this->redirect('/premissas/index');
		}
		$this->set('premissa', $this->Premissa->read(null, $id));
	}

	function add() {
		$this->checkAcess();
    if(empty($this->data)) {
			$this->set('declaracoesescopos', $this->Premissa->Declaracoesescopo->generateList(null,'id desc', null, '{n}.Declaracoesescopo.id', '{n}.Declaracoesescopo.ds_declaracao_escopo'));
			$this->render();
		} else {
			$this->cleanUpFields();
			if($this->Premissa->save($this->data)) {
				$this->Session->setFlash('Premissa inserida com sucesso.');
				$this->redirect('/premissas/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
				$this->set('declaracoesescopos', $this->Premissa->Declaracoesescopo->generateList(null,'id desc', null, '{n}.Declaracoesescopo.id', '{n}.Declaracoesescopo.ds_declaracao_escopo'));
			}
		}
	}

	function edit($id = null) {
		$this->checkAcess();
    if(empty($this->data)) {
			if(!$id) {
				$this->Session->setFlash('Id inválido para Premissa');
				$this->redirect('/premissas/index');
			}
			$this->data = $this->Premissa->read(null, $id);
			$this->set('declaracoesescopos', $this->Premissa->Declaracoesescopo->generateList(null,'id desc', null, '{n}.Declaracoesescopo.id', '{n}.Declaracoesescopo.ds_declaracao_escopo'));
		} else {
			$this->cleanUpFields();
			if($this->Premissa->save($this->data)) {
				$this->Session->setFlash('Premissa editada com sucesso.');
				$this->redirect('/premissas/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
				$this->set('declaracoesescopos', $this->Premissa->Declaracoesescopo->generateList(null,'id desc', null, '{n}.Declaracoesescopo.id', '{n}.Declaracoesescopo.ds_declaracao_escopo'));
			}
		}
	}

	function delete($id = null) {
		$this->checkAcess();
    if(!$id) {
			$this->Session->setFlash('ID inválido para Premissa');
			$this->redirect('/premissas/index');
		}
		if($this->Premissa->del($id)) {
			$this->Session->setFlash('Premissa Excluída: id '.$id.'');
			$this->redirect('/premissas/index');
		}
	}

}
?>
