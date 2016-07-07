<?php
class ObjetivosController extends AppController {

	var $name = 'Objetivos';
	var $helpers = array('Html', 'Form' , 'Ajax', 'Javascript');

	function index() {
		$this->checkAcess();
    $this->Objetivo->recursive = 0;
		$this->set('objetivos', $this->Objetivo->findAll('', '',
        'Objetivo.id desc'));
	}

	function view($id = null) {
		$this->checkAcess();
    if(!$id) {
			$this->Session->setFlash('ID inválido para Objetivo.');
			$this->redirect('/objetivos/index');
		}
		$this->set('objetivo', $this->Objetivo->read(null, $id));
	}

	function add() {
    $usuario = $_SESSION['Usuario'];
   	$this->checkAcess();
    if(empty($this->data)) {
			$this->set('estudosviabilidades', $this->Objetivo->Estudosviabilidade->generateList("Estudosviabilidade.user_created = '$usuario'",
            'Estudosviabilidade.id desc'));
			$this->render();
		} else {
			$this->cleanUpFields();
			if($this->Objetivo->save($this->data)) {
				$this->Session->setFlash('Objetivo inserido com sucesso.');
				$this->redirect('/objetivos/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
				$this->set('estudosviabilidades', $this->Objetivo->Estudosviabilidade->generateList("Estudosviabilidade.user_created = '$usuario'",
            'Estudosviabilidade.id desc'));
			}
		}
	}

	function edit($id = null) {
	$usuario = $_SESSION['Usuario'];
	$this->checkAcess();
    if(empty($this->data)) {
			if(!$id) {
				$this->Session->setFlash('Id inválido para Objetivo');
				$this->redirect('/objetivos/index');
			}
			$this->data = $this->Objetivo->read(null, $id);
			$this->set('estudosviabilidades', $this->Objetivo->Estudosviabilidade->generateList("Estudosviabilidade.user_created = '$usuario'",
            'Estudosviabilidade.id desc'));
		} else {
			$this->cleanUpFields();
			if($this->Objetivo->save($this->data)) {
				$this->Session->setFlash('Objetivo editado com sucesso.');
				$this->redirect('/objetivos/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
				$this->set('estudosviabilidades', $this->Objetivo->Estudosviabilidade->generateList("Estudosviabilidade.user_created = '$usuario'",
            'Estudosviabilidade.id desc'));
			}
		}
	}

	function delete($id = null) {
		$this->checkAcess();
    if(!$id) {
			$this->Session->setFlash('ID inválido para Objetivo');
			$this->redirect('/objetivos/index');
		}
		if($this->Objetivo->del($id)) {
			$this->Session->setFlash('Objetivo Excluído: id '.$id.'');
			$this->redirect('/objetivos/index');
		}
	}

}
?>
