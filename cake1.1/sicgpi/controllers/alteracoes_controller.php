<?php
class AlteracoesController extends AppController {

	var $name = 'Alteracoes';
	var $helpers = array('Html', 'Form' , 'Ajax', 'Javascript');

	function index() {
        $this->checkAcess();
        $this->Alteracao->recursive = 0;
		$this->set('alteracoes', $this->Alteracao->findAll());
	}

	function view($id = null) {
        $this->checkAcess();
        if(!$id) {
			$this->Session->setFlash('ID inv�lido para Alteracao.');
			$this->redirect('/alteracoes/index');
		}
		$this->set('alteracao', $this->Alteracao->read(null, $id));
	}

	function add() {
        $this->checkAcess();
        if(empty($this->data)) {
			$this->set('planosprojetos', $this->Alteracao->Planosprojeto->generateList(null,'ds_plano_projeto', null, '{n}.Planosprojeto.id', '{n}.Planosprojeto.ds_plano_projeto'));
			$this->render();
		} else {
			$this->cleanUpFields();
			if($this->Alteracao->save($this->data)) {
				$this->Session->setFlash('Altera��o inserida com sucesso.');
				$this->redirect('/alteracoes/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
				$this->set('planosprojetos', $this->Alteracao->Planosprojeto->generateList(null,'ds_plano_projeto', null, '{n}.Planosprojeto.id', '{n}.Planosprojeto.ds_plano_projeto'));
			}
		}
	}

	function edit($id = null) {
        $this->checkAcess();
        if(empty($this->data)) {
			if(!$id) {
				$this->Session->setFlash('Id inv�lido para Alteracao');
				$this->redirect('/alteracoes/index');
			}
			$this->data = $this->Alteracao->read(null, $id);
			$this->set('planosprojetos', $this->Alteracao->Planosprojeto->generateList(null,'ds_plano_projeto', null, '{n}.Planosprojeto.id', '{n}.Planosprojeto.ds_plano_projeto'));
		} else {
			$this->cleanUpFields();
			if($this->Alteracao->save($this->data)) {
				$this->Session->setFlash('Altera��o editada com sucesso.');
				$this->redirect('/alteracoes/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
				$this->set('planosprojetos', $this->Alteracao->Planosprojeto->generateList(null,'ds_plano_projeto', null, '{n}.Planosprojeto.id', '{n}.Planosprojeto.ds_plano_projeto'));
			}
		}
	}

	function delete($id = null) {
        $this->checkAcess();
        if(!$id) {
			$this->Session->setFlash('ID inv�lido para Alteracao');
			$this->redirect('/alteracoes/index');
		}
		if($this->Alteracao->del($id)) {
			$this->Session->setFlash('AAltera��o Exclu�da: id '.$id.'');
			$this->redirect('/alteracoes/index');
		}
	}

}
?>
