<?php
class ServicosController extends AppController {

	var $name = 'Servicos';
	var $helpers = array('Html', 'Form' , 'Ajax', 'Javascript');

	function index() {
		$this->checkAcess();
    $this->Servico->recursive = 0;
		$this->set('servicos', $this->Servico->findAll('', '',
        'Servico.id desc'));
	}

	function view($id = null) {
		$this->checkAcess();
    if(!$id) {
			$this->Session->setFlash('ID inválido para Servico.');
			$this->redirect('/servicos/index');
		}
		$this->set('servico', $this->Servico->read(null, $id));
	}

	function add() {
    $usuario = $_SESSION['Usuario'];
   	$this->checkAcess();
    if(empty($this->data)) {
			$this->set('produtos', $this->Servico->Produto->generateList("Produto.user_created = '$usuario'",'ds_produto', null, '{n}.Produto.id', '{n}.Produto.ds_produto'));
			$this->set('selectedProdutos', null);
			$this->set('estudosviabilidades', $this->Servico->Estudosviabilidade->generateList("Estudosviabilidade.user_created = '$usuario'",
            'Estudosviabilidade.id desc'));
			$this->render();
		} else {
			$this->cleanUpFields();
			if($this->Servico->save($this->data)) {
				$this->Session->setFlash('Serviço inserido com sucesso.');
				$this->redirect('/servicos/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
				$this->set('produtos', $this->Servico->Produto->generateList("Produto.user_created = '$usuario'",'ds_produto', null, '{n}.Produto.id', '{n}.Produto.ds_produto'));
				if(empty($this->data['Produto']['Produto'])) { $this->data['Produto']['Produto'] = null; }
				$this->set('selectedProdutos', $this->data['Produto']['Produto']);
				$this->set('estudosviabilidades', $this->Servico->Estudosviabilidade->generateList("Estudosviabilidade.user_created = '$usuario'",
            'Estudosviabilidade.id desc'));
			}
		}
	}

	function edit($id = null) {
    $usuario = $_SESSION['Usuario'];
    $this->checkAcess();
    if(empty($this->data)) {
			if(!$id) {
				$this->Session->setFlash('Id inválido para Servico');
				$this->redirect('/servicos/index');
			}
			$this->data = $this->Servico->read(null, $id);
			$this->set('produtos', $this->Servico->Produto->generateList("Produto.user_created = '$usuario'",'ds_produto', null, '{n}.Produto.id', '{n}.Produto.ds_produto'));
			if(empty($this->data['Produto'])) { $this->data['Produto'] = null; }
			$this->set('selectedProdutos', $this->_selectedArray($this->data['Produto']));
			$this->set('estudosviabilidades', $this->Servico->Estudosviabilidade->generateList("Estudosviabilidade.user_created = '$usuario'",
            'Estudosviabilidade.id desc'));
		} else {
			$this->cleanUpFields();
			if($this->Servico->save($this->data)) {
				$this->Session->setFlash('Serviço editado com sucesso.');
				$this->redirect('/servicos/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
				$this->set('produtos', $this->Servico->Produto->generateList("Produto.user_created = '$usuario'",'ds_produto', null, '{n}.Produto.id', '{n}.Produto.ds_produto'));
				if(empty($this->data['Produto']['Produto'])) { $this->data['Produto']['Produto'] = null; }
				$this->set('selectedProdutos', $this->data['Produto']['Produto']);
				$this->set('estudosviabilidades', $this->Servico->Estudosviabilidade->generateList("Estudosviabilidade.user_created = '$usuario'",
            'Estudosviabilidade.id desc'));
			}
		}
	}

	function delete($id = null) {
		$this->checkAcess();
    if(!$id) {
			$this->Session->setFlash('ID inválido para Servico');
			$this->redirect('/servicos/index');
		}
		if($this->Servico->del($id)) {
			$this->Session->setFlash('Serviço Excluído: id '.$id.'');
			$this->redirect('/servicos/index');
		}
	}

}
?>
