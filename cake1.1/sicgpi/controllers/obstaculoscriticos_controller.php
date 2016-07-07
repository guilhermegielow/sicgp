<?php
class ObstaculoscriticosController extends AppController {

	var $name = 'Obstaculoscriticos';
	var $helpers = array('Html', 'Form' , 'Ajax', 'Javascript');

	function index() {
		$this->checkAcess();
    $this->Obstaculoscritico->recursive = 0;
		$this->set('obstaculoscriticos', $this->Obstaculoscritico->findAll());
	}

	function view($id = null) {
		$this->checkAcess();
    if(!$id) {
			$this->Session->setFlash('ID inválido para Obstaculoscritico.');
			$this->redirect('/obstaculoscriticos/index');
		}
		$this->set('obstaculoscritico', $this->Obstaculoscritico->read(null, $id));
	}

	function add() {
	$usuario = $_SESSION['Usuario'];
		$this->checkAcess();
    if(empty($this->data)) {
			$this->set('licoesaprendidas', $this->Obstaculoscritico->Licoesaprendida->generateList("Licoesaprendida.user_created = '$usuario'",'id desc', null, '{n}.Licoesaprendida.id', '{n}.Licoesaprendida.ds_licao_aprendida'));
			$this->render();
		} else {
			$this->cleanUpFields();
			if($this->Obstaculoscritico->save($this->data)) {
				$this->Session->setFlash('Obstáculo crítico inserido com sucesso.');
				$this->redirect('/obstaculoscriticos/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
				$this->set('licoesaprendidas', $this->Obstaculoscritico->Licoesaprendida->generateList("Licoesaprendida.user_created = '$usuario'",'id desc', null, '{n}.Licoesaprendida.id', '{n}.Licoesaprendida.ds_licao_aprendida'));
			}
		}
	}

	function edit($id = null) {
	$usuario = $_SESSION['Usuario'];
		$this->checkAcess();
    if(empty($this->data)) {
			if(!$id) {
				$this->Session->setFlash('Id inválido para Obstaculoscritico');
				$this->redirect('/obstaculoscriticos/index');
			}
			$this->data = $this->Obstaculoscritico->read(null, $id);
			$this->set('licoesaprendidas', $this->Obstaculoscritico->Licoesaprendida->generateList("Licoesaprendida.user_created = '$usuario'",'id desc', null, '{n}.Licoesaprendida.id', '{n}.Licoesaprendida.ds_licao_aprendida'));
		} else {
			$this->cleanUpFields();
			if($this->Obstaculoscritico->save($this->data)) {
				$this->Session->setFlash('Obstáculo crítico editado com sucesso.');
				$this->redirect('/obstaculoscriticos/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
				$this->set('licoesaprendidas', $this->Obstaculoscritico->Licoesaprendida->generateList("Licoesaprendida.user_created = '$usuario'",'id desc', null, '{n}.Licoesaprendida.id', '{n}.Licoesaprendida.ds_licao_aprendida'));
			}
		}
	}

	function delete($id = null) {
		$this->checkAcess();
    if(!$id) {
			$this->Session->setFlash('ID inválido para Obstaculoscritico');
			$this->redirect('/obstaculoscriticos/index');
		}
		if($this->Obstaculoscritico->del($id)) {
			$this->Session->setFlash('Obstáculo crítico Excluído: id '.$id.'');
			$this->redirect('/obstaculoscriticos/index');
		}
	}

}
?>
