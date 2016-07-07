<?php
class CronogramasController extends AppController {

	var $name = 'Cronogramas';
	var $helpers = array('Html', 'Form' , 'Ajax', 'Javascript');

	function index() {
    $this->checkAcess();
    $usuario = $_SESSION['Usuario'];
    $this->Cronograma->recursive = 0;
		$this->set('cronogramas', $this->Cronograma->findAll("Cronograma.user_created = '$usuario'",'','Cronograma.id desc'));
	}

	function view($id = null) {
		$this->checkAcess();
    if(!$id) {
			$this->Session->setFlash('ID inválido para Cronograma.');
			$this->redirect('/cronogramas/index');
		}
		$this->set('cronograma', $this->Cronograma->read(null, $id));
	}

	function add() {
    $this->checkAcess();
    $usuario = $_SESSION['Usuario'];
    if(empty($this->data)) {
			$this->set('atividades', $this->Cronograma->Atividade->generateList("Atividade.user_created = '$usuario'",'id desc', null, '{n}.Atividade.id', '{n}.Atividade.ds_atividade'));
			$this->set('selectedAtividades', null);
			$this->set('projetos', $this->Cronograma->Projeto->generateList("Projeto.user_created = '$usuario'",'id desc', null, '{n}.Projeto.id', '{n}.Projeto.ds_titulo'));
			$this->render();
		} else {
			$this->cleanUpFields();
			if($this->Cronograma->save($this->data)) {
				$this->Session->setFlash('Cronograma inserido com sucesso.');
				$this->redirect('/cronogramas/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
				$this->set('atividades', $this->Cronograma->Atividade->generateList("Atividade.user_created = '$usuario'",'id desc', null, '{n}.Atividade.id', '{n}.Atividade.ds_atividade'));
				if(empty($this->data['Atividade']['Atividade'])) { $this->data['Atividade']['Atividade'] = null; }
				$this->set('selectedAtividades', $this->data['Atividade']['Atividade']);
				$this->set('projetos', $this->Cronograma->Projeto->generateList("Projeto.user_created = '$usuario'",'id desc',null,'{n}.Projeto.id','{n}.Projeto.ds_titulo'));
			}
		}
	}

	function edit($id = null) {
    $this->checkAcess();
    $usuario = $_SESSION['Usuario'];
    if(empty($this->data)) {
			if(!$id) {
				$this->Session->setFlash('Id inválido para Cronograma');
				$this->redirect('/cronogramas/index');
			}
			$this->data = $this->Cronograma->read(null, $id);
			$this->set('atividades', $this->Cronograma->Atividade->generateList("Atividade.user_created = '$usuario'",'id desc', null, '{n}.Atividade.id', '{n}.Atividade.ds_atividade'));
			if(empty($this->data['Atividade'])) { $this->data['Atividade'] = null; }
			$this->set('selectedAtividades', $this->_selectedArray($this->data['Atividade']));
			$this->set('projetos', $this->Cronograma->Projeto->generateList("Projeto.user_created = '$usuario'",'id desc',null,'{n}.Projeto.id','{n}.Projeto.ds_titulo'));
		} else {
			$this->cleanUpFields();
			if($this->Cronograma->save($this->data)) {
				$this->Session->setFlash('Cronograma editado com sucesso.');
				$this->redirect('/cronogramas/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
				$this->set('atividades', $this->Cronograma->Atividade->generateList("Atividade.user_created = '$usuario'",'id desc', null, '{n}.Atividade.id', '{n}.Atividade.ds_atividade'));
				if(empty($this->data['Atividade']['Atividade'])) { $this->data['Atividade']['Atividade'] = null; }
				$this->set('selectedAtividades', $this->data['Atividade']['Atividade']);
				$this->set('projetos', $this->Cronograma->Projeto->generateList("Projeto.user_created = '$usuario'",'id desc',null,'{n}.Projeto.id','{n}.Projeto.ds_titulo'));
			}
		}
	}

	function delete($id = null) {
		$this->checkAcess();
    if(!$id) {
			$this->Session->setFlash('ID inválido para Cronograma');
			$this->redirect('/cronogramas/index');
		}
		if($this->Cronograma->del($id)) {
			$this->Session->setFlash('Cronograma Excluído: id '.$id.'');
			$this->redirect('/cronogramas/index');
		}
	}

}
?>
