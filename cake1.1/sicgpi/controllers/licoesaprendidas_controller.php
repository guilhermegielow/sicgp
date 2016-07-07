<?php
class LicoesaprendidasController extends AppController {

	var $name = 'Licoesaprendidas';
	var $helpers = array('Html', 'Form' , 'Ajax', 'Javascript');

	function index() {
    $this->checkAcess();
    $usuario = $_SESSION['Usuario'];
		$this->Licoesaprendida->recursive = 0;
		$this->set('licoesaprendidas', $this->Licoesaprendida->findAll("Licoesaprendida.user_created = '$usuario'",'', 'Licoesaprendida.id desc'));
	}

	function view($id = null) {
    $this->checkAcess();
    if(!$id) {
			$this->Session->setFlash('ID inválido para Licoesaprendida.');
			$this->redirect('/licoesaprendidas/index');
		}
		$this->set('licoesaprendida', $this->Licoesaprendida->read(null, $id));
	}

	function add() {
    $this->checkAcess();
    $usuario = $_SESSION['Usuario'];
    if(empty($this->data)) {
			$this->set('projetos', $this->Licoesaprendida->Projeto->generateList("Projeto.user_created = '$usuario'",'id desc', null, '{n}.Projeto.id', '{n}.Projeto.ds_titulo'));
			$this->render();
		} else {
			$this->cleanUpFields();
			if($this->Licoesaprendida->save($this->data)) {
				$this->Session->setFlash('Lição aprendida inserida com sucesso.');
				$this->redirect('/licoesaprendidas/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
				$this->set('projetos', $this->Licoesaprendida->Projeto->generateList("Projeto.user_created = '$usuario'",'id desc', null, '{n}.Projeto.id', '{n}.Projeto.ds_titulo'));
			}
		}
	}

	function edit($id = null) {
    $this->checkAcess();
    $usuario = $_SESSION['Usuario'];
    if(empty($this->data)) {
			if(!$id) {
				$this->Session->setFlash('Id inválido para Licoesaprendida');
				$this->redirect('/licoesaprendidas/index');
			}
			$this->data = $this->Licoesaprendida->read(null, $id);
			$this->set('projetos', $this->Licoesaprendida->Projeto->generateList("Projeto.user_created = '$usuario'",'id desc', null, '{n}.Projeto.id', '{n}.Projeto.ds_titulo'));
		} else {
			$this->cleanUpFields();
			if($this->Licoesaprendida->save($this->data)) {
				$this->Session->setFlash('Lição aprendida editada com sucesso.');
				$this->redirect('/licoesaprendidas/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
				$this->set('projetos', $this->Licoesaprendida->Projeto->generateList("Projeto.user_created = '$usuario'",'id desc', null, '{n}.Projeto.id', '{n}.Projeto.ds_titulo'));
			}
		}
	}

	function delete($id = null) {
		$this->checkAcess();
    if(!$id) {
			$this->Session->setFlash('ID inválido para Licoesaprendida');
			$this->redirect('/licoesaprendidas/index');
		}
		if($this->Licoesaprendida->del($id)) {
			$this->Session->setFlash('Lição aprendida Excluída: id '.$id.'');
			$this->redirect('/licoesaprendidas/index');
		}
	}

}
?>
