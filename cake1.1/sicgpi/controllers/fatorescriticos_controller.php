<?php
class FatorescriticosController extends AppController {

	var $name = 'Fatorescriticos';
	var $helpers = array('Html', 'Form' , 'Ajax', 'Javascript');

	function index() {
		$this->checkAcess();
    $this->Fatorescritico->recursive = 0;
		$this->set('fatorescriticos', $this->Fatorescritico->findAll());
	}

	function view($id = null) {
		$this->checkAcess();
    if(!$id) {
			$this->Session->setFlash('ID inválido para Fatorescritico.');
			$this->redirect('/fatorescriticos/index');
		}
		$this->set('fatorescritico', $this->Fatorescritico->read(null, $id));
	}

	function add() {
    $usuario = $_SESSION['Usuario'];
    $this->checkAcess();
    if(empty($this->data)) {
			$this->set('licoesaprendidas', $this->Fatorescritico->Licoesaprendida->generateList("Licoesaprendida.user_created = '$usuario'",'id desc', null, '{n}.Licoesaprendida.id', '{n}.Licoesaprendida.ds_licao_aprendida'));
			$this->render();
		} else {
			$this->cleanUpFields();
			if($this->Fatorescritico->save($this->data)) {
				$this->Session->setFlash('Fator crítico inserido com sucesso.');
				$this->redirect('/fatorescriticos/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
				$this->set('licoesaprendidas', $this->Fatorescritico->Licoesaprendida->generateList("Licoesaprendida.user_created = '$usuario'",'id desc', null, '{n}.Licoesaprendida.id', '{n}.Licoesaprendida.ds_licao_aprendida'));
			}
		}
	}

	function edit($id = null) {
	$usuario = $_SESSION['Usuario'];
		$this->checkAcess();
    if(empty($this->data)) {
			if(!$id) {
				$this->Session->setFlash('Id inválido para Fatorescritico');
				$this->redirect('/fatorescriticos/index');
			}
			$this->data = $this->Fatorescritico->read(null, $id);
			$this->set('licoesaprendidas', $this->Fatorescritico->Licoesaprendida->generateList("Licoesaprendida.user_created = '$usuario'",'id desc', null, '{n}.Licoesaprendida.id', '{n}.Licoesaprendida.ds_licao_aprendida'));
		} else {
			$this->cleanUpFields();
			if($this->Fatorescritico->save($this->data)) {
				$this->Session->setFlash('Fator crítico editado com sucesso.');
				$this->redirect('/fatorescriticos/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
				$this->set('licoesaprendidas', $this->Fatorescritico->Licoesaprendida->generateList("Licoesaprendida.user_created = '$usuario'",'id desc', null, '{n}.Licoesaprendida.id', '{n}.Licoesaprendida.ds_licao_aprendida'));
			}
		}
	}

	function delete($id = null) {
		$this->checkAcess();
    if(!$id) {
			$this->Session->setFlash('ID inválido para Fatorescritico');
			$this->redirect('/fatorescriticos/index');
		}
		if($this->Fatorescritico->del($id)) {
			$this->Session->setFlash('Fator crítico Excluído: id '.$id.'');
			$this->redirect('/fatorescriticos/index');
		}
	}

}
?>
