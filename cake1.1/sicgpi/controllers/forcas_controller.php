<?php
class ForcasController extends AppController {

	var $name = 'Forcas';
	var $helpers = array('Html', 'Form' , 'Ajax', 'Javascript');

	function index() {
		$this->checkAcess();
    $this->Forca->recursive = 0;
		$this->set('forcas', $this->Forca->findAll());
	}

	function view($id = null) {
		$this->checkAcess();
    if(!$id) {
			$this->Session->setFlash('ID inválido para Forca.');
			$this->redirect('/forcas/index');
		}
		$this->set('forca', $this->Forca->read(null, $id));
	}

	function add() {
	$usuario = $_SESSION['Usuario'];
		$this->checkAcess();
    if(empty($this->data)) {
			$this->set('licoesaprendidas', $this->Forca->Licoesaprendida->generateList("Licoesaprendida.user_created = '$usuario'",'id desc', null, '{n}.Licoesaprendida.id', '{n}.Licoesaprendida.ds_licao_aprendida'));
			$this->render();
		} else {
			$this->cleanUpFields();
			if($this->Forca->save($this->data)) {
				$this->Session->setFlash('Força inserida com sucesso.');
                $this->redirect('/forcas/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
				$this->set('licoesaprendidas', $this->Forca->Licoesaprendida->generateList("Licoesaprendida.user_created = '$usuario'",'id desc', null, '{n}.Licoesaprendida.id', '{n}.Licoesaprendida.ds_licao_aprendida'));
			}
		}
	}

	function edit($id = null) {
	$usuario = $_SESSION['Usuario'];
		$this->checkAcess();
    if(empty($this->data)) {
			if(!$id) {
				$this->Session->setFlash('Id inválido para Forca');
				$this->redirect('/forcas/index');
			}
			$this->data = $this->Forca->read(null, $id);
			$this->set('licoesaprendidas', $this->Forca->Licoesaprendida->generateList("Licoesaprendida.user_created = '$usuario'",'id desc', null, '{n}.Licoesaprendida.id', '{n}.Licoesaprendida.ds_licao_aprendida'));
		} else {
			$this->cleanUpFields();
			if($this->Forca->save($this->data)) {
				$this->Session->setFlash('Força editada com sucesso.');
				$this->redirect('/forcas/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
				$this->set('licoesaprendidas', $this->Forca->Licoesaprendida->generateList("Licoesaprendida.user_created = '$usuario'",'id desc', null, '{n}.Licoesaprendida.id', '{n}.Licoesaprendida.ds_licao_aprendida'));
			}
		}

	}

	function delete($id = null) {
		$this->checkAcess();
    if(!$id) {
			$this->Session->setFlash('ID inválido para Forca');
			$this->redirect('/forcas/index');
		}
		if($this->Forca->del($id)) {
			$this->Session->setFlash('Força Excluída: id '.$id.'');
			$this->redirect('/forcas/index');
		}
	}
}
?>
