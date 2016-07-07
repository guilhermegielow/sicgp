<?php
class RelatoriosdesempenhosController extends AppController {

	var $name = 'Relatoriosdesempenhos';
	var $helpers = array('Html', 'Form' , 'Ajax', 'Javascript');

	function index() {
    $this->checkAcess();
    $usuario = $_SESSION['Usuario'];
    $this->Relatoriosdesempenho->recursive = 0;
		$this->set('relatoriosdesempenhos', $this->Relatoriosdesempenho->findAll("Relatoriosdesempenho.user_created = '$usuario'",'','Relatoriosdesempenho.id desc'));
	}

	function view($id = null) {
		$this->checkAcess();
    if(!$id) {
			$this->Session->setFlash('ID inválido para Relatoriosdesempenho.');
			$this->redirect('/relatoriosdesempenhos/index');
		}
		$this->set('relatoriosdesempenho', $this->Relatoriosdesempenho->read(null, $id));
	}

	function add() {
     $this->checkAcess();
     $usuario = $_SESSION['Usuario'];
     if(empty($this->data)) {
			$this->set('projetos', $this->Relatoriosdesempenho->Projeto->generateList("Projeto.user_created = '$usuario'",'id desc', null, '{n}.Projeto.id', '{n}.Projeto.ds_titulo'));
			$this->render();
		} else {
			$this->cleanUpFields();
			if($this->Relatoriosdesempenho->save($this->data)) {
                $this->Relatoriosdesempenho->gravaElementos($this->data['Relatoriosdesempenho']['projeto_id'], mysql_insert_id());
				$this->Session->setFlash('Relatório de desempenho inserido com sucesso.');
				$this->redirect('/relatoriosdesempenhos/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
				$this->set('projetos', $this->Relatoriosdesempenho->Projeto->generateList("Projeto.user_created = '$usuario'",'id desc', null, '{n}.Projeto.id', '{n}.Projeto.ds_titulo'));
			}
		}
	}

	function edit($id = null) {
    $this->checkAcess();
    $usuario = $_SESSION['Usuario'];
    if(empty($this->data)) {
			if(!$id) {
				$this->Session->setFlash('Id inválido para Relatoriosdesempenho');
				$this->redirect('/relatoriosdesempenhos/index');
			}
			$this->data = $this->Relatoriosdesempenho->read(null, $id);
			$this->set('projetos', $this->Relatoriosdesempenho->Projeto->generateList("Projeto.user_created = '$usuario'",'id desc', null, '{n}.Projeto.id', '{n}.Projeto.ds_titulo'));
		} else {
			$this->cleanUpFields();
			if($this->Relatoriosdesempenho->save($this->data)) {
				$this->Session->setFlash('Relatório de desempenho editado com sucesso.');
				$this->redirect('/relatoriosdesempenhos/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
				$this->set('projetos', $this->Relatoriosdesempenho->Projeto->generateList("Projeto.user_created = '$usuario'",'id desc', null, '{n}.Projeto.id', '{n}.Projeto.ds_titulo'));
			}
		}
	}

	function delete($id = null) {
		$this->checkAcess();
    if(!$id) {
			$this->Session->setFlash('ID inválido para Relatoriosdesempenho');
			$this->redirect('/relatoriosdesempenhos/index');
		}
		if($this->Relatoriosdesempenho->del($id)) {
			$this->Session->setFlash('Relatório de desempenho Excluído: id '.$id.'');
			$this->redirect('/relatoriosdesempenhos/index');
		}
	}

}
?>
