<?php
class JustificativasController extends AppController {

	var $name = 'Justificativas';
	var $helpers = array('Html', 'Form' , 'Ajax', 'Javascript');

	function index() {
		$this->checkAcess();
    $this->Justificativa->recursive = 0;
		$this->set('justificativas', $this->Justificativa->findAll('', '',
        'Justificativa.id desc'));
	}

	function view($id = null) {
		$this->checkAcess();
    if(!$id) {
			$this->Session->setFlash('ID inválido para Justificativa.');
			$this->redirect('/justificativas/index');
		}
		$this->set('justificativa', $this->Justificativa->read(null, $id));
	}

	function add() {
    $this->checkAcess();
    $usuario = $_SESSION['Usuario'];
    if(empty($this->data)) {
            $this->set('estudosviabilidades', $this->Justificativa->Estudosviabilidade->generateList("Estudosviabilidade.user_created = '$usuario'",
            'Estudosviabilidade.id desc'));
			$this->render();
		} else {
			$this->cleanUpFields();
			if($this->Justificativa->save($this->data)) {
				$this->Session->setFlash('Justificativa inserida com sucesso.');
				$this->redirect('/justificativas/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
				$this->set('estudosviabilidades', $this->Justificativa->Estudosviabilidade->generateList("Estudosviabilidade.user_created = '$usuario'",
                 'Estudosviabilidade.id desc'));
			}
		}
	}

	function edit($id = null) {
		$this->checkAcess();
    if(empty($this->data)) {
			if(!$id) {
				$this->Session->setFlash('Id inválido para Justificativa');
				$this->redirect('/justificativas/index');
			}
			$this->data = $this->Justificativa->read(null, $id);
			$this->set('estudosviabilidades', $this->Justificativa->Estudosviabilidade->generateList("Estudosviabilidade.user_created = '$usuario'",
            'Estudosviabilidade.id desc'));
		} else {
			$this->cleanUpFields();
			if($this->Justificativa->save($this->data)) {
				$this->Session->setFlash('Justificativa editada com sucesso.');
				$this->redirect('/justificativas/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
				$this->set('estudosviabilidades', $this->Justificativa->Estudosviabilidade->generateList("Estudosviabilidade.user_created = '$usuario'",
                'Estudosviabilidade.id desc'));
			}
		}
	}

	function delete($id = null) {
		$this->checkAcess();
    if(!$id) {
			$this->Session->setFlash('ID inválido para Justificativa');
			$this->redirect('/justificativas/index');
		}
		if($this->Justificativa->del($id)) {
			$this->Session->setFlash('Justificativa Excluída: id '.$id.'');
			$this->redirect('/justificativas/index');
		}
	}

}
?>
