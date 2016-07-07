<?php
class TiposrecursosviabilidadesController extends AppController {

	var $name = 'Tiposrecursosviabilidades';
	var $helpers = array('Html', 'Form' , 'Ajax', 'Javascript');

	function index() {
		$this->checkAcess();
    $this->Tiposrecursosviabilidade->recursive = 0;
		$this->set('tiposrecursosviabilidades', $this->Tiposrecursosviabilidade->findAll());
	}

	function view($id = null) {
		$this->checkAcess();
    if(!$id) {
			$this->Session->setFlash('ID inválido para Tiposrecursosviabilidade.');
			$this->redirect('/tiposrecursosviabilidades/index');
		}
		$this->set('tiposrecursosviabilidade', $this->Tiposrecursosviabilidade->read(null, $id));
	}

	function add() {
		$this->checkAcess();
    if(empty($this->data)) {
			$this->render();
		} else {
			$this->cleanUpFields();
			if($this->Tiposrecursosviabilidade->save($this->data)) {
				$this->Session->setFlash('Tipo de recurso de viabilidade inserido com sucesso.');
				$this->redirect('/tiposrecursosviabilidades/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
			}
		}
	}

	function edit($id = null) {
		$this->checkAcess();
    if(empty($this->data)) {
			if(!$id) {
				$this->Session->setFlash('Id inválido para Tiposrecursosviabilidade');
				$this->redirect('/tiposrecursosviabilidades/index');
			}
			$this->data = $this->Tiposrecursosviabilidade->read(null, $id);
		} else {
			$this->cleanUpFields();
			if($this->Tiposrecursosviabilidade->save($this->data)) {
				$this->Session->setFlash('Tipo de recurso de viabilidade editado com sucesso.');
				$this->redirect('/tiposrecursosviabilidades/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
			}
		}
	}

	function delete($id = null) {
		$this->checkAcess();
    if(!$id) {
			$this->Session->setFlash('ID inválido para Tiposrecursosviabilidade');
			$this->redirect('/tiposrecursosviabilidades/index');
		}
		if($this->Tiposrecursosviabilidade->del($id)) {
			$this->Session->setFlash('Tipo de recurso de viabilidade Excluído: id '.$id.'');
			$this->redirect('/tiposrecursosviabilidades/index');
		}
	}

}
?>
