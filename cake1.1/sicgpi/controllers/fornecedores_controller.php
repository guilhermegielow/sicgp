<?php
class FornecedoresController extends AppController {

	var $name = 'Fornecedores';
	var $helpers = array('Html', 'Form' , 'Ajax', 'Javascript');

	function index() {
		$this->checkAcess();
    $this->Fornecedor->recursive = 0;
		$this->set('fornecedores', $this->Fornecedor->findAll());
	}

	function view($id = null) {
		$this->checkAcess();
    if(!$id) {
			$this->Session->setFlash('ID inválido para Fornecedor.');
			$this->redirect('/fornecedores/index');
		}
		$this->set('fornecedor', $this->Fornecedor->read(null, $id));
	}

	function add() {
		$this->checkAcess();
    if(empty($this->data)) {
			$this->render();
		} else {
			$this->cleanUpFields();
			if($this->Fornecedor->save($this->data)) {
				$this->Session->setFlash('Fornecedor inserido com sucesso.');
				$this->redirect('/fornecedores/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
			}
		}
	}

	function edit($id = null) {
		$this->checkAcess();
    if(empty($this->data)) {
			if(!$id) {
				$this->Session->setFlash('Id inválido para Fornecedor');
				$this->redirect('/fornecedores/index');
			}
			$this->data = $this->Fornecedor->read(null, $id);
		} else {
			$this->cleanUpFields();
			if($this->Fornecedor->save($this->data)) {
				$this->Session->setFlash('Fornecedor editado com sucesso.');
				$this->redirect('/fornecedores/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
			}
		}
	}

	function delete($id = null) {
		$this->checkAcess();
    if(!$id) {
			$this->Session->setFlash('ID inválido para Fornecedor');
			$this->redirect('/fornecedores/index');
		}
		if($this->Fornecedor->del($id)) {
			$this->Session->setFlash('Fornecedor Excluído: id '.$id.'');
			$this->redirect('/fornecedores/index');
		}
	}

}
?>
