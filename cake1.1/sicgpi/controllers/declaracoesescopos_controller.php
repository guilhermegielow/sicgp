<?php
class DeclaracoesescoposController extends AppController {

	var $name = 'Declaracoesescopos';
	var $helpers = array('Html', 'Form' , 'Ajax', 'Javascript');

	function index() {
    $this->checkAcess();
    $usuario = $_SESSION['Usuario'];
		$this->Declaracoesescopo->recursive = 0;
		$this->set('declaracoesescopos', $this->Declaracoesescopo->findAll("Declaracoesescopo.user_created = '$usuario'", '',
        'Declaracoesescopo.id desc'));
	}

	function view($id = null) {
		$this->checkAcess();
    if(!$id) {
			$this->Session->setFlash('ID inválido para Declaracoesescopo.');
			$this->redirect('/declaracoesescopos/index');
		}
		$this->set('declaracoesescopo', $this->Declaracoesescopo->read(null, $id));
	}

	function add() {
    $this->checkAcess();
    $usuario = $_SESSION['Usuario'];
		if(empty($this->data)) {
			$this->set('departamentos', $this->Declaracoesescopo->Departamento->generateList(null,'ds_departamento', null, '{n}.Departamento.id', '{n}.Departamento.ds_departamento'));
			$this->set('selectedDepartamentos', null);
			$this->set('usuarios', $this->Declaracoesescopo->Usuario->generateList(null,'nm_usuario', null, '{n}.Usuario.id', '{n}.Usuario.nm_usuario'));
			$this->set('selectedUsuarios', null);
			$this->set('projetos', $this->Declaracoesescopo->Projeto->generateList("Projeto.user_created = '$usuario'",'id desc', null, '{n}.Projeto.id', '{n}.Projeto.ds_titulo'));
			$this->render();
		} else {
			$this->cleanUpFields();
			if($this->Declaracoesescopo->save($this->data)) {
				$this->Session->setFlash('Declaração de escopo inserida com sucesso.');
				$this->redirect('/declaracoesescopos/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
				$this->set('departamentos', $this->Declaracoesescopo->Departamento->generateList(null,'ds_departamento', null, '{n}.Departamento.id', '{n}.Departamento.ds_departamento'));
				if(empty($this->data['Departamento']['Departamento'])) { $this->data['Departamento']['Departamento'] = null; }
				$this->set('selectedDepartamentos', $this->data['Departamento']['Departamento']);
				$this->set('usuarios', $this->Declaracoesescopo->Usuario->generateList(null,'nm_usuario', null, '{n}.Usuario.id', '{n}.Usuario.nm_usuario'));
				if(empty($this->data['Usuario']['Usuario'])) { $this->data['Usuario']['Usuario'] = null; }
				$this->set('selectedUsuarios', $this->data['Usuario']['Usuario']);
				$this->set('projetos', $this->Declaracoesescopo->Projeto->generateList("Projeto.user_created = '$usuario'",'id desc', null, '{n}.Projeto.id', '{n}.Projeto.ds_titulo'));
			}
		}
	}

	function edit($id = null) {
    $this->checkAcess();
    $usuario = $_SESSION['Usuario'];
		if(empty($this->data)) {
			if(!$id) {
				$this->Session->setFlash('Id inválido para Declaracoesescopo');
				$this->redirect('/declaracoesescopos/index');
			}
			$this->data = $this->Declaracoesescopo->read(null, $id);
			$this->set('departamentos', $this->Declaracoesescopo->Departamento->generateList(null,'ds_departamento', null, '{n}.Departamento.id', '{n}.Departamento.ds_departamento'));
			if(empty($this->data['Departamento'])) { $this->data['Departamento'] = null; }
			$this->set('selectedDepartamentos', $this->_selectedArray($this->data['Departamento']));
			$this->set('usuarios', $this->Declaracoesescopo->Usuario->generateList(null,'nm_usuario', null, '{n}.Usuario.id', '{n}.Usuario.nm_usuario'));
			if(empty($this->data['Usuario'])) { $this->data['Usuario'] = null; }
			$this->set('selectedUsuarios', $this->_selectedArray($this->data['Usuario']));
			$this->set('projetos', $this->Declaracoesescopo->Projeto->generateList("Projeto.user_created = '$usuario'",'id desc', null, '{n}.Projeto.id', '{n}.Projeto.ds_titulo'));
		} else {
			$this->cleanUpFields();
			if($this->Declaracoesescopo->save($this->data)) {
				$this->Session->setFlash('Declaração de escopo editada com sucesso.');
				$this->redirect('/declaracoesescopos/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
				$this->set('departamentos', $this->Declaracoesescopo->Departamento->generateList(null,'ds_departamento', null, '{n}.Departamento.id', '{n}.Departamento.ds_departamento'));
				if(empty($this->data['Departamento']['Departamento'])) { $this->data['Departamento']['Departamento'] = null; }
				$this->set('selectedDepartamentos', $this->data['Departamento']['Departamento']);
				$this->set('usuarios', $this->Declaracoesescopo->Usuario->generateList(null,'nm_usuario', null, '{n}.Usuario.id', '{n}.Usuario.nm_usuario'));
				if(empty($this->data['Usuario']['Usuario'])) { $this->data['Usuario']['Usuario'] = null; }
				$this->set('selectedUsuarios', $this->data['Usuario']['Usuario']);
				$this->set('projetos', $this->Declaracoesescopo->Projeto->generateList("Projeto.user_created = '$usuario'",'id desc', null, '{n}.Projeto.id', '{n}.Projeto.ds_titulo'));
			}
		}
	}

	function delete($id = null) {
		$this->checkAcess();
    if(!$id) {
			$this->Session->setFlash('ID inválido para Declaracoesescopo');
			$this->redirect('/declaracoesescopos/index');
		}
		if($this->Declaracoesescopo->del($id)) {
			$this->Session->setFlash('Declaração de escopo Excluída: id '.$id.'');
			$this->redirect('/declaracoesescopos/index');
		}
	}

}
?>
