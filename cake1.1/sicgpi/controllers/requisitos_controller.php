<?php
class RequisitosController extends AppController {

	var $name = 'Requisitos';
	var $helpers = array('Html', 'Form' , 'Ajax', 'Javascript');

	function index() {
		$this->checkAcess();
    $this->Requisito->recursive = 0;
		$this->set('requisitos', $this->Requisito->findAll('', '',
        'Requisito.id desc'));
	}

	function view($id = null) {
		$this->checkAcess();
    if(!$id) {
			$this->Session->setFlash('ID inválido para Requisito.');
			$this->redirect('/requisitos/index');
		}
		$this->set('requisito', $this->Requisito->read(null, $id));
	}

	function add() {
	$usuario = $_SESSION['Usuario'];
		$this->checkAcess();
    if(empty($this->data)) {
			$this->set('estudosviabilidades', $this->Requisito->Estudosviabilidade->generateList("Estudosviabilidade.user_created = '$usuario'",
            'Estudosviabilidade.id desc'));
			$this->render();
		} else {
			$this->cleanUpFields();
			if($this->Requisito->save($this->data)) {
				$this->Session->setFlash('Requisito inserido com sucesso.');
				$this->redirect('/requisitos/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
				$this->set('estudosviabilidades', $this->Requisito->Estudosviabilidade->generateList("Estudosviabilidade.user_created = '$usuario'",
            'Estudosviabilidade.id desc'));
			}
		}
	}

	function edit($id = null) {
	$usuario = $_SESSION['Usuario'];
		$this->checkAcess();
    if(empty($this->data)) {
			if(!$id) {
				$this->Session->setFlash('Id inválido para Requisito');
				$this->redirect('/requisitos/index');
			}
			$this->data = $this->Requisito->read(null, $id);
			$this->set('estudosviabilidades', $this->Requisito->Estudosviabilidade->generateList("Estudosviabilidade.user_created = '$usuario'",
            'Estudosviabilidade.id desc'));
		} else {
			$this->cleanUpFields();
			if($this->Requisito->save($this->data)) {
				$this->Session->setFlash('Requisito editado com sucesso.');
				$this->redirect('/requisitos/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
				$this->set('estudosviabilidades', $this->Requisito->Estudosviabilidade->generateList("Estudosviabilidade.user_created = '$usuario'",
            'Estudosviabilidade.id desc'));
			}
		}
	}

	function delete($id = null) {
		$this->checkAcess();
    if(!$id) {
			$this->Session->setFlash('ID inválido para Requisito');
			$this->redirect('/requisitos/index');
		}
		if($this->Requisito->del($id)) {
			$this->Session->setFlash('Requisito Excluído: id '.$id.'');
			$this->redirect('/requisitos/index');
		}
	}

}
?>
