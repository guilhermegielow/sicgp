<?php
class TiposespecificacoesController extends AppController {

	var $name = 'Tiposespecificacoes';
	var $helpers = array('Html', 'Form' , 'Ajax', 'Javascript');

	function index() {
		$this->checkAcess();
    $this->Tiposespecificacao->recursive = 0;
		$this->set('tiposespecificacoes', $this->Tiposespecificacao->findAll());
	}

	function view($id = null) {
		$this->checkAcess();
    if(!$id) {
			$this->Session->setFlash('ID inv�lido para Tiposespecificacao.');
			$this->redirect('/tiposespecificacoes/index');
		}
		$this->set('tiposespecificacao', $this->Tiposespecificacao->read(null, $id));
	}

	function add() {
		$this->checkAcess();
    if(empty($this->data)) {
			$this->render();
		} else {
			$this->cleanUpFields();
			if($this->Tiposespecificacao->save($this->data)) {
				$this->Session->setFlash('Tipo de especifica��o inserida com sucesso.');
				$this->redirect('/tiposespecificacoes/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
			}
		}
	}

	function edit($id = null) {
		$this->checkAcess();
    if(empty($this->data)) {
			if(!$id) {
				$this->Session->setFlash('Id inv�lido para Tiposespecificacao');
				$this->redirect('/tiposespecificacoes/index');
			}
			$this->data = $this->Tiposespecificacao->read(null, $id);
		} else {
			$this->cleanUpFields();
			if($this->Tiposespecificacao->save($this->data)) {
				$this->Session->setFlash('Tipo de especifica��o editada com sucesso.');
				$this->redirect('/tiposespecificacoes/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
			}
		}
	}

	function delete($id = null) {
		$this->checkAcess();
    if(!$id) {
			$this->Session->setFlash('ID inv�lido para Tiposespecificacao');
			$this->redirect('/tiposespecificacoes/index');
		}
		if($this->Tiposespecificacao->del($id)) {
			$this->Session->setFlash('Tipo de especifica��o Exclu�da: id '.$id.'');
			$this->redirect('/tiposespecificacoes/index');
		}
	}

}
?>
