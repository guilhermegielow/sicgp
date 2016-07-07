<?php
class GruposrecursosController extends AppController {

	var $name = 'Gruposrecursos';
	var $helpers = array('Html', 'Form' , 'Ajax', 'Javascript');

	function index() {
		$this->checkAcess();
    $this->Gruposrecurso->recursive = 0;
		$this->set('gruposrecursos', $this->Gruposrecurso->findAll());
	}

	function view($id = null) {
		$this->checkAcess();
    if(!$id) {
			$this->Session->setFlash('ID inválido para Gruposrecurso.');
			$this->redirect('/gruposrecursos/index');
		}
		$this->set('gruposrecurso', $this->Gruposrecurso->read(null, $id));
	}

	function add() {
		$this->checkAcess();
    if(empty($this->data)) {
			$this->render();
		} else {
			$this->cleanUpFields();
			if($this->Gruposrecurso->save($this->data)) {
				$this->Session->setFlash('Grupo de recurso inserido com sucesso.');
				$this->redirect('/gruposrecursos/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
			}
		}
	}

	function edit($id = null) {
		$this->checkAcess();
    if(empty($this->data)) {
			if(!$id) {
				$this->Session->setFlash('Id inválido para Gruposrecurso');
				$this->redirect('/gruposrecursos/index');
			}
			$this->data = $this->Gruposrecurso->read(null, $id);
		} else {
			$this->cleanUpFields();
			if($this->Gruposrecurso->save($this->data)) {
				$this->Session->setFlash('Grupo de recurso editado com sucesso.');
				$this->redirect('/gruposrecursos/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
			}
		}
	}

	function delete($id = null) {
		$this->checkAcess();
    if(!$id) {
			$this->Session->setFlash('ID inválido para Gruposrecurso');
			$this->redirect('/gruposrecursos/index');
		}
		if($this->Gruposrecurso->del($id)) {
			$this->Session->setFlash('Grupo de recurso Excluído: id '.$id.'');
			$this->redirect('/gruposrecursos/index');
		}
	}

}
?>
