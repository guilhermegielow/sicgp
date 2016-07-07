<?php
class RestricoesescoposController extends AppController {

	var $name = 'Restricoesescopos';
	var $helpers = array('Html', 'Form' , 'Ajax', 'Javascript');

	function index() {
		$this->checkAcess();
    $this->Restricoesescopo->recursive = 0;
		$this->set('restricoesescopos', $this->Restricoesescopo->findAll('','','Restricoesescopo.id desc'));
	}

	function view($id = null) {
		$this->checkAcess();
    if(!$id) {
			$this->Session->setFlash('ID inválido para Restricoesescopo.');
			$this->redirect('/restricoesescopos/index');
		}
		$this->set('restricoesescopo', $this->Restricoesescopo->read(null, $id));
	}

	function add() {
		$this->checkAcess();
    if(empty($this->data)) {
			$this->set('declaracoesescopos', $this->Restricoesescopo->Declaracoesescopo->generateList(null,'id desc', null, '{n}.Declaracoesescopo.id', '{n}.Declaracoesescopo.ds_declaracao_escopo'));
			$this->render();
		} else {
			$this->cleanUpFields();
			if($this->Restricoesescopo->save($this->data)) {
				$this->Session->setFlash('Restrição de escopo inserida com sucesso.');
				$this->redirect('/restricoesescopos/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
				$this->set('declaracoesescopos', $this->Restricoesescopo->Declaracoesescopo->generateList(null,'id desc', null, '{n}.Declaracoesescopo.id', '{n}.Declaracoesescopo.ds_declaracao_escopo'));
			}
		}
	}

	function edit($id = null) {
		$this->checkAcess();
    if(empty($this->data)) {
			if(!$id) {
				$this->Session->setFlash('Id inválido para Restricoesescopo');
				$this->redirect('/restricoesescopos/index');
			}
			$this->data = $this->Restricoesescopo->read(null, $id);
			$this->set('declaracoesescopos', $this->Restricoesescopo->Declaracoesescopo->generateList(null,'id desc', null, '{n}.Declaracoesescopo.id', '{n}.Declaracoesescopo.ds_declaracao_escopo'));
		} else {
			$this->cleanUpFields();
			if($this->Restricoesescopo->save($this->data)) {
				$this->Session->setFlash('Restrição de escopo editada com sucesso.');
				$this->redirect('/restricoesescopos/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
				$this->set('declaracoesescopos', $this->Restricoesescopo->Declaracoesescopo->generateList(null,'id desc', null, '{n}.Declaracoesescopo.id', '{n}.Declaracoesescopo.ds_declaracao_escopo'));
			}
		}
	}

	function delete($id = null) {
		$this->checkAcess();
    if(!$id) {
			$this->Session->setFlash('ID inválido para Restricoesescopo');
			$this->redirect('/restricoesescopos/index');
		}
		if($this->Restricoesescopo->del($id)) {
			$this->Session->setFlash('Restrição de escopo Excluída: id '.$id.'');
			$this->redirect('/restricoesescopos/index');
		}
	}

}
?>
