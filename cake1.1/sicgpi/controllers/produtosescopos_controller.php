<?php
class ProdutosescoposController extends AppController {

	var $name = 'Produtosescopos';
	var $helpers = array('Html', 'Form' , 'Ajax', 'Javascript');

	function index() {
		$this->checkAcess();
    $this->Produtosescopo->recursive = 0;
		$this->set('produtosescopos', $this->Produtosescopo->findAll('','','Produtosescopo.id desc'));
	}

	function view($id = null) {
		$this->checkAcess();
    if(!$id) {
			$this->Session->setFlash('ID inválido para Produtosescopo.');
			$this->redirect('/produtosescopos/index');
		}
		$this->set('produtosescopo', $this->Produtosescopo->read(null, $id));
	}

	function add() {
		$this->checkAcess();
    if(empty($this->data)) {
			$this->set('declaracoesescopos', $this->Produtosescopo->Declaracoesescopo->generateList(null,'id desc', null, '{n}.Declaracoesescopo.id', '{n}.Declaracoesescopo.ds_declaracao_escopo'));
			$this->render();
		} else {
			$this->cleanUpFields();
			if($this->Produtosescopo->save($this->data)) {
				$this->Session->setFlash('Produto de escopo inserido com sucesso.');
				$this->redirect('/produtosescopos/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
				$this->set('declaracoesescopos', $this->Produtosescopo->Declaracoesescopo->generateList(null,'id desc', null, '{n}.Declaracoesescopo.id', '{n}.Declaracoesescopo.ds_declaracao_escopo'));
			}
		}
	}

	function edit($id = null) {
		$this->checkAcess();
    if(empty($this->data)) {
			if(!$id) {
				$this->Session->setFlash('Id inválido para Produtosescopo');
				$this->redirect('/produtosescopos/index');
			}
			$this->data = $this->Produtosescopo->read(null, $id);
			$this->set('declaracoesescopos', $this->Produtosescopo->Declaracoesescopo->generateList(null,'id desc', null, '{n}.Declaracoesescopo.id', '{n}.Declaracoesescopo.ds_declaracao_escopo'));
		} else {
			$this->cleanUpFields();
			if($this->Produtosescopo->save($this->data)) {
				$this->Session->setFlash('Produto de escopo editado com sucesso.');
				$this->redirect('/produtosescopos/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
				$this->set('declaracoesescopos', $this->Produtosescopo->Declaracoesescopo->generateList(null,'id desc', null, '{n}.Declaracoesescopo.id', '{n}.Declaracoesescopo.ds_declaracao_escopo'));
			}
		}
	}

	function delete($id = null) {
		$this->checkAcess();
    if(!$id) {
			$this->Session->setFlash('ID inválido para Produtosescopo');
			$this->redirect('/produtosescopos/index');
		}
		if($this->Produtosescopo->del($id)) {
			$this->Session->setFlash('Produto de escopo Excluído: id '.$id.'');
			$this->redirect('/produtosescopos/index');
		}
	}

}
?>
