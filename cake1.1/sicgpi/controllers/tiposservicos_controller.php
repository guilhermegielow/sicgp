<?php
class TiposservicosController extends AppController {

	var $name = 'Tiposservicos';
	var $helpers = array('Html', 'Form' , 'Ajax', 'Javascript');

	function index() {
		$this->checkAcess();
    $this->Tiposservico->recursive = 0;
		$this->set('tiposservicos', $this->Tiposservico->findAll());
	}

	function view($id = null) {
		$this->checkAcess();
    if(!$id) {
			$this->Session->setFlash('ID inválido para Tiposservico.');
			$this->redirect('/tiposservicos/index');
		}
		$this->set('tiposservico', $this->Tiposservico->read(null, $id));
	}

	function add() {
		$this->checkAcess();
    if(empty($this->data)) {
			$this->render();
		} else {
			$this->cleanUpFields();
			if($this->Tiposservico->save($this->data)) {
				$this->Session->setFlash('Tipo de serviço inserido com sucesso.');
				$this->redirect('/tiposservicos/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
			}
		}
	}

	function edit($id = null) {
		$this->checkAcess();
    if(empty($this->data)) {
			if(!$id) {
				$this->Session->setFlash('Id inválido para Tiposservico');
				$this->redirect('/tiposservicos/index');
			}
			$this->data = $this->Tiposservico->read(null, $id);
		} else {
			$this->cleanUpFields();
			if($this->Tiposservico->save($this->data)) {
				$this->Session->setFlash('Tipo de serviço editado com sucesso.');
				$this->redirect('/tiposservicos/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
			}
		}
	}

	function delete($id = null) {
		$this->checkAcess();
    if(!$id) {
			$this->Session->setFlash('ID inválido para Tiposservico');
			$this->redirect('/tiposservicos/index');
		}
		if($this->Tiposservico->del($id)) {
			$this->Session->setFlash('Tipo de serviço Excluído: id '.$id.'');
			$this->redirect('/tiposservicos/index');
		}
	}

}
?>
