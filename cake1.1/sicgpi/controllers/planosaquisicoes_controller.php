<?php
class PlanosaquisicoesController extends AppController {

	var $name = 'Planosaquisicoes';
	var $helpers = array('Html', 'Form' , 'Ajax', 'Javascript');

	function index() {
    $this->checkAcess();
    $usuario = $_SESSION['Usuario'];
		$this->Planosaquisicao->recursive = 0;
		$this->set('planosaquisicoes', $this->Planosaquisicao->findAll("Planosaquisicao.user_created = '$usuario'",'','Planosaquisicao.id desc'));
	}

	function view($id = null) {
		$this->checkAcess();
    if(!$id) {
			$this->Session->setFlash('ID inválido para Planosaquisicao.');
			$this->redirect('/planosaquisicoes/index');
		}
		$this->set('planosaquisicao', $this->Planosaquisicao->read(null, $id));
	}

	function add() {
    $this->checkAcess();
    $usuario = $_SESSION['Usuario'];
    if(empty($this->data)) {
			$this->set('projetos', $this->Planosaquisicao->Projeto->generateList("Projeto.user_created = '$usuario'",'id desc', null, '{n}.Projeto.id', '{n}.Projeto.ds_titulo'));
			$this->render();
		} else {
			$this->cleanUpFields();
			if($this->Planosaquisicao->save($this->data)) {
				$this->Session->setFlash('Plano de aquisição inserido com sucesso.');
				$this->redirect('/planosaquisicoes/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
				$this->set('projetos', $this->Planosaquisicao->Projeto->generateList("Projeto.user_created = '$usuario'",'ds_titulo', null, '{n}.Projeto.id', '{n}.Projeto.ds_titulo'));
			}
		}
	}

	function edit($id = null) {
    $this->checkAcess();
    $usuario = $_SESSION['Usuario'];
    if(empty($this->data)) {
			if(!$id) {
				$this->Session->setFlash('Id inválido para Planosaquisicao');
				$this->redirect('/planosaquisicoes/index');
			}
			$this->data = $this->Planosaquisicao->read(null, $id);
			$this->set('projetos', $this->Planosaquisicao->Projeto->generateList("Projeto.user_created = '$usuario'",'ds_titulo', null, '{n}.Projeto.id', '{n}.Projeto.ds_titulo'));
		} else {
			$this->cleanUpFields();
			if($this->Planosaquisicao->save($this->data)) {
				$this->Session->setFlash('Plano de aquisição editado com sucesso.');
				$this->redirect('/planosaquisicoes/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
				$this->set('projetos', $this->Planosaquisicao->Projeto->generateList("Projeto.user_created = '$usuario'",'ds_titulo', null, '{n}.Projeto.id', '{n}.Projeto.ds_titulo'));
			}
		}
	}

	function delete($id = null) {
		$this->checkAcess();
    if(!$id) {
			$this->Session->setFlash('ID inválido para Planosaquisicao');
			$this->redirect('/planosaquisicoes/index');
		}
		if($this->Planosaquisicao->del($id)) {
			$this->Session->setFlash('Plano de aquisição Excluído: id '.$id.'');
			$this->redirect('/planosaquisicoes/index');
		}
	}

}
?>
