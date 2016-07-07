<?php
class AtasreunioesController extends AppController {

	var $name = 'Atasreunioes';
	var $helpers = array('Html', 'Form' , 'Ajax', 'Javascript');

	function index() {
    $this->checkAcess();
    $usuario = $_SESSION['Usuario'];
    $this->Atasreuniao->recursive = 0;
		$this->set('atasreunioes', $this->Atasreuniao->findAll("Atasreuniao.user_created = '$usuario'", '', 'Atasreuniao.id desc'));
	}

	function view($id = null) {
		$this->checkAcess();
    if(!$id) {
			$this->Session->setFlash('ID inválido para Atasreuniao.');
			$this->redirect('/atasreunioes/index');
		}
		$this->set('atasreuniao', $this->Atasreuniao->read(null, $id));
	}

	function add() {
    $this->checkAcess();
    $usuario = $_SESSION['Usuario'];
    if(empty($this->data)) {
			$this->set('tiposreunioes', $this->Atasreuniao->Tiposreuniao->generateList(null,'ds_tipo_reuniao', null, '{n}.Tiposreuniao.id', '{n}.Tiposreuniao.ds_tipo_reuniao'));
			$this->set('projetos', $this->Atasreuniao->Projeto->generateList("Projeto.user_created = '$usuario'",'id desc', null, '{n}.Projeto.id', '{n}.Projeto.ds_titulo'));
			$this->render();
		} else {
			$this->cleanUpFields();
			if($this->Atasreuniao->save($this->data)) {
				$this->Session->setFlash('Ata de reunião inserida com sucesso.');
				$this->redirect('/atasreunioes/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
				$this->set('tiposreunioes', $this->Atasreuniao->Tiposreuniao->generateList(null,'ds_tipo_reuniao', null, '{n}.Tiposreuniao.id', '{n}.Tiposreuniao.ds_tipo_reuniao'));
				$this->set('projetos', $this->Atasreuniao->Projeto->generateList("Projeto.user_created = '$usuario'",'id desc', null, '{n}.Projeto.id', '{n}.Projeto.ds_titulo'));
			}
		}
	}

	function edit($id = null) {
    $this->checkAcess();
    $usuario = $_SESSION['Usuario'];
    if(empty($this->data)) {
			if(!$id) {
				$this->Session->setFlash('Id inválido para Atasreuniao');
				$this->redirect('/atasreunioes/index');
			}
			$this->data = $this->Atasreuniao->read(null, $id);
			$this->set('tiposreunioes', $this->Atasreuniao->Tiposreuniao->generateList(null,'ds_tipo_reuniao', null, '{n}.Tiposreuniao.id', '{n}.Tiposreuniao.ds_tipo_reuniao'));
			$this->set('projetos', $this->Atasreuniao->Projeto->generateList("Projeto.user_created = '$usuario'",'id desc', null, '{n}.Projeto.id', '{n}.Projeto.ds_titulo'));
		} else {
			$this->cleanUpFields();
			if($this->Atasreuniao->save($this->data)) {
				$this->Session->setFlash('Ata de reunião editada com sucesso.');
				$this->redirect('/atasreunioes/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
				$this->set('tiposreunioes', $this->Atasreuniao->Tiposreuniao->generateList(null,'ds_tipo_reuniao', null, '{n}.Tiposreuniao.id', '{n}.Tiposreuniao.ds_tipo_reuniao'));
				$this->set('projetos', $this->Atasreuniao->Projeto->generateList("Projeto.user_created = '$usuario'",'id desc', null, '{n}.Projeto.id', '{n}.Projeto.ds_titulo'));
			}
		}
	}

	function delete($id = null) {
		$this->checkAcess();
    if(!$id) {
			$this->Session->setFlash('ID inválido para Atasreuniao');
			$this->redirect('/atasreunioes/index');
		}
		if($this->Atasreuniao->del($id)) {
			$this->Session->setFlash('Ata de reunião Excluída: id '.$id.'');
			$this->redirect('/atasreunioes/index');
		}
	}

}
?>
