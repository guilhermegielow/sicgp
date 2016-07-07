<?php
class ServicosescoposController extends AppController {

	var $name = 'Servicosescopos';
	var $helpers = array('Html', 'Form' , 'Ajax', 'Javascript');

	function index() {
		$this->checkAcess();
    $this->Servicosescopo->recursive = 0;
		$this->set('servicosescopos', $this->Servicosescopo->findAll('','','Servicosescopo.id desc'));
	}

	function view($id = null) {
		$this->checkAcess();
    if(!$id) {
			$this->Session->setFlash('ID inválido para Servicosescopo.');
			$this->redirect('/servicosescopos/index');
		}
		$this->set('servicosescopo', $this->Servicosescopo->read(null, $id));
	}

	function add() {
		$this->checkAcess();
    if(empty($this->data)) {
			$this->set('declaracoesescopos', $this->Servicosescopo->Declaracoesescopo->generateList(null,'id desc', null, '{n}.Declaracoesescopo.id', '{n}.Declaracoesescopo.ds_declaracao_escopo'));
			$this->render();
		} else {
			$this->cleanUpFields();
			if($this->Servicosescopo->save($this->data)) {
				$this->Session->setFlash('Serviço de escopo inserido com sucesso.');
				$this->redirect('/servicosescopos/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
				$this->set('declaracoesescopos', $this->Servicosescopo->Declaracoesescopo->generateList(null,'id desc', null, '{n}.Declaracoesescopo.id', '{n}.Declaracoesescopo.ds_declaracao_escopo'));
			}
		}
	}

	function edit($id = null) {
		$this->checkAcess();
    if(empty($this->data)) {
			if(!$id) {
				$this->Session->setFlash('Id inválido para Servicosescopo');
				$this->redirect('/servicosescopos/index');
			}
			$this->data = $this->Servicosescopo->read(null, $id);
			$this->set('declaracoesescopos', $this->Servicosescopo->Declaracoesescopo->generateList(null,'id desc', null, '{n}.Declaracoesescopo.id', '{n}.Declaracoesescopo.ds_declaracao_escopo'));
		} else {
			$this->cleanUpFields();
			if($this->Servicosescopo->save($this->data)) {
				$this->Session->setFlash('Serviço de escopo editado com sucesso.');
				$this->redirect('/servicosescopos/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
				$this->set('declaracoesescopos', $this->Servicosescopo->Declaracoesescopo->generateList(null,'id desc', null, '{n}.Declaracoesescopo.id', '{n}.Declaracoesescopo.ds_declaracao_escopo'));
			}
		}
	}

	function delete($id = null) {
		$this->checkAcess();
    if(!$id) {
			$this->Session->setFlash('ID inválido para Servicosescopo');
			$this->redirect('/servicosescopos/index');
		}
		if($this->Servicosescopo->del($id)) {
			$this->Session->setFlash('Serviço de escopo Excluído: id '.$id.'');
			$this->redirect('/servicosescopos/index');
		}
	}

}
?>
