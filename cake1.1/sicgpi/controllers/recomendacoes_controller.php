<?php
class RecomendacoesController extends AppController {

	var $name = 'Recomendacoes';
	var $helpers = array('Html', 'Form' , 'Ajax', 'Javascript');

	function index() {
		$this->checkAcess();
    $this->Recomendacao->recursive = 0;
		$this->set('recomendacoes', $this->Recomendacao->findAll());
	}

	function view($id = null) {
		$this->checkAcess();
    if(!$id) {
			$this->Session->setFlash('ID inválido para Recomendacao.');
			$this->redirect('/recomendacoes/index');
		}
		$this->set('recomendacao', $this->Recomendacao->read(null, $id));
	}

	function add() {
	$usuario = $_SESSION['Usuario'];
		$this->checkAcess();
    if(empty($this->data)) {
			$this->set('licoesaprendidas', $this->Recomendacao->Licoesaprendida->generateList("Licoesaprendida.user_created = '$usuario'",'id desc', null, '{n}.Licoesaprendida.id', '{n}.Licoesaprendida.ds_licao_aprendida'));
			$this->render();
		} else {
			$this->cleanUpFields();
			if($this->Recomendacao->save($this->data)) {
				$this->Session->setFlash('Recomendação inserida com sucesso.');
				$this->redirect('/recomendacoes/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
				$this->set('licoesaprendidas', $this->Recomendacao->Licoesaprendida->generateList("Licoesaprendida.user_created = '$usuario'",'id desc', null, '{n}.Licoesaprendida.id', '{n}.Licoesaprendida.ds_licao_aprendida'));
			}
		}
	}

	function edit($id = null) {
	$usuario = $_SESSION['Usuario'];
		$this->checkAcess();
    if(empty($this->data)) {
			if(!$id) {
				$this->Session->setFlash('Id inválido para Recomendacao');
				$this->redirect('/recomendacoes/index');
			}
			$this->data = $this->Recomendacao->read(null, $id);
			$this->set('licoesaprendidas', $this->Recomendacao->Licoesaprendida->generateList("Licoesaprendida.user_created = '$usuario'",'id desc', null, '{n}.Licoesaprendida.id', '{n}.Licoesaprendida.ds_licao_aprendida'));
		} else {
			$this->cleanUpFields();
			if($this->Recomendacao->save($this->data)) {
				$this->Session->setFlash('Recomendação editada com sucesso.');
				$this->redirect('/recomendacoes/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
				$this->set('licoesaprendidas', $this->Recomendacao->Licoesaprendida->generateList("Licoesaprendida.user_created = '$usuario'",'id desc', null, '{n}.Licoesaprendida.id', '{n}.Licoesaprendida.ds_licao_aprendida'));
			}
		}
	}

	function delete($id = null) {
		$this->checkAcess();
    if(!$id) {
			$this->Session->setFlash('ID inválido para Recomendacao');
			$this->redirect('/recomendacoes/index');
		}
		if($this->Recomendacao->del($id)) {
			$this->Session->setFlash('Recomendação Excluída: id '.$id.'');
			$this->redirect('/recomendacoes/index');
		}
	}

}
?>
