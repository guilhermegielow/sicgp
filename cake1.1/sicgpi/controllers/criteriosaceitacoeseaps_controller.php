<?php
class CriteriosaceitacoeseapsController extends AppController {

	var $name = 'Criteriosaceitacoeseaps';
	var $helpers = array('Html', 'Form' , 'Ajax', 'Javascript');

	function index() {
		$this->checkAcess();
    $this->Criteriosaceitacoeseap->recursive = 0;
		$this->set('criteriosaceitacoeseaps', $this->Criteriosaceitacoeseap->findAll());
	}

	function view($id = null) {
		$this->checkAcess();
    if(!$id) {
			$this->Session->setFlash('ID inválido para Criteriosaceitacoeseap.');
			$this->redirect('/criteriosaceitacoeseaps/index');
		}
		$this->set('criteriosaceitacoeseap', $this->Criteriosaceitacoeseap->read(null, $id));
	}

	function add() {
		$this->checkAcess();
    if(empty($this->data)) {
			$this->set('dicionarioseaps', $this->Criteriosaceitacoeseap->Dicionarioseap->generateList());
			$this->render();
		} else {
			$this->cleanUpFields();
			if($this->Criteriosaceitacoeseap->save($this->data)) {
				$this->Session->setFlash('Critério de aceitação da eap inserido com sucesso.');
				$this->redirect('/criteriosaceitacoeseaps/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
				$this->set('dicionarioseaps', $this->Criteriosaceitacoeseap->Dicionarioseap->generateList());
			}
		}
	}

	function edit($id = null) {
		$this->checkAcess();
    if(empty($this->data)) {
			if(!$id) {
				$this->Session->setFlash('Id inválido para Criteriosaceitacoeseap');
				$this->redirect('/criteriosaceitacoeseaps/index');
			}
			$this->data = $this->Criteriosaceitacoeseap->read(null, $id);
			$this->set('dicionarioseaps', $this->Criteriosaceitacoeseap->Dicionarioseap->generateList());
		} else {
			$this->cleanUpFields();
			if($this->Criteriosaceitacoeseap->save($this->data)) {
				$this->Session->setFlash('Critério de aceitação da eap editado com sucesso.');
				$this->redirect('/criteriosaceitacoeseaps/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
				$this->set('dicionarioseaps', $this->Criteriosaceitacoeseap->Dicionarioseap->generateList());
			}
		}
	}

	function delete($id = null) {
		$this->checkAcess();
    if(!$id) {
			$this->Session->setFlash('ID inválido para Criteriosaceitacoeseap');
			$this->redirect('/criteriosaceitacoeseaps/index');
		}
		if($this->Criteriosaceitacoeseap->del($id)) {
			$this->Session->setFlash('Critério de aceitação da eap Excluído: id '.$id.'');
			$this->redirect('/criteriosaceitacoeseaps/index');
		}
	}

}
?>
