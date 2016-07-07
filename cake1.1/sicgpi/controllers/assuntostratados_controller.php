<?php
class AssuntostratadosController extends AppController {

	var $name = 'Assuntostratados';
	var $helpers = array('Html', 'Form' , 'Ajax', 'Javascript');

	function index() {
        $this->checkAcess();
		$this->Assuntostratado->recursive = 0;
		$this->set('assuntostratados', $this->Assuntostratado->findAll());
	}

	function view($id = null) {
        $this->checkAcess();
        if(!$id) {
			$this->Session->setFlash('ID inválido para Assuntostratado.');
			$this->redirect('/assuntostratados/index');
		}
		$this->set('assuntostratado', $this->Assuntostratado->read(null, $id));
	}

	function add() {
        $this->checkAcess();
        if(empty($this->data)) {
			$this->set('atasreunioes', $this->Assuntostratado->Atasreuniao->generateList(null,'ds_ata_reuniao', null, '{n}.Atasreuniao.id', '{n}.Atasreuniao.ds_ata_reuniao'));
			$this->render();
		} else {
			$this->cleanUpFields();
			if($this->Assuntostratado->save($this->data)) {
				$this->Session->setFlash('Assunto tratado inserido com sucesso.');
				$this->redirect('/assuntostratados/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
				$this->set('atasreunioes', $this->Assuntostratado->Atasreuniao->generateList(null,'ds_ata_reuniao', null, '{n}.Atasreuniao.id', '{n}.Atasreuniao.ds_ata_reuniao'));
			}
		}
	}

	function edit($id = null) {
        $this->checkAcess();
        if(empty($this->data)) {
			if(!$id) {
				$this->Session->setFlash('Id inválido para Assuntostratado');
				$this->redirect('/assuntostratados/index');
			}
			$this->data = $this->Assuntostratado->read(null, $id);
			$this->set('atasreunioes', $this->Assuntostratado->Atasreuniao->generateList(null,'ds_ata_reuniao', null, '{n}.Atasreuniao.id', '{n}.Atasreuniao.ds_ata_reuniao'));
		} else {
			$this->cleanUpFields();
			if($this->Assuntostratado->save($this->data)) {
				$this->Session->setFlash('Assunto tratado editado com sucesso.');
				$this->redirect('/assuntostratados/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
				$this->set('atasreunioes', $this->Assuntostratado->Atasreuniao->generateList(null,'ds_ata_reuniao', null, '{n}.Atasreuniao.id', '{n}.Atasreuniao.ds_ata_reuniao'));
			}
		}
	}

	function delete($id = null) {
        $this->checkAcess();
        if(!$id) {
			$this->Session->setFlash('ID inválido para Assuntostratado');
			$this->redirect('/assuntostratados/index');
		}
		if($this->Assuntostratado->del($id)) {
			$this->Session->setFlash('Assunto tratado Excluído: id '.$id.'');
			$this->redirect('/assuntostratados/index');
		}
	}

}
?>
