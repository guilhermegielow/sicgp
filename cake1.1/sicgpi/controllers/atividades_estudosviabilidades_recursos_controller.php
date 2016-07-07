<?php
class AtividadesEstudosviabilidadesRecursosController extends AppController {

	var $name = 'AtividadesEstudosviabilidadesRecursos';
	var $helpers = array('Html', 'Form' , 'Ajax', 'Javascript');

	function index() {
		$this->checkAcess();
    $this->AtividadesEstudosviabilidadesRecurso->recursive = 0;
		$this->set('atividadesEstudosviabilidadesRecursos', $this->AtividadesEstudosviabilidadesRecurso->findAll('', '',
        'AtividadesEstudosviabilidadesRecurso.id desc'));
	}

	function view($id = null) {
    if(!$id) {
			$this->Session->setFlash('ID inválido para Atividades Estudosviabilidades Recurso.');
			$this->redirect('/atividades_estudosviabilidades_recursos/index');
		}
		$this->set('atividadesEstudosviabilidadesRecurso', $this->AtividadesEstudosviabilidadesRecurso->read(null, $id));
	}

	function add() {
    $usuario = $_SESSION['Usuario'];
    $this->checkAcess();
    if(empty($this->data)) {
			$this->set('recursos', $this->AtividadesEstudosviabilidadesRecurso->Recurso->generateList("Recurso.user_created = '$usuario'",'id desc', null, '{n}.Recurso.id', '{n}.Recurso.ds_recurso'));
			$this->set('estudosviabilidades', $this->AtividadesEstudosviabilidadesRecurso->Estudosviabilidade->generateList("Estudosviabilidade.user_created = '$usuario'",'id desc', null, '{n}.Estudosviabilidade.id', '{n}.Estudosviabilidade.id'));
			$this->set('atividades', $this->AtividadesEstudosviabilidadesRecurso->Atividade->generateList("Atividade.user_created = '$usuario'",'id desc', null, '{n}.Atividade.id', '{n}.Atividade.ds_atividade'));
			$this->set('tiposrecursosviabilidades', $this->AtividadesEstudosviabilidadesRecurso->Tiposrecursosviabilidade->generateList(null,'id desc', null, '{n}.Tiposrecursosviabilidade.id', '{n}.Tiposrecursosviabilidade.ds_tipo_recurso_viabilidade'));
			$this->render();
		} else {
			$this->cleanUpFields();
			if($this->AtividadesEstudosviabilidadesRecurso->save($this->data)) {
				$this->Session->setFlash('Atividade Estudo de viabilidade Recurso inserido com sucesso.');
				$this->redirect('/atividades_estudosviabilidades_recursos/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
			 $this->set('recursos', $this->AtividadesEstudosviabilidadesRecurso->Recurso->generateList("Recurso.user_created = '$usuario'",'id desc', null, '{n}.Recurso.id', '{n}.Recurso.ds_recurso'));
			 $this->set('estudosviabilidades', $this->AtividadesEstudosviabilidadesRecurso->Estudosviabilidade->generateList("Estudosviabilidade.user_created = '$usuario'",'id desc', null, '{n}.Estudosviabilidade.id', '{n}.Estudosviabilidade.id'));
			 $this->set('atividades', $this->AtividadesEstudosviabilidadesRecurso->Atividade->generateList("Atividade.user_created = '$usuario'",'id desc', null, '{n}.Atividade.id', '{n}.Atividade.ds_atividade'));
			 $this->set('tiposrecursosviabilidades', $this->AtividadesEstudosviabilidadesRecurso->Tiposrecursosviabilidade->generateList(null,'ds_tipo_recurso_viabilidade', null, '{n}.Tiposrecursosviabilidade.id', '{n}.Tiposrecursosviabilidade.ds_tipo_recurso_viabilidade'));
			}
		}
	}

	function edit($id = null) {
    $usuario = $_SESSION['Usuario'];
    $this->checkAcess();
    if(empty($this->data)) {
			if(!$id) {
				$this->Session->setFlash('Id inválido para Atividades Estudosviabilidades Recurso');
				$this->redirect('/atividades_estudosviabilidades_recursos/index');
			}
			$this->data = $this->AtividadesEstudosviabilidadesRecurso->read(null, $id);
			$this->set('recursos', $this->AtividadesEstudosviabilidadesRecurso->Recurso->generateList("Recurso.user_created = '$usuario'",'id desc', null, '{n}.Recurso.id', '{n}.Recurso.ds_recurso'));
			$this->set('estudosviabilidades', $this->AtividadesEstudosviabilidadesRecurso->Estudosviabilidade->generateList("Estudosviabilidade.user_created = '$usuario'",'id desc', null, '{n}.Estudosviabilidade.id', '{n}.Estudosviabilidade.id'));
			$this->set('atividades', $this->AtividadesEstudosviabilidadesRecurso->Atividade->generateList("Atividade.user_created = '$usuario'",'id desc', null, '{n}.Atividade.id', '{n}.Atividade.ds_atividade'));
			$this->set('tiposrecursosviabilidades', $this->AtividadesEstudosviabilidadesRecurso->Tiposrecursosviabilidade->generateList(null,'ds_tipo_recurso_viabilidade', null, '{n}.Tiposrecursosviabilidade.id', '{n}.Tiposrecursosviabilidade.ds_tipo_recurso_viabilidade'));
		} else {
			$this->cleanUpFields();
			if($this->AtividadesEstudosviabilidadesRecurso->save($this->data)) {
				$this->Session->setFlash('Atividade Estudo de viabilidade Recurso editado com sucesso.');
				$this->redirect('/atividades_estudosviabilidades_recursos/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
			    $this->set('recursos', $this->AtividadesEstudosviabilidadesRecurso->Recurso->generateList("Recurso.user_created = '$usuario'",'id desc', null, '{n}.Recurso.id', '{n}.Recurso.ds_recurso'));
                $this->set('estudosviabilidades', $this->AtividadesEstudosviabilidadesRecurso->Estudosviabilidade->generateList("Estudosviabilidade.user_created = '$usuario'",'id desc', null, '{n}.Estudosviabilidade.id', '{n}.Estudosviabilidade.id'));
			    $this->set('atividades', $this->AtividadesEstudosviabilidadesRecurso->Atividade->generateList("Atividade.user_created = '$usuario'",'id desc', null, '{n}.Atividade.id', '{n}.Atividade.ds_atividade'));
			    $this->set('tiposrecursosviabilidades', $this->AtividadesEstudosviabilidadesRecurso->Tiposrecursosviabilidade->generateList(null,'ds_tipo_recurso_viabilidade', null, '{n}.Tiposrecursosviabilidade.id', '{n}.Tiposrecursosviabilidade.ds_tipo_recurso_viabilidade'));
			}
		}
	}

	function delete($id = null) {
		$this->checkAcess();
    if(!$id) {
			$this->Session->setFlash('ID inválido para Atividades Estudosviabilidades Recurso');
			$this->redirect('/atividades_estudosviabilidades_recursos/index');
		}
		if($this->AtividadesEstudosviabilidadesRecurso->del($id)) {
			$this->Session->setFlash('Atividade Estudo de viabilidade Recurso Excluído: id '.$id.'');
			$this->redirect('/atividades_estudosviabilidades_recursos/index');
		}
	}

}
?>
