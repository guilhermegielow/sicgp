<?php
class ResponsabilidadesController extends AppController {

	var $name = 'Responsabilidades';
	var $helpers = array('Html', 'Form' , 'Ajax', 'Javascript');

	function index() {
		$this->checkAcess();
    $this->Responsabilidade->recursive = 0;
		$this->set('responsabilidades', $this->Responsabilidade->findAll());
	}

	function view($id = null) {
		$this->checkAcess();
    if(!$id) {
			$this->Session->setFlash('ID inválido para Responsabilidade.');
			$this->redirect('/responsabilidades/index');
		}
		$this->set('responsabilidade', $this->Responsabilidade->read(null, $id));
	}

	function add() {
     $usuario = $_SESSION['Usuario'];
        $this->checkAcess();
    if(empty($this->data)) {
			$this->set('estudosviabilidades', $this->Responsabilidade->Estudosviabilidade->generateList("Estudosviabilidade.user_created = '$usuario'",
            'Estudosviabilidade.id desc'));
			$this->set('tiposresponsabilidades', $this->Responsabilidade->Tiposresponsabilidade->generateList(null,'ds_tipo_responsabilidade', null, '{n}.Tiposresponsabilidade.id', '{n}.Tiposresponsabilidade.ds_tipo_responsabilidade'));
			$this->render();
		} else {
			$this->cleanUpFields();
			if($this->Responsabilidade->save($this->data)) {
				$this->Session->setFlash('Responsabilidade inserida com sucesso.');
				$this->redirect('/responsabilidades/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
				$this->set('estudosviabilidades', $this->Responsabilidade->Estudosviabilidade->generateList("Estudosviabilidade.user_created = '$usuario'",
            'Estudosviabilidade.id desc'));
				$this->set('tiposresponsabilidades', $this->Responsabilidade->Tiposresponsabilidade->generateList(null,'ds_tipo_responsabilidade', null, '{n}.Tiposresponsabilidade.id', '{n}.Tiposresponsabilidade.ds_tipo_responsabilidade'));
			}
		}
	}

	function edit($id = null) {
    $usuario = $_SESSION['Usuario'];
    	$this->checkAcess();
    if(empty($this->data)) {
			if(!$id) {
				$this->Session->setFlash('Id inválido para Responsabilidade');
				$this->redirect('/responsabilidades/index');
			}
			$this->data = $this->Responsabilidade->read(null, $id);
			$this->set('estudosviabilidades', $this->Responsabilidade->Estudosviabilidade->generateList("Estudosviabilidade.user_created = '$usuario'",
            'Estudosviabilidade.id desc'));
			$this->set('tiposresponsabilidades', $this->Responsabilidade->Tiposresponsabilidade->generateList(null,'ds_tipo_responsabilidade', null, '{n}.Tiposresponsabilidade.id', '{n}.Tiposresponsabilidade.ds_tipo_responsabilidade'));
		} else {
			$this->cleanUpFields();
			if($this->Responsabilidade->save($this->data)) {
				$this->Session->setFlash('Responsabilidade editada com sucesso.');
				$this->redirect('/responsabilidades/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
				$this->set('estudosviabilidades', $this->Responsabilidade->Estudosviabilidade->generateList("Estudosviabilidade.user_created = '$usuario'",
            'Estudosviabilidade.id desc'));
				$this->set('tiposresponsabilidades', $this->Responsabilidade->Tiposresponsabilidade->generateList(null,'ds_tipo_responsabilidade', null, '{n}.Tiposresponsabilidade.id', '{n}.Tiposresponsabilidade.ds_tipo_responsabilidade'));
			}
		}
	}

	function delete($id = null) {
		$this->checkAcess();
    if(!$id) {
			$this->Session->setFlash('ID inválido para Responsabilidade');
			$this->redirect('/responsabilidades/index');
		}
		if($this->Responsabilidade->del($id)) {
			$this->Session->setFlash('Responsabilidade Excluída: id '.$id.'');
			$this->redirect('/responsabilidades/index');
		}
	}

}
?>
