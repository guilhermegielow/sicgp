<?php
class ProdutosController extends AppController {

	var $name = 'Produtos';
	var $helpers = array('Html', 'Form' , 'Ajax', 'Javascript');

	function index() {
		$this->checkAcess();
    $this->Produto->recursive = 0;
		$this->set('produtos', $this->Produto->findAll('', '',
        'Produto.id desc'));
	}

	function view($id = null) {
		$this->checkAcess();
    if(!$id) {
			$this->Session->setFlash('ID inválido para Produto.');
			$this->redirect('/produtos/index');
		}
		$this->set('produto', $this->Produto->read(null, $id));
	}

	function add() {
    $usuario = $_SESSION['Usuario'];
    	$this->checkAcess();
    if(empty($this->data)) {
			$this->set('estudosviabilidades', $this->Produto->Estudosviabilidade->generateList("Estudosviabilidade.user_created = '$usuario'",
            'Estudosviabilidade.id desc'));
			$this->render();
		} else {
			$this->cleanUpFields();
			if($this->Produto->save($this->data)) {
				$this->Session->setFlash('Produto inserido com sucesso.');
				$this->redirect('/produtos/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
				$this->set('estudosviabilidades', $this->Produto->Estudosviabilidade->generateList("Estudosviabilidade.user_created = '$usuario'",
            'Estudosviabilidade.id desc'));
			}
		}
	}

	function edit($id = null) {
    $usuario = $_SESSION['Usuario'];
    	$this->checkAcess();
    if(empty($this->data)) {
			if(!$id) {
				$this->Session->setFlash('Id inválido para Produto');
				$this->redirect('/produtos/index');
			}
			$this->data = $this->Produto->read(null, $id);
			$this->set('estudosviabilidades', $this->Produto->Estudosviabilidade->generateList("Estudosviabilidade.user_created = '$usuario'",
            'Estudosviabilidade.id desc'));
		} else {
			$this->cleanUpFields();
			if($this->Produto->save($this->data)) {
				$this->Session->setFlash('Produto editado com sucesso.');
				$this->redirect('/produtos/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
				$this->set('estudosviabilidades', $this->Produto->Estudosviabilidade->generateList("Estudosviabilidade.user_created = '$usuario'",
            'Estudosviabilidade.id desc'));
			}
		}
	}

	function delete($id = null) {
		$this->checkAcess();
    if(!$id) {
			$this->Session->setFlash('ID inválido para Produto');
			$this->redirect('/produtos/index');
		}
		if($this->Produto->del($id)) {
			$this->Session->setFlash('Produto Excluído: id '.$id.'');
			$this->redirect('/produtos/index');
		}
	}

}
?>
