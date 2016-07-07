<?php
class ProjetosController extends AppController {

	var $name = 'Projetos';
	var $helpers = array('Html', 'Form' , 'Ajax', 'Javascript', 'Time');
	var $uses = array('Usuario','Atividade', 'Elementoseap', 'Departamento', 'Projeto');

	function index() {
    $this->checkAcess();
    $usuario = $_SESSION['Usuario'];
    $this->Projeto->recursive = 0;
		$this->set('projetos', $this->Projeto->findAll("Projeto.user_created = '$usuario'", '',
        'Projeto.id desc'));
	}

	function view($id = null) {
    $this->checkAcess();
		if(!$id) {
			$this->Session->setFlash('ID inválido para Projeto.');
			$this->redirect('/projetos/index');
		}
		$this->set('projeto', $this->Projeto->read(null, $id));
	}

	function add() {
    $this->checkAcess();
    if(empty($this->data)) {
			$this->set('estados', $this->Projeto->Estado->generateList('id = 1','ds_estado', null, '{n}.Estado.id', '{n}.Estado.ds_estado'));
			$this->set('usuarios', $this->Projeto->Usuario->generateList(null,'nm_usuario', null, '{n}.Usuario.id', '{n}.Usuario.nm_usuario'));
			$this->render();
		} else {
			$this->cleanUpFields();
			if($this->Projeto->save($this->data)) {
				$this->Session->setFlash('Projeto inserido com sucesso.');
				$this->redirect('/projetos/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
				$this->set('estados', $this->Projeto->Estado->generateList(null,'ds_estado', null, '{n}.Estado.id', '{n}.Estado.ds_estado'));
				$this->set('usuarios', $this->Projeto->Usuario->generateList(null,'nm_usuario', null, '{n}.Usuario.id', '{n}.Usuario.nm_usuario'));
			}
		}
	}

	function edit($id = null) {
    $this->checkAcess();
    if(empty($this->data)) {
			if(!$id) {
				$this->Session->setFlash('Id inválido para Projeto');
				$this->redirect('/projetos/index');
			}
			$this->data = $this->Projeto->read(null, $id);
			$this->set('estados', $this->Projeto->Estado->generateList('id  > 1','id', null, '{n}.Estado.id', '{n}.Estado.ds_estado'));
			$this->set('usuarios', $this->Projeto->Usuario->generateList(null,'nm_usuario', null, '{n}.Usuario.id', '{n}.Usuario.nm_usuario'));
		} else {
			$this->cleanUpFields();
			if($this->Projeto->save($this->data)) {
				$this->Session->setFlash('Projeto editado com sucesso.');
				$this->redirect('/projetos/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
				$this->set('estados', $this->Projeto->Estado->generateList(null,'ds_estado', null, '{n}.Estado.id', '{n}.Estado.ds_estado'));
				$this->set('usuarios', $this->Projeto->Usuario->generateList(null,'nm_usuario', null, '{n}.Usuario.id', '{n}.Usuario.nm_usuario'));
			}
		}
	}
    function relatoriocusto($id){
		if(!$id) {
			$this->Session->setFlash('ID inválido para Projeto.');
			$this->redirect('/projetos/index');
		}
		$this->set('projeto', $this->Projeto->read(null, $id));
		$relatoriocusto = $this->Projeto->tempoCusto($id);
		$this->set('relatoriocusto', $relatoriocusto);
	}
	function delete($id = null) {
    $this->checkAcess();
    if(!$id) {
			$this->Session->setFlash('ID inválido para Projeto');
			$this->redirect('/projetos/index');
		}
		if($this->Projeto->del($id)) {
			$this->Session->setFlash('Projeto Excluído: id '.$id.'');
			$this->redirect('/projetos/index');
		}
	}

}
?>
