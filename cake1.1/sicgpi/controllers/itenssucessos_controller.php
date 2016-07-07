<?php
class ItenssucessosController extends AppController {

	var $name = 'Itenssucessos';
	var $helpers = array('Html', 'Form' , 'Ajax', 'Javascript');

	function index() {
		$this->checkAcess();
    $this->Itenssucesso->recursive = 0;
		$this->set('itenssucessos', $this->Itenssucesso->findAll());
	}

	function view($id = null) {
		$this->checkAcess();
    if(!$id) {
			$this->Session->setFlash('ID inválido para Itenssucesso.');
			$this->redirect('/itenssucessos/index');
		}
		$this->set('itenssucesso', $this->Itenssucesso->read(null, $id));
	}

	function add() {
	$usuario = $_SESSION['Usuario'];
		$this->checkAcess();
    if(empty($this->data)) {
			$this->set('licoesaprendidas', $this->Itenssucesso->Licoesaprendida->generateList("Licoesaprendida.user_created = '$usuario'",'id desc', null, '{n}.Licoesaprendida.id', '{n}.Licoesaprendida.ds_licao_aprendida'));
			$this->render();
		} else {
			$this->cleanUpFields();
			if($this->Itenssucesso->save($this->data)) {
				$this->Session->setFlash('Ítem de sucesso inserido com sucesso.');
				$this->redirect('/itenssucessos/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
				$this->set('licoesaprendidas', $this->Itenssucesso->Licoesaprendida->generateList("Licoesaprendida.user_created = '$usuario'",'id desc', null, '{n}.Licoesaprendida.id', '{n}.Licoesaprendida.ds_licao_aprendida'));
			}
		}
	}

	function edit($id = null) {
	$usuario = $_SESSION['Usuario'];
		$this->checkAcess();
    if(empty($this->data)) {
			if(!$id) {
				$this->Session->setFlash('Id inválido para Itenssucesso');
				$this->redirect('/itenssucessos/index');
			}
			$this->data = $this->Itenssucesso->read(null, $id);
			$this->set('licoesaprendidas', $this->Itenssucesso->Licoesaprendida->generateList("Licoesaprendida.user_created = '$usuario'",'id desc', null, '{n}.Licoesaprendida.id', '{n}.Licoesaprendida.ds_licao_aprendida'));
		} else {
			$this->cleanUpFields();
			if($this->Itenssucesso->save($this->data)) {
				$this->Session->setFlash('Ítem de sucesso editado com sucesso.');
				$this->redirect('/itenssucessos/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
				$this->set('licoesaprendidas', $this->Itenssucesso->Licoesaprendida->generateList("Licoesaprendida.user_created = '$usuario'",'id desc', null, '{n}.Licoesaprendida.id', '{n}.Licoesaprendida.ds_licao_aprendida'));
			}
		}
	}

	function delete($id = null) {
		$this->checkAcess();
    if(!$id) {
			$this->Session->setFlash('ID inválido para Itenssucesso');
			$this->redirect('/itenssucessos/index');
		}
		if($this->Itenssucesso->del($id)) {
			$this->Session->setFlash('Ítem de sucesso Excluído: id '.$id.'');
			$this->redirect('/itenssucessos/index');
		}
	}

}
?>
