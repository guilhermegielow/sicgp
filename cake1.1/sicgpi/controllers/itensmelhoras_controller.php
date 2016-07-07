<?php
class ItensmelhorasController extends AppController {

	var $name = 'Itensmelhoras';
	var $helpers = array('Html', 'Form' , 'Ajax', 'Javascript');

	function index() {
		$this->checkAcess();
    $this->Itensmelhora->recursive = 0;
		$this->set('itensmelhoras', $this->Itensmelhora->findAll());
	}

	function view($id = null) {
		$this->checkAcess();
    if(!$id) {
			$this->Session->setFlash('ID inválido para Itensmelhora.');
			$this->redirect('/itensmelhoras/index');
		}
		$this->set('itensmelhora', $this->Itensmelhora->read(null, $id));
	}

	function add() {
	$usuario = $_SESSION['Usuario'];
		$this->checkAcess();
    if(empty($this->data)) {
			$this->set('licoesaprendidas', $this->Itensmelhora->Licoesaprendida->generateList("Licoesaprendida.user_created = '$usuario'",'id desc', null, '{n}.Licoesaprendida.id', '{n}.Licoesaprendida.ds_licao_aprendida'));
			$this->render();
		} else {
			$this->cleanUpFields();
			if($this->Itensmelhora->save($this->data)) {
				$this->Session->setFlash('Ítem de melhoria inserido com sucesso.');
				$this->redirect('/itensmelhoras/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
				$this->set('licoesaprendidas', $this->Itensmelhora->Licoesaprendida->generateList("Licoesaprendida.user_created = '$usuario'",'id desc', null, '{n}.Licoesaprendida.id', '{n}.Licoesaprendida.ds_licao_aprendida'));
			}
		}
	}

	function edit($id = null) {
	$usuario = $_SESSION['Usuario'];
		$this->checkAcess();
    if(empty($this->data)) {
			if(!$id) {
				$this->Session->setFlash('Id inválido para Itensmelhora');
				$this->redirect('/itensmelhoras/index');
			}
			$this->data = $this->Itensmelhora->read(null, $id);
			$this->set('licoesaprendidas', $this->Itensmelhora->Licoesaprendida->generateList("Licoesaprendida.user_created = '$usuario'",'id desc', null, '{n}.Licoesaprendida.id', '{n}.Licoesaprendida.ds_licao_aprendida'));
		} else {
			$this->cleanUpFields();
			if($this->Itensmelhora->save($this->data)) {
				$this->Session->setFlash('Ítem de melhoria editado com sucesso.');
				$this->redirect('/itensmelhoras/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
				$this->set('licoesaprendidas', $this->Itensmelhora->Licoesaprendida->generateList("Licoesaprendida.user_created = '$usuario'",'id desc', null, '{n}.Licoesaprendida.id', '{n}.Licoesaprendida.ds_licao_aprendida'));
			}
		}
	}

	function delete($id = null) {
		$this->checkAcess();
    if(!$id) {
			$this->Session->setFlash('ID inválido para Itensmelhora');
			$this->redirect('/itensmelhoras/index');
		}
		if($this->Itensmelhora->del($id)) {
			$this->Session->setFlash('Ítem de melhoria Excluído: id '.$id.'');
			$this->redirect('/itensmelhoras/index');
		}
	}

}
?>
