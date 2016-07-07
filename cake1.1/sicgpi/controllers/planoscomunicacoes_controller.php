<?php
class PlanoscomunicacoesController extends AppController {

	var $name = 'Planoscomunicacoes';
	var $helpers = array('Html', 'Form' , 'Ajax', 'Javascript');

	function index() {
    $this->checkAcess();
    $usuario = $_SESSION['Usuario'];
		$this->Planoscomunicacao->recursive = 0;
		$this->set('planoscomunicacoes', $this->Planoscomunicacao->findAll("Planoscomunicacao.user_created = '$usuario'", '','Planoscomunicacao.id desc'));
	}

	function view($id = null) {
		$this->checkAcess();
    if(!$id) {
			$this->Session->setFlash('ID inválido para Planoscomunicacao.');
			$this->redirect('/planoscomunicacoes/index');
		}
		$this->set('planoscomunicacao', $this->Planoscomunicacao->read(null, $id));
	}

	function add() {
    $this->checkAcess();
    $usuario = $_SESSION['Usuario'];
    if(empty($this->data)) {
			$this->set('projetos', $this->Planoscomunicacao->Projeto->generateList("Projeto.user_created = '$usuario'",'id desc',null,'{n}.Projeto.id','{n}.Projeto.ds_titulo'));
			$this->render();
		} else {
			$this->cleanUpFields();
			if($this->Planoscomunicacao->save($this->data)) {
				$this->Session->setFlash('Plano de comunicação inserido com sucesso.');
				$this->redirect('/planoscomunicacoes/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
				$this->set('projetos', $this->Planoscomunicacao->Projeto->generateList("Projeto.user_created = '$usuario'",'id desc',null,'{n}.Projeto.id','{n}.Projeto.ds_titulo'));
			}
		}
	}

	function edit($id = null) {
    $this->checkAcess();
    $usuario = $_SESSION['Usuario'];
    if(empty($this->data)) {
			if(!$id) {
				$this->Session->setFlash('Id inválido para Planoscomunicacao');
				$this->redirect('/planoscomunicacoes/index');
			}
			$this->data = $this->Planoscomunicacao->read(null, $id);
			$this->set('projetos', $this->Planoscomunicacao->Projeto->generateList("Projeto.user_created = '$usuario'",'id desc',null,'{n}.Projeto.id','{n}.Projeto.ds_titulo'));
		} else {
			$this->cleanUpFields();
			if($this->Planoscomunicacao->save($this->data)) {
				$this->Session->setFlash('Plano de comunicação editado com sucesso.');
				$this->redirect('/planoscomunicacoes/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
				$this->set('projetos', $this->Planoscomunicacao->Projeto->generateList("Projeto.user_created = '$usuario'",'id desc',null,'{n}.Projeto.id','{n}.Projeto.ds_titulo'));
			}
		}
	}

	function delete($id = null) {
		$this->checkAcess();
    if(!$id) {
			$this->Session->setFlash('ID inválido para Planoscomunicacao');
			$this->redirect('/planoscomunicacoes/index');
		}
		if($this->Planoscomunicacao->del($id)) {
			$this->Session->setFlash('Plano de comunicação Excluído: id '.$id.'');
			$this->redirect('/planoscomunicacoes/index');
		}
	}

}
?>
