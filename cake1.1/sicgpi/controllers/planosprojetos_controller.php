<?php
class PlanosprojetosController extends AppController {

	var $name = 'Planosprojetos';
	var $helpers = array('Html', 'Form' , 'Ajax', 'Javascript');

	function index() {
    $this->checkAcess();
    $usuario = $_SESSION['Usuario'];
		$this->Planosprojeto->recursive = 0;
		$this->set('planosprojetos', $this->Planosprojeto->findAll("Planosprojeto.user_created = '$usuario'",'','Planosprojeto.id desc'));
	}

	function view($id = null) {
    $this->checkAcess();
    $usuario = $_SESSION['Usuario'];
    if(!$id) {
			$this->Session->setFlash('ID inválido para Planosprojeto.');
			$this->redirect('/planosprojetos/index');
		}
		$this->set('planosprojeto', $this->Planosprojeto->read(null, $id));
	}

	function add() {
    $this->checkAcess();
    $usuario = $_SESSION['Usuario'];
		if(empty($this->data)) {
			$this->set('usuarios', $this->Planosprojeto->Usuario->generateList(null,'nm_usuario', null, '{n}.Usuario.id', '{n}.Usuario.nm_usuario'));
			$this->set('selectedUsuarios', null);
			$this->set('projetos', $this->Planosprojeto->Projeto->generateList("Projeto.user_created = '$usuario'",'id desc', null, '{n}.Projeto.id', '{n}.Projeto.ds_titulo'));
			$this->render();
		} else {
			$this->cleanUpFields();
			if($this->Planosprojeto->save($this->data)) {
				$this->Session->setFlash('Plano de projeto inserido com sucesso.');
				$this->redirect('/planosprojetos/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
				$this->set('usuarios', $this->Planosprojeto->Usuario->generateList(null,'nm_usuario', null, '{n}.Usuario.id', '{n}.Usuario.nm_usuario'));
				if(empty($this->data['Usuario']['Usuario'])) { $this->data['Usuario']['Usuario'] = null; }
				$this->set('selectedUsuarios', $this->data['Usuario']['Usuario']);
				$this->set('projetos', $this->Planosprojeto->Projeto->generateList("Projeto.user_created = '$usuario'",'id desc', null, '{n}.Projeto.id', '{n}.Projeto.ds_titulo'));
			}
		}
	}

	function edit($id = null) {
    $this->checkAcess();
    $usuario = $_SESSION['Usuario'];
		if(empty($this->data)) {
			if(!$id) {
				$this->Session->setFlash('Id inválido para Planosprojeto');
				$this->redirect('/planosprojetos/index');
			}
			$this->data = $this->Planosprojeto->read(null, $id);
			$this->set('usuarios', $this->Planosprojeto->Usuario->generateList(null,'nm_usuario', null, '{n}.Usuario.id', '{n}.Usuario.nm_usuario'));
			if(empty($this->data['Usuario'])) { $this->data['Usuario'] = null; }
			$this->set('selectedUsuarios', $this->_selectedArray($this->data['Usuario']));
			$this->set('projetos', $this->Planosprojeto->Projeto->generateList("Projeto.user_created = '$usuario'",'id desc', null, '{n}.Projeto.id', '{n}.Projeto.ds_titulo'));
		} else {
			$this->cleanUpFields();
			if($this->Planosprojeto->save($this->data)) {
				$this->Session->setFlash('Plano de projeto editado com sucesso.');
				$this->redirect('/planosprojetos/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
				$this->set('usuarios', $this->Planosprojeto->Usuario->generateList(null,'nm_usuario', null, '{n}.Usuario.id', '{n}.Usuario.nm_usuario'));
				if(empty($this->data['Usuario']['Usuario'])) { $this->data['Usuario']['Usuario'] = null; }
				$this->set('selectedUsuarios', $this->data['Usuario']['Usuario']);
				$this->set('projetos', $this->Planosprojeto->Projeto->generateList("Projeto.user_created = '$usuario'",'id desc', null, '{n}.Projeto.id', '{n}.Projeto.ds_titulo'));
			}
		}
	}

	function delete($id = null) {
		$this->checkAcess();
    if(!$id) {
			$this->Session->setFlash('ID inválido para Planosprojeto');
			$this->redirect('/planosprojetos/index');
		}
		if($this->Planosprojeto->del($id)) {
			$this->Session->setFlash('Plano de projeto Excluído: id '.$id.'');
			$this->redirect('/planosprojetos/index');
		}
	}

}
?>
