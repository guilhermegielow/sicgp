<?php
class PlanoscustosController extends AppController {

	var $name = 'Planoscustos';
	var $helpers = array('Html', 'Form' , 'Ajax', 'Javascript');

	function index() {
    $this->checkAcess();
    $usuario = $_SESSION['Usuario'];
		$this->Planoscusto->recursive = 0;
		$this->set('planoscustos', $this->Planoscusto->findAll("Planoscusto.user_created = '$usuario'",'','Planoscusto.id desc'));
	}

	function view($id = null) {
		$this->checkAcess();
    if(!$id) {
			$this->Session->setFlash('ID inválido para Planoscusto.');
			$this->redirect('/planoscustos/index');
		}
		$this->set('planoscusto', $this->Planoscusto->read(null, $id));
	}

	function add() {
    $this->checkAcess();
    $usuario = $_SESSION['Usuario'];
    if(empty($this->data)) {
			$this->set('projetos', $this->Planoscusto->Projeto->generateList("Projeto.user_created = '$usuario'",'id desc', null, '{n}.Projeto.id', '{n}.Projeto.ds_titulo'));
			$this->render();
		} else {
			$this->cleanUpFields();
			if($this->Planoscusto->save($this->data)) {
				$this->Session->setFlash('Plano de custo inserido com sucesso.');
				$this->redirect('/planoscustos/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
				$this->set('projetos', $this->Planoscusto->Projeto->generateList("Projeto.user_created = '$usuario'",'id desc', null, '{n}.Projeto.id', '{n}.Projeto.ds_titulo'));
			}
		}
	}

	function edit($id = null) {
    $this->checkAcess();
    $usuario = $_SESSION['Usuario'];
    if(empty($this->data)) {
			if(!$id) {
				$this->Session->setFlash('Id inválido para Planoscusto');
				$this->redirect('/planoscustos/index');
			}
			$this->data = $this->Planoscusto->read(null, $id);
			$this->set('projetos', $this->Planoscusto->Projeto->generateList("Projeto.user_created = '$usuario'",'id desc', null, '{n}.Projeto.id', '{n}.Projeto.ds_titulo'));
		} else {
			$this->cleanUpFields();
			if($this->Planoscusto->save($this->data)) {
				$this->Session->setFlash('Plano de custo editado com sucesso.');
				$this->redirect('/planoscustos/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
				$this->set('projetos', $this->Planoscusto->Projeto->generateList("Projeto.user_created = '$usuario'",'id desc', null, '{n}.Projeto.id', '{n}.Projeto.ds_titulo'));
			}
		}
	}

	function delete($id = null) {
		$this->checkAcess();
    if(!$id) {
			$this->Session->setFlash('ID inválido para Planoscusto');
			$this->redirect('/planoscustos/index');
		}
		if($this->Planoscusto->del($id)) {
			$this->Session->setFlash('Plano de custo Excluído: id '.$id.'');
			$this->redirect('/planoscustos/index');
		}
	}

}
?>
