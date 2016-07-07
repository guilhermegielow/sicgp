<?php
class MarcosController extends AppController {

	var $name = 'Marcos';
	var $helpers = array('Html', 'Form' , 'Ajax', 'Javascript');

	function index() {
	$this->checkAcess();
    $this->Marco->recursive = 0;
		$this->set('marcos', $this->Marco->findAll('', '',
        'Marco.id desc'));
	}

	function view($id = null) {
	$this->checkAcess();
    if(!$id) {
			$this->Session->setFlash('ID inválido para Marco.');
			$this->redirect('/marcos/index');
		}
		$this->set('marco', $this->Marco->read(null, $id));
	}

	function add() {
	$usuario = $_SESSION['Usuario'];
	$this->checkAcess();
    if(empty($this->data)) {
			$this->set('estudosviabilidades', $this->Marco->Estudosviabilidade->generateList("Estudosviabilidade.user_created = '$usuario'",
            'Estudosviabilidade.id desc'));
			$this->render();
		} else {
			$this->cleanUpFields();
			if($this->Marco->save($this->data)) {
				$this->Session->setFlash('Marco inserido com sucesso.');
				$this->redirect('/marcos/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
				$this->set('estudosviabilidades', $this->Marco->Estudosviabilidade->generateList("Estudosviabilidade.user_created = '$usuario'",
            'Estudosviabilidade.id desc'));
			}
		}
	}

	function edit($id = null) {
    $usuario = $_SESSION['Usuario'];
    $this->checkAcess();
    if(empty($this->data)) {
			if(!$id) {
				$this->Session->setFlash('Id inválido para Marco');
				$this->redirect('/marcos/index');
			}
			$this->data = $this->Marco->read(null, $id);
			$this->set('estudosviabilidades', $this->Marco->Estudosviabilidade->generateList("Estudosviabilidade.user_created = '$usuario'",
            'Estudosviabilidade.id desc'));
		} else {
			$this->cleanUpFields();
			if($this->Marco->save($this->data)) {
				$this->Session->setFlash('Marco editado com sucesso.');
				$this->redirect('/marcos/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
				$this->set('estudosviabilidades', $this->Marco->Estudosviabilidade->generateList("Estudosviabilidade.user_created = '$usuario'",
            'Estudosviabilidade.id desc'));
			}
		}
	}

	function delete($id = null) {
		$this->checkAcess();
    if(!$id) {
			$this->Session->setFlash('ID inválido para Marco');
			$this->redirect('/marcos/index');
		}
		if($this->Marco->del($id)) {
			$this->Session->setFlash('Marco Excluído: id '.$id.'');
			$this->redirect('/marcos/index');
		}
	}

}
?>
