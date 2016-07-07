<?php
class TiposatividadesController extends AppController {

	var $name = 'Tiposatividades';
	var $helpers = array('Html', 'Form' , 'Ajax', 'Javascript');

	function index() {
		$this->checkAcess();
    $this->Tiposatividade->recursive = 0;
		$this->set('tiposatividades', $this->Tiposatividade->findAll());
	}

	function view($id = null) {
		$this->checkAcess();
    if(!$id) {
			$this->Session->setFlash('ID inválido para Tiposatividade.');
			$this->redirect('/tiposatividades/index');
		}
		$this->set('tiposatividade', $this->Tiposatividade->read(null, $id));
	}

	function add() {
		$this->checkAcess();
    if(empty($this->data)) {
			$this->render();
		} else {
			$this->cleanUpFields();
			if($this->Tiposatividade->save($this->data)) {
				$this->Session->setFlash('Tipo de atividade inserido com sucesso.');
				$this->redirect('/tiposatividades/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
			}
		}
	}

	function edit($id = null) {
		$this->checkAcess();
    if(empty($this->data)) {
			if(!$id) {
				$this->Session->setFlash('Id inválido para Tiposatividade');
				$this->redirect('/tiposatividades/index');
			}
			$this->data = $this->Tiposatividade->read(null, $id);
		} else {
			$this->cleanUpFields();
			if($this->Tiposatividade->save($this->data)) {
				$this->Session->setFlash('Tipo de atividade editado com sucesso.');
				$this->redirect('/tiposatividades/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
			}
		}
	}

	function delete($id = null) {
		$this->checkAcess();
    if(!$id) {
			$this->Session->setFlash('ID inválido para Tiposatividade');
			$this->redirect('/tiposatividades/index');
		}
		if($this->Tiposatividade->del($id)) {
			$this->Session->setFlash('Tipo de atividade Excluído: id '.$id.'');
			$this->redirect('/tiposatividades/index');
		}
	}

}
?>
