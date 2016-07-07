<?php
class EscoposnaoincluidosController extends AppController {

	var $name = 'Escoposnaoincluidos';
	var $helpers = array('Html', 'Form' , 'Ajax', 'Javascript');

	function index() {
		$this->checkAcess();
    $this->Escoposnaoincluido->recursive = 0;
		$this->set('escoposnaoincluidos', $this->Escoposnaoincluido->findAll('','','Escoposnaoincluido.id desc'));
	}

	function view($id = null) {
		$this->checkAcess();
    if(!$id) {
			$this->Session->setFlash('ID inválido para Escoposnaoincluido.');
			$this->redirect('/escoposnaoincluidos/index');
		}
		$this->set('escoposnaoincluido', $this->Escoposnaoincluido->read(null, $id));
	}

	function add() {
		$this->checkAcess();
    if(empty($this->data)) {
			$this->set('declaracoesescopos', $this->Escoposnaoincluido->Declaracoesescopo->generateList(null,'id desc', null, '{n}.Declaracoesescopo.id', '{n}.Declaracoesescopo.ds_declaracao_escopo'));
			$this->render();
		} else {
			$this->cleanUpFields();
			if($this->Escoposnaoincluido->save($this->data)) {
				$this->Session->setFlash('Não incluido no escopo inserido com sucesso.');
				$this->redirect('/escoposnaoincluidos/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
				$this->set('declaracoesescopos', $this->Escoposnaoincluido->Declaracoesescopo->generateList(null,'id desc', null, '{n}.Declaracoesescopo.id', '{n}.Declaracoesescopo.ds_declaracao_escopo'));
			}
		}
	}

	function edit($id = null) {
		$this->checkAcess();
    if(empty($this->data)) {
			if(!$id) {
				$this->Session->setFlash('Id inválido para Escoposnaoincluido');
				$this->redirect('/escoposnaoincluidos/index');
			}
			$this->data = $this->Escoposnaoincluido->read(null, $id);
			$this->set('declaracoesescopos', $this->Escoposnaoincluido->Declaracoesescopo->generateList(null,'id desc', null, '{n}.Declaracoesescopo.id', '{n}.Declaracoesescopo.ds_declaracao_escopo'));
		} else {
			$this->cleanUpFields();
			if($this->Escoposnaoincluido->save($this->data)) {
				$this->Session->setFlash('Não incluido no escopo editado com sucesso.');
				$this->redirect('/escoposnaoincluidos/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
				$this->set('declaracoesescopos', $this->Escoposnaoincluido->Declaracoesescopo->generateList(null,'id desc', null, '{n}.Declaracoesescopo.id', '{n}.Declaracoesescopo.ds_declaracao_escopo'));
			}
		}
	}

	function delete($id = null) {
		$this->checkAcess();
    if(!$id) {
			$this->Session->setFlash('ID inválido para Escoposnaoincluido');
			$this->redirect('/escoposnaoincluidos/index');
		}
		if($this->Escoposnaoincluido->del($id)) {
			$this->Session->setFlash('Não incluido no escopo Excluído: id '.$id.'');
			$this->redirect('/escoposnaoincluidos/index');
		}
	}

}
?>
