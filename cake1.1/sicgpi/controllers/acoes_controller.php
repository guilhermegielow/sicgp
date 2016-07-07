<?php
class AcoesController extends AppController {

	var $name = 'Acoes';
	var $helpers = array('Html', 'Form' , 'Ajax', 'Javascript');

	function index() {
        $this->pageTitle = 'A��o';
        $this->checkAcess();
        $this->Acao->recursive = 0;
		$this->set('acoes', $this->Acao->findAll());
	}

	function view($id = null) {
        $this->pageTitle = 'A��o';
        $this->checkAcess();
		if(!$id) {
			$this->Session->setFlash('ID inv�lido para Acao.');
			$this->redirect('/acoes/index');
		}
		$this->set('acao', $this->Acao->read(null, $id));
	}

	function add() {
	    $this->pageTitle = 'A��o';
        $this->checkAcess();
		if(empty($this->data)) {
			$this->set('usuarios', $this->Acao->Usuario->generateList(null,'ds_usuario',null,'{n}.Usuario.id','{n}.Usuario.ds_usuario'));
			$this->set('selectedUsuarios', null);
			$this->set('atasreunioes', $this->Acao->Atasreuniao->generateList(null,'ds_ata_reuniao',null,'{n}.Atasreuniao.id','{n}.Atasreuniao.ds_ata_reuniao'));
			$this->render();
		} else {
			$this->cleanUpFields();
			if($this->Acao->save($this->data)) {
				$this->Session->setFlash('A��o inserida com sucesso.');
				$this->redirect('/acoes/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
				$this->set('usuarios', $this->Acao->Usuario->generateList(null,'ds_usuario',null,'{n}.Usuario.id','{n}.Usuario.ds_usuario'));
				if(empty($this->data['Usuario']['Usuario'])) { $this->data['Usuario']['Usuario'] = null; }
				$this->set('selectedUsuarios', $this->data['Usuario']['Usuario']);
				$this->set('atasreunioes', $this->Acao->Atasreuniao->generateList(null,'ds_ata_reuniao',null,'{n}.Atasreuniao.id','{n}.Atasreuniao.ds_ata_reuniao'));
			}
		}
	}

	function edit($id = null) {
	    $this->pageTitle = 'A��o';
        $this->checkAcess();
		if(empty($this->data)) {
			if(!$id) {
				$this->Session->setFlash('Id inv�lido para Acao');
				$this->redirect('/acoes/index');
			}
			$this->data = $this->Acao->read(null, $id);
			$this->set('usuarios', $this->Acao->Usuario->generateList(null,'ds_usuario',null,'{n}.Usuario.id','{n}.Usuario.ds_usuario'));
			if(empty($this->data['Usuario'])) { $this->data['Usuario'] = null; }
			$this->set('selectedUsuarios', $this->_selectedArray($this->data['Usuario']));
			$this->set('atasreunioes', $this->Acao->Atasreuniao->generateList(null,'ds_ata_reuniao',null,'{n}.Atasreuniao.id','{n}.Atasreuniao.ds_ata_reuniao'));
		} else {
			$this->cleanUpFields();
			if($this->Acao->save($this->data)) {
				$this->Session->setFlash('A��o editada com sucesso.');
				$this->redirect('/acoes/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
				$this->set('usuarios', $this->Acao->Usuario->generateList(null,'ds_usuario',null,'{n}.Usuario.id','{n}.Usuario.ds_usuario'));
				if(empty($this->data['Usuario']['Usuario'])) { $this->data['Usuario']['Usuario'] = null; }
				$this->set('selectedUsuarios', $this->data['Usuario']['Usuario']);
				$this->set('atasreunioes', $this->Acao->Atasreuniao->generateList(null,'ds_ata_reuniao',null,'{n}.Atasreuniao.id','{n}.Atasreuniao.ds_ata_reuniao'));
			}
		}
	}

	function delete($id = null) {
        $this->checkAcess();
		if(!$id) {
			$this->Session->setFlash('ID inv�lido para Acao');
			$this->redirect('/acoes/index');
		}
		if($this->Acao->del($id)) {
			$this->Session->setFlash('A��o Exclu�da: id '.$id.'');
			$this->redirect('/acoes/index');
		}
	}

}
?>
