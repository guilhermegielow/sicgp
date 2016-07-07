<?php
class ElementoseapsController extends AppController {

	var $name = 'Elementoseaps';
	var $helpers = array('Html', 'Form' , 'Ajax', 'Javascript');

	function index() {
	    $this->checkAcess();
        $usuario = $_SESSION['Usuario'];
		$this->Elementoseap->recursive = 0;
		$this->set('elementoseaps', $this->Elementoseap->findAll("Elementoseap.user_responsavel = '$usuario' or Elementoseap.user_created = '$usuario'",
        '', 'Elementoseap.id desc'));
	}

	function view($id = null) {
		$this->checkAcess();
    if(!$id) {
			$this->Session->setFlash('ID inválido para Elementoseap.');
			$this->redirect('/elementoseaps/index');
		}
		$this->set('elementoseap', $this->Elementoseap->read(null, $id));
	}

	function add() {
    $this->checkAcess();
    $usuario = $_SESSION['Usuario'];

		if(empty($this->data)) {
			$this->set('atividades', $this->Elementoseap->Atividade->generateList("Atividade.user_created = '$usuario'",'id desc', null, '{n}.Atividade.id', '{n}.Atividade.ds_atividade'));
			$this->render();
		} else {
			$this->cleanUpFields();
			if($this->Elementoseap->save($this->data)) {
                //gerar mensagem que o analista possui uma atividade de sua responsabilidade e que o foi solicitado por o usuario x
                $this->Elementoseap->enviaMensagem($this->data['Elementoseap']['atividade_id'],$this->data['Elementoseap']['user_solicitante'], $this->data['Elementoseap']['user_responsavel']);
				$this->Session->setFlash('Elemento da eap inserido com sucesso.');
				$this->redirect('/elementoseaps/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
				$this->set('atividades', $this->Elementoseap->Atividade->generateList("Atividade.user_created = '$usuario'",'id desc', null, '{n}.Atividade.id', '{n}.Atividade.ds_atividade'));
			}
		}
	}

	function edit($id = null) {
    $this->checkAcess();
    $usuario = $_SESSION['Usuario'];
    if(empty($this->data)) {
			if(!$id) {
				$this->Session->setFlash('Id inválido para Elementoseap');
				$this->redirect('/elementoseaps/index');
			}
			$this->data = $this->Elementoseap->read(null, $id);
			$this->set('atividades', $this->Elementoseap->Atividade->generateList("Atividade.user_created = '$usuario'",'id desc', null, '{n}.Atividade.id', '{n}.Atividade.ds_atividade'));
		} else {
			$this->cleanUpFields();
			if($this->Elementoseap->save($this->data)) {
				$this->Session->setFlash('Elemento da eap editado com sucesso.');
				$this->redirect('/elementoseaps/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
				$this->set('atividades', $this->Elementoseap->Atividade->generateList("Atividade.user_created = '$usuario'",'id desc', null, '{n}.Atividade.id', '{n}.Atividade.ds_atividade'));
			}
		}
	}
	function atualizareap($id = null) {
	$usuario = $_SESSION['Usuario'];
    if(empty($this->data)) {
			if(!$id) {
				$this->Session->setFlash('Id inválido para Elementoseap');
				$this->redirect('/elementoseaps/index');
			}
			$this->data = $this->Elementoseap->read(null, $id);
			$this->set('atividades', $this->Elementoseap->Atividade->generateList('','ds_atividade', null, '{n}.Atividade.id', '{n}.Atividade.ds_atividade'));
		} else {
			$this->cleanUpFields();
			if($this->Elementoseap->save($this->data)) {
				$this->Session->setFlash('Elemento da eap atualizado com sucesso.');
				$this->redirect('/elementoseaps/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
				$this->set('atividades', $this->Elementoseap->Atividade->generateList('','ds_atividade', null, '{n}.Atividade.id', '{n}.Atividade.ds_atividade'));
			}
		}
	}

	function delete($id = null) {
		$this->checkAcess();
    if(!$id) {
			$this->Session->setFlash('ID inválido para Elementoseap');
			$this->redirect('/elementoseaps/index');
		}
		if($this->Elementoseap->del($id)) {
			$this->Session->setFlash('Elementoseap Excluído: id '.$id.'');
			$this->redirect('/elementoseaps/index');
		}
	}

}
?>
