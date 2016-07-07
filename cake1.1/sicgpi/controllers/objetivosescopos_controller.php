<?php
class ObjetivosescoposController extends AppController {

	var $name = 'Objetivosescopos';
	var $helpers = array('Html', 'Form' , 'Ajax', 'Javascript');

	function index() {
		$this->checkAcess();
    $this->Objetivosescopo->recursive = 0;
		$this->set('objetivosescopos', $this->Objetivosescopo->findAll('','','Objetivosescopo.id desc'));
	}

	function view($id = null) {
		$this->checkAcess();
    if(!$id) {
			$this->Session->setFlash('ID inválido para Objetivosescopo.');
			$this->redirect('/objetivosescopos/index');
		}
		$this->set('objetivosescopo', $this->Objetivosescopo->read(null, $id));
	}

	function add() {
		$this->checkAcess();
    if(empty($this->data)) {
			$this->set('declaracoesescopos', $this->Objetivosescopo->Declaracoesescopo->generateList(null,'id desc', null, '{n}.Declaracoesescopo.id', '{n}.Declaracoesescopo.ds_declaracao_escopo'));
			$this->render();
		} else {
			$this->cleanUpFields();
			if($this->Objetivosescopo->save($this->data)) {
				$this->Session->setFlash('Objetivo de escopo inserido com sucesso.');
				$this->redirect('/objetivosescopos/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
				$this->set('declaracoesescopos', $this->Objetivosescopo->Declaracoesescopo->generateList(null,'id desc', null, '{n}.Declaracoesescopo.id', '{n}.Declaracoesescopo.ds_declaracao_escopo'));
			}
		}
	}

	function edit($id = null) {
		$this->checkAcess();
    if(empty($this->data)) {
			if(!$id) {
				$this->Session->setFlash('Id inválido para Objetivosescopo');
				$this->redirect('/objetivosescopos/index');
			}
			$this->data = $this->Objetivosescopo->read(null, $id);
			$this->set('declaracoesescopos', $this->Objetivosescopo->Declaracoesescopo->generateList(null,'id desc', null, '{n}.Declaracoesescopo.id', '{n}.Declaracoesescopo.ds_declaracao_escopo'));
		} else {
			$this->cleanUpFields();
			if($this->Objetivosescopo->save($this->data)) {
				$this->Session->setFlash('Objetivo de escopo editado com sucesso.');
				$this->redirect('/objetivosescopos/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
				$this->set('declaracoesescopos', $this->Objetivosescopo->Declaracoesescopo->generateList(null,'id desc', null, '{n}.Declaracoesescopo.id', '{n}.Declaracoesescopo.ds_declaracao_escopo'));
			}
		}
	}

	function delete($id = null) {
		$this->checkAcess();
    if(!$id) {
			$this->Session->setFlash('ID inválido para Objetivosescopo');
			$this->redirect('/objetivosescopos/index');
		}
		if($this->Objetivosescopo->del($id)) {
			$this->Session->setFlash('Objetivo de escopo Excluído: id '.$id.'');
			$this->redirect('/objetivosescopos/index');
		}
	}

}
?>
