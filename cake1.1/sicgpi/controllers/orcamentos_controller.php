<?php
class OrcamentosController extends AppController {

	var $name = 'Orcamentos';
	var $helpers = array('Html', 'Form' , 'Ajax', 'Javascript');

	function index() {
    $this->checkAcess();
    $usuario = $_SESSION['Usuario'];
		$this->Orcamento->recursive = 0;
		$this->set('orcamentos', $this->Orcamento->findAll("Orcamento.user_created = '$usuario'",'','Orcamento.id desc'));
	}

	function view($id = null) {
		$this->checkAcess();
    if(!$id) {
			$this->Session->setFlash('ID inválido para Orcamento.');
			$this->redirect('/orcamentos/index');
		}
		$this->set('orcamento', $this->Orcamento->read(null, $id));
	}

	function add() {
    $this->checkAcess();
    $usuario = $_SESSION['Usuario'];
		if(empty($this->data)) {
			$this->set('atividades', $this->Orcamento->Atividade->generateList("Atividade.user_created = '$usuario'",'projeto_id desc', null, '{n}.Atividade.id', '{n}.Atividade.ds_atividade'));
			$this->set('selectedAtividades', null);
			$this->set('recursos', $this->Orcamento->Recurso->generateList("Recurso.user_created = '$usuario'",'projeto_id desc', null, '{n}.Recurso.id', '{n}.Recurso.ds_recurso'));
			$this->set('selectedRecursos', null);
			$this->set('projetos', $this->Orcamento->Projeto->generateList("Projeto.user_created = '$usuario'",'id desc', null, '{n}.Projeto.id', '{n}.Projeto.ds_titulo'));
			$this->render();
		} else {
			$this->cleanUpFields();
			if($this->Orcamento->save($this->data)) {
				$this->Session->setFlash('Orçamento inserido com sucesso.');
				$this->redirect('/orcamentos/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
				$this->set('atividades', $this->Orcamento->Atividade->generateList("Atividade.user_created = '$usuario'",'projeto_id desc', null, '{n}.Atividade.id', '{n}.Atividade.ds_atividade'));
				if(empty($this->data['Atividade']['Atividade'])) { $this->data['Atividade']['Atividade'] = null; }
				$this->set('selectedAtividades', $this->data['Atividade']['Atividade']);
				$this->set('recursos', $this->Orcamento->Recurso->generateList("Recurso.user_created = '$usuario'",'projeto_id desc', null, '{n}.Recurso.id', '{n}.Recurso.ds_recurso'));
				if(empty($this->data['Recurso']['Recurso'])) { $this->data['Recurso']['Recurso'] = null; }
				$this->set('selectedRecursos', $this->data['Recurso']['Recurso']);
				$this->set('projetos', $this->Orcamento->Projeto->generateList("Projeto.user_created = '$usuario'",'id desc', null, '{n}.Projeto.id', '{n}.Projeto.ds_titulo'));
			}
		}
	}

	function edit($id = null) {
    $this->checkAcess();
    $usuario = $_SESSION['Usuario'];
		if(empty($this->data)) {
			if(!$id) {
				$this->Session->setFlash('Id inválido para Orcamento');
				$this->redirect('/orcamentos/index');
			}
			$this->data = $this->Orcamento->read(null, $id);
			$this->set('atividades', $this->Orcamento->Atividade->generateList("Atividade.user_created = '$usuario'",'projeto_id desc', null, '{n}.Atividade.id', '{n}.Atividade.ds_atividade'));
			if(empty($this->data['Atividade'])) { $this->data['Atividade'] = null; }
			$this->set('selectedAtividades', $this->_selectedArray($this->data['Atividade']));
			$this->set('recursos', $this->Orcamento->Recurso->generateList("Recurso.user_created = '$usuario'",'projeto_id desc ', null, '{n}.Recurso.id', '{n}.Recurso.ds_recurso'));
			if(empty($this->data['Recurso'])) { $this->data['Recurso'] = null; }
			$this->set('selectedRecursos', $this->_selectedArray($this->data['Recurso']));
			$this->set('projetos', $this->Orcamento->Projeto->generateList("Projeto.user_created = '$usuario'",'id desc', null, '{n}.Projeto.id', '{n}.Projeto.ds_titulo'));
		} else {
			$this->cleanUpFields();
			if($this->Orcamento->save($this->data)) {
                $this->Orcamento->valorCusto($this->data['Orcamento']['id']);
				$this->Session->setFlash('Orçamento editado com sucesso.');
				$this->redirect('/orcamentos/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
				$this->set('atividades', $this->Orcamento->Atividade->generateList("Atividade.user_created = '$usuario'",'projeto_id desc', null, '{n}.Atividade.id', '{n}.Atividade.ds_atividade'));
				if(empty($this->data['Atividade']['Atividade'])) { $this->data['Atividade']['Atividade'] = null; }
				$this->set('selectedAtividades', $this->data['Atividade']['Atividade']);
				$this->set('recursos', $this->Orcamento->Recurso->generateList("Recurso.user_created = '$usuario'",'projeto_id desc', null, '{n}.Recurso.id', '{n}.Recurso.ds_recurso'));
				if(empty($this->data['Recurso']['Recurso'])) { $this->data['Recurso']['Recurso'] = null; }
				$this->set('selectedRecursos', $this->data['Recurso']['Recurso']);
				$this->set('projetos', $this->Orcamento->Projeto->generateList("Projeto.user_created = '$usuario'",'id desc', null, '{n}.Projeto.id', '{n}.Projeto.ds_titulo'));
			}
		}
	}

	function delete($id = null) {
		$this->checkAcess();
    if(!$id) {
			$this->Session->setFlash('ID inválido para Orcamento');
			$this->redirect('/orcamentos/index');
		}
		if($this->Orcamento->del($id)) {
			$this->Session->setFlash('Orçamento Excluído: id '.$id.'');
			$this->redirect('/orcamentos/index');
		}
	}

}
?>
