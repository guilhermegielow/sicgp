<?php
class AcoesrelatoriosController extends AppController {

	var $name = 'Acoesrelatorios';
	var $helpers = array('Html', 'Form' , 'Ajax', 'Javascript');

	function index() {
	    $this->pageTitle = 'A��o de relat�rio';
        $this->checkAcess();
		$this->Acoesrelatorio->recursive = 0;
		$this->set('acoesrelatorios', $this->Acoesrelatorio->findAll());
	}

	function view($id = null) {
	    $this->pageTitle = 'A��o de relat�rio';
        $this->checkAcess();
		if(!$id) {
			$this->Session->setFlash('ID inv�lido para Acoesrelatorio.');
			$this->redirect('/acoesrelatorios/index');
		}
		$this->set('acoesrelatorio', $this->Acoesrelatorio->read(null, $id));
	}

	function add() {
	    $this->pageTitle = 'A��o de relat�rio';
	    $this->checkAcess();
		if(empty($this->data)) {
			$this->set('usuarios', $this->Acoesrelatorio->Usuario->generateList(null,'ds_usuario', null, '{n}.Usuario.id', '{n}.Usuario.ds_usuario'));
			$this->set('selectedUsuarios', null);
			$this->set('relatoriosdesempenhos', $this->Acoesrelatorio->Relatoriosdesempenho->generateList(null,'ds_relatorio_desempenho',null,'{n}.Relatoriosdesempenho.id','{n}.Relatoriosdesempenho.ds_relatorio_desempenho'));
			$this->render();
		} else {
			$this->cleanUpFields();
			if($this->Acoesrelatorio->save($this->data)) {
				$this->Session->setFlash('A��o do relat�rio inserida com sucesso.');
				$this->redirect('/acoesrelatorios/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
				$this->set('usuarios', $this->Acoesrelatorio->Usuario->generateList(null,'ds_usuario', null, '{n}.Usuario.id', '{n}.Usuario.ds_usuario'));
				if(empty($this->data['Usuario']['Usuario'])) { $this->data['Usuario']['Usuario'] = null; }
				$this->set('selectedUsuarios', $this->data['Usuario']['Usuario']);
				$this->set('relatoriosdesempenhos', $this->Acoesrelatorio->Relatoriosdesempenho->generateList(null,'ds_relatorio_desempenho',null,'{n}.Relatoriosdesempenho.id','{n}.Relatoriosdesempenho.ds_relatorio_desempenho'));
			}
		}
	}

	function edit($id = null) {
	    $this->pageTitle = 'A��o de relat�rio';
	    $this->checkAcess();
		if(empty($this->data)) {
			if(!$id) {
				$this->Session->setFlash('Id inv�lido para Acoesrelatorio');
				$this->redirect('/acoesrelatorios/index');
			}
			$this->data = $this->Acoesrelatorio->read(null, $id);
			$this->set('usuarios', $this->Acoesrelatorio->Usuario->generateList(null,'ds_usuario', null, '{n}.Usuario.id', '{n}.Usuario.ds_usuario'));
			if(empty($this->data['Usuario'])) { $this->data['Usuario'] = null; }
			$this->set('selectedUsuarios', $this->_selectedArray($this->data['Usuario']));
			$this->set('relatoriosdesempenhos', $this->Acoesrelatorio->Relatoriosdesempenho->generateList(null,'ds_relatorio_desempenho',null,'{n}.Relatoriosdesempenho.id','{n}.Relatoriosdesempenho.ds_relatorio_desempenho'));
		} else {
			$this->cleanUpFields();
			if($this->Acoesrelatorio->save($this->data)) {
				$this->Session->setFlash('A��o do Relat�rio editada com sucesso.');
				$this->redirect('/acoesrelatorios/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
				$this->set('usuarios', $this->Acoesrelatorio->Usuario->generateList(null,'ds_usuario', null, '{n}.Usuario.id', '{n}.Usuario.ds_usuario'));
				if(empty($this->data['Usuario']['Usuario'])) { $this->data['Usuario']['Usuario'] = null; }
				$this->set('selectedUsuarios', $this->data['Usuario']['Usuario']);
				$this->set('relatoriosdesempenhos', $this->Acoesrelatorio->Relatoriosdesempenho->generateList(null,'ds_relatorio_desempenho',null,'{n}.Relatoriosdesempenho.id','{n}.Relatoriosdesempenho.ds_relatorio_desempenho'));
			}
		}
	}

	function delete($id = null) {
	$this->checkAcess();
		if(!$id) {
			$this->Session->setFlash('ID inv�lido para Acoesrelatorio');
			$this->redirect('/acoesrelatorios/index');
		}
		if($this->Acoesrelatorio->del($id)) {
			$this->Session->setFlash('A��o do relat�rio Exclu�da: id '.$id.'');
			$this->redirect('/acoesrelatorios/index');
		}
	}

}
?>
