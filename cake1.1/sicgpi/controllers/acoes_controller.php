<?php
class AcoesController extends AppController {

	var $name = 'Acoes';
	var $helpers = array('Html', 'Form' , 'Ajax', 'Javascript');

	function index() {
        $this->pageTitle = 'Ação';
        $this->checkAcess();
        $this->Acao->recursive = 0;
		$this->set('acoes', $this->Acao->findAll());
	}

	function view($id = null) {
        $this->pageTitle = 'Ação';
        $this->checkAcess();
		if(!$id) {
			$this->Session->setFlash('ID inválido para Acao.');
			$this->redirect('/acoes/index');
		}
		$this->set('acao', $this->Acao->read(null, $id));
	}

	function add() {
	    $this->pageTitle = 'Ação';
        $this->checkAcess();
		if(empty($this->data)) {
			$this->set('usuarios', $this->Acao->Usuario->generateList(null,'ds_usuario',null,'{n}.Usuario.id','{n}.Usuario.ds_usuario'));
			$this->set('selectedUsuarios', null);
			$this->set('atasreunioes', $this->Acao->Atasreuniao->generateList(null,'ds_ata_reuniao',null,'{n}.Atasreuniao.id','{n}.Atasreuniao.ds_ata_reuniao'));
			$this->render();
		} else {
			$this->cleanUpFields();
			if($this->Acao->save($this->data)) {
				$this->Session->setFlash('Ação inserida com sucesso.');
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
	    $this->pageTitle = 'Ação';
        $this->checkAcess();
		if(empty($this->data)) {
			if(!$id) {
				$this->Session->setFlash('Id inválido para Acao');
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
				$this->Session->setFlash('Ação editada com sucesso.');
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
			$this->Session->setFlash('ID inválido para Acao');
			$this->redirect('/acoes/index');
		}
		if($this->Acao->del($id)) {
			$this->Session->setFlash('Ação Excluída: id '.$id.'');
			$this->redirect('/acoes/index');
		}
	}

}
?>
