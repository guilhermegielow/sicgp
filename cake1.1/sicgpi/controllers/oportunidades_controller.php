<?php
class OportunidadesController extends AppController {

	var $name = 'Oportunidades';
	var $helpers = array('Html', 'Form' , 'Ajax', 'Javascript');

	function index() {
		$this->checkAcess();
    $this->Oportunidade->recursive = 0;
		$this->set('oportunidades', $this->Oportunidade->findAll());
	}

	function view($id = null) {
		$this->checkAcess();
    if(!$id) {
			$this->Session->setFlash('ID inválido para Oportunidade.');
			$this->redirect('/oportunidades/index');
		}
		$this->set('oportunidade', $this->Oportunidade->read(null, $id));
	}

	function add() {
	$usuario = $_SESSION['Usuario'];
		$this->checkAcess();
    if(empty($this->data)) {
			$this->set('licoesaprendidas', $this->Oportunidade->Licoesaprendida->generateList("Licoesaprendida.user_created = '$usuario'",'id desc', null, '{n}.Licoesaprendida.id', '{n}.Licoesaprendida.ds_licao_aprendida'));
			$this->render();
		} else {
			$this->cleanUpFields();
			if($this->Oportunidade->save($this->data)) {
				$this->Session->setFlash('Oportunidade inserida com sucesso.');
				$this->redirect('/oportunidades/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
				$this->set('licoesaprendidas', $this->Oportunidade->Licoesaprendida->generateList("Licoesaprendida.user_created = '$usuario'",'id desc', null, '{n}.Licoesaprendida.id', '{n}.Licoesaprendida.ds_licao_aprendida'));
			}
		}
	}

	function edit($id = null) {
	$usuario = $_SESSION['Usuario'];
		$this->checkAcess();
    if(empty($this->data)) {
			if(!$id) {
				$this->Session->setFlash('Id inválido para Oportunidade');
				$this->redirect('/oportunidades/index');
			}
			$this->data = $this->Oportunidade->read(null, $id);
			$this->set('licoesaprendidas', $this->Oportunidade->Licoesaprendida->generateList("Licoesaprendida.user_created = '$usuario'",'id desc', null, '{n}.Licoesaprendida.id', '{n}.Licoesaprendida.ds_licao_aprendida'));
		} else {
			$this->cleanUpFields();
			if($this->Oportunidade->save($this->data)) {
				$this->Session->setFlash('Oportunidade editada com sucesso.');
				$this->redirect('/oportunidades/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
				$this->set('licoesaprendidas', $this->Oportunidade->Licoesaprendida->generateList("Licoesaprendida.user_created = '$usuario'",'id desc', null, '{n}.Licoesaprendida.id', '{n}.Licoesaprendida.ds_licao_aprendida'));
			}
		}
	}

	function delete($id = null) {
		$this->checkAcess();
    if(!$id) {
			$this->Session->setFlash('ID inválido para Oportunidade');
			$this->redirect('/oportunidades/index');
		}
		if($this->Oportunidade->del($id)) {
			$this->Session->setFlash('Oportunidade Excluída: id '.$id.'');
			$this->redirect('/oportunidades/index');
		}
	}

}
?>
