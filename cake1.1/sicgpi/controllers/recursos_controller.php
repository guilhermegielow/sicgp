<?php
class RecursosController extends AppController {

	var $name = 'Recursos';
	var $helpers = array('Html', 'Form' , 'Ajax', 'Javascript');

	function index() {
    $this->checkAcess();
    $usuario = $_SESSION['Usuario'];
    $this->Recurso->recursive = 0;
		$this->set('recursos', $this->Recurso->findAll("Recurso.user_created = '$usuario'",'','Recurso.projeto_id desc'));
	}

	function view($id = null) {
    if(!$id) {
			$this->Session->setFlash('ID inválido para Recurso.');
			$this->redirect('/recursos/index');
		}
		$this->set('recurso', $this->Recurso->read(null, $id));
	}

	function add() {
      $this->checkAcess();
      $usuario = $_SESSION['Usuario'];
      if(empty($this->data)) {
			$this->set('orcamentos', $this->Recurso->Orcamento->generateList("Orcamento.user_created = '$usuario'",'id desc'));
			$this->set('selectedOrcamentos', null);
			$this->set('gruposrecursos', $this->Recurso->Gruposrecurso->generateList(null,'', null, '{n}.Gruposrecurso.id', '{n}.Gruposrecurso.ds_grupo_recurso'));
			$this->set('unidades', $this->Recurso->Unidade->generateList(null,'ds_unidade', null, '{n}.Unidade.id', '{n}.Unidade.ds_unidade'));
			$this->set('projetos', $this->Recurso->Projeto->generateList("Projeto.user_created = '$usuario'",'id desc', null, '{n}.Projeto.id', '{n}.Projeto.ds_titulo'));
			$this->render();
		} else {
			$this->cleanUpFields();
			if($this->Recurso->save($this->data)) {
				$this->Session->setFlash('Recurso inserido com sucesso.');
				$this->redirect('/recursos/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
				$this->set('orcamentos', $this->Recurso->Orcamento->generateList("Orcamento.user_created = '$usuario'",'id desc'));
				if(empty($this->data['Orcamento']['Orcamento'])) { $this->data['Orcamento']['Orcamento'] = null; }
				$this->set('selectedOrcamentos', $this->data['Orcamento']['Orcamento']);
				$this->set('gruposrecursos', $this->Recurso->Gruposrecurso->generateList(null,'ds_grupo_recurso', null, '{n}.Gruposrecurso.id', '{n}.Gruposrecurso.ds_grupo_recurso'));
				$this->set('unidades', $this->Recurso->Unidade->generateList(null,'ds_unidade', null, '{n}.Unidade.id', '{n}.Unidade.ds_unidade'));
                $this->set('projetos', $this->Recurso->Projeto->generateList("Projeto.user_created = '$usuario'",'id desc', null, '{n}.Projeto.id', '{n}.Projeto.ds_titulo'));
		}
	}
	}

	function edit($id = null) {
    $this->checkAcess();
    $usuario = $_SESSION['Usuario'];
    if(empty($this->data)) {
			if(!$id) {
				$this->Session->setFlash('Id inválido para Recurso');
				$this->redirect('/recursos/index');
			}
			$this->data = $this->Recurso->read(null, $id);
			$this->set('orcamentos', $this->Recurso->Orcamento->generateList("Orcamento.user_created = '$usuario'",'id desc'));
			if(empty($this->data['Orcamento'])) { $this->data['Orcamento'] = null; }
			$this->set('selectedOrcamentos', $this->_selectedArray($this->data['Orcamento']));
			$this->set('gruposrecursos', $this->Recurso->Gruposrecurso->generateList(null,'ds_grupo_recurso', null, '{n}.Gruposrecurso.id', '{n}.Gruposrecurso.ds_grupo_recurso'));
			$this->set('unidades', $this->Recurso->Unidade->generateList(null,'ds_unidade', null, '{n}.Unidade.id', '{n}.Unidade.ds_unidade'));
            $this->set('projetos', $this->Recurso->Projeto->generateList("Projeto.user_created = '$usuario'",'id desc', null, '{n}.Projeto.id', '{n}.Projeto.ds_titulo'));
		} else {
			$this->cleanUpFields();
			if($this->Recurso->save($this->data)) {
				$this->Session->setFlash('Recurso editado com sucesso.');
				$this->redirect('/recursos/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
				$this->set('orcamentos', $this->Recurso->Orcamento->generateList("Orcamento.user_created = '$usuario'",'id desc'));
				if(empty($this->data['Orcamento']['Orcamento'])) { $this->data['Orcamento']['Orcamento'] = null; }
				$this->set('selectedOrcamentos', $this->data['Orcamento']['Orcamento']);
				$this->set('gruposrecursos', $this->Recurso->Gruposrecurso->generateList(null,'ds_grupo_recurso', null, '{n}.Gruposrecurso.id', '{n}.Gruposrecurso.ds_grupo_recurso'));
				$this->set('unidades', $this->Recurso->Unidade->generateList(null,'ds_unidade', null, '{n}.Unidade.id', '{n}.Unidade.ds_unidade'));
                $this->set('projetos', $this->Recurso->Projeto->generateList("Projeto.user_created = '$usuario'",'id desc', null, '{n}.Projeto.id', '{n}.Projeto.ds_titulo'));
                }
		}
	}

	function delete($id = null) {
		$this->checkAcess();
    if(!$id) {
			$this->Session->setFlash('ID inválido para Recurso');
			$this->redirect('/recursos/index');
		}
		if($this->Recurso->del($id)) {
			$this->Session->setFlash('Recurso Excluído: id '.$id.'');
			$this->redirect('/recursos/index');
		}
	}
}
?>
