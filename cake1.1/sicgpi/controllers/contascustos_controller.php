<?php
class ContascustosController extends AppController {

	var $name = 'Contascustos';
	var $helpers = array('Html', 'Form' , 'Ajax', 'Javascript');

	function index() {
		$this->checkAcess();
    $this->Contascusto->recursive = 0;
		$this->set('contascustos', $this->Contascusto->findAll());
	}

	function view($id = null) {
		$this->checkAcess();
    if(!$id) {
			$this->Session->setFlash('ID inválido para conta.');
			$this->redirect('/contascustos/index');
		}
		$this->set('contascusto', $this->Contascusto->read(null, $id));
	}

	function add() {
		$this->checkAcess();
    if(empty($this->data)) {
			$this->set('estudosviabilidades', $this->Contascusto->Estudosviabilidade->generateList());
			$this->set('selectedEstudosviabilidades', null);
			$this->set('tiposcontas', $this->Contascusto->Tiposconta->generateList(null,'ds_tipo_conta', null, '{n}.Tiposconta.id', '{n}.Tiposconta.ds_tipo_conta'));
			$this->render();
		} else {
			$this->cleanUpFields();
			if($this->Contascusto->save($this->data)) {
				$this->Session->setFlash('Conta inserida com sucesso.');
				$this->redirect('/contascustos/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
				$this->set('estudosviabilidades', $this->Contascusto->Estudosviabilidade->generateList());
				if(empty($this->data['Estudosviabilidade']['Estudosviabilidade'])) { $this->data['Estudosviabilidade']['Estudosviabilidade'] = null; }
				$this->set('selectedEstudosviabilidades', $this->data['Estudosviabilidade']['Estudosviabilidade']);
				$this->set('tiposcontas', $this->Contascusto->Tiposconta->generateList(null,'ds_tipo_conta', null, '{n}.Tiposconta.id', '{n}.Tiposconta.ds_tipo_conta'));
			}
		}
	}

	function edit($id = null) {
		$this->checkAcess();
    if(empty($this->data)) {
			if(!$id) {
				$this->Session->setFlash('Id inválido para conta');
				$this->redirect('/contascustos/index');
			}
			$this->data = $this->Contascusto->read(null, $id);
			$this->set('estudosviabilidades', $this->Contascusto->Estudosviabilidade->generateList());
			if(empty($this->data['Estudosviabilidade'])) { $this->data['Estudosviabilidade'] = null; }
			$this->set('selectedEstudosviabilidades', $this->_selectedArray($this->data['Estudosviabilidade']));
			$this->set('tiposcontas', $this->Contascusto->Tiposconta->generateList(null,'ds_tipo_conta', null, '{n}.Tiposconta.id', '{n}.Tiposconta.ds_tipo_conta'));
		} else {
			$this->cleanUpFields();
			if($this->Contascusto->save($this->data)) {
				$this->Session->setFlash('Conta editada com sucesso.');
				$this->redirect('/contascustos/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
				$this->set('estudosviabilidades', $this->Contascusto->Estudosviabilidade->generateList());
				if(empty($this->data['Estudosviabilidade']['Estudosviabilidade'])) { $this->data['Estudosviabilidade']['Estudosviabilidade'] = null; }
				$this->set('selectedEstudosviabilidades', $this->data['Estudosviabilidade']['Estudosviabilidade']);
				$this->set('tiposcontas', $this->Contascusto->Tiposconta->generateList(null,'ds_tipo_conta', null, '{n}.Tiposconta.id', '{n}.Tiposconta.ds_tipo_conta'));
			}
		}
	}

	function delete($id = null) {
		$this->checkAcess();
    if(!$id) {
			$this->Session->setFlash('ID inválido para conta');
			$this->redirect('/contas/index');
		}
		if($this->Contascusto->del($id)) {
			$this->Session->setFlash('Conta Excluída: id '.$id.'');
			$this->redirect('/contascustos/index');
		}
	}

}
?>
