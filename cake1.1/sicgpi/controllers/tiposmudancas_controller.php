<?php
class TiposmudancasController extends AppController {

	var $name = 'Tiposmudancas';
	var $helpers = array('Html', 'Form' , 'Ajax', 'Javascript');

	function index() {
		$this->checkAcess();
    $this->Tiposmudanca->recursive = 0;
		$this->set('tiposmudancas', $this->Tiposmudanca->findAll());
	}

	function view($id = null) {
		$this->checkAcess();
    if(!$id) {
			$this->Session->setFlash('ID inv�lido para Tiposmudanca.');
			$this->redirect('/tiposmudancas/index');
		}
		$this->set('tiposmudanca', $this->Tiposmudanca->read(null, $id));
	}

	function add() {
		$this->checkAcess();
    if(empty($this->data)) {
			$this->render();
		} else {
			$this->cleanUpFields();
			if($this->Tiposmudanca->save($this->data)) {
				$this->Session->setFlash('Tipo de mudan�a inserida com sucesso.');
				$this->redirect('/tiposmudancas/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
			}
		}
	}

	function edit($id = null) {
		$this->checkAcess();
    if(empty($this->data)) {
			if(!$id) {
				$this->Session->setFlash('Id inv�lido para Tiposmudanca');
				$this->redirect('/tiposmudancas/index');
			}
			$this->data = $this->Tiposmudanca->read(null, $id);
		} else {
			$this->cleanUpFields();
			if($this->Tiposmudanca->save($this->data)) {
				$this->Session->setFlash('Tipo de mudan�a editada com sucesso.');
				$this->redirect('/tiposmudancas/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
			}
		}
	}

	function delete($id = null) {
		$this->checkAcess();
    if(!$id) {
			$this->Session->setFlash('ID inv�lido para Tiposmudanca');
			$this->redirect('/tiposmudancas/index');
		}
		if($this->Tiposmudanca->del($id)) {
			$this->Session->setFlash('Tipo de mudan�a Exclu�da: id '.$id.'');
			$this->redirect('/tiposmudancas/index');
		}
	}

}
?>
