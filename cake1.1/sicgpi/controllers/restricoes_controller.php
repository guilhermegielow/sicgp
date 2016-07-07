<?php
class RestricoesController extends AppController {

	var $name = 'Restricoes';
	var $helpers = array('Html', 'Form' , 'Ajax', 'Javascript');

	function index() {
		$this->checkAcess();
    $this->Restricao->recursive = 0;
		$this->set('restricoes', $this->Restricao->findAll('', '',
        'Restricao.id desc'));
	}

	function view($id = null) {
		$this->checkAcess();
    if(!$id) {
			$this->Session->setFlash('ID inválido para Restricao.');
			$this->redirect('/restricoes/index');
		}
		$this->set('restricao', $this->Restricao->read(null, $id));
	}

	function add() {
    $usuario = $_SESSION['Usuario'];
    $this->checkAcess();
    if(empty($this->data)) {
			$this->set('estudosviabilidades', $this->Restricao->Estudosviabilidade->generateList("Estudosviabilidade.user_created = '$usuario'",
            'Estudosviabilidade.id desc'));
			$this->render();
		} else {
			$this->cleanUpFields();
			if($this->Restricao->save($this->data)) {
				$this->Session->setFlash('Restrição inserida com sucesso.');
				$this->redirect('/restricoes/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
				$this->set('estudosviabilidades', $this->Restricao->Estudosviabilidade->generateList("Estudosviabilidade.user_created = '$usuario'",
            'Estudosviabilidade.id desc'));
			}
		}
	}

	function edit($id = null) {
    $usuario = $_SESSION['Usuario'];
    $this->checkAcess();
    if(empty($this->data)) {
			if(!$id) {
				$this->Session->setFlash('Id inválido para Restricao');
				$this->redirect('/restricoes/index');
			}
			$this->data = $this->Restricao->read(null, $id);
			$this->set('estudosviabilidades', $this->Restricao->Estudosviabilidade->generateList("Estudosviabilidade.user_created = '$usuario'",
            'Estudosviabilidade.id desc'));
		} else {
			$this->cleanUpFields();
			if($this->Restricao->save($this->data)) {
				$this->Session->setFlash('Restrição editada com sucesso.');
				$this->redirect('/restricoes/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
				$this->set('estudosviabilidades', $this->Restricao->Estudosviabilidade->generateList("Estudosviabilidade.user_created = '$usuario'",
            'Estudosviabilidade.id desc'));
			}
		}
	}

	function delete($id = null) {
		$this->checkAcess();
    if(!$id) {
			$this->Session->setFlash('ID inválido para Restricao');
			$this->redirect('/restricoes/index');
		}
		if($this->Restricao->del($id)) {
			$this->Session->setFlash('Restrição Excluída: id '.$id.'');
			$this->redirect('/restricoes/index');
		}
	}

}
?>
