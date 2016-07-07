<?php
class DepartamentosController extends AppController {

	var $name = 'Departamentos';
	var $helpers = array('Html', 'Form' , 'Ajax', 'Javascript');

	function index() {
    $this->checkAcess();
		$this->Departamento->recursive = 0;
		$this->set('departamentos', $this->Departamento->findAll());
	}

	function view($id = null) {
    $this->checkAcess();
		if(!$id) {
			$this->Session->setFlash('ID inválido para Departamento.');
			$this->redirect('/departamentos/index');
		}
		$this->set('departamento', $this->Departamento->read(null, $id));
	}

	function add() {
    $this->checkAcess();
		if(empty($this->data)) {
			$this->set('declaracoesescopos', $this->Departamento->Declaracoesescopo->generateList());
			$this->set('selectedDeclaracoesescopos', null);
			$this->render();
		} else {
			$this->cleanUpFields();
			if($this->Departamento->save($this->data)) {
				$this->Session->setFlash('Departamento inserido com sucesso.');
				$this->redirect('/departamentos/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
				$this->set('declaracoesescopos', $this->Departamento->Declaracoesescopo->generateList());
				if(empty($this->data['Declaracoesescopo']['Declaracoesescopo'])) { $this->data['Declaracoesescopo']['Declaracoesescopo'] = null; }
				$this->set('selectedDeclaracoesescopos', $this->data['Declaracoesescopo']['Declaracoesescopo']);
			}
		}
	}

	function edit($id = null) {
    $this->checkAcess();
		if(empty($this->data)) {
			if(!$id) {
				$this->Session->setFlash('Id inválido para Departamento');
				$this->redirect('/departamentos/index');
			}
			$this->data = $this->Departamento->read(null, $id);
			$this->set('declaracoesescopos', $this->Departamento->Declaracoesescopo->generateList());
			if(empty($this->data['Declaracoesescopo'])) { $this->data['Declaracoesescopo'] = null; }
			$this->set('selectedDeclaracoesescopos', $this->_selectedArray($this->data['Declaracoesescopo']));
		} else {
			$this->cleanUpFields();
			if($this->Departamento->save($this->data)) {
				$this->Session->setFlash('Departamento editado com sucesso.');
				$this->redirect('/departamentos/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
				$this->set('declaracoesescopos', $this->Departamento->Declaracoesescopo->generateList());
				if(empty($this->data['Declaracoesescopo']['Declaracoesescopo'])) { $this->data['Declaracoesescopo']['Declaracoesescopo'] = null; }
				$this->set('selectedDeclaracoesescopos', $this->data['Declaracoesescopo']['Declaracoesescopo']);
			}
		}
	}

	function delete($id = null) {
    $this->checkAcess();
		if(!$id) {
			$this->Session->setFlash('ID inválido para Departamento');
			$this->redirect('/departamentos/index');
		}
		if($this->Departamento->del($id)) {
			$this->Session->setFlash('Departamento Excluído: id '.$id.'');
			$this->redirect('/departamentos/index');
		}
	}

}
?>
