<?php
class ArosController extends AppController {

	var $name = 'Aros';
	var $helpers = array('Html', 'Form' , 'Ajax', 'Javascript');

	function index() {
        $this->checkAcess();
		$this->Aro->recursive = 0;
		$this->set('aros', $this->Aro->findAll());
	}

	function view($id = null) {
        $this->checkAcess();
		if(!$id) {
			$this->Session->setFlash('ID inválido para Aro.');
			$this->redirect('/aros/index');
		}
		$this->set('aro', $this->Aro->read(null, $id));
	}

	function add() {
        $this->checkAcess();
        if(empty($this->data)) {
			$this->render();
		} else {
			$this->cleanUpFields();
			if($this->Aro->save($this->data)) {
				$this->Session->setFlash('Aro inserido com sucesso.');
				$this->redirect('/aros/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
			}
		}
	}

	function edit($id = null) {
        $this->checkAcess();
        if(empty($this->data)) {
			if(!$id) {
				$this->Session->setFlash('Id inválido para Aro');
				$this->redirect('/aros/index');
			}
			$this->data = $this->Aro->read(null, $id);
		} else {
			$this->cleanUpFields();
			if($this->Aro->save($this->data)) {
				$this->Session->setFlash('Aro editado com sucesso.');
				$this->redirect('/aros/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
			}
		}
	}

	function delete($id = null) {
        $this->checkAcess();
        if(!$id) {
			$this->Session->setFlash('ID inválido para Aro');
			$this->redirect('/aros/index');
		}
		if($this->Aro->del($id)) {
			$this->Session->setFlash('Aro Excluído: id '.$id.'');
			$this->redirect('/aros/index');
		}
	}

}
?>
