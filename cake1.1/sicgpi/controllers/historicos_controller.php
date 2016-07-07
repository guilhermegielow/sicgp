<?php
class HistoricosController extends AppController {

	var $name = 'Historicos';
	var $helpers = array('Html', 'Form' , 'Ajax', 'Javascript');

	function index() {
		$this->checkAcess();
    $this->Historico->recursive = 0;
		$this->set('historicos', $this->Historico->findAll());
	}

	function view($id = null) {
		$this->checkAcess();
    if(!$id) {
			$this->Session->setFlash('ID inválido para Historico.');
			$this->redirect('/historicos/index');
		}
		$this->set('historico', $this->Historico->read(null, $id));
	}

	function add() {
		$this->checkAcess();
    if(empty($this->data)) {
			$this->set('projetos', $this->Historico->Projeto->generateList("Projeto.user_created = '$usuario'",'ds_titulo', null, '{n}.Projeto.id', '{n}.Projeto.ds_titulo'));
			$this->set('usuarios', $this->Historico->Usuario->generateList(null,'ds_usuario', null, '{n}.Usuario.id', '{n}.Usuario.ds_usuario'));
			$this->render();
		} else {
			$this->cleanUpFields();
			if($this->Historico->save($this->data)) {
				$this->Session->setFlash('Histórico inserido com sucesso.');
				$this->redirect('/historicos/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
				$this->set('projetos', $this->Historico->Projeto->generateList("Projeto.user_created = '$usuario'",'ds_titulo', null, '{n}.Projeto.id', '{n}.Projeto.ds_titulo'));
				$this->set('usuarios', $this->Historico->Usuario->generateList(null,'ds_usuario', null, '{n}.Usuario.id', '{n}.Usuario.ds_usuario'));
			}
		}
	}

	function edit($id = null) {
		$this->checkAcess();
    if(empty($this->data)) {
			if(!$id) {
				$this->Session->setFlash('Id inválido para Historico');
				$this->redirect('/historicos/index');
			}
			$this->data = $this->Historico->read(null, $id);
			$this->set('projetos', $this->Historico->Projeto->generateList("Projeto.user_created = '$usuario'",'ds_titulo', null, '{n}.Projeto.id', '{n}.Projeto.ds_titulo'));
			$this->set('usuarios', $this->Historico->Usuario->generateList(null,'ds_usuario', null, '{n}.Usuario.id', '{n}.Usuario.ds_usuario'));
		} else {
			$this->cleanUpFields();
			if($this->Historico->save($this->data)) {
				$this->Session->setFlash('Histórico editado com sucesso.');
				$this->redirect('/historicos/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
				$this->set('projetos', $this->Historico->Projeto->generateList("Projeto.user_created = '$usuario'",'ds_titulo', null, '{n}.Projeto.id', '{n}.Projeto.ds_titulo'));
				$this->set('usuarios', $this->Historico->Usuario->generateList(null,'ds_usuario', null, '{n}.Usuario.id', '{n}.Usuario.ds_usuario'));
			}
		}
	}

	function delete($id = null) {
		$this->checkAcess();
    if(!$id) {
			$this->Session->setFlash('ID inválido para Historico');
			$this->redirect('/historicos/index');
		}
		if($this->Historico->del($id)) {
			$this->Session->setFlash('Histórico Excluído: id '.$id.'');
			$this->redirect('/historicos/index');
		}
	}

}
?>
