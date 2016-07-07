<?php
class CriteriosaceitacoesController extends AppController {

	var $name = 'Criteriosaceitacoes';
	var $helpers = array('Html', 'Form' , 'Ajax', 'Javascript');

	function index() {
		$this->checkAcess();
    $this->Criteriosaceitacao->recursive = 0;
		$this->set('criteriosaceitacoes', $this->Criteriosaceitacao->findAll('','','Criteriosaceitacao.id desc'));
	}

	function view($id = null) {
		$this->checkAcess();
    if(!$id) {
			$this->Session->setFlash('ID inválido para Criteriosaceitacao.');
			$this->redirect('/criteriosaceitacoes/index');
		}
		$this->set('criteriosaceitacao', $this->Criteriosaceitacao->read(null, $id));
	}

	function add() {
		$this->checkAcess();
    if(empty($this->data)) {
			$this->set('declaracoesescopos', $this->Criteriosaceitacao->Declaracoesescopo->generateList(null,'id desc', null, '{n}.Declaracoesescopo.id', '{n}.Declaracoesescopo.ds_declaracao_escopo'));
			$this->render();
		} else {
			$this->cleanUpFields();
			if($this->Criteriosaceitacao->save($this->data)) {
				$this->Session->setFlash('Critério de aceitação inserido com sucesso.');
				$this->redirect('/criteriosaceitacoes/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
				$this->set('declaracoesescopos', $this->Criteriosaceitacao->Declaracoesescopo->generateList(null,'id desc', null, '{n}.Declaracoesescopo.id', '{n}.Declaracoesescopo.ds_declaracao_escopo'));
			}
		}
	}

	function edit($id = null) {
		$this->checkAcess();
    if(empty($this->data)) {
			if(!$id) {
				$this->Session->setFlash('Id inválido para Criteriosaceitacao');
				$this->redirect('/criteriosaceitacoes/index');
			}
			$this->data = $this->Criteriosaceitacao->read(null, $id);
			$this->set('declaracoesescopos', $this->Criteriosaceitacao->Declaracoesescopo->generateList(null,'id desc', null, '{n}.Declaracoesescopo.id', '{n}.Declaracoesescopo.ds_declaracao_escopo'));
		} else {
			$this->cleanUpFields();
			if($this->Criteriosaceitacao->save($this->data)) {
				$this->Session->setFlash('Critério de aceitação editado com sucesso.');
				$this->redirect('/criteriosaceitacoes/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
				$this->set('declaracoesescopos', $this->Criteriosaceitacao->Declaracoesescopo->generateList(null,'id desc', null, '{n}.Declaracoesescopo.id', '{n}.Declaracoesescopo.ds_declaracao_escopo'));
			}
		}
	}

	function delete($id = null) {
		$this->checkAcess();
    if(!$id) {
			$this->Session->setFlash('ID inválido para Criteriosaceitacao');
			$this->redirect('/criteriosaceitacoes/index');
		}
		if($this->Criteriosaceitacao->del($id)) {
			$this->Session->setFlash('Critério de aceitação Excluído: id '.$id.'');
			$this->redirect('/criteriosaceitacoes/index');
		}
	}

}
?>
