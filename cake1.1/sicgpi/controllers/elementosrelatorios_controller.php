<?php
class ElementosrelatoriosController extends AppController {

	var $name = 'Elementosrelatorios';
	var $helpers = array('Html', 'Form' , 'Ajax', 'Javascript');

	function index() {
		$this->checkAcess();
    $this->Elementosrelatorio->recursive = 0;
		$this->set('elementosrelatorios', $this->Elementosrelatorio->findAll());
	}

	function view($id = null) {
		$this->checkAcess();
    if(!$id) {
			$this->Session->setFlash('ID inválido para Elementosrelatorio.');
			$this->redirect('/elementosrelatorios/index');
		}
		$this->set('elementosrelatorio', $this->Elementosrelatorio->read(null, $id));
	}

	function add() {
		$this->checkAcess();
    if(empty($this->data)) {
			$this->set('relatoriosdesempenhos', $this->Elementosrelatorio->Relatoriosdesempenho->generateList());
			$this->render();
		} else {
			$this->cleanUpFields();
			if($this->Elementosrelatorio->save($this->data)) {
				$this->Session->setFlash('Elemento de relatório inserido com sucesso.');
				$this->redirect('/elementosrelatorios/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
				$this->set('relatoriosdesempenhos', $this->Elementosrelatorio->Relatoriosdesempenho->generateList());
			}
		}
	}

	function edit($id = null) {
		$this->checkAcess();
    if(empty($this->data)) {
			if(!$id) {
				$this->Session->setFlash('Id inválido para Elementosrelatorio');
				$this->redirect('/elementosrelatorios/index');
			}
			$this->data = $this->Elementosrelatorio->read(null, $id);
			$this->set('relatoriosdesempenhos', $this->Elementosrelatorio->Relatoriosdesempenho->generateList());
		} else {
			$this->cleanUpFields();
			if($this->Elementosrelatorio->save($this->data)) {
				$this->Session->setFlash('Elemento de relatório editado com sucesso.');
				$this->redirect('/elementosrelatorios/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
				$this->set('relatoriosdesempenhos', $this->Elementosrelatorio->Relatoriosdesempenho->generateList());
			}
		}
	}

	function delete($id = null) {
		$this->checkAcess();
    if(!$id) {
			$this->Session->setFlash('ID inválido para Elementosrelatorio');
			$this->redirect('/elementosrelatorios/index');
		}
		if($this->Elementosrelatorio->del($id)) {
			$this->Session->setFlash('Elemento de relatório Excluído: id '.$id.'');
			$this->redirect('/elementosrelatorios/index');
		}
	}

}
?>
