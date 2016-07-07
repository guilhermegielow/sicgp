<?php
class TiposcomunicacoesController extends AppController {

	var $name = 'Tiposcomunicacoes';
	var $helpers = array('Html', 'Form' , 'Ajax', 'Javascript');

	function index() {
		$this->checkAcess();
    $this->Tiposcomunicacao->recursive = 0;
		$this->set('tiposcomunicacoes', $this->Tiposcomunicacao->findAll());
	}

	function view($id = null) {
		$this->checkAcess();
    if(!$id) {
			$this->Session->setFlash('ID inválido para Tiposcomunicacao.');
			$this->redirect('/tiposcomunicacoes/index');
		}
		$this->set('tiposcomunicacao', $this->Tiposcomunicacao->read(null, $id));
	}

	function add() {
		$this->checkAcess();
    if(empty($this->data)) {
			$this->render();
		} else {
			$this->cleanUpFields();
			if($this->Tiposcomunicacao->save($this->data)) {
				$this->Session->setFlash('Tipo de comunicação inserida com sucesso.');
				$this->redirect('/tiposcomunicacoes/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
			}
		}
	}

	function edit($id = null) {
		$this->checkAcess();
    if(empty($this->data)) {
			if(!$id) {
				$this->Session->setFlash('Id inválido para Tiposcomunicacao');
				$this->redirect('/tiposcomunicacoes/index');
			}
			$this->data = $this->Tiposcomunicacao->read(null, $id);
		} else {
			$this->cleanUpFields();
			if($this->Tiposcomunicacao->save($this->data)) {
				$this->Session->setFlash('Tipo de comunicação editada com sucesso.');
				$this->redirect('/tiposcomunicacoes/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
			}
		}
	}

	function delete($id = null) {
		$this->checkAcess();
    if(!$id) {
			$this->Session->setFlash('ID inválido para Tiposcomunicacao');
			$this->redirect('/tiposcomunicacoes/index');
		}
		if($this->Tiposcomunicacao->del($id)) {
			$this->Session->setFlash('Tipo de comunicação Excluída: id '.$id.'');
			$this->redirect('/tiposcomunicacoes/index');
		}
	}

}
?>
