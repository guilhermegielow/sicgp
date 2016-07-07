<?php
class DecisoesController extends AppController {

	var $name = 'Decisoes';
	var $helpers = array('Html', 'Form' , 'Ajax', 'Javascript');

	function index() {
		$this->checkAcess();
    $this->Decisao->recursive = 0;
		$this->set('decisoes', $this->Decisao->findAll());
	}

	function view($id = null) {
		$this->checkAcess();
    if(!$id) {
			$this->Session->setFlash('ID inválido para Decisao.');
			$this->redirect('/decisoes/index');
		}
		$this->set('decisao', $this->Decisao->read(null, $id));
	}

	function add() {
		$this->checkAcess();
    if(empty($this->data)) {
			$this->set('atasreunioes', $this->Decisao->Atasreuniao->generateList());
			$this->render();
		} else {
			$this->cleanUpFields();
			if($this->Decisao->save($this->data)) {
				$this->Session->setFlash('Decisão inserida com sucesso.');
				$this->redirect('/decisoes/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
				$this->set('atasreunioes', $this->Decisao->Atasreuniao->generateList());
			}
		}
	}

	function edit($id = null) {
		$this->checkAcess();
    if(empty($this->data)) {
			if(!$id) {
				$this->Session->setFlash('Id inválido para Decisao');
				$this->redirect('/decisoes/index');
			}
			$this->data = $this->Decisao->read(null, $id);
			$this->set('atasreunioes', $this->Decisao->Atasreuniao->generateList());
		} else {
			$this->cleanUpFields();
			if($this->Decisao->save($this->data)) {
				$this->Session->setFlash('Decisão editada com sucesso.');
				$this->redirect('/decisoes/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
				$this->set('atasreunioes', $this->Decisao->Atasreuniao->generateList());
			}
		}
	}

	function delete($id = null) {
		$this->checkAcess();
    if(!$id) {
			$this->Session->setFlash('ID inválido para Decisao');
			$this->redirect('/decisoes/index');
		}
		if($this->Decisao->del($id)) {
			$this->Session->setFlash('Decisão Excluída: id '.$id.'');
			$this->redirect('/decisoes/index');
		}
	}

}
?>
